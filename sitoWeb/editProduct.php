<?php
    require_once("utils/headerFunction.php");

    function checkDatabaseInput() {
        global $templateParams;
        $templateParams["visible"]  = array();
        $templateParams["invisible"]= array();
        $templateParams["unsetted"] = array();

        foreach ($templateParams["products"] as $product) {
            if($product["idEtichetta"] != null && $product["attivo"] == "1") {
                array_push($templateParams["visible"], $product);
            }
            if($product["idEtichetta"] != null && $product["attivo"] == "0") {
                array_push($templateParams["invisible"], $product);
            }
            if($product["idEtichetta"] == null) {
                array_push($templateParams["unsetted"], $product);
            }
        }
    }


    if(isUserLoggedIn() && getUserRole() === "admin" && isset($_GET["idEtichetta"]) && is_numeric($_GET["idEtichetta"])) {

        $templateParams["label"] = $dataBase->getLabelFromId($_GET["idEtichetta"]);
        $templateParams["products"] = $dataBase->getProductsByIdLabel($_GET["idEtichetta"]);
        checkDatabaseInput();

        $templateParams["titoloPagina"] = $templateParams["label"]["stato"]." ".$templateParams["label"]["nomeCantina"]." ".$templateParams["label"]["nomeEtichetta"];
        $templateParams["titoloScheda"] = $templateParams["label"]["nomeEtichetta"];
        $templateParams["indirizzoPagina"] = "template/editProduct.php";
        $templateParams["jsAggiuntivi"] = '
        <script type="text/javascript" src="../js/containerModuleController.js"></script>
        ';
        
        setcookie("label", json_encode($dataBase->getProductsByIdLabel($_GET["idEtichetta"])), time() + 60);

        require('./template/base.php');
    } else {
        header("Location:./index.php");
    }
?>
