<?php
    session_start();
    define("UPLOAD_DIR", "./upload/");
    define("WINE_PHOTO_DIR", "./upload/idVino/");
    require_once("db/db.php");
    $dataBase = new Database("localhost", "root", "", "worldwineweb", 3306);
    require_once("utils/functions.php");
?>
