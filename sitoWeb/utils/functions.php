<?php
    function getLoggedUserId() {
        return isset($_SESSION["idUtente"]) ? $_SESSION["idUtente"] : NULL;
    }

    function isUserLoggedIn() {
        return !empty($_SESSION["idUtente"]);
    }

    function registerLoggedUser($user){
        $_SESSION["idUtente"] = $user["idUtente"];
    }

    function getUserRole() {
        global $dataBase;
        return $dataBase->getUserRole(getLoggedUserId());
    }

    function getWineImgURL($idEtichetta, $idContenitore){
        if (is_dir(WINE_PHOTO_DIR . $idEtichetta . "_" . $idContenitore)){
            $path = scandir(WINE_PHOTO_DIR . $idEtichetta . "_" . $idContenitore ."/");
            return $idEtichetta . "_" . $idContenitore ."/" . $path[2];
        } else {
            return "default.png";
        }
    }

    function getUserImgURL($idUtente){
        if (glob(USER_PHOTO_DIR . $idUtente . ".*")){
            return glob(USER_PHOTO_DIR . $idUtente . ".*")[0];
        } else {
            return USER_PHOTO_DIR . "defaultUser.png";
        }
    }

?>
