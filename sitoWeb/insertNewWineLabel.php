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

    function secureUnset(&$array) {
        $size = sizeof($array);
        for ($i=0; i<sizeof($cars); $i++) {
            $array[$i] = null;
        }
    }

    function checkVitigno() {
        return !isset($_POST["vitigno"]) || (isset($_POST["vitigno"]) && (is_numeric($_POST["vitigno"]) || (in_array($_POST["coloreBaccaNuovoVitigno"], array("Chiara", "Nera")) && (strlen($_POST["nomeNuovoVitigno"]) < 50))));
    }

    function checkAnnata($required) {
        return (isset($_POST["anno"]) || !$required) && is_numeric($_POST["anno"]) && inRange($_POST["anno"], 1900, 2099);
    }

    function checkCertficateIg($required){
        return (isset($_POST["indicazioneGeografica"]) || !$required) && strlen($_POST["indicazioneGeografica"]) < 100;
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
                $tmp = array($_POST["vitigno"], $_POST["menzione"], $_POST["anno"], $_POST["indicazioneGeografica"], $_POST["specificazione"]);
                secureUnset($tmp);
                return true;
            } else if ($_POST["classificazione"] === "Varietale"){
                $tmp = array($_POST["menzione"], $_POST["indicazioneGeografica"], $_POST["specificazione"]);
                secureUnset($tmp);
                return checkVarietale();
            } else if (in_array($_POST["classificazione"], array("IGT", "IGP"))) {
                $tmp = array($_POST["menzione"], $_POST["specificazione"]);
                secureUnset($tmp);
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
        && strlen($_POST["description"]) <= 500
        && (is_numeric($_POST["cantina"]) || $_POST["cantina"]==="new")
        && in_array($_POST["solfiti"], $boolean)
        && in_array($_POST["biologico"], $boolean)
        && ((isset($_POST["tMax"]) && is_numeric($_POST["tMax"]) && inRange($_POST["tMax"], 0.0, 100.0)) || !isset($_POST["tMax"]))
        && ((isset($_POST["tMin"]) && is_numeric($_POST["tMin"]) && inRange($_POST["tMin"], 0.0, 100.0)) || !isset($_POST["tMin"]))
        && (isset($_POST["tMin"],$_POST["tMax"]) && $_POST["tMin"] < $_POST["tMax"]);
    }

    // VERIFICO CHE L'UTENTE SIA LOGGATO E CHE SIA L'AMMINISTRATORE
    if(isUserLoggedIn() && getUserRole() === "admin") {

        // VERIFICO CHE I PARAMETRI PRINCIPALI SIANO STATI IMPOSTATI
        if(basicInputCheck()) {
            $idCantina = null;
            $tMin = isset($_POST["tMin"]) ? $_POST["tMin"] : null;
            $tMax = isset($_POST["tMax"]) ? $_POST["tMax"] : null;
            // VERIFICO SE LA CANTINA SIA DA REGISTRARE O SE E' GIA' STATA INSERITA!!
            if($_POST["cantina"] === "new" && isset($_POST["nomeCantina"], $_POST["statoCantina"])) {
                $idCantina = $dataBase->getWineryId($_POST["nomeCantina"], $_POST["statoCantina"]);
                if($idCantina == null) {
                    if(!$dataBase->addNewWinery($_POST["nomeCantina"], $_POST["statoCantina"])) {
                        callBackWithError("L'inserimento della nuova cantina è fallito!");
                    }
                    $idCantina = $dataBase->getWineryId($_POST["nomeCantina"], $_POST["statoCantina"]);
                }
            } else {
                $idCantina = $_POST["cantina"];
            }

            // CONTROLLO SE QUELLO DA INSERIRE E' UN VINO OPPURE UNO SPUMANTE
            switch ($_POST["categoria"]) {
                case "Vino":
                    if(wineInputCheck()) { // VERIFICO PRIMA TUTTI I PARAMETRI PASSATI IN INGRESSO
                        $idVitigno = null;
                        $idMenzione = null;
                        $annata = isset($_POST["anno"]) ? $_POST["anno"] : null;
                        $ig = isset($_POST["indicazioneGeografica"]) ? $_POST["indicazioneGeografica"] : null;

                        // CARICO L'EVENTUALE NUOVA VARIETA DI VITIGNO
                        if(isset($_POST["vitigno"], $_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"]) && $_POST["vitigno"] === "new"){
                            $idVitigno = $dataBase->getVitignoId($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"]);
                            if($idVitigno == null) {
                                if(!$dataBase->addNewVitigno($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"])) {
                                    callBackWithError("L'inserimento del nuovo Vitigno è fallito!");
                                }
                                $idVitigno = $dataBase->getVitignoId($_POST["coloreBaccaNuovoVitigno"], $_POST["nomeNuovoVitigno"]);
                            }
                        } else if (isset($_POST["vitigno"])) {
                            $idVitigno = $_POST["vitigno"];
                        }

                        // CARICO L'EVENTUALE NUOVA MENZIONE
                        if(isset($_POST["menzione"], $_POST["newMenzione"]) && $_POST["menzione"] === "new") {
                            $idMenzione = $dataBase->getMentionId($_POST["newMenzione"]);
                            if($idMenzione == null) {
                                if(!$dataBase->addNewMention($_POST["newMenzione"])) {
                                    callBackWithError("L'inserimento della nuova menzione è fallito!");
                                }
                                $idMenzione = $dataBase->getMentionId($_POST["newMenzione"]);
                            }
                        } else if(isset($_POST["menzione"])) {
                            $idMenzione = $_POST["menzione"] == "0" ? null : $_POST["menzione"];
                        }

                        // EFFETTUO L'EFFETTIVO INSERIMENTO A DATABASE DELLA NUOVA ETICHETTA
                        $dataBase->addNewWine($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $_POST["gas"], $idCantina, $_POST["solfiti"], $_POST["biologico"], $tMin, $tMax,
                        $_POST["classificazione"], $idVitigno, $annata, $ig, $idMenzione, $_POST["specificazione"]);
                    } else {
                        callBackWithError("inserimento annullato! Ricontrollare i dati inseriti del vino");
                    }
                    break;

                case "Spumante":
                    $dataBase->addNewSpumante($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $idCantina, $_POST["solfiti"], $_POST["biologico"], $tMin, $tMax );
                    break;

                default:
                    callBackWithError("inserimento annullato! Dati incoerenti!!");
                    break;
            }

            $result = $dataBase->getLastInsertIntoId();
            if($result == 0) {
                callBackWithError("inserimento annullato! Database non risponde");
            } else {
                header("Location:./editProduct.php?idEtichetta=".$result);
            }
        } else {
            callBackWithError("inserimento annullato! Errore con i dati inseriti");
        }
    } else {
        header("Location:./index.php");
    }
?>
