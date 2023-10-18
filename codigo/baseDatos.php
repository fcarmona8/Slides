<?php

$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirPresentacio"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];

    // Insertar los datos en la base de datos
    $dao->setPresentacions($titol, $descripcio);
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
