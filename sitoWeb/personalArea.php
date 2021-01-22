<?php

    require_once("utils/headerFunction.php");

    if(isUserLoggedIn()) {

        $templateParams["titoloPagina"] = "Pagina di Registrazione";
        $templateParams["titoloScheda"] = "World Wine Web - Registrazione";
        $templateParams["indirizzoPagina"] = "template/register.php";
        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="./js/userRegisterModuleController.js"></script>
        ';

        require('./template/base.php');
    }

    header("Location:./index.php");

?>
