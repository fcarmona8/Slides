<?php
include_once("controllers/baseDatos.php");
include_once("controllers/DAO.php");

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
$imatge = "";

if (isset($_GET["id_diapo"])) {
    $id_diapo = $_GET["id_diapo"];
    if ($id_diapo != '') {
        $titolDiapo = $dao->getTitolDiapoPorID($id_diapo);
        $contingut = $dao->getContingutPorID($id_diapo);
        $imatge = $dao->getImatgePorID($id_diapo);

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
                
                <div class='buttons-editar'>
                    <p id="titulo-guardado" class="tituloGuardado"><?php echo $titol; ?> 
                    <form method='post'>
                            <input type="hidden" name="id_presentacion" value="<?= $id_presentacio; ?>">
                            <input type="hidden" name="from" value="Crear">
                            <button class='buttons' type="submit" name="previsualizar_presentacion">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                    
                            </button>
                        </form>
                    </p>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="down">
        <div class="left">
            <div class="nuevaDiapositiva">
                <button name="tipusTitol" class="buttonType">Titulo</button>
                <button name="tipusContingut" class="buttonType">Contenido</button>
                <button name="tipusImatge" class="buttonType">Imagen</button>
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
        <div id="confirmacion-eliminar" class="confirm-box">
            <p>Este archivo pesa más que 2MB. Elija otro porfavor.</p>
            <button id="confirmar-eliminar">Confirmar</button>
         </div>
        <div class="right">
            <form method="POST" enctype="multipart/form-data"id="formDiapoCont" action=" <?= $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                <?php if ($infoDiapo === TRUE) {
                   ?><input type="text" name="titol" class="titolContDiapo" id='titol' value=' <?=$titolDiapo?> 'readOnly  > <?php ;
                } else {
                    echo '<input type="text" name="titol" id="titol" class="titolContDiapo" placeholder="Titulo" maxlength="25"required/>';
                   } ?>

                   <?php if ($infoDiapo === TRUE) {
                        echo '<p name="contingut" class="contingutDiapo" id="contingut"> '. $contingut .'</p>';
                   }else {
                    echo '<textarea name="contingut" id="contingut" class="contingutDiapo" placeholder="Contenido" required ></textarea>';
                   } ?>
                    
                    <?php if ($infoDiapo === TRUE) {
                        echo '<p class="imatge"> '.$imatge.'</p>';
                   }else {
                    echo '<input input type="file" name="imatge" id="imatge" required >';
                   } ?>  
                   
                   <?php if($infoDiapo != TRUE){
                        echo '<input type="submit" name="anadirDiapositiva" class="boton-crear" value="Añadir diapositiva">';
                   }?>
                   
                  
            </form>
            <div class='buttons-diapositiva'>
                <!-- Boton previsualizar diapositiva -->
                <form method="post" action="previsualitzarDiapositiva.php">
                    <input type="hidden" name="id_presentacio" value="<?= $id_presentacio; ?>">
                    <input type="hidden" name="id_diapo" value="<?= $id_diapo; ?>">
                    <input type="hidden" name="titol" class="titolContDiapo" placeholder="Título" value="<?= $titolDiapo; ?>">
                    <input type="hidden" name="contingut" class="contingutDiapo" placeholder="Contenido" value="<?= $contingut; ?>">
                        <button type='submit' onclick="obtenerValores()" name='previsualizar_diapo'>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                    
                        </button>
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
        document.querySelector("button[name='tipusImatge']").addEventListener("click", function() {
            window.location.href = "CrearDiapositivesImatge.php?id=<?php echo $id_presentacio; ?>";
            
        });
        button.addEventListener('click', function (e) {
            window.location.href = "index.php";
        });

        function obtenerValores() {
            var titolDiapo = document.getElementById('titol').value;
            var contingut = document.getElementById('contingut').value;

            // Almacena los valores en localStorage para que estén disponibles en la nueva página
            localStorage.setItem('titolDiapo', titolDiapo);
            localStorage.setItem('contingut', contingut);
        }

        // Obtiene los valores almacenados en localStorage
        var titolDiapo = localStorage.getItem('titolDiapo');
        var contingut = localStorage.getItem('contingut');

            // Función para borrar los valores de localStorage
        function clearLocalStorage() {
            localStorage.removeItem('titolDiapo');
            localStorage.removeItem('contingut');
        }

        // Agrega un evento para borrar los valores cuando se cargue la página
        window.addEventListener('load', clearLocalStorage);
        function confirmarEliminacion(file) {
        document.getElementById('confirmacion-eliminar').style.display = 'block';
        
        document.getElementById('confirmar-eliminar').onclick = function() {
            document.getElementById('confirmacion-eliminar').style.display= 'none';
            file.value = ''
        };
        
        }
        const fileInput = document.querySelector("input[name='imatge']");
    fileInput.addEventListener('change', function(){
        const size = this.files[0].size /1024 /1024;
        if(size >= 2){return confirmarEliminacion(fileInput);};
    })
    </script>
    <script src="controllers/Diapositives.js"></script>
</body>
</html>