<?php
    function getLoggedUserId() {
        return isset($_SESSION["idUtente"]) ? $_SESSION["idUtente"] : NULL;
    }

    function isUserLoggedIn() {
        if (!empty($_SESSION["idUtente"])) {
            return true;
        }
        return false;
    }

    function registerLoggedUser($user){
        $_SESSION["idUtente"] = $user["idUtente"];
    }

    function getUserRole() {
        return $dataBase->getUserRole(getLoggedUserId());
    }

?>
