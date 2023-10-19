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
    <title>Pantalla Crear Presentació</title>
    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body id="crearPresentacio">
    <div class="up">
        <div class="volver">
            <button> 
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 513">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                </svg> 
                Volver
            </button>
        </div>
        <div class="presentacion">
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
                    <option value="titol">Titol</option>
                    <option value="titolContingut">Titol + contingut</option>
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
    
        
        
    </div>
    <script>
        document.getElementById("tipus").addEventListener("change", function() {
            if (this.value === "titolContingut") {
                window.location.href = "CrearDiapositivesContingut.php?id=<?php echo $id_presentacio; ?>";
            }
            if (this.value === "titol") {
                window.location.href = "CrearDiapositivesTitol.php?id=<?php echo $id_presentacio; ?>";
            }
        });
    </script>
    <script src="Diapositives.js"></script>
</body>
</html>
