function validateForm() {
    const titol = document.getElementById("titol");
    var titleError = document.getElementById("titolError");
    let isValid = true;

    if (titol.value.length > 25) {
        titleError.textContent = "El título no puede tener más de 25 caracteres";
        titol.focus();
        isValid = false;
    } else {
        titleError.textContent = ""; // Limpia el mensaje de error si es válido
    }
    return isValid;
}

function validateFormCont() {
    const titol = document.getElementById("titol");
    var titleError = document.getElementById("titolError");
    const contingut = document.getElementById("contingut");
    var contError = document.getElementById("contError");
    let isValid = true;
    

    if (titol.value.length > 25) {
        titleError.textContent = "El título no puede tener más de 25 caracteres";
        titol.focus();
        isValid = false;
    } else if(contingut.value.length > 640){
        contError.textContent = "Has superado el límite de caracteres";
        contError.focus();
        isValid = false;
    } else {
        titleError.textContent = ""; // Limpia el mensaje de error si es válido
        contError.textContent = "";
    }
    return isValid;
}
