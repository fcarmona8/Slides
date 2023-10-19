const newDiapo = document.getElementById('tipus');
const finalizar = document.getElementById('fin');
const titPres = document.getElementById('titol');
const descPres = document.getElementById('descripcio');
const visualizarDiapo = document.querySelector('.diapositivas');
const button = document.querySelector('.volver');
const anadirPresentacio = document.querySelector('.anadirPresentacio');
const downElements = document.querySelectorAll('.down .left, .down .right'); // Todos los elementos dentro de "down"
const presentacionGuardada = document.querySelector('.presentacion-guardada');
const tituloGuardado = document.getElementById('titulo-guardado');
const descripcionGuardada = document.getElementById('descripcion-guardada');

let titol = '', contingut = '';
let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let tituloPresentacion = '';
let descripcionPresentacion = '';
let contadorArray = 0;

button.addEventListener('click', function(e){
    document.location.href = 'Home.php';
});


newDiapo.addEventListener('change', function(e){
    const diapo = document.querySelector('div[class="right"]');

    //if que borra la diapositiva anterior cada vez que se cmabia
    if(titol!=''){
        if (contingut!='') {
            titol.remove();
            titol = ''; 
            contingut.remove(); 
            contingut = ''; titolContingut = '';
        }else{
            titol.remove();
            titol = ''; 
        }
    }
    
    document.getElementById("tipus").addEventListener("change", function() {
        if (this.value === "titolContingut") {
            window.location.href = "CrearDiapositivesContingut.php?id=<?php echo $id_presentacio; ?>";
        }
    });

    /*
    //creacion de inputs para escribir el titulo (y contenido si es el caso) de una diapositiva
    newTitol = document.createElement('input');
    newTitol.setAttribute('id','titolDiapositiva');    
    newTitol.setAttribute('type','text');

    if (this.value == 'titol') {
        newTitol.classList.add('titolDiapo');
        newTitol.setAttribute('placeholder','Titol');
        newTitol.setAttribute('name', 'titol');

        diapo.insertAdjacentElement('afterbegin',newTitol);
        titol = document.getElementById('titolDiapositiva');
        titol.addEventListener('change', function(e){
            diapositives.push([this.value, null]);
            newVisualDiapo = document.createElement('div');
            text = document.createTextNode(diapositives[contadorArray][0]);
            newVisualDiapo.appendChild(text);
            newVisualDiapo.classList.add('diaposInfo');
            visualizarDiapo.insertAdjacentElement('beforeend',newVisualDiapo);
            contadorArray++;
            document.getElementById('formularioPresentacion').submit();
            this.value = null;
        });
    }else if (this.value == 'titolContingut') {
        newTitol.classList.add('titolContDiapo');
        newTitol.setAttribute('placeholder','Titol');
        newTitol.setAttribute('name', 'titol');

        diapo.insertAdjacentElement('afterbegin',newTitol);
        titol = document.getElementById('titolDiapositiva');
        titol.addEventListener('change', function(e){
            titolDiapo = this.value;
        })

        newConti = document.createElement('textarea');
        newConti.setAttribute('id','contingutDiapositiva');
        newConti.setAttribute('name', 'contingut');
        newConti.setAttribute('type','text');
        newConti.classList.add('contingutDiapo');
        newConti.setAttribute('placeholder','Contingut');

        titol.insertAdjacentElement('afterEnd', newConti);
        contingut = document.getElementById('contingutDiapositiva');
        let titolDiapo;
        contingut.addEventListener('change', function(e){
            diapositives.push([titolDiapo, this.value]);
            newVisualDiapo = document.createElement('div');
            text = document.createTextNode(diapositives[contadorArray][0]);
            newVisualDiapo.appendChild(text);
            newVisualDiapo.classList.add('diaposInfo');
            visualizarDiapo.insertAdjacentElement('beforeend',newVisualDiapo);
            contadorArray++;
            titol.value = null;
            this.value = null;
        })
    }

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
    })
    */



});