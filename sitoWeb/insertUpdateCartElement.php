<?php

    require_once("utils/headerFunction.php");

    if (isUserLoggedIn() && getUserRole() === "client"
        && isset($_POST["idLabel"], $_POST["idContainer"], $_POST["idUser"], $_POST["qnt"])
        && is_numeric($_POST["idLabel"]) && is_numeric($_POST["idContainer"])
        && is_numeric($_POST["idUser"]) && is_numeric($_POST["qnt"])) {

        $dataBase->insertUpdateSingleCartElement($_POST["idContainer"], $_POST["idLabel"], $_POST["idUser"], $_POST["qnt"]);

        $url = "Location:./showLabelDetails.php?idLabel=".$_POST['idLabel']."&idContainer=".$_POST['idContainer'];
        header($url);
    } else {
        header("Location:./index.php");
    }

?>
