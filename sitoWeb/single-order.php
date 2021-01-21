<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn()) {
        header("location: login.php");
    } else {

        if (isset($_POST["statoDiAvanzamento"])) {
            $stato = ORDER_STATUS[0];
            switch ($_POST["statoDiAvanzamento"]) {
                case 'accetta':
                $stato = ORDER_STATUS[1];
                break;
                case 'spedisci':
                $stato = ORDER_STATUS[2];
                break;
                case 'consegnato':
                $stato = ORDER_STATUS[3];
                break;
                case 'annulla ordine':
                $stato = ORDER_STATUS[-1];
                break;
                default:
                break;
            }

            $dataBase->updateOrderState($_GET["ordine"], getLoggedUserId(), $stato);
        }
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
