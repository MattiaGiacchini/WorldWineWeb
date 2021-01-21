<?php
    require_once("utils/headerFunction.php");

    if(isset($_GET["idLabel"], $_GET["idContainer"]) && is_numeric($_GET["idLabel"]) && is_numeric($_GET["idContainer"])) {

        $prodotto = $dataBase->getAllProductDetails($_GET["idLabel"], $_GET["idContainer"]);
        if($prodotto) {

            $isClient = isUserLoggedIn() && getUserRole() === "client";

            // carico le recensioni ed eventualmente, se sono un cliente, anche la mia vecchia recensione
            $myReview   = $isClient ? $dataBase->getMyProductReview($_GET["idContainer"], $_GET["idLabel"], getLoggedUserId()) : null;
            $recensioni = $dataBase->getAllProductReviews($_GET["idContainer"], $_GET["idLabel"]);
            if($recensioni) { shuffle($recensioni); }

            // sempre se sono un cliente calcolo il massimo dei vini acquistabili ancora
            $cartElement = null;
            if($isClient) {
                $cartElement = $dataBase->getSingleCartElement($_GET["idContainer"], $_GET["idLabel"], getLoggedUserId());
                if($cartElement) {
                    $cartElement = $prodotto["scorteMagazzino"] - $cartElement["quantita"];
                } else {
                    $cartElement = $prodotto["scorteMagazzino"];
                }
            }


            if($recensioni) { shuffle($recensioni); }

            $templateParams["titoloPagina"] = "Dettaglio Prodotto";
            $templateParams["titoloScheda"] = "World Wine Web";
            $templateParams["indirizzoPagina"] = "template/showLabelDetails.php";


            $templateParams["cssAggiuntivi"] = '
            <link rel="stylesheet" type="text/css" href="../css/wineDetails.css">
            ';
            $templateParams["jsAggiuntivi"] = '
                <script type="text/javascript" src="../js/wineDetails.js"></script>
                <script type="text/javascript" src="../js/wineCard.js"></script>
            ';

            require('./template/base.php');
        } else {
            header("Location:./index.php");
        }
    } else {
        header("Location:./index.php");
    }
?>
