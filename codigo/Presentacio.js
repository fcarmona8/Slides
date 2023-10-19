const titPres = document.getElementById('titulo');
const descPres = document.getElementById('descripcion');
const button = document.querySelector('.volver');
const downElements = document.querySelectorAll('.down .left, .down .right'); // Todos los elementos dentro de "down"
const presentacionGuardada = document.querySelector('.presentacion-guardada');
const tituloGuardado = document.getElementById('titulo-guardado');
const añadir = document.querySelector('.añadir');
const descripcionGuardada = document.getElementById('descripcion-guardada');

let tituloPresentacion = '';
let descripcionPresentacion = '';



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
    }
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
});