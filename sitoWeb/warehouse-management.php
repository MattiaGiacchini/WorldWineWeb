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

        $templateParams["warehouseMovements"] = $dataBase->getWarehouseLoad(1,3);


        require('./template/base.php');
    }
?>
