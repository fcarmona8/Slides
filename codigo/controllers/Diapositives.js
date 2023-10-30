
// Función para mostrar el mensaje durante 3 segundos y luego ocultarlo
function mostrarMensajeExito() {
    var mensajeExito = document.getElementById("mensaje-exito");
    mensajeExito.style.display = "block";
    mensajeExito.innerText = "Presentación creada correctamente";
    
    setTimeout(function() {
        mensajeExito.style.display = "none";
    }, 3000); // 3000 milisegundos = 3 segundos
}

// Llama a la función para mostrar el mensaje
mostrarMensajeExito();
