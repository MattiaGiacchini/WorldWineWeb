<?php
    require_once("utils/headerFunction.php");

    if(isUserLoggedIn() && getUserRole() === "admin" && isset($_GET["idLabel"]) && is_numeric($_GET["idLabel"])) {
        $templateParams["labelInfo"] = $dataBase->getLabelDetailsFromId($_GET["idLabel"]);
        $templateParams["titoloPagina"] = "Dettagli Etichetta";
        $templateParams["titoloScheda"] = "Dettagli Etichetta";
        $templateParams["indirizzoPagina"] = "template/newWineLabel.php";


        setcookie("labelDetails", json_encode($templateParams["labelInfo"]), time() + 60, "/");

        $templateParams["jsAggiuntivi"] = '
            <script type="text/javascript" src="./js/wineLabelModuleController.js"></script>
        ';

        require('./template/base.php');

    } else {
        header("Location:./index.php");
    }
 ?>
