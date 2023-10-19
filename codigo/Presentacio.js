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

        // Mostrar elementos en "down"
        downElements.forEach(element => {
            element.style.display = 'flex';
        });
    }
});


