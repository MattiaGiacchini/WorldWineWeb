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
            $stmt->bind_param('i',$idUtente);
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
            $stmt->bind_param('ss',$email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        // aggiunge un nuovo utente business a database
        public function addNewBusinessUser($email, $psw, $company, $pIva){
            return $this->addNewUser($email, $psw, 'client', null, null, null, null, $company, $pIva);
        }

        // aggiunge un nuovo utente private a database
        public function addNewPrivateUser($email, $psw, $name, $surname, $cf, $birthday) {
            return $this->addNewUser($email, $psw, 'client', $name, $surname, $cf, $birthday, null, null);
        }

        // aggiunge un nuovo utente collaboratore a database
        public function addNewCollaboratorUser($email, $psw, $name, $surname, $cf, $birthday) {
            return $this->addNewUser($email, $psw, 'collaborator', $name, $surname, $cf, $birthday, null, null);
        }

        // aggiunge un nuovo utente amministratore a database
        public function addNewAdminUser($email, $psw, $name, $surname, $cf, $birthday) {
            return $this->addNewUser($email, $psw, 'admin', $name, $surname, $cf, $birthday, null, null);
        }

        private function addNewUser($email, $psw, $ruolo, $name, $surname, $cf, $birthday, $company, $pIva) {
            $query = "INSERT INTO `utente` (`idUtente`, `email`, `password`, `ruolo`, `nome`, `cognome`, `dataDiNascita`, `cf`, `partitaIva`, `ragioneSociale`)
                      VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssssis',$email, $psw, $ruolo, $name, $surname, $birthday, $cf, $pIva, $company);

            return $stmt->execute();
        }

        public function getCurrentDateTime() {
            return date("Y-m-d H:i:s");
        }

        public function warehouseLoad($idContenitore, $idEtichetta, $collaboratore, $amount){
            $currentdate = $this->getCurrentDateTime();
            $query = "INSERT INTO modifica_scorte(idContenitore, idEtichetta, idCollaboratore, quantita, data) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iiiis", $idContenitore, $idEtichetta, $collaboratore, $amount, $currentdate);
            $stmt->execute();
        }

        public function getWarehouseLoad($idContenitore, $idEtichetta) {
            $query = "SELECT quantita, data, nome, cognome FROM modifica_scorte JOIN utente WHERE modifica_scorte.idCollaboratore = utente.idUtente AND modifica_scorte.idContenitore = ? AND modifica_scorte.idEtichetta = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }


    }
?>
