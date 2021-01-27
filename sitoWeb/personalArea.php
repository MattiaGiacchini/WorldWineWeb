<?php

    require_once("utils/headerFunction.php");

    if(isUserLoggedIn()) {

        $templateParams["userInfo"] = $dataBase->getAllUserInfo(getLoggedUserId());

        if(isset($_POST["submit"])) {

            // FASE DI AGGIORNAMENTO DATI
            if (isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0) {
                list($result, $msg) = upLoadUserImage($_FILES["newPhoto"], $_POST["id"]);
                if($result == 0){
                    // errore
                    $_SESSION["msgError"] = $msg;
                }
            }

            $psw = null;
            if(isset($_POST["psw"])) {
                if(password_verify($_POST["psw"], $templateParams["userInfo"]["password"]) || $_POST["psw"] == '') {
                    $psw = $templateParams["userInfo"]["password"];
                    unset($_POST["psw"]);
                } else {
                    $psw = password_hash($_POST["psw"], PASSWORD_DEFAULT);
                }
            } else {
                $psw = $templateParams["userInfo"]["password"];
            }

            $email = null;
            if(isset($_POST["email"])) {
                if($_POST["email"] === $templateParams["userInfo"]["email"] || $_POST["email"] == '') {
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
            unset($_POST);
        }

        $templateParams["user"] = "personal";
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
