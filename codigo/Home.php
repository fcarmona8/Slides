<?php
//index de prova
include_once("baseDatos.php");
require_once 'DAO.php';

$presen = $dao->getPresentacions();


?>
<!DOCTYPE html>
<html>

<head>
    <title>Pantalla Home</title>
    <link rel="stylesheet" href="Styles.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var messageContainer = document.getElementById("message-container");

        // Verifica si existe un mensaje y lo oculta después de 3 segundos (3000 milisegundos)
        if (messageContainer) {
            setTimeout(function() {
                messageContainer.style.display = "none";
            }, 3000); // 3000 ms = 3 segundos
        }
    });
</script>
</head>

<body>
    <h1>Slides</h1>
    <hr class="line">
    
    <div class="container">
        <a href="CrearPresentacio.php" class="button"><svg class='iconoCrear' xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.iconoCrear{fill:#ffffff}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg> Crear una nueva presentación</a>
    </div>
    <div class="presentacionsBD">
        <?php while ($row = $presen->fetch()) : ?>
                    
            <table class='pres'>   
                <tbody class='bodyTable'>
                        <tr>
                            <td class='titolPres'><?= $row['titol']; ?></td>
                        </tr>
                        <tr class="button-row">    
                            <td>
                                <form method='post'class='form-inline'>
                                    <input type="hidden" name="id_presentacion" value="<?= $row['ID_Presentacio']; ?>">
                                    <button class='buttons' type="submit" name="editar_presentacion"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></button>
                                </form>
                                <form method="post" class="form-inline" onsubmit="return confirmarEliminacion(this);">
                                    <input type="hidden" name="id_presentacion" value="<?= $row['ID_Presentacio']; ?>">
                                    <button class='buttons' type="submit" name="eliminar_presentacion"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                                </form>
                                <button class='buttons'><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M288 448H64V224h64V160H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H288c35.3 0 64-28.7 64-64V384H288v64zm-64-96H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H224c-35.3 0-64 28.7-64 64V288c0 35.3 28.7 64 64 64z"/></svg></button>
                                <form method='post' class="form-inline">
                                    <input type="hidden" name="id_presentacion" value="<?= $row['ID_Presentacio']; ?>">
                                    <input type="hidden" name="from" value="Home">
                                    <button class='buttons' type="submit" name="previsualizar_presentacion"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                                </form>
                            </td>
                        </tr>
                    
                </tbody>
            </table>
         <?php endwhile ?>
    </div>
    <div>    <p class="description">Este sitio web te permite crear y gestionar presentaciones de diapositivas de forma sencilla y eficiente. ¡Comienza a crear tu presentación ahora!</p>
</div>
    <script>
    function confirmarEliminacion(form) {
    var result = confirm("¿Estás seguro de que deseas eliminar esta presentación?");
    return result;
}
</script>
</body>


</html>