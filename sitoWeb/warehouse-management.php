<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() || ( getUserRole() == "client" )) {
        header("location: login.php");
    } else {

        if (isset($_POST["amount"])) {
            $dataBase->warehouseLoad($_GET["etichetta"], $_GET["contenitore"], $_SESSION["idUtente"] , $_POST["amount"]);
            unset($_POST);
        }

        $templateParams["product"] = $dataBase->getProductDetails($_GET["etichetta"], $_GET["contenitore"]);

        $templateParams["titoloPagina"] = "Scorte magazzino";
        $templateParams["titoloScheda"] = "Gestione Magazzino";
        $templateParams["indirizzoPagina"] = "template/warehouse-single-product.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/warehouse.css">';

        $templateParams["warehouseMovements"] = $dataBase->getWarehouseMovements($_GET["etichetta"], $_GET["contenitore"]);

        require('./template/base.php');
    }
?>
