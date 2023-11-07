const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');
const button = document.querySelector('.volver');
const downElements = document.querySelectorAll('.down .left, .down .right'); // Todos los elementos dentro de "down"
const presentacionGuardada = document.querySelector('.presentacion-guardada');
const tituloGuardado = document.getElementById('titulo-guardado');
const añadir = document.querySelector('.añadir');
const descripcionGuardada = document.getElementById('descripcion-guardada');
const passwordInput = document.getElementById('password');
const toggleButton = document.getElementById('togglePassword');
const toggleButtonOpen = document.getElementById('togglePasswordOpen');

let tituloPresentacion = '';
let descripcionPresentacion = '';



button.addEventListener('click', function (e) {
    document.location.href = 'index.php';
});

function validateForm() {
    const titol = document.forms["formPresentacio"]["titol"].value;
    const descripcio = document.forms["formPresentacio"]["descripcio"].value;
    const password = document.forms["formPresentacio"]["password"].value;
    let isValid = true;
    var titleError = document.getElementById("titolError");
    var passwordError = document.getElementById("passwordError");
    
    if (titol === "") {
        isValid = false;
    } else if( titol.length > 30){
        titleError.textContent = "El título no debe tener más de 30 caracteres.";
        isValid = false;
    } else if(password.length > 8){
        passwordError.textContent = "El pin no debe tener más de 8 carácteres."
        isValid = false;
    } else {
        document.getElementById("titolError").innerText = "";
        document.getElementById("passwordError").innerText = "";
    }
    
    return isValid;
}


toggleButton.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.style.display = 'none';
        toggleButtonOpen.style.display = 'block';
    }
})

toggleButtonOpen.addEventListener('click', function () {
    if (passwordInput.type === 'text') {
        passwordInput.type = 'password';
        toggleButton.style.display = 'block';
        toggleButtonOpen.style.display = 'none';
    }
})
