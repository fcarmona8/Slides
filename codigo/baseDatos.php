<?php

$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirPresentacio"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    if ($titol != '' && $descripcio != '') {
        // Insertar los datos en la base de datos y obtener el ID generado
        $dao->setPresentacions($titol, $descripcio);

        // Obtener el ID generado automáticamente
        $lastInsertId = $dao->getLastInsertId();

        // Redirigir a CrearDiapositives.php con el ID de la presentación como parámetro en la URL
        header("Location: CrearDiapositives.php?id=" . $lastInsertId . "&mensaje=Presentación creada correctamente");
        $_POST['titol'] = null;
        $_POST['descripcio'] = null;
        exit();
    }else{
        // Redirigir de nuevo a CrearPresentacio.php
        header("Location: CrearPresentacio.php");
        exit();
    }
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


if (isset($_POST['eliminar_presentacion'])) {
    $id_presentacion = $_POST['id_presentacion'];
    $result = $dao->eliminarPresentacion($id_presentacion);

    if ($result) {
        echo '<div id="message-container" class="mensaje-exito">Presentación eliminada correctamente.</div>';
    } else {
        echo '<div id="message-container" class="mensaje-error">No se pudo eliminar la presentación.</div>';
    }
}

if (isset($_POST['editar_presentacion'])) {
    $id_presentacion = $_POST['id_presentacion'];
    
    header("Location: editarDiapositivesTitol.php?id=".$id_presentacion);
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
