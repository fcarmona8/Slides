<?php

$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirPresentacio"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    $estilPresentacio = 'fondoBlanco';
    $password = $_POST["password"];

    if ($password === "") {
        $password = null;
    } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    if ($titol != '' && $descripcio != '') {
        // Insertar los datos en la base de datos y obtener el ID generado
        $dao->setPresentacions($titol, $descripcio, $estilPresentacio, $hashPassword);

        // Obtener el ID generado automáticamente
        $lastInsertId = $dao->getLastInsertId();

        // Obtén el mensaje que deseas pasar
        $mensaje = "Presentación creada correctamente";

        // Codifica el mensaje usando una función de cifrado
        $mensajeCodificado = base64_encode($mensaje);

        // Redirigir a CrearDiapositives.php con el ID de la presentación como parámetro en la URL
        header("Location: CrearDiapositivesTitol.php?id=" . $lastInsertId . "&mensaje=" . $mensajeCodificado);
        $_POST['titol'] = null;
        $_POST['descripcio'] = null;
        exit();
    }else{
        // Redirigir de nuevo a CrearPresentacio.php
        header("Location: CrearPresentacio.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cambiarPresentacion"])) {
    // Obtener los datos del formulario
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    $id = $_POST['id_presentacio'];
    if ($titol != '' && $descripcio != '') {
            // Insertar los datos en la base de datos y obtener el ID generado
        $dao->editarPresentacio($titol, $descripcio,$id);

        header("Location: editarDiapositivesTitol.php?id=" . $id);
        $_POST['titol'] = null;
        $_POST['descripcio'] = null;
    }else{
        header("Location: editarDiapositivesTitol.php?id=".$id);
    }
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirDiapositiva"])) {
    if (isset($_FILES['imatge'])) {
        // Obtener los datos del formulario
        $titol = $_POST["titol"];
        $contingut = $_POST["contingut"];
        $id_presentacio = $_POST["id_presentacio"];

        if(strlen($titol) > 25){
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesContingut.php?id=" . $id_presentacio);
        } elseif(strlen($contingut) > 640){
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesContingut.php?id=" . $id_presentacio);
        } else{
        if ($_FILES["imatge"]["error"] == UPLOAD_ERR_OK) { 
            $folderLocation = "uploaded";
            if (!file_exists($folderLocation)) { 
                mkdir($folderLocation);
                if(!file_exists($folderLocation)){
                    $command = "sudo mkdir $folderLocation";
                    exec($command, $output, $returnCode);
                }
            }
            move_uploaded_file($_FILES["imatge"]["tmp_name"], "$folderLocation/" . basename($_FILES["imatge"]["name"])); 
            
            $imatge = $folderLocation ."/".basename($_FILES["imatge"]["name"]);
        }
        // Insertar los datos en la base de datos
        $dao->setDiapositivesImatge($titol, $contingut, $imatge, $id_presentacio); 
                
        // Redirigir de nuevo a CrearDiapositives.php
        header("Location: CrearDiapositivesImatge.php?id=" . $id_presentacio); 
        }   
    }else if (isset($_POST['contingut']) && (isset($_FILES['imatge']) == FALSE)) {

        // Obtener los datos del formulario
        $titol = $_POST["titol"];
        $contingut = $_POST["contingut"];
        $id_presentacio = $_POST["id_presentacio"];

        if(strlen($titol) > 25){
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesContingut.php?id=" . $id_presentacio);
        } elseif(strlen($contingut) > 640){
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesContingut.php?id=" . $id_presentacio);
        } else{
            // Insertar los datos en la base de datos
            $dao->setDiapositives($titol, $contingut, $id_presentacio); 
                    
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesContingut.php?id=" . $id_presentacio);
        }
     }else {
        
        // Obtener los datos del formulario
        $titol = $_POST["titol"];
        $id_presentacio = $_POST["id_presentacio"];

        if(strlen($titol) > 25){
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesTitol.php?id=" . $id_presentacio);
        }else{
            // Insertar los datos en la base de datos
            $dao->setDiapositivesTitol($titol, $id_presentacio); 
                    
            // Redirigir de nuevo a CrearDiapositives.php
            header("Location: CrearDiapositivesTitol.php?id=" . $id_presentacio);
        }
     }   
    exit();              
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["anadirEditarDiapositiva"])) {
        if (isset($_POST['contingut'])) {
            if (isset($_FILES['imatge'])) {
                    // Obtener los datos del formulario
                $titol = $_POST["titol"];
                $contingut = $_POST["contingut"];
                $id_presentacio = $_POST["id_presentacio"];
                if(strlen($titol) > 25){
                    // Redirigir de nuevo a CrearDiapositives.php
                    header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio);
                } elseif(strlen($contingut) > 640){
                    // Redirigir de nuevo a CrearDiapositives.php
                    header("Location: erearDiapositivesContingut.php?id=" . $id_presentacio);
                } else{
                if ($_FILES["imatge"]["error"] == UPLOAD_ERR_OK) { 
                    $folderLocation = "uploaded";
                    if (!file_exists($folderLocation)) { 
                        mkdir($folderLocation);
                        if(!file_exists($folderLocation)){
                            $command = "sudo mkdir $folderLocation";
                            exec($command, $output, $returnCode);
                        }
                    }
                    move_uploaded_file($_FILES["imatge"]["tmp_name"], "$folderLocation/" . basename($_FILES["imatge"]["name"])); 
                    
                    $imatge = $folderLocation ."/".basename($_FILES["imatge"]["name"]);
                }
                if (isset($_POST['id_diapo'])) {  
                    $editDiapo = $_POST['id_diapo'];
                    $dao->alterDiapositivesImatge($titol, $contingut, $imatge, $editDiapo);
                    header("Location: editarDiapositivesImatge.php?id=" . $id_presentacio . "&id_diapo=".$editDiapo);
                    
                }else {
                        // Insertar los datos en la base de datos
                    $dao->setDiapositivesImatge($titol, $contingut, $imatge,$id_presentacio); 
                        
                    // Redirigir de nuevo a CrearDiapositives.php
                    header("Location: editarDiapositivesImatge.php?id=" . $id_presentacio);
                }
            }
            }else{
            // Obtener los datos del formulario
            $titol = $_POST["titol"];
            $contingut = $_POST["contingut"];
            $id_presentacio = $_POST["id_presentacio"];
            if(strlen($titol) > 25){
                // Redirigir de nuevo a CrearDiapositives.php
                header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio);
            } elseif(strlen($contingut) > 640){
                // Redirigir de nuevo a CrearDiapositives.php
                header("Location: erearDiapositivesContingut.php?id=" . $id_presentacio);
            } else{
            if (isset($_POST['id_diapo'])) {  
                $editDiapo = $_POST['id_diapo'];
                $dao->alterDiapositives($titol, $contingut, $editDiapo);
                header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio . "&id_diapo=".$editDiapo);
                
            }else {
                    // Insertar los datos en la base de datos
                $dao->setDiapositives($titol, $contingut,$id_presentacio); 
                    
                // Redirigir de nuevo a CrearDiapositives.php
                header("Location: editarDiapositivesContingut.php?id=" . $id_presentacio);         
            } 
            
        }
        
    }
       }else {
            
            // Obtener los datos del formulario
            $titol = $_POST["titol"];
            $id_presentacio = $_POST["id_presentacio"];
            if(strlen($titol) > 25){
                // Redirigir de nuevo a CrearDiapositives.php
                header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio);
            }else{

            if (isset($_POST['id_diapo'])) {  
                $editDiapo = $_POST['id_diapo'];
                $dao->alterDiapositivesTitol($titol, $editDiapo);
                
                header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio . "&id_diapo=".$editDiapo);
                
            }else {
                    // Insertar los datos en la base de datos
                $dao->setDiapositivesTitol($titol,$id_presentacio); 
                    
                // Redirigir de nuevo a CrearDiapositives.php
                header("Location: editarDiapositivesTitol.php?id=" . $id_presentacio);         
            }
        }         
    }
        

    exit();          
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_diapo"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $cont = $dao->getContingutPorID($id_diapo);
    if($cont != NULL ){
        $imatge = $dao->getImatgePorID($id_diapo);
        if($imatge != NULL){
            header("Location: editarDiapositivesImatge.php?id=".$id."&id_diapo=".$id_diapo);
        }else{
            header("Location: editarDiapositivesContingut.php?id=".$id."&id_diapo=".$id_diapo);
        }
    }else {
        header("Location: editarDiapositivesTitol.php?id=".$id."&id_diapo=".$id_diapo);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getInfoDiapo"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $cont = $dao->getContingutPorID($id_diapo);
    $imatge = $dao->getImatgePorID($id_diapo);
    if($cont != NULL ){
        if ($imatge!= NULL) {
            header("Location: CrearDiapositivesImatge.php?id=".$id."&id_diapo=".$id_diapo);
        }else{
            header("Location: CrearDiapositivesContingut.php?id=".$id."&id_diapo=".$id_diapo);
        }
    }else {
        header("Location: CrearDiapositivesTitol.php?id=".$id."&id_diapo=".$id_diapo);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getInfoDiapoVista"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $cont = $dao->getContingutPorID($id_diapo);
    if($cont != NULL ){
        header("Location: vistaPreviaClientContingut.php?id=".$id."&id_diapo=".$id_diapo);
    }else {
        header("Location: vistaPreviaClientTitol.php?id=".$id."&id_diapo=".$id_diapo);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ordenDiapoUp"])) {
     $id_diapo = $_POST['id_diapo'];
     try {
        $dao->changeOrdenUp($id_diapo);
    } catch (PDOException $th) {
        echo 'No se logro reordenar las diapositivas';
     }
     
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ordenDiapoDown"])) {
    $id_diapo = $_POST['id_diapo'];
    try {
       $dao->changeOrdenDown($id_diapo);
   } catch (PDOException $th) {
       echo 'No se logro reordenar las diapositivas';
    }
    
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminarDiapo"])){
    $id = $_POST['id'];
    $id_diapo = $_POST['id_diapo'];
    $dao->eliminarDiapo($id_diapo);
    if ($dao == TRUE) {
        header("Location: editarDiapositivesTitol.php?id=".$id . "&feedEliminado=Diapositiva eliminada correctamente.");
    }else{
        echo 'No se pudo eliminar la diapositiva';
    }
}

if (isset($_POST['form']) && $_POST['form'] === 'eliminar') {
    $id_presentacion = $_POST['id_presentacion'];
    $result = $dao->eliminarPresentacion($id_presentacion);
    
    if ($result) {
        echo '<div id="message-container" class="mensaje-exito">Presentación eliminada correctamente.</div>';
    } else {
        echo '<div id="message-container" class="mensaje-error">No se pudo eliminar la presentación.</div>';
    }
}

if (isset($_POST['editar_presentacion'])) {
    $id_presentacion = $_POST['id_presentacion'];
    
    header("Location: editarDiapositivesTitol.php?id=".$id_presentacion);
    exit();
}

if (isset($_POST['previsualizar_presentacion'])) {
    $id_presentacion = $_POST['id_presentacion'];
    $from = $_POST['from'];

    // Construir la URL de redirección con ambos valores
    $redireccion_url = "vistaPrevia.php?id=" . $id_presentacion . "&from=" . $from;

    // Redirigir a vistaPrevia.php
    header("Location: " . $redireccion_url);
    exit();
}

if (isset($_POST['previsualizar_client'])) {
    $id_presentacion = $_POST['id_presentacion'];
    $id_diapo = $_POST['id_diapo'];
    $from = $_POST['from'];

    // Construir la URL de redirección con ambos valores
    $redireccion_url = "previsualitzarClient.php?id=" . $id_presentacion . "&id_diapo=".$id_diapo . "&from=" . $from;

    // Redirigir a vistaPrevia.php
    header("Location: " . $redireccion_url);
    exit();
}

if (isset($_POST['editarPres'])) {
    $id_presentacion = $_GET['id'];
    
    header("Location: editarPresentacio.php?id=".$id_presentacion);
    exit();
}
if (isset($_GET['id'])) {
    $id_presentacio = $_GET['id'];
    $estiloPresentacion = $dao->getEstiloPresentacion($id_presentacio);
}

if (isset($_POST['previsualizar_diapo'])) {
    $id_presentacion = $_POST['id_presentacio'];

    $redireccion_url = "previsualitzarDiapositiva.php?id=" . $id_presentacion;

    header("Location: " . $redireccion_url);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["publicar_presentacion"])) {
    $id_presentacion = $_POST['id_presentacion'];

    // Verifica si la presentación está publicada
    $estaba_publicada = $dao->getPublicacionPresentacion($id_presentacion);

    if ($estaba_publicada) {
        // Estaba publicada, ahora la despublicamos
        $result = $dao->despublicarPresentacion($id_presentacion);
    } else {
        // No estaba publicada, la publicamos
        $result = $dao->publicarPresentacion($id_presentacion);
    }

    if ($result && $estaba_publicada) {
        echo '<div id="message-container" class="mensaje-exito">Presentación despublicada correctamente.</div>';
    } elseif ($result && !$estaba_publicada){
        echo '<div id="message-container" class="mensaje-exito">Presentación publicada correctamente.</div>';
    } else {
        echo '<div id="message-container" class="mensaje-error">No se pudo completar la operación.</div>';
    }
}

