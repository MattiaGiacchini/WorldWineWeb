<?php
    require_once("utils/headerFunction.php");

    if(isUserLoggedIn() && getUserRole() === "admin" && isset($_GET["idEtichetta"])) {
        $templateParams["label"] = $dataBase->getLabelFromId($_GET["idEtichetta"]);
        $templateParams["titoloPagina"] = $templateParams["label"]["nomeCantina"]."(".$templateParams["label"]["stato"].") ".$templateParams["label"]["nomeEtichetta"];
        $templateParams["titoloScheda"] = $templateParams["label"]["nomeEtichetta"];
        $templateParams["indirizzoPagina"] = "template/editProduct.php";
        $templateParams["jsAggiuntivi"] = '
        <script type="text/javascript" src="../js/containerModuleController.js"></script>
        ';

        require('./template/base.php');
    } else {
        header("Location:./index.php");
    }
?>
