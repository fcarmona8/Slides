const newDiapo = document.getElementById('tipus');
const finalizar = document.getElementById('fin');
const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');
const visualizarDiapo = document.querySelector('.diapositivas');

let titol = '', contingut = '';
let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let tituloPresentacion, descripcionPresentacion;
let contadorArray = 0;

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
    
    //creacion de inputs para escribir el titulo (y contenido si es el caso) de una diapositiva
    newTitol = document.createElement('input');
    newTitol.setAttribute('id','titolDiapositiva');    
    newTitol.setAttribute('type','text');

    if (this.value == 'titol') {
        newTitol.classList.add('titolDiapo');
        newTitol.setAttribute('placeholder','Titol');

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
            this.value = null;
        });
    }else if (this.value == 'titolContingut') {
        newTitol.classList.add('titolContDiapo');
        newTitol.setAttribute('placeholder','Titol');

        diapo.insertAdjacentElement('afterbegin',newTitol);
        titol = document.getElementById('titolDiapositiva');
        titol.addEventListener('change', function(e){
            titolDiapo = this.value;
        })

        newConti = document.createElement('textarea');
        newConti.setAttribute('id','contingutDiapositiva');
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

    finalizar.addEventListener('click', function(e){
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
    })



});