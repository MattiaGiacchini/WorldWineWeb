<?php
    require_once("utils/headerFunction.php");

    $templateParams["titoloPagina"] = "Gestione Magazzino";
    $templateParams["titoloScheda"] = "Gestione Magazzino";
    $templateParams["indirizzoPagina"] = "template/warehouseManagement.php";
    $templateParams["cssAggiuntivi"] = '<link rel="stylesheet" type="text/css" href="./css/warehouse.css">';


    $templateParams["product"] = array("name" => "Pinot Bianco", "producer" => "Tenuta Coccapane",  "price" => "24.99", "availability" => "145",  "size" => "0.75");
    $templateParams["warehouseMovements"] = array(0 => array("date" => "25/12/2021", "time" => "08.20", "description" => "Giacchini Mattia", "amount" => +25), 1 => array("date" => "25/12/2021", "time" => "08.20", "description" => "ordine #65477", "amount" => -50)); //// TODO:

    require('./template/base.php');
?>
