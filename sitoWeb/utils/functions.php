<?php
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
        return $dataBase->getUserRole();
    }
?>
