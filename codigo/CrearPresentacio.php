<?php
include_once("baseDatos.php")
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pantalla Crear Presentació</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body id="crearPresentacio">
    <div class="up">
        <div class="volver">
            <button>Volver</button>
        </div>
        <div class="presentacion">
            <form name="creaPrese" method="post">
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la presentacion">
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
                <input class="añadir" type="submit" name="anadirPresentacio" value="Crear"></input>
            </form>
            <div class="presentacion-guardada" style="display: none;">
                <p id="titulo-guardado"></p>
                <p id="descripcion-guardada"></p>
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
