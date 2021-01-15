<?php
    require_once("utils/headerFunction.php");

    if(isUserLoggedIn() && getUserRole() === "admin") {
        $templateParams["titoloPagina"] = "Nuova Etichetta";
        $templateParams["titoloScheda"] = "Nuova Etichetta";
        $templateParams["indirizzoPagina"] = "template/newWineLabel.php";


        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="../js/wineLabelModuleController.js"></script>
        ';

        require('./template/base.php');

    } else {
        header("Location:./index.php");
    }
?>
