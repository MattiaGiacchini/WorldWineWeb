<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn()) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Ordini";
        $templateParams["titoloScheda"] = "Ordini";
        $templateParams["indirizzoPagina"] = "template/order-list.php";

        if (isUserLoggedIn() && getUserRole() == "client" ) {
            $templateParams["orders"] = $dataBase->getClientOrders(getLoggedUserId());
        } elseif (isUserLoggedIn()) {
            $templateParams["orders"] = $dataBase->getAllOrders();
        }

        require('./template/base.php');
    }
?>
