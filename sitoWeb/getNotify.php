<?php
    require_once("utils/headerFunction.php");
    $userId = getLoggedUserId();
    echo $dataBase->getNumberNotificationsYetToBeRead($userId);
?>
