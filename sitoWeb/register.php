<?php
    require_once("utils/headerFunction.php");


    function inputParamLoginChecker() {
        $emailPattern = "/\b[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,6}\b/";
        $passwordPattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/";
        return isset($_POST["email"]) && isset($_POST["psw"])
        && preg_match($emailPattern, $_POST["email"]) && strlen($_POST["email"]) <= 100
        && preg_match($passwordPattern, $_POST["psw"]) && strlen($_POST["psw"]) <= 20;
    }

    function checkBusiness() {
        $pIvaPattern = "/^[0-9]{11}$/";
        return inputParamLoginChecker() && isset($_POST["company"], $_POST["pIva"])
        && strlen($_POST["company"]) < 101 && preg_match($pIvaPattern, $_POST["pIva"]);
    }

    function checkPrivate() {
        $time = strtotime("-18 year", time());
        $time = date("Y-m-d", $time);
        $cfPattern = "/^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$/";
        return inputParamLoginChecker() && isset($_POST["name"], $_POST["surname"], $_POST["cf"], $_POST["birthday"])
        && strlen($_POST["name"]) <= 20 && strlen($_POST["surname"]) <= 20 && preg_match($cfPattern, $_POST["cf"])
        && $_POST["birthday"] <= $time;
    }

    function callBackWithError($errore) {
        $templateParams["titoloPagina"] = "Pagina di Registrazione";
        $templateParams["titoloScheda"] = "World Wine Web - Registrazione";
        $templateParams["indirizzoPagina"] = "template/register.php";
        $templateParams["erroreDiRegistrazione"] = $errore;
        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="./js/userRegisterModuleController.js"></script>
        ';

        require('./template/base.php');
    }

    function registerSuccessed() {
        "La registrazione è avvenuta con successo!";
        header("Location:./login.php?msg="."La registrazione è avvenuta con successo!");

    }

    if(isset($_POST["register"])) {
        switch ($_POST["register"]) {
            case 'business':
                if(checkBusiness()){
                    registerSuccessed();
                } else {
                    callBackWithError("I dati per la registrazione non sono stati accettati");
                }
                break;

            case 'private':
                if(checkPrivate()){
                    registerSuccessed();
                } else {
                    callBackWithError("I dati per la registrazione non sono stati accettati");
                }
                break;

            default:
                callBackWithError("ERRORE CRITICO");
                break;
        }
    } else {
        $templateParams["titoloPagina"] = "Pagina di Registrazione";
        $templateParams["titoloScheda"] = "World Wine Web - Registrazione";
        $templateParams["indirizzoPagina"] = "template/register.php";
        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="./js/userRegisterModuleController.js"></script>
        ';

        require('./template/base.php');
    }
?>
