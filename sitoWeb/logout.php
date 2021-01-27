<?php
    require_once("utils/headerFunction.php");
    logOut();
    unset($_POST);
    header("Location:./login.php");
?>
