<?php
// Si se usa el archivo config descomentar y comentar las variables de abajo
// $config = include('config.php');

// $db_host = $config['db_host'];
// $db_port = $config['db_port'];
// $db_name = $config['db_name'];
// $db_user = $config['db_user'];
// $db_pass = $config['db_pass'];

$db_host = '192.168.1.12';
$db_name = 'slidescarmonagalindojumelle';
$db_user = 'root';
$db_pass = 1234;
$db_port = 3306;


try {
    // Intenta establecer la conexión a la base de datos
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // Configura el modo de errores y atributos de PDO según sea necesario
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Si la consulta se ejecuta sin errores, la conexión se ha establecido correctamente
    echo 'Conexión exitosa.';
} catch (PDOException $e) {
    var_dump($e);
}

$conn = null;
?>