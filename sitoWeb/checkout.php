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
            $orderAddress = $dataBase->getUserSpecificiAddress(getLoggedUserId(), $_POST["shippingAddress"]);
            var_dump($orderAddress);
        }

        if(isset($_POST["payment"])) {
            if ($_POST["payment"] === "new"){
                $dataBase->insertNewPayment(getLoggedUserId(), $_POST["cardname"], $_POST["cardnumber"], $_POST["expiration"]."-01", $_POST["cvv"], $_POST["cardTipology"]);
                $_POST["payment"] = $_POST["cardnumber"];
            }
            $orderPayment = $dataBase->getUserSpecificPayment(getLoggedUserId(), $_POST["payment"]);
            var_dump($orderPayment);
        }

        require('./template/base.php');
    }
?>
