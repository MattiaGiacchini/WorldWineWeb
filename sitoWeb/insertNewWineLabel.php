<?php
    require_once("utils/headerFunction.php");

    // funzione che blocca l'inserimento e rispedisce l'utente al form di inserimento!!
    function callBackWithError($msg) {
       $_SESSION["msgError"] = $msg;
       header("Location:./newWineLabel.php");
    }

    function inRange($variable, $min, $max) {
        return $variable >= $min && $variable <= $max;
    }

    function checkVitigno() {
        return !isset($_POST["vitigno"])
        || $_POST["vitigno"] === ''
        || is_numeric($_POST["vitigno"])
        || (isset($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"])
            && in_array($_POST["coloreBaccaNuovoVitigno"], array("Chiara", "Nera"))
            && strlen($_POST["nomeNuovoVitigno"]) > 0);
    }

    function checkAnnata($required) {
        return ($required && isset($_POST["anno"]) && is_numeric($_POST["anno"]) && inRange($_POST["anno"], 1900, 2099))
           || (!$required && (!isset($_POST["anno"])
                            || $_POST["anno"] ===''
                            || (is_numeric($_POST["anno"]) && inRange($_POST["anno"], 1900, 2099))));
    }

    function checkCertficateIg($required){
        return ($required && isset($_POST["indicazioneGeografica"]) && strlen($_POST["indicazioneGeografica"]) < 100 && strlen($_POST["indicazioneGeografica"]) > 0)
            || (!$required && (!isset($_POST["indicazioneGeografica"])
                                || $_POST["anno"] ===''
                                || strlen($_POST["indicazioneGeografica"]) < 100));
    }

    function checkSpecificazione() {
       return !isset($_POST["specificazione"]) || (isset($_POST["specificazione"]) && in_array($_POST["specificazione"], array("Nessuna", "Storica", "Classica")));
    }

    function checkVarietale() { return checkAnnata(false) && checkVitigno(); }

    function checkIg() { return checkVarietale() && checkCertficateIg(true); }

    function checkDo(){
        return checkAnnata(true) && checkVitigno() && checkCertficateIg(false) && checkSpecificazione();
    }

    function wineInputCheck() {
        $gas = array("Fermo", "Frizzante");
        $classificazioni = array("Generico", "Varietale", "DOC", "DOP", "DOCG", "IGT", "IGP");

        if(isset($_POST["classificazione"]) && in_array($_POST["classificazione"], $classificazioni)
            && isset($_POST["gas"]) && in_array($_POST["gas"], $gas)) {
            if($_POST["classificazione"] === "Generico") {
                unset($_POST["vitigno"], $_POST["menzione"], $_POST["anno"], $_POST["indicazioneGeografica"], $_POST["specificazione"]);
                return true;
            } else if ($_POST["classificazione"] === "Varietale"){
                unset($_POST["menzione"], $_POST["indicazioneGeografica"], $_POST["specificazione"]);
                return checkVarietale();
            } else if (in_array($_POST["classificazione"], array("IGT", "IGP"))) {
                unset($_POST["menzione"], $_POST["specificazione"]);
                return checkIg();
            } else if(in_array($_POST["classificazione"], array("DOC", "DOP", "DOCG"))){
                return checkDo();
            }
        }
        return false;
    }

    function basicInputCheck() {
        $tenoriZuccherini = array("Brut Nature", "Extra Brut", "Brut", "Extra Dry", "Dry", "Demi Sec", "Dolce", "Secco", "Abboccato", "Amabile");
        $categorie = array("Vino", "Spumante");
        $colori = array("Rosso", "Rosato", "Bianco");
        $boolean = array("true", "false");

        return isset($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $_POST["cantina"], $_POST["solfiti"], $_POST["biologico"], $_POST["cantina"])
        && in_array($_POST["categoria"], $categorie)
        && in_array($_POST["colore"], $colori)
        && in_array($_POST["zucchero"], $tenoriZuccherini)
        && is_numeric($_POST["alcol"])
        && inRange($_POST["alcol"], 0.0, 100.0)
        && strlen($_POST["nome"]) <= 50
        && (is_numeric($_POST["cantina"]) || $_POST["cantina"]==="new")
        && in_array($_POST["solfiti"], $boolean)
        && in_array($_POST["biologico"], $boolean);
    }

    // VERIFICO CHE L'UTENTE SIA LOGGATO E CHE SIA L'AMMINISTRATORE
    if(isUserLoggedIn() && getUserRole() === "admin") {

        // VERIFICO CHE I PARAMETRI PRINCIPALI SIANO STATI IMPOSTATI
        if(basicInputCheck()) {

            $tMin = isset($_POST["tMin"]) ? $_POST["tMin"] : null;
            $tMax = isset($_POST["tMax"]) ? $_POST["tMax"] : null;

            if(strlen($_POST["description"]) > 500) {
                $_POST["description"] = substr($_POST["description"], 0, 500);
            }

            // VERIFICO SE LA CANTINA SIA DA REGISTRARE O SE E' GIA' STATA INSERITA!!
            $idCantina = null;
            if($_POST["cantina"] === "new" && isset($_POST["nomeCantina"], $_POST["statoCantina"])) {
                $idCantina = $dataBase->getWineryId($_POST["nomeCantina"], $_POST["statoCantina"]);
                if($idCantina == null) {
                    if(!$dataBase->addNewWinery($_POST["nomeCantina"], $_POST["statoCantina"])) {
                        callBackWithError("L'inserimento della nuova cantina è fallito!");
                    }
                    $idCantina = $dataBase->getLastInsertIntoId();
                }
            } else {
                $idCantina = $_POST["cantina"];
            }

            // CONTROLLO SE QUELLO DA INSERIRE E' UN VINO OPPURE UNO SPUMANTE
            switch ($_POST["categoria"]) {

                case "Vino":
                    if(wineInputCheck()) { // VERIFICO PRIMA TUTTI I PARAMETRI PASSATI IN INGRESSO

                        $annata = isset($_POST["anno"]) ? $_POST["anno"] : null;
                        $annata = $annata == '' ? null : $annata;

                        $ig = isset($_POST["indicazioneGeografica"]) ? $_POST["indicazioneGeografica"] : null;
                        $ig = $ig === '' ? null : $ig;

                        // CARICO L'EVENTUALE NUOVA VARIETA DI VITIGNO
                        $idVitigno = null;
                        if(isset($_POST["vitigno"], $_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"]) && $_POST["vitigno"] === "new"){
                            $idVitigno = $dataBase->getVitignoId($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"]);
                            if($idVitigno == null) {
                                if(!$dataBase->addNewVitigno($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"])) {
                                    callBackWithError("L'inserimento del nuovo Vitigno è fallito!");
                                }
                                $idVitigno = $dataBase->getLastInsertIntoId();
                            }
                        } else if (isset($_POST["vitigno"])) {
                            $idVitigno = $_POST["vitigno"];
                        }

                        // CARICO L'EVENTUALE NUOVA MENZIONE
                        $idMenzione = null;
                        if(isset($_POST["menzione"], $_POST["newMenzione"]) && $_POST["menzione"] === "new") {
                            $idMenzione = $dataBase->getMentionId($_POST["newMenzione"]);
                            if($idMenzione == null) {
                                if(!$dataBase->addNewMention($_POST["newMenzione"])) {
                                    callBackWithError("L'inserimento della nuova menzione è fallito!");
                                }
                                $idMenzione = $dataBase->getLastInsertIntoId();
                            }
                        } else if(isset($_POST["menzione"])) {
                            $idMenzione = $_POST["menzione"] == "0" ? null : $_POST["menzione"];
                            $idMenzione = $idMenzione == '' ? null : $idMenzione;
                        }

                        // EFFETTUO L'EFFETTIVO INSERIMENTO A DATABASE DELLA NUOVA ETICHETTA
                        $dataBase->addNewWine($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $_POST["gas"], $idCantina, $_POST["solfiti"], $_POST["biologico"], $tMin, $tMax,
                        $_POST["classificazione"], $idVitigno, $annata, $ig, $idMenzione, $_POST["specificazione"]);
                    } else {
                        callBackWithError("inserimento annullato! Errore dati specifici per Vino!");
                    }
                    break;

                case "Spumante":
                    $dataBase->addNewSpumante($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $idCantina, $_POST["solfiti"], $_POST["biologico"], $tMin, $tMax );
                    break;

                default:
                    callBackWithError("inserimento annullato! Categoria non considerata!!");
                    break;
            }

            $result = $dataBase->getLastInsertIntoId();
            if($result == 0) {
                callBackWithError("inserimento annullato! il database non ha prodotto l'id.");
            } else {
                header("Location:./editProduct.php?idEtichetta=".$result);
            }
        } else {
            callBackWithError("inserimento annullato! Errore con i dati comuni");
        }
    } else {
        header("Location:./index.php");
    }
?>
