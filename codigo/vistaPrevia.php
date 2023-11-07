<?php

// Incluye archivos de funciones necesarios
include_once("controllers/baseDatos.php");
include_once("controllers/DAO.php");

// Comprueba si se proporciona un parámetro "id" en la URL
if (isset($_GET["id"])) {
    $id_presentacio = $_GET["id"];
    // Obtiene el valor del parámetro "from" en la URL o establece un valor predeterminado
    $from = isset($_GET["from"]) ? $_GET["from"] : "Página desconocida";
    // Obtiene el título, descripción y diapositivas de la presentación
    $titol = $dao->getTitolPorID($id_presentacio);
    $desc = $dao->getDescPorID($id_presentacio);
    $diapositivas = $dao->getDiapositivesVista($id_presentacio);
} else {
    $titol = "Error, no se encuentra la presentacion";
    $desc = "";
    $diapositivas = array();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vista Previa de Presentación</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body class="vista">
    <div class="titulo">
    <a href="<?php
    if ($from === 'Home') {
        echo 'index.php';
    } elseif ($from === 'Editar') {
        echo 'editarDiapositivesTitol.php?id=' . $id_presentacio;
    } elseif ($from === 'Vista') {
        echo 'vistaPreviaClient.php?id=' . $id_presentacio;
    } else {
        echo 'CrearDiapositivesTitol.php?id=' . $id_presentacio;
    }
    ?>"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></a>
    </div>
    <div class="preview">
    <?php if (empty($diapositivas)): ?>
        <div class="aviso">Esta presentación no tiene diapositivas.</div>
    <?php else: ?>
    <div class="diapositiva-preview-<?php echo $estiloPresentacion;?>">
        <h1></h1>
        <div class="contenido">
            <p></p>
            <img id="imagen" src="" style="width: 250px; height: 250px; margin-right: 50px">
        </div>
    </div>
    <div class="controles">
        <button id="anterior"><svg class="rotate" xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>
        <button id="siguiente"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>
    </div>
    </div>
    <?php endif; ?>
    <script>
        <?php if (!empty($diapositivas)): ?>
        // Comprueba si hay diapositivas disponibles para mostrar
        var diapositivas = <?php echo json_encode($diapositivas); ?>;
        var currentSlide = 0; // Inicializa el índice de la diapositiva actual
        var totalSlides = diapositivas.length; // Obtiene el número total de diapositivas

        var anteriorButton = document.getElementById("anterior"); // Obtiene el botón de diapositiva anterior
        var siguienteButton = document.getElementById("siguiente"); // Obtiene el botón de diapositiva siguiente

        function mostrarDiapositiva(slideIndex) {
            // Función para mostrar una diapositiva en función del índice
            var diapositiva = diapositivas[slideIndex];
            document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> h1').textContent = diapositiva.titol;
            document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> p').textContent = diapositiva.contingut;
            
            document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> img').src = diapositiva.imatge;
            var tituloElement = document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> h1');
            var contenidoElement = document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> p');
            var imatgeElement = document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> img');
            var img = document.getElementById("imagen");
            const cont = document.querySelector('.contenido');
            if (diapositiva.contingut === null) {
                // Si el contenido es nulo, ocultar el contenido
                contenidoElement.style.display = 'none';
                imatgeElement.style.display='none';
            } else {
                if(diapositiva.imatge != null){       
                    // Si hay una imagen en la diapositiva, ajusta el diseño             
                    cont.style.display = 'flex';
                    cont.style.flexDirection= 'row';
                    cont.style.justifyContent= 'space-around';

                    
                    tituloElement.textContent = diapositiva.titol;
                    contenidoElement.textContent = diapositiva.contingut;
                    contenidoElement.style.display = 'flex';
                    contenidoElement.style.width = '500px';
                    contenidoElement.style.padding = '10px'

                    imatgeElement.src = diapositiva.imatge;
                    imatgeElement.style.display = 'flex';
                }else{
                    // Si no hay una imagen, muestra solo el contenid
                    contenidoElement.style.display = 'flex';
                    imatgeElement.style.display = 'none';
                }
                
                
            }

            currentSlide = slideIndex;

            // Habilitar o deshabilitar botones según la posición de la diapositiva
            anteriorButton.disabled = currentSlide === 0;
            siguienteButton.disabled = currentSlide === totalSlides - 1;
        }


        document.getElementById("anterior").addEventListener("click", function() {
            // Asocia una función a la acción de hacer clic en el botón anterior
            mostrarDiapositiva(currentSlide - 1); // Muestra la diapositiva anterior
        });

        document.getElementById("siguiente").addEventListener("click", function() {
            // Asocia una función a la acción de hacer clic en el botón siguiente
            mostrarDiapositiva(currentSlide + 1); // Muestra la diapositiva siguiente
        });

        // Mostrar la primera diapositiva al cargar la página
        mostrarDiapositiva(0);
        <?php endif; ?>
    </script>
</body>
</html>