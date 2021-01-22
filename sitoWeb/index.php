<?php
    require_once("utils/headerFunction.php");

    $isClient = isUserLoggedIn() && getUserRole() === "client";
    $userId = $isClient ? getLoggedUserId() : null;

    $templateParams["products"] = null;
    if(!$isClient) {
        $templateParams["products"] = $dataBase->getAllProductsHomePage();
    } else {
        $templateParams["products"] = $dataBase->getAllProductsHomePageByClient($userId);
    }

    $templateParams["titoloPagina"] = "Home";
    $templateParams["titoloScheda"] = "World Wine Web";
    $templateParams["indirizzoPagina"] = "template/home.php";

    $templateParams["jsAggiuntivi"] = '
    <script type="text/javascript" src="./js/wineCard.js"></script>
    ';

    shuffle($templateParams["products"]);


    require('./template/base.php');
?>
