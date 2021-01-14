<?php

    class Database{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
        }

        public function insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore){
            $query = "INSERT INTO articolo (titoloarticolo, testoarticolo, anteprimaarticolo, dataarticolo, imgarticolo, autore) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssi',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
            $stmt->execute();

            return $stmt->insert_id;
        }

        public function checkLogin($username, $password){
            $query = "SELECT idautore, username, nome FROM autore WHERE attivo=1 AND username = ? AND password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
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
