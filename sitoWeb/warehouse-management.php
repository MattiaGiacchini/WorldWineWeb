<?php
    require_once("utils/headerFunction.php");

    if (isUserLoggedIn()) {// TODO: change to !
        header("location: login.php");
    } else {
        $templateParams["product"] = array("idContenitore" => 1, "idEtichetta" => 3, "name" => "Pinot Bianco", "producer" => "Tenuta Coccapane",  "price" => "24.99", "availability" => "145",  "size" => "0.75");

        if (isset($_POST["amount"])) {
            $dataBase->warehouseLoad($templateParams["product"]["idContenitore"], $templateParams["product"]["idEtichetta"], 1 , $_POST["amount"]);
        }

        $templateParams["titoloPagina"] = "Scorte magazzino";
        $templateParams["titoloScheda"] = "Gestione Magazzino";
        $templateParams["indirizzoPagina"] = "template/warehouseManagement.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/warehouse.css">';

        $templateParams["warehouseMovements"] = array(0 => array("date" => "25/12/2021", "time" => "08.20", "description" => "Giacchini Mattia", "amount" => +25), 1 => array("date" => "25/12/2021", "time" => "08.20", "description" => "ordine #65477", "amount" => -50)); //// TODO:


        require('./template/base.php');
    }
?>
