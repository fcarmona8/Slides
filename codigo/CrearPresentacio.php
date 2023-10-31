<?php
include_once("controllers/baseDatos.php");
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
            <svg  class='volverButton' xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>

                Home
            </button>
        </div>
        <div class="presentacion">
            <form method="POST" id="formPresentacio" onsubmit="return validateForm();">
                <input type="text" name="titol" class="titol" placeholder="Titulo de la presentación" maxlength="30" required>
                <span id="titolError" class="error"></span>

                <textarea type="text" name="descripcio" class="descripcio" placeholder="Descripción" required></textarea>
                <span id="descripcioError" class="error"></span>
                
                <input type="submit" name="anadirPresentacio" class="boton-crear" value="Crear Presentación">   
            </form>
        </div>
    </div>
    <script src="controllers/Presentacio.js"></script>
</body>
</html>
