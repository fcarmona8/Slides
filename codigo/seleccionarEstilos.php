<?php
include_once("controllers/baseDatos.php");
include_once("controllers/DAO.php");

$dao = new DAO(Connection::getConnection($config['db']));

if (isset($_GET["id"])) {
    $fondoBlancoChecked = '';
    $fondoNegroChecked = '';

    if ($estiloPresentacion === 'fondoBlanco') {
        $fondoBlancoChecked = 'checked';
    } elseif ($estiloPresentacion === 'fondoNegro') {
        $fondoNegroChecked = 'checked';
    }
} else {
    $titol = "Error, no se encuentra la presentacion";

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Estilos</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>  
    <div class="up">
        <div class="volver">
            <button> 
            <svg class="volverButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                Volver
            </button>
        </div>
        
    </div>
<h1 class="tituloSeleccionarEstilos">Seleccionar Estilos</h1>
<div class="containerSeleccionarEstilos">

    <form class="containerSeleccionarEstilos" method="post" action="">

    <div>
        <input type="radio" id="fondoBlanco" name="estilos" value="fondoBlanco" <?php echo $fondoBlancoChecked; ?>>
        <label for="fondoBlanco">Estilo 1</label>

        <div class="diapositivaExemple1">
            <h4 class="diapositivaExemple1Titol">Titol Exemple</h4>
            <p class="diapositivaExemple1Contingut">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quasi debitis atque 
                est enim animi ut facilis voluptatum, accusamus harum nemo quae nam ab incidunt similique quos aliquid deserunt sit.</p>
        </div>

    </div>


    <div>

    <input type="radio" id="fondoNegro" name="estilos" value="fondoNegro" <?php echo $fondoNegroChecked; ?>>
        <label for="fondoNegro">Estilo 2</label>
        <input type="hidden" name="id_presentacion" value="' . $id_presentacion . '">
        
        <div class="diapositivaExemple2">
            <h4 class="diapositivaExemple2Titol">Titol Exemple</h4>
            <p class="diapositivaExemple2Contingut">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus nam expedita ducimus 
                totam ratione incidunt, adipisci animi nulla illo, ex blanditiis iure dolores! Voluptatum, laboriosam ea quaerat quam alias dolor.</p>
        </div>

    </div>
        

        
    </div>
        <div>
            <button class="enviarEstils" type="submit" name="enviarEstilos">Guardar Estilos</button>
        </div>
        
    </form>
    
</div>

<?php
// Verificar si s'ha rebut el id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_presentacion = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviarEstilos"])) {
        $estilos = $_POST["estilos"];

        $dao->editarEstilsPresentacio($id_presentacion, $estilos);

        if ($contingut != '') {
            header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio . "&id_diapo=".$id_diapo);
        }else {
            header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio . "&id_diapo=".$id_diapo);
        }
    }
} else {
    echo 'Error: No se proporcionó un ID de presentación válido.';
}

?>

</body>
<script>
    const btn = document.querySelector('.volver');
    btn.addEventListener('click', function (e) {
        window.history.back();
    });
</script>
</html>
