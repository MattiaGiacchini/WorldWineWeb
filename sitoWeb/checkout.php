<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "client" || getUserRole() != "admin" )) { // TODO: remove admin
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Checkout";
        $templateParams["titoloScheda"] = "Checkout";
        $templateParams["indirizzoPagina"] = "template/checkout-page.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/cart.css">';
        $templateParams["jsAggiuntivi"] = '<script src="./js/checkout.js"></script> <script src="./js/checkoutHelper.js"></script>';


        $templateParams["cartProducts"] = $dataBase->getCartProducts(getLoggedUserId());
        $templateParams["cartValue"] = $dataBase->getCartValue(getLoggedUserId());

        $templateParams["addresses"] = $dataBase->getUserAddresses(getLoggedUserId());
        $templateParams["payments"] = $dataBase-> getUserPayments(getLoggedUserId());

        if (isset($_POST["shippingAddress"])) {
            if ($_POST["shippingAddress"] === "new") {
                $dataBase->insertNewAddress(getLoggedUserId(), $_POST["name"], $_POST["address"], $_POST["civic"], $_POST["city"], $_POST["province"], $_POST["zip"], $_POST["state"]);
                $_POST["shippingAddress"] = $dataBase->getLastAddedAddress(getLoggedUserId());
            }
            $orderAddress = $_POST["shippingAddress"];
        }

        if(isset($_POST["payment"])) {
            if ($_POST["payment"] === "new"){
                $dataBase->insertNewPayment(getLoggedUserId(), $_POST["cardname"], $_POST["cardnumber"], $_POST["expiration"]."-01", $_POST["cvv"], $_POST["cardTipology"]);
                $_POST["payment"] = $_POST["cardnumber"];
            }
            $orderPayment = $_POST["payment"];
        }

        if(isset($_POST["submit"]) && isset($_POST["payment"]) && isset($_POST["shippingAddress"])){
            $dataBase->createOrder(getLoggedUserId(), $orderPayment, $orderAddress);
        }

        require('./template/base.php');
    }
?>
