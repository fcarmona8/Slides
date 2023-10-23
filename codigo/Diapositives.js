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

// Funciones Drag and Drop para reordenar las diapositivas
function dragStart(e) {
  e.dataTransfer.setData('text/plain', this.textContent);
  this.classList.add('dragging');
}

function dragOver(e) {
  e.preventDefault();
  
}

function drop(e) {
  e.preventDefault();
  const draggedElement = document.querySelector('.dragging');
  const indexFrom = Array.from(visualizarDiapo.children).indexOf(draggedElement);
  const indexTo = Array.from(visualizarDiapo.children).indexOf(this);

  [diapositives[indexFrom], diapositives[indexTo]] = [diapositives[indexTo], diapositives[indexFrom]];

  if (indexFrom < indexTo) {
    visualizarDiapo.insertBefore(draggedElement, this.nextSibling);
  } else {
    visualizarDiapo.insertBefore(draggedElement, this);
  }

  draggedElement.classList.remove('dragging');
}

