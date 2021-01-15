<?php
    require_once("utils/headerFunction.php");

    if(isset($_POST["email"]) && isset($_POST["psw"])){
        $result = $dataBase->checkLogin($_POST["email"], $_POST["psw"]);
        if(count($result)==0){
            $templateParams["errorelogin"] = "Login Fallito! Verificare email o password!";
        }
        else{
            registerLoggedUser($result[0]);
        }
    }

    if(isUserLoggedIn()){
        header("Location:./index.php");
    } else {
        $templateParams["titoloPagina"] = "Login";
        $templateParams["titoloScheda"] = "World Wine Web - login";
        $templateParams["indirizzoPagina"] = "template/login-form.php";
        require('./template/base.php');
    }

?>
