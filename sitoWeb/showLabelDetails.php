<?php
    require_once("utils/headerFunction.php");

    if(isset($_GET["idLabel"], $_GET["idContainer"]) && is_numeric($_GET["idLabel"]) && is_numeric($_GET["idContainer"])) {

        $prodotto = $dataBase->getAllProductDetails($_GET["idLabel"], $_GET["idContainer"]);
        $recensioni = $dataBase->getAllProductReviews($_GET["idContainer"], $_GET["idLabel"]);
        $myReview   = $dataBase->getMyProductReview($_GET["idContainer"], $_GET["idLabel"], getLoggedUserId());

        if($recensioni) { shuffle($recensioni); }

        $templateParams["titoloPagina"] = "Dettaglio Prodotto";
        $templateParams["titoloScheda"] = "World Wine Web";
        $templateParams["indirizzoPagina"] = "template/showLabelDetails.php";


        $templateParams["cssAggiuntivi"] = '
        <link rel="stylesheet" type="text/css" href="../css/productCard.css">
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
?>
