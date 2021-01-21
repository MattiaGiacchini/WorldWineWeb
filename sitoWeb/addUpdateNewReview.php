<?php
    require_once("utils/headerFunction.php");

    function lenghtCorrection($string, $max) {
        if(strlen($string) > 500) {
            return substr($string, 0, 500);
        }
        return $string;
    }

    if (isset($_POST["submit"], $_POST["idContainer"], $_POST["idLabel"], $_POST["idUser"], $_POST["title"], $_POST["vote"], $_POST["text"])
        && is_numeric($_POST["vote"]) && is_numeric($_POST["idContainer"]) && is_numeric($_POST["idLabel"])) {

        $_POST["text"]  =   lenghtCorrection($_POST["text"],  500);
        $_POST["title"] =   lenghtCorrection($_POST["title"], 100);

        if($_POST["submit"] === "Inserisci") {
            $dataBase->addNewProductReview($_POST["idContainer"], $_POST["idLabel"], $_POST["idUser"], $_POST["title"], $_POST["vote"], $_POST["text"]);
        } else if ($_POST["submit"] === "Aggiorna") {
            $dataBase->updateProductReview($_POST["idContainer"], $_POST["idLabel"], $_POST["idUser"], $_POST["title"], $_POST["vote"], $_POST["text"]);
        }
        $url = "Location:./showLabelDetails.php?idLabel=".$_POST['idLabel']."&idContainer=".$_POST['idContainer'];
        header($url);
    } else {
        header("Location:./index.php");
    }

?>
