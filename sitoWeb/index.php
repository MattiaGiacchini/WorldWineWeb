<?php
    require_once("utils/headerFunction.php");

    $templateParams["titoloPagina"] = "Home";
    $templateParams["titoloScheda"] = "World Wine Web";
    $templateParams["indirizzoPagina"] = "template/home.php";
    $templateParams["products"] = $dataBase->getAllProductsHomePage(25);
    $templateParams["jsAggiuntivi"] = '
    <script type="text/javascript" src="../js/wineCard.js"></script>
    ';

    shuffle($templateParams["products"]);


    require('./template/base.php');
?>
