<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "admin" || getUserRole() != "collaborator" )) {
        header("location: login.php");
    } else {

        if (isset($_POST["amount"])) {
            $dataBase->warehouseLoad(3, 1, $_SESSION["idUtente"] , $_POST["amount"]);
            unset($_POST);
        }

        $templateParams["product"] = $dataBase->getProductDetails(3, 1);
        $templateParams["product"][0]["scorteMagazzino"] = $dataBase->getProductAvailability(3, 1);


        $templateParams["titoloPagina"] = "Scorte magazzino";
        $templateParams["titoloScheda"] = "Gestione Magazzino";
        $templateParams["indirizzoPagina"] = "template/warehouseManagement.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/warehouse.css">';

        $templateParams["warehouseMovements"] = $dataBase->getWarehouseLoad(3, 1);

        require('./template/base.php');
    }
?>
