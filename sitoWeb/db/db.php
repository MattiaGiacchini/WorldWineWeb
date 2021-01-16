<?php

    class Database{
        private $basicUser = "user";
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
            $this->db->query("SET NAMES 'utf8'");
        }

        // ritorna tutti gli stati inseriti a database
        public function getStates(){
            $stmt = $this->db->prepare("SELECT * FROM stato ORDER BY nome ASC ");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        // ritorna tutte le mezioni
        public function getMentions() {
            $stmt = $this->db->prepare("SELECT * FROM menzione ORDER BY menzione.menzione ASC ");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        // ritorna tutte i vitigni
        public function getVitigni() {
            $stmt = $this->db->prepare("SELECT * FROM vitigno ORDER BY vitigno.coloreBacca, vitigno.nomeSpecie ASC");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        }

        // ritorna tutte le cantine
        public function getCantine() {
            $stmt = $this->db->prepare("SELECT idCantina, stato.nome as nomeStato, cantina.nome as nomeCantina FROM cantina, stato WHERE cantina.stato = stato.sigla ORDER BY stato.nome, cantina.nome ASC");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        }

        // restituisce l'id di una cantina
        public function getWineryId($nomeCantina, $idStatoCantina) {
            $query = "SELECT idCantina FROM cantina WHERE nome = ? AND stato = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$nomeCantina, $idStatoCantina);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(count($result)==0) {
                return null;
            } else {
                return $result[0]["idCantina"];
            }
        }

        // restituisce il ruolo ricoperto dall'utente di cui viene passato il suo id
        public function getUserRole($idUtente) {
            if(isset($idUtente)) {
                $query = "SELECT ruolo FROM utente WHERE idUtente = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('i',$idUtente);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if(count($result)==0) {
                    return $this->basicUser;
                } else {
                    return $result[0]["ruolo"];
                }
            }
            return $this->basicUser;
        }

        // restituisce l'id dell'utente se password e email vengono riconosciute
        public function checkLogin($email, $password){
            $query = "SELECT idUtente, nome, cognome, ragioneSociale FROM utente WHERE email = ? AND password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$email, $password);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
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

        // funzione privata per aggiungere un nuovo utente
        private function addNewUser($email, $psw, $ruolo, $name, $surname, $cf, $birthday, $company, $pIva) {
            $query = "INSERT INTO `utente` (`idUtente`, `email`, `password`, `ruolo`, `nome`, `cognome`, `dataDiNascita`, `cf`, `partitaIva`, `ragioneSociale`)
                      VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssssis',$email, $psw, $ruolo, $name, $surname, $birthday, $cf, $pIva, $company);

            return $stmt->execute();
        }

        // aggiunge una nuova cantina a database
        public function addNewWinery($winery, $state) {
            $query = "INSERT INTO `cantina` (`idCantina`, `nome`, `stato`) VALUES (NULL, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $winery, $state);

            return $stmt->execute();
        }

        // aggiunge una nuova cantina a database
        public function addNewVitigno($coloreBacca, $nomeSpecie) {
            $query = "INSERT INTO `vitigno` (`idVitigno`, `coloreBacca`, `nomeSpecie`) VALUES (NULL, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $winery, $state);

            return $stmt->execute();
        }

        // aggiunge una nuova cantina a database
        public function addNewMention($mention) {
            $query = "INSERT INTO `menzione` (`idMenzione`, `menzione`) VALUES (NULL, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $mention);

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
