<?php
// Incluir el archivo de configuración
$config = include('config.php');

// Valores de configuración
$db_host = $config['db_host'];
$db_port = $config['db_port'];
$db_name = $config['db_name'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];

try {
    // Intenta establecer la conexión a la base de datos
    $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    // Configura el modo de errores y atributos de PDO según sea necesario
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Realiza una consulta simple para verificar la conexión
    $stmt = $conn->query('SELECT 1');
    
    // Si la consulta se ejecuta sin errores, la conexión se ha establecido correctamente
    echo 'Conexión exitosa.';
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>