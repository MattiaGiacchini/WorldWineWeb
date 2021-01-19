<?php
    require_once("utils/headerFunction.php");

    if(isUserLoggedIn() && getUserRole() === "admin") {
        if ($_POST["id"] == "new") {            // inserimento nuovo prodotto
            upLoadWineImage($_FILES["newPhoto"], $_POST["idLabel"], $_POST["idNewContainer"]);
        } else if (is_numeric($_POST["id"])) {  // aggiornamento nuovo prodotto

        } else {                                // ERRORE

        }


/*
        if(isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0){
            array($result, $msg) = uploadImage(WINE_PHOTO_DIR, $_FILES["imgarticolo"]);
            if($result == 0){
                // TODO: errore
                //header("location: login.php?formmsg=".$msg);
            }
            $imgarticolo = $msg;
        } else {
            $imgarticolo = $_POST["oldimg"];
        }
        */
    }
?>
