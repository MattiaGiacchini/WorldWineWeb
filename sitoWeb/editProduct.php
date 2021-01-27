<?php
    require_once("utils/headerFunction.php");

    function checkDatabaseInput() {
        global $templateParams;
        $numberProducts = count($templateParams["products"]);
        $templateParams["visible"]  = array();
        $templateParams["invisible"]= array();
        $templateParams["unsetted"] = array();

        for ($i = 0; $i < $numberProducts; $i++) {

            $templateParams["products"][$i]["photo"] = getWineImgURL($templateParams["products"][$i]["idEtichetta"],$templateParams["products"][$i]["idContenitore"]);

            if($templateParams["products"][$i]["idEtichetta"] != null && $templateParams["products"][$i]["attivo"] == "1") {
                array_push($templateParams["visible"], $templateParams["products"][$i]);
            }
            if($templateParams["products"][$i]["idEtichetta"] != null && $templateParams["products"][$i]["attivo"] == "0") {
                array_push($templateParams["invisible"], $templateParams["products"][$i]);
            }
            if($templateParams["products"][$i]["idEtichetta"] == null) {
                array_push($templateParams["unsetted"], $templateParams["products"][$i]);
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
        <script src="./js/containerModuleController.js"></script>
        ';

        setcookie("label", json_encode($templateParams["products"]), time() + 60, "/");

        require('./template/base.php');
    } else {
        header("Location:./index.php");
    }
?>
