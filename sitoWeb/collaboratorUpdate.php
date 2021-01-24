<?php
require_once("utils/headerFunction.php");

if(isUserLoggedIn() && getUserRole() == "admin" && isset($_GET["idCollaborator"])) {


    $templateParams["userInfo"] = $dataBase->getAllUserInfo($_GET["idCollaborator"]);

    if(isset($_POST["submit"])) {

        // FASE DI AGGIORNAMENTO DATI
        if (isset($_FILES["newPhoto"]) && strlen($_FILES["newPhoto"]["name"])>0) {
            list($result, $msg) = upLoadUserImage($_FILES["newPhoto"], $_GET["idCollaborator"]);
            if($result == 0){
                // errore
                $_SESSION["msgError"] = $msg;
            }
        }

        $attivo = $templateParams["userInfo"]["attivo"];
        $activeRequest = false;
        if(isset($_POST["attivo"]) xor $templateParams["userInfo"]["attivo"] == 1) {
            $attivo = isset($_POST["attivo"]) ? 1 : 0;
            $activeRequest = true;
        }

        $psw = null;
        if(isset($_POST["psw"])) {
            if($_POST["psw"] === $templateParams["userInfo"]["password"] || $_POST["psw"] == '') {
                $psw = $templateParams["userInfo"]["password"];
                unset($_POST["psw"]);
            } else {
                $psw = $_POST["psw"];
            }
        } else {
            $psw = $templateParams["userInfo"]["password"];
        }

        $email = null;
        if(isset($_POST["email"])) {
            if($_POST["email"] === $templateParams["userInfo"]["email"] || $_POST["email"] == '') {
                $email = $templateParams["userInfo"]["email"];
                unset($_POST["email"]);
            } else {
                $email = $_POST["email"];
            }
        } else {
            $email = $templateParams["userInfo"]["email"];
        }

        if(isset($_POST["email"]) || isset($_POST["psw"]) || $activeRequest) {
            $dataBase->adminUpdateUserInfo($_GET["idCollaborator"], $email, $psw, $attivo);
            $templateParams["userInfo"] = $dataBase->getAllUserInfo($_GET["idCollaborator"]);
        }
        unset($_POST);
    }

    $templateParams["user"] = "admin";
    $templateParams["titoloPagina"] = "Collaborator Update";
    $templateParams["titoloScheda"] = "World Wine Web";
    $templateParams["indirizzoPagina"] = "template/personalArea.php";
    $templateParams["jsAggiuntivi"] = '
        <script type="text/javascript" src="./js/personalAreaController.js"></script>
    ';


    require('./template/base.php');
} else {
    header("Location:./index.php");
}
?>
