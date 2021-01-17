<?php
    require_once("utils/headerFunction.php");

    if(isUserLoggedIn() && getUserRole() === "admin" && isset($_GET["idProdotto"])) {
        $templateParams["label"] = $dataBase->getLabelFromId($_GET["idProdotto"]);
        $templateParams["titoloScheda"] = $templateParams["label"]["stato"]." - ".$templateParams["label"]["nomeCantina"]." - ".$templateParams["label"]["nomeEtichetta"];
        $templateParams["titoloPagina"] = $templateParams["label"]["nomeEtichetta"];
        $templateParams["indirizzoPagina"] = "template/home.php";

        require('./template/base.php');
    } else {
        header("Location:./index.php");
    }
?>
