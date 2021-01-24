<?php
    require_once("utils/headerFunction.php");

    function callBackWithError($id, $msg) {
        $_SESSION["msg"] = $msg;
        header("Location:./editProduct.php?idEtichetta=".$id);
    }

    if(isUserLoggedIn() && getUserRole() === "admin") {

        if(isset($_POST["id"], $_POST["idLabel"], $_POST["price"], $_POST["iva"])
           && is_numeric($_POST["idLabel"])
           && is_numeric($_POST["price"])
           && is_numeric($_POST["iva"])) {

           $active = isset($_POST["Visibile"]) ? 1 : 0;

            if ($_POST["id"] === "new" && $_POST["idNewContainer"] && is_numeric($_POST["idNewContainer"])) {            // inserimento nuovo prodotto


                if(!$dataBase->addNewProduct($_POST["idNewContainer"], $_POST["idLabel"], $active)) {
                    callBackWithError($_POST["idLabel"], "L'inserimento del nuovo Prodotto è fallito!");
                }

                if (!$dataBase->addNewEvaluationProduct($_POST["idLabel"], $_POST["idNewContainer"],$_POST["price"], $_POST["iva"])) {
                    callBackWithError($_POST["idLabel"], "L'inserimento del prezzo + iva del nuovo prodotto è fallito!");
                }

                if (isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0) {
                    list($result, $msg) = upLoadWineImage($_FILES["newPhoto"], $_POST["idLabel"], $_POST["idNewContainer"]);
                    if($result == 0){
                        callBackWithError($_POST["idLabel"], $msg);
                    }
                    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                    header("Cache-Control: no-cache");
                    header("Pragma: no-cache");
                }

                header("Location:./editProduct.php?idEtichetta=".$_POST["idLabel"]);

            } else if (is_numeric($_POST["id"])
                && isset($_POST["lastVisible"], $_POST["lastiva"], $_POST["lastPrice"])
                && in_array($_POST["lastVisible"], array("true", "false"))) {  // aggiornamento nuovo prodotto

                $_POST["lastiva"] = $_POST["lastiva"] == '' ? 0.0 : $_POST["lastiva"];
                $_POST["lastPrice"] = $_POST["lastPrice"] == '' ? 0.0 : $_POST["lastPrice"];
                $lastActive = $_POST["lastVisible"] == "true" ? 1 : 0;

                if($active != $lastActive && !$dataBase->updateProduct($_POST["id"], $_POST["idLabel"], $active)) {
                    callBackWithError($_POST["idLabel"], "L'aggiornamento del Prodotto è fallito!");
                }

                if ((($_POST["lastiva"] != $_POST["iva"]) || ($_POST["lastPrice"] != $_POST["price"]))
                    && !$dataBase->addNewEvaluationProduct($_POST["idLabel"], $_POST["id"],$_POST["price"], $_POST["iva"])) {
                    callBackWithError($_POST["idLabel"], "L'aggiornamento del prezzo + iva del prodotto è fallito!");
                }

                if (isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0) {
                    list($result, $msg) = upLoadWineImage($_FILES["newPhoto"], $_POST["idLabel"], $_POST["id"]);
                    if($result == 0) {
                        callBackWithError($_POST["idLabel"], $msg);
                    }
                    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                    header("Cache-Control: no-cache");
                    header("Pragma: no-cache");
                }

                header("Location:./editProduct.php?idEtichetta=".$_POST["idLabel"]);
            }
        }
    }

    //header("Location:./index.php");
?>
