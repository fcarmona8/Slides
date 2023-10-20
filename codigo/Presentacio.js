const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');
const button = document.querySelector('.volver');
const downElements = document.querySelectorAll('.down .left, .down .right'); // Todos los elementos dentro de "down"
const presentacionGuardada = document.querySelector('.presentacion-guardada');
const tituloGuardado = document.getElementById('titulo-guardado');
const añadir = document.querySelector('.añadir');
const descripcionGuardada = document.getElementById('descripcion-guardada');

let tituloPresentacion = '';
let descripcionPresentacion = '';



button.addEventListener('click', function (e) {
    document.location.href = 'Home.php';
});

function validateForm() {
    const titol = document.forms["formPresentacio"]["titol"].value;
    const descripcio = document.forms["formPresentacio"]["descripcio"].value;
    let isValid = true;
    
    if (titol === "") {
        isValid = false;
    } else {
        document.getElementById("titolError").innerText = "";
    }
    
    if (descripcio === "") {
        isValid = false;
    } else {
        document.getElementById("descripcioError").innerText = "";
    }
    
    return isValid;
}