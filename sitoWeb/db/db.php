<?php

    class Database{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
        }

        // ritorna tutti gli stati inseriti a database
        public function getAllStates(){
            $stmt = $this->db->prepare("SELECT * FROM stato");
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        // restituisce il ruolo ricoperto dall'utente di cui viene passato il suo id
        public function getUserRole($idUtente){
            $query = "SELECT ruolo FROM utente WHERE idUtente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $idUtente);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(count($result)==0) {
                return false;
            } else {
                return $result[0]["ruolo"];
            }
        }

        // restituisce l'id dell'utente se password e email vengono riconosciute
        public function checkLogin($email, $password){
            $query = "SELECT idUtente FROM utente WHERE email = ? AND password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        // aggiunge un nuovo utente business a database
        public function addNewBusinessUser($email, $psw, $company, $pIva){
            return true;
        }

        // aggiunge un nuovo utente private a database
        public function addNewPrivateUser($email, $psw, $name, $surname, $cf, $birthday) {
            return true;
        }
/*
        public function insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore){
            $query = "INSERT INTO articolo (titoloarticolo, testoarticolo, anteprimaarticolo, dataarticolo, imgarticolo, autore) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssi',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
            $stmt->execute();

            return $stmt->insert_id;
        }
*/
        private function getCurrentDateTime() {
            return date("Y-m-d H:i:s");
        }

        public function warehouseLoad($idEtichetta, $idContenitore, $collaboratore, $amount){
            $currentdate = $this->getCurrentDateTime();
            $query = "INSERT INTO modifica_scorte(idContenitore, idEtichetta, idCollaboratore, quantita, data) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iiiis", $idContenitore, $idEtichetta, $collaboratore, $amount, $currentdate);
            $stmt->execute();

            $this->updateWarehouseAvailability($idEtichetta, $idContenitore, $amount);
        }

        public function getWarehouseMovements($idEtichetta, $idContenitore ) {
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "crescente") {
                $sort = "ASC";
            } else {
                $sort = "DESC";
            }

            $query = "SELECT quantita, data, nome, cognome FROM modifica_scorte JOIN utente ON (modifica_scorte.idCollaboratore = utente.idUtente) WHERE modifica_scorte.idContenitore = ? AND modifica_scorte.idEtichetta = ? ORDER BY data " . $sort;
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        private function updateWarehouseAvailability($idEtichetta, $idContenitore, $amount){
            $query = "SELECT SUM(quantita) as 'QuantitaDisponibile' FROM modifica_scorte WHERE idContenitore = ? AND idEtichetta = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta);
            $stmt->execute();
            $oldAmount = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $finalAmount = intval($oldAmount[0]["QuantitaDisponibile"]);

            $query = "UPDATE vino_confezionato SET scorteMagazzino = ? WHERE idContenitore = ? AND idEtichetta = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii', $finalAmount, $idContenitore, $idEtichetta);
            $stmt->execute();
        }

        public function getProductDetails($idEtichetta, $idContenitore)
        {
            $query = "SELECT e.nome AS NomeVino, cantina.nome AS NomeCantina, p.prezzo, v.scorteMagazzino, c.capacita FROM contenitore AS c JOIN etichetta AS e JOIN prezzo AS p JOIN vino_confezionato AS v JOIN cantina ON (v.idContenitore = c.idContenitore) AND (v.idEtichetta = e.idEtichetta) AND (v.idContenitore = p.idContenitore) AND (v.idEtichetta = p.idEtichetta) AND (e.idCantina = cantina.idCantina) WHERE v.idContenitore = ? AND v.idEtichetta = ? ORDER BY p.data DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getWarehouseProducts()
        {
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "decrescente") {
                $sort = "ORDER BY e.nome DESC, cantina.nome ASC";
            } else {
                $sort = "ORDER BY e.nome, cantina.nome ASC";
            }

            $status = [];
            if (isset($_GET["attivo"])) {
                array_push($status, 1);
            }

            if (isset($_GET["disattivato"])) {
                array_push($status, 0);
            }

            $statusWhereCondition = "";
            if (!empty($status)) {
                $statusWhereCondition = "AND v.attivo IN (" . implode(", ", $status) . ")";
                echo $statusWhereCondition;
            }

            $query = "SELECT e.nome AS NomeVino, cantina.nome AS NomeCantina, p.prezzo, v.scorteMagazzino, c.capacita, v.idEtichetta, v.idContenitore, v.attivo FROM contenitore AS c JOIN etichetta AS e JOIN prezzo AS p JOIN vino_confezionato AS v JOIN cantina ON (v.idContenitore = c.idContenitore) AND (v.idEtichetta = e.idEtichetta) AND (v.idContenitore = p.idContenitore) AND (v.idEtichetta = p.idEtichetta) AND (e.idCantina = cantina.idCantina) WHERE p.data = (SELECT MAX(data) FROM prezzo WHERE prezzo.idContenitore = v.idContenitore AND prezzo.idEtichetta = v.idEtichetta) " . $statusWhereCondition . " " . $sort;
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        }

        /*NOT ACTUALY USED TODO*/
        private function getProductAvailability($idEtichetta, $idContenitore) {
            $query = "SELECT scorteMagazzino FROM vino_confezionato WHERE idContenitore = ? AND idEtichetta = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta );
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result[0]["scorteMagazzino"];
        }

        public function getCollaborators() {
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "decrescente") {
                $sort = "ORDER BY cognome DESC, nome ASC";
            } else {
                $sort = "ORDER BY cognome, nome ASC";
            }

            $status = [];
            if (isset($_GET["attivo"])) {
                array_push($status, 1);
            }

            if (isset($_GET["disattivato"])) {
                array_push($status, 0);
            }

            $statusWhereCondition = "";
            if (!empty($status)) {
                $statusWhereCondition = "AND attivo IN (" . implode(", ", $status) . ")";
            }

            $query = "SELECT cognome, nome, idUtente, attivo FROM utente WHERE (ruolo = 'admin' OR ruolo = 'collaborator') " . $statusWhereCondition . " " . $sort;
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

    }
?>
