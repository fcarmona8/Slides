<?php

$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirPresentacio"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];

    // Insertar los datos en la base de datos y obtener el ID generado
    $dao->setPresentacions($titol, $descripcio);

    // Obtener el ID generado automáticamente
    $lastInsertId = $dao->getLastInsertId();
    // Redirigir a CrearDiapositives.php con el ID de la presentación como parámetro en la URL
    header("Location: CrearDiapositives.php?id=" . $lastInsertId);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirDiapositiva"])) {
        // Obtener los datos del formulario
        $titol = $_POST["titol"];
        $contingut = $_POST["contingut"];
        $id_presentacio = $_POST["id_presentacio"];

        // Insertar los datos en la base de datos
        $dao->setDiapositives($titol, $contingut, $id_presentacio);

        // Redirigir de nuevo a CrearDiapositives.php
        header("Location: CrearDiapositives.php?id=" . $id_presentacio);
        exit();
}




/*
if(isset($_GET['anadirPresentacio'])){
    $titol = $_POST['titol'];
    $descripcio = $_POST['descripcio'];

    $dao->setPresentacions($titol, $descripcio);
}
*/

// if(isset($_REQUEST['añadirDiapositiva'])){

// }

// if(isset($_REQUEST['fianlizar'])){

// }
