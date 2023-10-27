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
$infoDiapo = FALSE;
$id_diapo = '';
$titolDiapo = "";
$contingut = "";

if (isset($_GET["id_diapo"])) {
    $id_diapo = $_GET["id_diapo"];
    if ($id_diapo != '') {
        $titolDiapo = $dao->getTitolDiapoPorID($id_diapo);
        $contingut = $dao->getContingutPorID($id_diapo);

        $infoDiapo = TRUE;
    }
    
}else{
    $infoDiapo =FALSE;
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
                <div class='buttons-editar'>
                    <form method='post'>
                        <input type="hidden" name="id_presentacion" value="<?= $id_presentacio; ?>">
                        <input type="hidden" name="from" value="Crear">
                        <button class='buttons' type="submit" name="previsualizar_presentacion"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <div class="down">
        <div class="left">
            <div class="nuevaDiapositiva">
                <button name="tipusTitol" class="buttonType">Titulo</button>
                <button name="tipusContingut" class="buttonType">Contenido</button>
            </div>
            <div class="diapositivas">
                <?php while ($row = $diapo->fetch()) : ?>
                    <div class='diapo'>   
                        <div>
                            <form method='post'>
                                <input type="hidden" name="id" value="<?= $id_presentacio?>">
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                <button type='submit' name="getInfoDiapo" class="button-diapo"><?= $row['titol']; ?></button>
                            </form>
                        </div>
                        
                        <div class='buttons-orden'>
                            <form method="post"  class='button-upDown'>
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                    <button type="submit" name="ordenDiapoUp">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>                    </button>
                            </form>
                            <form method="post" class='button-upDown'>
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                    <button type="submit" name="ordenDiapoDown">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z"/></svg>                    </button>
                            </form>
                        </div>
                            
                    </div>
                <?php endwhile ?>  
            </div>
        </div>
        <div class="right">
            <form method="POST" id="formDiapoCont" onsubmit="return validateForm();">
            <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                <?php if ($infoDiapo === TRUE) {
                   ?><input type="text" name="titol" class="titolDiapo" id='titol' value=' <?=$titolDiapo?>'readOnly > <?php ;
                   }else {
                    echo '<input type="text" name="titol" id="titol" class="titolDiapo" placeholder="Titulo" maxlength="25"required/>';
                   } ?>                
                   <input type="submit" name="anadirDiapositiva" class="boton-crear" value="Añadir diapositiva">
            </form>
            <div class='buttons-diapositiva'>
                <!-- Boton previsualizar diapositiva -->
                <form method="post" action="previsualitzarDiapositiva.php">
                    <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                    <button type='submit' onclick="obtenerValores()" name='previsualizar_diapo'><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const button = document.querySelector('.volver');
        document.querySelector("button[name='tipusTitol']").addEventListener("click", function() {            
            window.location.href = "CrearDiapositivesTitol.php?id=<?php echo $id_presentacio; ?>";
            
        });
        document.querySelector("button[name='tipusContingut']").addEventListener("click", function() {
            window.location.href = "CrearDiapositivesContingut.php?id=<?php echo $id_presentacio; ?>";
            
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

        function obtenerValores() {
            var titolDiapo = document.getElementById('titol').value.toString();
            // Almacena los valores en localStorage para que estén disponibles en la nueva página
            localStorage.setItem('titolDiapo', titolDiapo);
        }
    </script>
    <script src="Diapositives.js"></script>
    
</body>
</html>