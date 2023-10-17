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
            <form method="get">
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la presentacion">
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
                <input type="submit" name="botonCrear" value="Crear" class="añadir">   
            </form>
            <div class="presentacion-guardada" style="display: none;">
                <p id="titulo-guardado" class="tituloGuardado"></p>
            </div>
        </div>
    </div>
    
    
    <div class="down">
        <div class="left">
            <div class="nuevaDiapositiva">
                <select name="tipus" id="tipus">
                    <option value="" selected disabled>Nueva Diapositiva</option>
                    <option value="titol">Titol</option>
                    <option value="titolContingut">Titol + contingut</option>
                </select>
            </div>
            <div class="diapositivas">
            </div>
        </div>
    
        <div class="right">

            <div class="botones">
                <button name="añadirDiapositiva">Añadir diapositiva</button>
                <button name="finalizar">Finalizar presentacion</button>
            </div>
        </div>
        
    </div>
    <script src="Presentacio.js"></script>
</body>
</html>
