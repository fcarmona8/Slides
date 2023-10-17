<?php

$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

try {    
    if(isset($_REQUEST['anadirPresentacio'])){
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];

        $dao->setPresentacions($titulo, $descripcion);
    };
} catch (PDOException $e) {
    echo $e;
}

// if(isset($_REQUEST['añadirDiapositiva'])){

// }

// if(isset($_REQUEST['fianlizar'])){

// }
