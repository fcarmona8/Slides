const visualizarDiapo = document.querySelector('.diapositivas');
const button = document.querySelector('.volver');
const newDiapo = document.getElementById('tipus');
const añadirDiapositiva = document.getElementById('añadirDiapositiva');

let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let titol = '', contingut = '', titolContingut = '', titolDiapo = '';
let contadorArray = 0;

button.addEventListener('click', function (e) {
    document.location.href = 'Home.php';
});

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

newDiapo.addEventListener('change', function (e) {
    const diapo = document.querySelector('div[class="right"]');

    //if que borra la diapositiva anterior cada vez que se cambia
    if (titol !== '') {
        titol.remove();
        titol = '';

        if (contingut !== '') {
            contingut.remove();
            contingut = '';
            titolDiapo = '';
        }
    }

    // creacion de inputs para escribir el titulo (y contenido si es el caso) de una diapositiva
    newTitol = document.createElement('input');
    newTitol.setAttribute('id', 'titolDiapositiva');
    newTitol.setAttribute('type', 'text');

    if (this.value == 'titol') {
        newTitol.classList.add('titolDiapo');
        newTitol.setAttribute('placeholder', 'Titol');

        diapo.insertAdjacentElement('afterbegin', newTitol);
        titol = document.getElementById('titolDiapositiva');
    } else if (this.value == 'titolContingut') {
        newTitol.classList.add('titolContDiapo');
        newTitol.setAttribute('placeholder', 'Titol');

        diapo.insertAdjacentElement('afterbegin', newTitol);
        titol = document.getElementById('titolDiapositiva');
        titol.addEventListener('change', function (e) {
            titolDiapo = this.value;
        });

        newConti = document.createElement('textarea');
        newConti.setAttribute('id', 'contingutDiapositiva');
        newConti.setAttribute('type', 'text');
        newConti.classList.add('contingutDiapo');
        newConti.setAttribute('placeholder', 'Contingut');

        titol.insertAdjacentElement('afterEnd', newConti);
        contingut = document.getElementById('contingutDiapositiva');


    }
    //Guarda la diapositiva al array al clicar el boton añadir diapositiva
    añadirDiapositiva.addEventListener('click', function (e) {
        e.preventDefault();

        if (newDiapo.value === 'titol') {
            if (titol.value.trim() !== '') {
                diapositives.push([titol.value, null]);
                mostrarDiapositivaColumna();
            }
        } else if (newDiapo.value === 'titolContingut') {
            if (titolDiapo.trim() !== '' || contingut.value.trim() !== '') {
                diapositives.push([titolDiapo, contingut.value]);
                mostrarDiapositivaColumna();
            }
        }
    });
});

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
  console.log(diapositives);
}

