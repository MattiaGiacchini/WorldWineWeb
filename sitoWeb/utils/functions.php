<?php
    function getLoggedUserId() {
        return isset($_SESSION["idUtente"]) ? $_SESSION["idUtente"] : null;
    }

    function isUserLoggedIn() {
        return !empty($_SESSION["idUtente"]);
    }

    function registerLoggedUser($user){
        $_SESSION["idUtente"] = $user["idUtente"];
        if(isset($user["ragioneSociale"])) {
            $_SESSION["nomeUtente"] = $user["ragioneSociale"];
        } else {
            $_SESSION["nomeUtente"] = $user["nome"]." ".$user["cognome"];
        }
    }

    function getUserRole() {
        global $dataBase;
        return $dataBase->getUserRole(getLoggedUserId());
    }

    function getUserName() {
        return isset($_SESSION["nomeUtente"]) ? $_SESSION["nomeUtente"] : "";
    }

    function logOut() {
        if(isUserLoggedIn()) {
            session_unset();
        }
    }
?>
