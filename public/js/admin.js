document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})
function iniciarApp() {
    buscarPorFecha();
    eliminarCita();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fecha-admin');
    fechaInput.addEventListener('input', function(e) {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    });
}

function eliminarCita() {

    const eliminarCita = document.getElementById('btnDelete');
    const form = document.getElementById('eliminar-cita')

    eliminarCita.addEventListener('click', (e) => {
        e.preventDefault();

        Swal.fire({
            title: 'Está seguro de eliminar la cita?',
            text: "Una vez eliminada no podrá revertir los cambios!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Eliminada!',
                    'La cita ha sido eliminada exitosamente.',
                    'success'
                ).then( () => {
                    setTimeout(() => {
                        HTMLFormElement.prototype.submit.call(form);
                    }, 500);
                })
            }
        })
    });
}
