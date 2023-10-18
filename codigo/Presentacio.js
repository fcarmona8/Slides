const newDiapo = document.getElementById('tipus');
const finalizar = document.getElementById('fin');
const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');
const visualizarDiapo = document.querySelector('.diapositivas');
const button = document.querySelector('.volver');
const añadir = document.querySelector('.añadir');
const downElements = document.querySelectorAll('.down .left, .down .right'); // Todos los elementos dentro de "down"
const presentacionGuardada = document.querySelector('.presentacion-guardada');
const tituloGuardado = document.getElementById('titulo-guardado');
const descripcionGuardada = document.getElementById('descripcion-guardada');

let titol = '', contingut = '', titolContingut = '', titolDiapo = '';;
let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let tituloPresentacion = '';
let descripcionPresentacion = '';
let contadorArray = 0;

button.addEventListener('click', function (e) {
    document.location.href = 'Home.php';
});

añadir.addEventListener('click', function (e) {
    if (titPres.value.trim() !== '' && descPres.value.trim() !== '') {
        tituloPresentacion = titPres.value;
        añadir.remove();
        titPres.remove();
        descPres.remove();
        presentacionGuardada.style.display = 'flex';
        tituloGuardado.textContent = tituloPresentacion;

        // Mostrar elementos en "down"
        downElements.forEach(element => {
            element.style.display = 'flex';
        });
    }
});

const mostrarDiapositivaColumna = () => {
    const newVisualDiapo = document.createElement('div');
    if (diapositives && diapositives.length > contadorArray) {
        const text = document.createTextNode(diapositives[contadorArray][0]);
        newVisualDiapo.appendChild(text);
        newVisualDiapo.classList.add('diaposInfo');
        visualizarDiapo.insertAdjacentElement('beforeend', newVisualDiapo);
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
            diapositives.push([titolDiapo || 'Sin título', contingut.value]);
            mostrarDiapositivaColumna();
            }
        }

        

    });

    
    //evento donde al dar click en el boton añade los datos a la base de datos sobre la presentacion hecha
    finalizar.addEventListener('click', e => {
        if (titPres != '') {
            tituloPresentacion = titPres.value;
            if (descPres != '') {
                descripcionPresentacion = descPres.value;
            }
        }

        //este bloque solo muestra los datos que se deben llevar a la bd (quitar luego)
        console.log(tituloPresentacion);
        console.log(descripcionPresentacion);
        for (let i = 0; i < diapositives.length; i++) {
            console.log(diapositives[i]);
        }


        //añadir array diapositivas a la base de datos
        //mas el titulo de la presentacion y la descripcion

        //y llevar al usuario a la pagina home
        document.location.href = 'Home.php';
    });
});










