<?php
// Obtener el valor de $id_presentacio de PHP
$id_presentacio = isset($_GET["id"]) ? $_GET["id"] : "";
?>

<!DOCTYPE html>
<html class="preview">
<head>
    <title>Previsualización de la Diapositiva</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body class="preview">
    <div class="diapositiva-preview">
        <h1 id="tituloPrevisualizado"></h1>
        <p id="contenidoPrevisualizado"></p>
        <p id="aviso" style="color: red;"></p>
        <button class="boton-crear" id="volverButton">Volver</button>
    </div>

    <script>
        // Obtiene los valores almacenados en localStorage
        var titolDiapo = localStorage.getItem('titolDiapo');
        var contingut = localStorage.getItem('contingut');

        // Variable para el mensaje de aviso
        var aviso = '';

        // Comprueba si no hay título
        if (!titolDiapo) {
            // Oculta el contenido
            document.getElementById('contenidoPrevisualizado').style.display = 'none';
            // Actualiza el mensaje de aviso
            aviso = 'La diapositiva no tiene contenido.';
        }

        // Muestra los valores en la página
        document.getElementById('tituloPrevisualizado').textContent = titolDiapo;
        document.getElementById('contenidoPrevisualizado').textContent = contingut;
        document.getElementById('aviso').textContent = aviso;

        localStorage.removeItem('titolDiapo');
        localStorage.removeItem('contingut');


        document.getElementById("volverButton").addEventListener("click", function() {
        // Redirige a la página anterior
        window.history.back(); // Esto redirige a la página anterior en el historial del navegador
    });
    </script>
</body>
</html>
