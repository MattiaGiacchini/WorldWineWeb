<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "client" || getUserRole() != "admin" )) { // TODO: remove admin
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Checkout";
        $templateParams["titoloScheda"] = "Checkout";
        $templateParams["indirizzoPagina"] = "template/checkout-page.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/cart.css">';
        $templateParams["jsAggiuntivi"] = '<script src="./js/checkout.js"></script>';


        $templateParams["cartProducts"] = $dataBase->getCartProducts(getLoggedUserId());
        $templateParams["cartValue"] = $dataBase->getCartValue(getLoggedUserId());

        $templateParams["addresses"] = $dataBase->getUserAddresses(getLoggedUserId());
        $templateParams["payments"] = $dataBase-> getUserPayments(getLoggedUserId());

        require('./template/base.php');
    }
?>
