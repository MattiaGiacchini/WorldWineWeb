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

        public function getLastInsertIntoId() {
            return $this->db->insert_id;
        }

        // ritorna tutti gli stati inseriti a database
        public function getStates(){
            $stmt = $this->db->prepare("SELECT * FROM stato ORDER BY nome ASC ");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        // ritorna tutte le informazioni di un'etichetta attraverso il suo ID
        public function getLabelFromId($idLabel) {
            $query = "SELECT e.nome as nomeEtichetta, c.nome as nomeCantina, c.*  FROM etichetta e, cantina c WHERE idEtichetta = ? AND e.idCantina = c.idCantina";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$idLabel);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(count($result)==0) {
                return null;
            } else {
                return $result[0];
            }
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

        // restituisce l'id di una cantina
        public function getVitignoId($coloreBacca, $nomeSpecie) {
            $query = "SELECT idVitigno FROM vitigno WHERE coloreBacca = ? AND nomeSpecie = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$coloreBacca, $nomeSpecie);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(count($result)==0) {
                return null;
            } else {
                return $result[0]["idVitigno"];
            }
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

        // restituisce l'id di una cantina
        public function getMentionId($menzione) {
            $query = "SELECT idMenzione FROM menzione WHERE menzione = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$menzione);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if(count($result)==0) {
                return null;
            } else {
                return $result[0]["idMenzione"];
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
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        // aggiunge una nuova valutazione al prodotto
        public function addNewEvaluationProduct($idLabel, $idContainer, $price, $iva) {
            $query = "INSERT INTO `prezzo` (`idContenitore`, `idEtichetta`, `data`, `prezzo`, `iva`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssdd', $idContainer, $idLabel, $this->getCurrentDateTime(), $price, $iva);

            return $stmt->execute();
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
            $stmt->bind_param('ss', $coloreBacca, $nomeSpecie);

            return $stmt->execute();
        }

        // aggiunge una nuova cantina a database
        public function addNewMention($mention) {
            $query = "INSERT INTO `menzione` (`idMenzione`, `menzione`) VALUES (NULL, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $mention);

            return $stmt->execute();
        }

        public function addNewWine($categoria, $nome, $description, $color, $alcol, $zucchero, $gas, $idCantina, $solfiti, $bio, $tMin, $tMax, $classificazione, $idVitigno, $annata, $ig, $idMenzione, $specificazione) {
            if($solfiti === "true") {
                $solfiti = 1;
            } else {
                $solfiti = 0;
            }
            if($bio === "true") {
                $bio = 1;
            } else {
                $bio = 0;
            }
            $query = "INSERT INTO `etichetta` (`idEtichetta`, `nome`, `descrizione`, `colore`, `titoloAlcolico`, `solfiti`, `bio`, `categoria`, `tenoreZuccherino`, `temperaturaMinima`, `temperaturaMassima`, `classificazione`, `gas`, `annata`, `indicazioneGeografica`, `specificazione`, `vitigno`, `menzione`, `idCantina`) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssdiissddssissiii', $nome, $description, $color, $alcol, $solfiti, $bio, $categoria, $zucchero, $tMin, $tMax, $classificazione, $gas, $annata, $ig, $specificazione, $idVitigno, $idMenzione, $idCantina);

            return $stmt->execute();
        }

        public function addNewSpumante($categoria, $nome, $description, $colore, $alcol, $zucchero, $idCantina, $solfiti, $biologico, $tMin, $tMax) {
            return $this->addNewWine($categoria, $nome, $description, $colore, $alcol, $zucchero, null, $idCantina, $solfiti, $biologico, $tMin, $tMax, null, null, null, null, null, null);
        }

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
            $query = "SELECT e.nome AS NomeVino, cantina.nome AS NomeCantina, p.prezzo, v.scorteMagazzino, c.capacita FROM contenitore AS c JOIN etichetta AS e JOIN prezzo_recente AS p JOIN vino_confezionato AS v JOIN cantina ON (v.idContenitore = c.idContenitore) AND (v.idEtichetta = e.idEtichetta) AND (v.idContenitore = p.idContenitore) AND (v.idEtichetta = p.idEtichetta) AND (e.idCantina = cantina.idCantina) WHERE v.idContenitore = ? AND v.idEtichetta = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $idContenitore, $idEtichetta);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getWarehouseProducts()
        {
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "decrescente") {
                $sort = "ORDER BY attivo DESC, e.nome DESC, cantina.nome ASC";
            } else {
                $sort = "ORDER BY attivo DESC, e.nome, cantina.nome ASC";
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
            }

            $query = "SELECT e.nome AS NomeVino, cantina.nome AS NomeCantina, p.prezzo, v.scorteMagazzino, c.capacita, v.idEtichetta, v.idContenitore, v.attivo FROM contenitore AS c JOIN etichetta AS e JOIN prezzo_recente AS p JOIN vino_confezionato AS v JOIN cantina ON (v.idContenitore = c.idContenitore) AND (v.idEtichetta = e.idEtichetta) AND (v.idContenitore = p.idContenitore) AND (v.idEtichetta = p.idEtichetta) AND (e.idCantina = cantina.idCantina) WHERE p.idContenitore = v.idContenitore AND p.idEtichetta = v.idEtichetta " . $statusWhereCondition . " " . $sort;
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
                $sort = "ORDER BY attivo DESC, cognome DESC, nome ASC";
            } else {
                $sort = "ORDER BY attivo DESC, cognome, nome ASC";
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

        public function getAllOrders(){
            $query = "SELECT o.idOrdine, o.data, o.statoDiAvanzamento, tot.totaleOrdine FROM ordine o JOIN totale_ordine tot ON (o.idOrdine = tot.idOrdine) WHERE 1" . $this->getOrderFilters();

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        public function getClientOrders($userId){
            $query = "SELECT o.idOrdine, o.data, o.statoDiAvanzamento, tot.totaleOrdine FROM ordine o JOIN totale_ordine tot ON o.idOrdine = tot.idOrdine WHERE o.idCliente = ? " . $this->getOrderFilters();
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        private function getOrderFilters(){
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "decrescente") {
                $sort = "ORDER BY o.data DESC";
            } else {
                $sort = "ORDER BY o.data ASC";
            }

            $status = [];
            if (isset($_GET["accettazione"])) {
                array_push($status, "accettazione");
            }

            if (isset($_GET["approvato"])) {
                array_push($status, "approvato");
            }

            if (isset($_GET["elaborazione"])) {
                array_push($status, "elaborazione");
            }

            if (isset($_GET["spedito"])) {
                array_push($status, "spedito");
            }

            if (isset($_GET["consegnato"])) {
                array_push($status, "consegnato");
            }

            if (isset($_GET["annullato"])) {
                array_push($status, "annullato");
            }

            $statusWhereCondition = "";
            if (!empty($status)) {
                array_walk($status, function(&$status) {$status = "'$status'";});
                $statusWhereCondition = " AND statoDiAvanzamento IN (" . implode(', ', $status) . ")";
            }

            return $statusWhereCondition . " " . $sort;

        }

        public function getWineLabels() {
            if (isset($_GET["ordine"]) && $_GET["ordine"] === "decrescente") {
                $sort = "ORDER BY vino DESC, cantina ASC, annata DESC";
            } else {
                $sort = "ORDER BY vino ASC, cantina ASC, annata DESC";
            }

            $query = "SELECT e.idEtichetta, e.nome as vino, c.nome as cantina, c.stato, e.annata, e.indicazioneGeografica as origine, e.colore FROM etichetta e JOIN cantina c ON (e.idCantina = c.idCantina) " . $sort;
            $stmt = $this->db->prepare($query);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        public function getCartProducts($userId) {
            $query = "SELECT e.nome AS NomeVino, cantina.nome AS NomeCantina, p.prezzo, v.scorteMagazzino, c.capacita, v.idEtichetta, v.idContenitore, v.attivo, carrello.quantita, IF(carrello.quantita > v.scorteMagazzino, v.scorteMagazzino, carrello.quantita) as quantitaDefinitiva FROM contenitore AS c JOIN etichetta AS e JOIN prezzo_recente AS p JOIN vino_confezionato AS v JOIN cantina JOIN carrello ON (v.idContenitore = c.idContenitore) AND (v.idEtichetta = e.idEtichetta) AND (v.idContenitore = p.idContenitore) AND (v.idEtichetta = p.idEtichetta) AND (e.idCantina = cantina.idCantina) AND (carrello.idEtichetta = v.idEtichetta) AND (carrello.idContenitore = v.idContenitore) WHERE p.idContenitore = v.idContenitore AND p.idEtichetta = v.idEtichetta AND carrello.idCliente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        public function getCartValue($userId) {
            $query = "SELECT sum(totale_prodotto_carrello.totaleProdotto) AS totaleCarrello FROM totale_prodotto_carrello WHERE idCliente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result[0]["totaleCarrello"];
        }

        public function getUserAddresses($userId) {
            $query = "SELECT * FROM indirizzo WHERE idCliente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

        public function getUserPayments($userId) {
            $query = "SELECT * FROM metodo_di_pagamento WHERE idCliente = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $userId);

            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        }

    }
?>
