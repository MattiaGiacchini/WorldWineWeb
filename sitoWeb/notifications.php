<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn()) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Notifiche";
        $templateParams["titoloScheda"] = "Notifiche";
        $templateParams["indirizzoPagina"] = "template/notification-list.php";
        $templateParams["jsAggiuntivi"] = '<script src="./js/notification.js"></script>';



        if (isUserLoggedIn() && getUserRole() == "client" ) {
            $templateParams["notifiche"] = $dataBase->getClientNotifications(getLoggedUserId());
        }

        require('./template/base.php');
    }
?>
