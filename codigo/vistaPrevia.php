<?php
include_once("baseDatos.php");
include_once("DAO.php");

if (isset($_GET["id"])) {
    $id_presentacio = $_GET["id"];
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
<html class="preview">
<head>
    <title>Vista Previa de Presentación</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body class="preview">
    <?php if (empty($diapositivas)): ?>
        <div class="aviso">Esta presentación no tiene diapositivas.</div>
        <a href="Home.php">Cancelar</a>
    <?php else: ?>
    <div class="diapositiva-preview">
        <h1></h1>
        <p></p>
    </div>
    <div class="controles">
        <button id="anterior">Anterior</button>
        <button id="siguiente">Siguiente</button>
        <a href="Home.php">Cancelar</a>
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
                document.querySelector('.diapositiva-preview h1').textContent = diapositiva.titol;
                document.querySelector('.diapositiva-preview p').textContent = diapositiva.contingut;
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