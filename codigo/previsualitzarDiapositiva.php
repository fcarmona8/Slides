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
    </div>

    <script>
        // Obtiene los valores almacenados en localStorage
        var titolDiapo = localStorage.getItem('titolDiapo');
        var contingut = localStorage.getItem('contingut');

        // Muestra los valores en la página
        document.getElementById('tituloPrevisualizado').textContent = titolDiapo;
        document.getElementById('contenidoPrevisualizado').textContent = contingut;

        // Limpia los valores de localStorage después de usarlos
        localStorage.removeItem('titolDiapo');
        localStorage.removeItem('contingut');
    </script>
</body>
</html>
