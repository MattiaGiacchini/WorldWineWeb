<?php
        require_once("utils/headerFunction.php");
        if(isset($_POST["idContainer"],$_POST["idLabel"],$_POST["idClient"])) {
            echo $dataBase->toggleSingleFavorite($_POST["idContainer"],$_POST["idLabel"],$_POST["idClient"]) ?
                "favourite" : "not-favourite";
        }
?>
