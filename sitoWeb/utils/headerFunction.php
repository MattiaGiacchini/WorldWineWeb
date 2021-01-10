<?php
    session_start();
    define("UPLOAD_DIR", "./upload/");
    require_once("db/db.php");
    require_once("utils/functions.php");
    $dataBase = new DataBase("localhost", "root", "", "worldwineweb", 3306);
?>
