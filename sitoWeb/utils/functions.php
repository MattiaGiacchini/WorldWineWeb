<?php
    function isUserLoggedIn() {
        if (!empty($_SESSION["idUtente"])) {
            return $_SESSION["ruolo"];
        } 
        
        return false;
    }
?>
