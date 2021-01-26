<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "client")) {
        header("location: login.php");
    } else {

        $userId = getLoggedUserId();

        if(!isset($_POST["payment"]) && !isset($_POST["shippingAddress"])){
            $updateCartProducts = getProductsId(array_keys($_POST));
            $dataBase->updateCartValues(getLoggedUserId(), $updateCartProducts);
            $dataBase->removeUnavailableProducts($userId);
            $templateParams["cartProducts"] = $dataBase->getCartProducts($userId);
            $templateParams["cartValue"] = $dataBase->getCartValue($userId);
        }

        $templateParams["addresses"] = $dataBase->getUserAddresses($userId);
        $templateParams["payments"] = $dataBase-> getUserPayments($userId);


        $templateParams["titoloPagina"] = "Checkout";
        $templateParams["titoloScheda"] = "Checkout";
        $templateParams["indirizzoPagina"] = "template/checkout-page.php";
        $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/cart.css">';
        $templateParams["jsAggiuntivi"] = '<script type="text/javascript" src="./js/checkout.js"></script>';

        $checkoutData = array($templateParams["addresses"], $templateParams["payments"]);
        setcookie("checkoutData", json_encode($checkoutData), time() + 60, "/");

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
            $_SESSION["orderCreated"] = "true";
            header("location: login.php");
        }


        require('./template/base.php');
    }

    function getProductsId($string) {
        if (($key = array_search('checkout', $string)) !== false) {
            unset($string[$key]);
        }
        $products = array();
        if (count($string) > 0) {
            foreach ($string as $value) {
                $product = array();
                $id = explode("_", $value);
                //var_dump($id);
                $product["idEtichetta"] = $id[0];
                $product["idContenitore"] = $id[1];
                $product["quantita"] = $_POST[$value];

                array_push($products, $product);
            }
        }

        return $products;
    }
?>
