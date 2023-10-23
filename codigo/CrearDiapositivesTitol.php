<?php
include_once("baseDatos.php");
include_once("DAO.php");

if (isset($_GET["id"])) {
    $id_presentacio = $_GET["id"];
    $titol = $dao->getTitolPorID($id_presentacio);
    $diapo = $dao->getDiapositives($id_presentacio);
} else {
    $titol = "Título no disponible";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pantalla Crear Diapositivas Contingut</title>
    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body id="crearDiapositivasContingut">
    <div class="up">
        <div class="volver">
            <button> 
            <svg  class='volverButton' xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                Home
            </button>
        </div>
        <div class="presentacionV2">
            <div class="presentacion-guardada">
                <p id="titulo-guardado" class="tituloGuardado"><?php echo $titol; ?></p>
            </div>
            
        </div>
    </div>

    <div class="down">
        <div class="left">
            <div class="nuevaDiapositiva">
                <select name="tipus" id="tipus">
                    <option value="" selected disabled>Nueva Diapositiva</option>
                    <option value="titol">Titulo</option>
                    <option value="titolContingut">Titulo + contenido</option>
                </select>
            </div>
            <div class="diapositivas">
                <?php while ($row = $diapo->fetch()) : ?>
                    <table class='diapo'>   
                        <tbody>
                            <tr>
                                <td><?= $row['titol']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endwhile ?>  
            </div>
        </div>
        <div class="right">
            <form method="POST" id="formDiapoCont" onsubmit="return validateForm();">
                <!-- Campo oculto para enviar el ID -->
                <input type="hidden" name="id_presentacio" value="<?php echo $id_presentacio; ?>">
                <input type="text" name="titol" class="titolDiapo" placeholder="Titulo" required>
                <span id="titolError" class="error"></span>

                <input type="submit" name="anadirDiapositiva" class="boton-crear" value="Añadir diapositiva">
            </form>
        </div>
    </div>

    <script>
        const button = document.querySelector('.volver');
        document.getElementById("tipus").addEventListener("change", function() {
            if (this.value === "titolContingut") {
                window.location.href = "CrearDiapositivesContingut.php?id=<?php echo $id_presentacio; ?>";
            }
        });
        button.addEventListener('click', function (e) {
            window.location.href = "Home.php";
        });

        function validateForm() {
            const titol = document.forms["formDiapoCont"]["titol"].value;
            let isValid = true;
            
            if (titol.trim() === "") {
                isValid = false;
                document.getElementById("titolError").innerText = "El campo 'Titol' no puede estar vacío";
            } else {
                document.getElementById("titolError").innerText = "";
            }
            
            return isValid;
        }
    </script>
    <script src="Diapositives.js"></script>
    
</body>
</html>