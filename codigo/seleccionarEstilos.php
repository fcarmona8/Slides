<?php
$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Estilos</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>  
    <div class="up">
        <div class="volver">
            <button> 
            <svg  class='volverButton' xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                Volver
            </button>
        </div>
        
    </div>
<div class="containerSeleccionarEstilos">
    <h1 class="tituloSeleccionarEstilos">Seleccionar Estilos</h1>

    <form method="post" action="">
        <label for="estilos">Estilo:</label>
        <select name="estilos" id="estilos">
        <option value="fondoBlanco">Fondo Blanco</option>
        <option value="fondoNegro">Fondo Negro</option>
        </select>
        <input type="hidden" name="id_presentacion" value="' . $id_presentacion . '">
        <div>
            <button class="enviarEstils" type="submit" name="enviarEstilos">Guardar Estilos</button>
        </div>
        
    </form>
</div>

<?php
// Verificar si s'ha rebut el id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_presentacion = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviarEstilos"])) {
        $estilos = $_POST["estilos"];

        $dao->editarEstilsPresentacio($id_presentacion, $estilos);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
} else {
    echo 'Error: No se proporcionó un ID de presentación válido.';
}

?>

</body>
<script>
    const btn = document.querySelector('.volver');
    btn.addEventListener('click', function (e) {
        window.history.back();
    });
</script>
</html>
