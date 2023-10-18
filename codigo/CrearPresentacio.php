<?php
include_once("baseDatos.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pantalla Crear Presentació</title>
    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body id="crearPresentacio">
    <div class="up">
        <div class="volver">
            <button> 
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 513">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                </svg> 
                Volver
            </button>
        </div>
        <div class="presentacion">
            <form method="POST">
                <input type="text" name="titol" id="titol" placeholder="Titulo de la presentacion">
                <input type="text" name="descripcio" id="descripcio" placeholder="Descripcio">
                <input type="submit" name="anadirPresentacio" value="Crear">   
            </form>
        </div>
    </div>
    <script src="Presentacio.js"></script>
</body>
</html>
