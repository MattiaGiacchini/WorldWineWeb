<?php

    require_once("utils/headerFunction.php");

    if(isUserLoggedIn()) {

        // FASE DI AGGIORNAMENTO DATI
        if (isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0) {
            list($result, $msg) = upLoadUserImage($_FILES["newPhoto"], $_POST["id"]);
            if($result == 0){
                // errore
                $_SESSION["msgError"] = $msg;
            }
        }

        $templateParams["userInfo"] = $dataBase->getAllUserInfo(getLoggedUserId());

        $psw = null;
        if(isset($_POST["psw"])) {
            if($_POST["psw"] === $templateParams["userInfo"]["password"]) {
                $psw = $templateParams["userInfo"]["password"];
                unset($_POST["psw"]);
            } else {
                $psw = $_POST["psw"];
            }
        } else {
            $psw = $templateParams["userInfo"]["password"];
        }

        $email = null;
        if(isset($_POST["email"])) {
            if($_POST["email"] === $templateParams["userInfo"]["email"]) {
                $email = $templateParams["userInfo"]["email"];
                unset($_POST["email"]);
            } else {
                $email = $_POST["email"];
            }
        } else {
            $email = $templateParams["userInfo"]["email"];
        }

        if(isset($_POST["email"]) || isset($_POST["psw"])) {
            $dataBase->updateUserInfo($templateParams["userInfo"]["idUtente"], $email, $psw);
            $templateParams["userInfo"] = $dataBase->getAllUserInfo(getLoggedUserId());
        }


        $templateParams["titoloPagina"] = "Area Personale";
        $templateParams["titoloScheda"] = "World Wine Web";
        $templateParams["indirizzoPagina"] = "template/personalArea.php";
        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="./js/personalAreaController.js"></script>
        ';


        require('./template/base.php');
    } else {
        header("Location:./index.php");
    }
?>
