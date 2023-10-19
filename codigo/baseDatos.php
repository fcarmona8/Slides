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
        header("Location: CrearDiapositives.php?id=" . $lastInsertId);
        $_POST['titol'] = null;
        $_POST['descripcio'] = null;
    }else{
        header("Location: CrearPresentacio.php");
    }
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
