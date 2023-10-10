const newDiapo = document.getElementById('tipus');
newDiapo.addEventListener('change', function(e){
    const diapo = document.querySelector('div[class="right"]');

    if (this.value == 'titol') {
        let newInput = document.createElement('input');
        newInput.setAttribute('id','titolDiapositiva');
        newInput.setAttribute('type','text');
        newInput.classList.add('titolDiapo');
        newInput.setAttribute('placeholder','Titol');

        diapo.insertAdjacentElement('afterbegin',newInput);
    }else if (this.value == 'titolContingut') {
        let newConti = document.createElement('input');
        newConti.setAttribute('id','contingutDiapositiva');
        newConti.setAttribute('type','text');
        newConti.classList.add('contingutDiapo');
        newConti.setAttribute('placeholder','Contingut');

        diapo.insertAdjacentElement('afterbegin', newConti);

        let newInput = document.createElement('input');
        newInput.setAttribute('id','titolDiapositiva');
        newInput.setAttribute('type','text');
        newInput.classList.add('titolContDiapo');
        newInput.setAttribute('placeholder','Titol');

        diapo.insertAdjacentElement('afterbegin',newInput);
    }
    
});