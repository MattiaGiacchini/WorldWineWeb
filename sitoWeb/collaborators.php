<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() != "admin" || getUserRole() != "collaborator" )) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Collaboratori";
        $templateParams["titoloScheda"] = "Collaboratori";
        $templateParams["indirizzoPagina"] = "template/collaborator-list.php";

        $templateParams["collaborators"] = $dataBase->getCollaborators();

        require('./template/base.php');
    }
?>
