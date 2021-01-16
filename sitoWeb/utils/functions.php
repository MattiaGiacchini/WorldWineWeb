<?php
    function getLoggedUserId() {
        return isset($_SESSION["idUtente"]) ? $_SESSION["idUtente"] : NULL;
    }

    function isUserLoggedIn() {
        if (!empty($_SESSION["idUtente"])) {
            return true;
        }
        return false;
    }

    function registerLoggedUser($user){
        $_SESSION["idUtente"] = $user["idUtente"];
    }

    function getUserRole() {
        global $dataBase;
        return $dataBase->getUserRole(getLoggedUserId());
    }

    function getImgURL($idEtichetta, $idContenitore){
        if (is_dir(WINE_PHOTO_DIR . $idEtichetta . "_" . $idContenitore)){
            $path = scandir(WINE_PHOTO_DIR . $idEtichetta . "_" . $idContenitore ."/");
            return $idEtichetta . "_" . $idContenitore ."/" . $path[2];
        } else {
            return "default.png";
        }
    }

?>
