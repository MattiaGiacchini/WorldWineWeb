<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "client" || getUserRole() != "admin" )) { // TODO: remove admin
        header("location: login.php");
    } else {

        $userId = getLoggedUserId();

        $templateParams["titoloPagina"] = "Checkout";
        $templateParams["titoloScheda"] = "Checkout";
        $templateParams["indirizzoPagina"] = "template/checkout-page.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/cart.css">';
        $templateParams["jsAggiuntivi"] = '<script src="./js/checkout.js"></script> <script src="./js/checkoutHelper.js"></script>';


        $dataBase->removeUnavailableProducts($userId);
        $templateParams["cartProducts"] = $dataBase->getCartProducts($userId);
        $templateParams["cartValue"] = $dataBase->getCartValue($userId);

        $templateParams["addresses"] = $dataBase->getUserAddresses($userId);
        $templateParams["payments"] = $dataBase-> getUserPayments($userId);

        if (isset($_POST["shippingAddress"])) {
            if ($_POST["shippingAddress"] === "new") {
                $dataBase->insertNewAddress($userId, $_POST["name"], $_POST["address"], $_POST["civic"], $_POST["city"], $_POST["province"], $_POST["zip"], $_POST["state"]);
                $_POST["shippingAddress"] = $dataBase->getLastAddedAddress($userId);
            }
            $orderAddress = $_POST["shippingAddress"];
        }

        if(isset($_POST["payment"])) {
            if ($_POST["payment"] === "new"){
                $dataBase->insertNewPayment($userId, $_POST["cardname"], $_POST["cardnumber"], $_POST["expiration"]."-01", $_POST["cvv"], $_POST["cardTipology"]);
                $_POST["payment"] = $_POST["cardnumber"];
            }
            $orderPayment = $_POST["payment"];
        }

        if(isset($_POST["submit"]) && isset($_POST["payment"]) && isset($_POST["shippingAddress"])){
            $dataBase->createOrder($userId, $orderPayment, $orderAddress);
        }

        require('./template/base.php');
    }
?>
