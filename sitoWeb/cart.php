<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "client")) { 
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Carrello";
        $templateParams["titoloScheda"] = "Carrello";
        $templateParams["indirizzoPagina"] = "template/cart-products.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/cart.css">';
        $templateParams["jsAggiuntivi"] = '<script src="./js/cart.js"></script>';


        $templateParams["cartProducts"] = $dataBase->getCartProducts(getLoggedUserId());
        $templateParams["cartValue"] = $dataBase->getCartValue(getLoggedUserId());

        require('./template/base.php');
    }
?>
