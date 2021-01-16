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

    function secureUnset($array) {
        $num = count($array);
        for($i = 0; $i < $num; $i++) {
            if(isset($var[$i])) {
                unset($var[$i]);
            }
        }
    }

    function wineInputCheck() {
        $gas = array("Fermo", "Frizzante");
        $classificazioni = array("Generico", "Varietale", "DOC", "DOP", "DOCG", "IGT", "IGP");
        $specificazioni = arrat("Nessuna", "Storica", "Classica");

        if(isset($_POST["classificazione"]) && in_array($_POST["classificazione"], $classificazioni)
            && isset($_POST["gas"]) && in_array($_POST["gas"], $gas)) {
            switch ($_POST["classificazione"]) {
                case "Generico":
                    secureUnset(array($_POST[""], $_POST[""]));
                    return true;
                    break;
            }
        }
        return false;
    }

    function basicInputCheck() {
        $tenoriZuccherini = array("Brut Nature", "Extra Brut", "Brut", "Extra Dry", "Dry", "Demi Sec", "Dolce", "Secco", "Abboccato", "Amabile");
        $categorie = array("Vino", "Spumante");
        $colori = array("Rosso", "Rosato", "Bianco");
        $boolean = array("true", "false");

        return isset($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $_POST["cantina"], $_POST["solfiti"], $_POST["biologico"])
        && in_array($_POST["categoria"], $categorie)
        && in_array($_POST["colore"], $colori)
        && in_array($_POST["zucchero"], $tenoriZuccherini)
        && inRange($_POST["alcol"], 0.0, 100.0)
        && strlen($_POST["nome"]) <= 50)
        && strlen($_POST["description"] <= 500)
        && is_numeric($_POST["cantina"])
        && in_array($_POST["cantina"], $boolean)
        && in_array($_POST["biologico"], $boolean);
    }

    // VERIFICO CHE L'UTENTE SIA LOGGATO E CHE SIA L'AMMINISTRATORE
    if(isUserLoggedIn() && getUserRole() === "admin") {

        // VERIFICO CHE I PARAMETRI PRINCIPALI SIANO STATI IMPOSTATI
        if(basicInputCheck()) { // TODO:

            // VERIFICO SE LA CANTINA SIA DA REGISTRARE O SE E' GIA' STATA INSERITA!!
            $idCantina = null;
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
                            $idMenzione = $_POST["menzione"]);
                        }

                        // EFFETTUO L'EFFETTIVO INSERIMENTO A DATABASE DELLA NUOVA ETICHETTA
                        $dataBase->addNewWine($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $_POST["gas"], $idCantina, $_POST["solfiti"], $_POST["biologico"], $_POST["classificazione"],
                        $idVitigno, $annata, $ig, $idMenzione);
                    } else {
                        callBackWithError("inserimento annullato! Ricontrollare i dati inseriti del vino");
                    }
                    break;

                case "Spumante":
                    $dataBase->addNewSpumante($_POST["categoria"], $_POST["nome"], $_POST["description"], $_POST["colore"], $_POST["alcol"], $_POST["zucchero"], $idCantina, $_POST["solfiti"], $_POST["biologico"]);
                    break;

                default:
                    callBackWithError("inserimento annullato! Dati incoerenti!!");
                    break;
            }
        } else {
            callBackWithError("inserimento annullato! Errore con i dati inseriti");
        }
    } else {
        header("Location:./index.php");
    }
?>
