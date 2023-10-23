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
    <div class="diapositiva">
        <h1><?php echo $titol; ?></h1>
        <p><?php echo $desc; ?></p>
    </div>
    <div class="controles">
        <button id="anterior">Anterior</button>
        <button id="siguiente">Siguiente</button>
        <a href="Home.php">Cancelar</a>
    </div>
    <script>
        var diapositivas = <?php echo json_encode($diapositivas); ?>;
        var currentSlide = 0;

        
        function mostrarDiapositiva(slideIndex) {
                var diapositiva = diapositivas[slideIndex];
                document.querySelector('.diapositiva h1').textContent = diapositiva.titol;
                document.querySelector('.diapositiva p').textContent = diapositiva.contingut;
                currentSlide = slideIndex;
        }

        document.getElementById("anterior").addEventListener("click", function() {
            mostrarDiapositiva(currentSlide - 1);
        });

        document.getElementById("siguiente").addEventListener("click", function() {
            mostrarDiapositiva(currentSlide + 1);
        });

        // Mostrar la primera diapositiva al cargar la página
        mostrarDiapositiva(0);
    </script>
</body>
</html>