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
    <div class="titulo">
        <button class="boton-salir" id="volverButton"><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg></button>
    </div>
    <div class="aviso">
        <p id="aviso" style="color: red;"></p>
    </div>
    <div>
    <div class="diapositiva-preview">
        <h1 id="tituloPrevisualizado"></h1>
        <p id="contenidoPrevisualizado"></p>
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
            document.getElementById('tituloPrevisualizado').style.display='none';
            document.getElementById('contenidoPrevisualizado').style.display = 'none';
            // Actualiza el mensaje de aviso
            aviso = 'La diapositiva no tiene contenido.';
        }
        if (!contingut) {
            document.getElementById('tituloPrevisualizado').style.margin='200px';
            document.getElementById('contenidoPrevisualizado').style.display='none';

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
