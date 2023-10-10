const newDiapo = document.getElementById('tipus');
const finalizar = document.getElementById('fin');
let newInput = '', newConti = '', titol = '', contingut = '', titolContingut = '';
let diapositives = []; //array [titol, cont][titol, null][titol,cont]
let tituloPresentacion, descripcionPresentacion;
const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');


newDiapo.addEventListener('change', function(e){
    const diapo = document.querySelector('div[class="right"]');
        if(titol!='' || titolContingut!=''){
            if (contingut!='') {
                contingut.remove(); 
                titolContingut.remove();
                contingut = ''; titolContingut = '';
            }else{
                titol.remove();
                titol = ''; 
            }
    }

    if (this.value == 'titol') {
        newInput = document.createElement('input');
        newInput.setAttribute('id','titolDiapositiva');
        newInput.setAttribute('type','text');
        newInput.classList.add('titolDiapo');
        newInput.setAttribute('placeholder','Titol');

        diapo.insertAdjacentElement('afterbegin',newInput);
        titol = document.getElementById('titolDiapositiva');
        titol.addEventListener('change', function(e){
            diapositives.push([this.value, null]);
        });
    }else if (this.value == 'titolContingut') {

        newInput = document.createElement('input');
        newInput.setAttribute('id','titolDiapositiva');
        newInput.setAttribute('type','text');
        newInput.classList.add('titolContDiapo');
        newInput.setAttribute('placeholder','Titol');

        diapo.insertAdjacentElement('afterbegin',newInput);
        titolContingut = document.getElementById('titolDiapositiva');
        titolContingut.addEventListener('change', function(e){
            titolDiapo = this.value;
        })

        newConti = document.createElement('input');
        newConti.setAttribute('id','contingutDiapositiva');
        newConti.setAttribute('type','text');
        newConti.classList.add('contingutDiapo');
        newConti.setAttribute('placeholder','Contingut');

        titolContingut.insertAdjacentElement('afterEnd', newConti);
        contingut = document.getElementById('contingutDiapositiva');
        let titolDiapo;
        contingut.addEventListener('change', function(e){
            diapositives.push([titolDiapo, this.value]);
        })
    }

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