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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cambiarPresentacion"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    $id = $_POST['id_presentacio'];
    if ($titol != '' && $descripcio != '') {
            // Insertar los datos en la base de datos y obtener el ID generado
        $dao->editarPresentacio($titol, $descripcio,$id);

        header("Location: editarDiapositivesTitol.php?id=" . $id);
        $_POST['titol'] = null;
        $_POST['descripcio'] = null;
    }else{
        header("Location: editarDiapositivesTitol.php?id=".$id);
    }
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirDiapositiva"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $contingut = $_POST["contingut"];
    $id_presentacio = $_POST["id_presentacio"];
    $editDiapo = $_POST['id_diapo'];
    // Insertar los datos en la base de datos
    $dao->setDiapositives($titol, $contingut, $id_presentacio); 
            
    // Redirigir de nuevo a CrearDiapositives.php
    header("Location: CrearDiapositivesTitol.php?id=" . $id_presentacio);         
    exit();          
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirEditarDiapositiva"])) {
        // Obtener los datos del formulario
        $titol = $_POST["titol"];
        $contingut = $_POST["contingut"];
        $id_presentacio = $_POST["id_presentacio"];
        $editDiapo = $_POST['id_diapo'];
        if ($editDiapo != '') {
            $dao->alterDiapositives($titol, $contingut, $editDiapo);
            if ($contingut != '') {
                header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio . "&id_diapo=".$id_diapo);
            }else {
                header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio . "&id_diapo=".$id_diapo);
            }
        }else {
                // Insertar los datos en la base de datos
            $dao->setDiapositives($titol, $contingut, $id_presentacio); 
                
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio);         
        }

        exit();          
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_diapo"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $cont = $dao->getContingutPorID($id_diapo);
    if($cont != NULL ){
        header("Location: editarDiapositivesContingut.php?id=".$id."&id_diapo=".$id_diapo);
    }else {
        header("Location: editarDiapositivesTitol.php?id=".$id."&id_diapo=".$id_diapo);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminarDiapo"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $dao->eliminarDiapo($id_diapo);
    if ($dao == TRUE) {
        header("Location: editarDiapositivesTitol.php?id=".$id . "&feedEliminado=Diapositiva eliminada correctamente.");
    }else{
        echo 'No se pudo eliminar la diapositiva';
    }
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

if (isset($_POST['editarPres'])) {
    $id_presentacion = $_GET['id'];
    
    header("Location: editarPresentacio.php?id=".$id_presentacion);
    exit();
}