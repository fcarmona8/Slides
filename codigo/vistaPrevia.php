<?php
include_once("baseDatos.php");
include_once("DAO.php");

if (isset($_GET["id"])) {
    $id_presentacio = $_GET["id"];
    $from = isset($_GET["from"]) ? $_GET["from"] : "Página desconocida"; // Obtén el valor de "from"
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
        <a href="<?php echo $from === 'Home' ? 'Home.php' : ($from === 'Editar' ? 'editarDiapositivesTitol.php?id=' . $id_presentacio : 'crearDiapositivesTitol.php?id=' . $id_presentacio); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></a>
    </div>
    <div class="preview">
    <?php if (empty($diapositivas)): ?>
        <div class="aviso">Esta presentación no tiene diapositivas.</div>
        <a href="<?php echo $from === 'Home' ? 'Home.php' : ($from === 'Editar' ? 'editarDiapositivesTitol.php?id=' . $id_presentacio : 'crearDiapositivesTitol.php?id=' . $id_presentacio); ?>">Cancelar</a>
    <?php else: ?>
    <div class="diapositiva-preview-<?php echo $estiloPresentacion;?>">
        <h1></h1>
        <p></p>
    </div>
    <div class="controles">
        <button id="anterior"><svg class="rotate" xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>
        <button id="siguiente"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>
    </div>
    </div>
    <?php endif; ?>
    <script>
        <?php if (!empty($diapositivas)): ?>
        var diapositivas = <?php echo json_encode($diapositivas); ?>;
        var currentSlide = 0;
        var totalSlides = diapositivas.length;

        var anteriorButton = document.getElementById("anterior");
        var siguienteButton = document.getElementById("siguiente");
        
        function mostrarDiapositiva(slideIndex) {
                var diapositiva = diapositivas[slideIndex];
                document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> h1').textContent = diapositiva.titol;
                document.querySelector('.diapositiva-preview-<?php echo $estiloPresentacion;?> p').textContent = diapositiva.contingut;
                currentSlide = slideIndex;

                // Habilitar o deshabilitar botones según la posición de la diapositiva
                anteriorButton.disabled = currentSlide === 0;
                siguienteButton.disabled = currentSlide === totalSlides - 1;
        }

        document.getElementById("anterior").addEventListener("click", function() {
            mostrarDiapositiva(currentSlide - 1);
        });

        document.getElementById("siguiente").addEventListener("click", function() {
            mostrarDiapositiva(currentSlide + 1);
        });

        // Mostrar la primera diapositiva al cargar la página
        mostrarDiapositiva(0);
        <?php endif; ?>
    </script>
</body>
</html>