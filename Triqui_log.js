const cuadrados = document.querySelectorAll('.cuadrado');
let jugadorActual = 'X';
const jugadores = ['X', 'O'];
cuadrados.forEach(function (cuadrado) { //objeto de objetos
    cuadrado.addEventListener('click', function () {
        if (cuadrado.textContent === '') {
            cuadrado.textContent = jugadorActual;
            cuadrado.setAttribute('jugador-data', jugadorActual);
            jugadorActual = jugadorActual === jugadores[0] ? jugadores[1] : jugadores[0];
        }
    });
});

const btnReset = document.querySelector('#reinicio-btn'); // Esto se define como objeto
btnReset.addEventListener('click', function () {
    cuadrados.forEach(function (cuadrado) {
        cuadrado.textContent = '';
        cuadrado.removeAttribute('jugador-data'); //Borrado de atributos
    });
});