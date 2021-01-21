<?php
    session_start();
    define("UPLOAD_DIR", "./upload/");
    define("WINE_PHOTO_DIR", "./upload/idVino/");
    define("USER_PHOTO_DIR", "./upload/users/");
    define("ORDER_STATUS", array('0' => "Accettazione", '1' => "Elaborazione", '2' => "Spedito", '3' => "Consegnato", '-1' => "Annullato"));
    require_once("db/db.php");
    $dataBase = new Database("localhost", "root", "", "worldwineweb", 3306);
    require_once("utils/functions.php");
?>
