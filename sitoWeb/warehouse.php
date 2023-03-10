<?php
    require_once("utils/headerFunction.php");

    if (!isUserLoggedIn() && ( getUserRole() === "client" )) {
        header("location: login.php");
    } else {

        $templateParams["titoloPagina"] = "Magazzino";
        $templateParams["titoloScheda"] = "Magazzino";
        $templateParams["indirizzoPagina"] = "template/warehouse-products.php";

        $templateParams["warehouseProducts"] = $dataBase->getWarehouseProducts();

        require('./template/base.php');
    }
?>
