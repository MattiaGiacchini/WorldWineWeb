<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "admin" || getUserRole() != "collaborator" )) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Etichette";
        $templateParams["titoloScheda"] = "Lista etichette";
        $templateParams["indirizzoPagina"] = "template/label-list.php";

        $templateParams["labels"] = $dataBase->getWineLabels();

        require('./template/base.php');
    }
?>