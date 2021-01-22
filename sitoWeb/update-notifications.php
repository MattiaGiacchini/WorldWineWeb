<?php
    require_once("./utils/headerFunction.php");

    $dataBase->readNotification($_POST["idNotifica"]);
    echo $_POST["idNotifica"];
?>
