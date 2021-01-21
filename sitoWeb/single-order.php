<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn()) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Ordini";
        $templateParams["titoloScheda"] = "Ordini";
        $templateParams["indirizzoPagina"] = "template/order-details.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/order.css">';

        if (isUserLoggedIn()) {
            $templateParams["orderProductsDetails"] = $dataBase->getOrderProductsDetails($_GET["ordine"]);
            $templateParams["orderDetails"] = $dataBase->getOrderDetails($_GET["ordine"]);
            $templateParams["orderValue"] = $dataBase->getOrderSubtotal($_GET["ordine"]);
            $templateParams["userData"] = $dataBase->getUserData($templateParams["orderDetails"]["idCliente"]);     
        }

        require('./template/base.php');
    }
?>
