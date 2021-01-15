<?php
    function getLoggedUserId() {
        return isset($_SESSION["idUtente"]) ? $_SESSION["idUtente"] : NULL;
    }

    function isUserLoggedIn() {
        return !empty($_SESSION["idUtente"]);
    }

    function registerLoggedUser($user){
        $_SESSION["idUtente"] = $user["idUtente"];
    }

    function getUserRole() {
        global $dataBase;
        return isUserLoggedIn() ? $dataBase->getUserRole(getLoggedUserId()) : "user";
    }

?>
