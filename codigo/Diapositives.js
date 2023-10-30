const visualizarDiapo = document.querySelector('.diapositivas');
const newDiapo = document.getElementById('tipus');
const añadirDiapositiva = document.getElementById('añadirDiapositiva');

let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let titol = '', contingut = '', titolContingut = '', titolDiapo = '';
let contadorArray = 0;

const mostrarDiapositivaColumna = () => {
  const newVisualDiapo = document.createElement('div');
  if (diapositives && diapositives.length > contadorArray) {
      const displayTitle = diapositives[contadorArray][0] || 'Sin título';

      const text = document.createTextNode(displayTitle);
      newVisualDiapo.appendChild(text);
      newVisualDiapo.classList.add('diaposInfo');
      visualizarDiapo.insertAdjacentElement('beforeend', newVisualDiapo);

      // Agregar atributo draggable para habilitar arrastrar para reordenar
      newVisualDiapo.setAttribute('draggable', true);

      // Agregar eventos para reordenar diapositivas
      newVisualDiapo.addEventListener('dragstart', dragStart);
      newVisualDiapo.addEventListener('dragover', dragOver);
      newVisualDiapo.addEventListener('drop', drop);

      contadorArray++;
      titol.value = null;
      contingut.value = null;
      titolDiapo = '';
  }
};

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
