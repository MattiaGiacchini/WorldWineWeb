<?php
    session_start();
    define("UPLOAD_DIR", "./upload/");
    require_once("db/db.php");
    $dataBase = new Database("localhost", "root", "", "worldwineweb", 3306);
    require_once("utils/functions.php");
?>
