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

$editDiapo = FALSE;
$id_diapo = '';
$titolDiapo = "";
$contingut = "";

if (isset($_GET["id_diapo"])) {
    $id_diapo = $_GET["id_diapo"];
    if ($id_diapo != '') {
        $titolDiapo = $dao->getTitolDiapoPorID($id_diapo);
        $contingut = $dao->getContingutPorID($id_diapo);

        $editDiapo = TRUE;
    }
    
}else{
    $editDiapo =FALSE;
}

if ($editDiapo === false) {
    // Obtiene el último ID de diapositiva de la base de datos
    $ultimoIDDiapo = $dao->obtenerUltimoIDDiapositiva();

    // Incrementa el ID para asignar el nuevo ID
    $nuevoIDDiapo = $ultimoIDDiapo + 1;

    // Establece los valores de título y contenido desde el formulario si no existe la diapositiva
    $titolDiapo = $_POST["titol"] ?? "";
    $contingut = $_POST["contingut"] ?? "";
}
?>
  
<!DOCTYPE html>
<html>
<head>
    <title>Pantalla Crear Diapositivas Contingut</title>
    <link rel="stylesheet" href="Styles.css">
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
            
            <form method='post' class="presentacion-guardada">
                <button class="tituloGuardado" name="editarPres" type='submit' ><?php echo $titol; ?></button>
                <div class='buttons-editar'>
                    <form method='post'>
                        <input type="hidden" name="id_presentacion" value="<?= $id_presentacio; ?>">
                        <input type="hidden" name="from" value="Editar">
                        <button type="submit" name="previsualizar_presentacion"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                    </form>
                    <button class="editarEstils">
                        <!-- Boton editar estilo de la presentacion -->
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M339.3 367.1c27.3-3.9 51.9-19.4 67.2-42.9L568.2 74.1c12.6-19.5 9.4-45.3-7.6-61.2S517.7-4.4 499.1 9.6L262.4 187.2c-24 18-38.2 46.1-38.4 76.1L339.3 367.1zm-19.6 25.4l-116-104.4C143.9 290.3 96 339.6 96 400c0 3.9 .2 7.8 .6 11.6C98.4 429.1 86.4 448 68.8 448H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H208c61.9 0 112-50.1 112-112c0-2.5-.1-5-.2-7.5z"/></svg>
                    </button>
                        
                </div>
                </form>
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
                    <div class='diapo'>   
                            
                        <div>
                            <form method='post'>
                                <input type="hidden" name="id" value="<?= $id_presentacio?>">
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                <button type='submit' name="editar_diapo" class="button-diapo"><?= $row['titol']; ?></button>
                            </form>
                        </div>
                        
                        <div class='buttons-orden'>
                            <form method="post"  class='button-upDown'>
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                    <button type="submit" class="buttonOrden name="ordenDiapoUp">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>                    </button>
                            </form>
                            <form method="post" class='button-upDown'>
                                <input type="hidden" name="id_diapo" value="<?= $row['ID_Diapositiva'];?>">
                                    <button type="submit" class="buttonOrden" name="ordenDiapoDown">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z"/></svg>                    </button>
                            </form>
                        </div>
                           
                    </div>
                <?php endwhile ?>  
            </div>
        </div>
        <div class="right">
            <form method="POST" id="formDiapoCont">
                <!-- Campo oculto para enviar el ID -->
                <?php if ($editDiapo) {
                    echo "<input type='hidden' name='id_diapo' value='$id_diapo'>";}?>
                <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                <input type="text" id="titol" name="titol" class="titolContDiapo" placeholder="Titulo" maxlength="25"required<?php if ($editDiapo === TRUE) {
                   ?> value="<?= $titolDiapo; ?>" <?php ;
                   } ?> >
                <textarea id="contingut" name="contingut" class="contingutDiapo" placeholder="Contenido" required ><?php if ($editDiapo === TRUE) {
                   echo $contingut;
                   } ?></textarea>
                <input type="submit" name="anadirEditarDiapositiva" class="boton-crear" <?php if ($editDiapo === TRUE) {
                        echo 'value="Guardar diapositiva"';
                    }else{
                        echo 'value="Añadir diapositiva"';
                    }
                    ?> >            
            </form>
            <div class='buttons-diapositiva'>
                <!-- Boton previsualizar diapositiva -->
                <form method="post" action="previsualitzarDiapositiva.php">
                    <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                    <input type="hidden" name="id_diapo" value="<?= $id_diapo; ?>">
                    <input type="hidden" name="titol" class="titolContDiapo" placeholder="Título" value="<?= $titolDiapo; ?>">
                    <input type="hidden" name="contingut" class="contingutDiapo" placeholder="Contenido" value="<?= $contingut; ?>">
                    <button type='submit' onclick="obtenerValores()" name='previsualizar_diapo'><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                </form>
                <form method = 'post'>  
                    <?php if ($editDiapo) {
                            echo "<input type='hidden' name='id_diapo' value='$id_diapo'>";}?>
                    <input type="hidden" name="id" value="<?= $id_presentacio; ?>">
                    <button type='submit' name='eliminarDiapo'>
                        <!-- Boton eliminar diapositiva -->
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        const button = document.querySelector('.volver');
        const buttonEstils = document.querySelector('.editarEstils');
        document.getElementById("tipus").addEventListener("change", function() {
            if (this.value === "titol") {
                window.location.href = "editarDiapositivesTitol.php?id=<?php echo $id_presentacio; ?>";
            }
        });
        button.addEventListener('click', function (e) {
            window.location.href = "Home.php";
        });
        buttonEstils.addEventListener('click', function (e) {
            e.preventDefault();
            const url = "seleccionarEstilos.php?id=<?php echo $id_presentacio; ?>";
            console.log(url);
            window.location.href = url;
        });

        function obtenerValores() {
            var titolDiapo = document.getElementById('titol').value;
        var contingut = document.getElementById('contingut').value;

        // Almacena los valores en localStorage para que estén disponibles en la nueva página
        localStorage.setItem('titolDiapo', titolDiapo);
        localStorage.setItem('contingut', contingut);
        }
    </script>
    <script src="Diapositives.js"></script>
</body>
</html>