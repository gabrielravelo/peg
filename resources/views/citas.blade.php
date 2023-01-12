@extends('layouts.app')

@section('content')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <div class="logout">
            <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
            <input href="{{ route('logout') }}" class="boton" type="submit" value="{{ __('Logout') }}">
        </div>
    </form>

    <h1 class="nombre-pagina">Ver citas</h1>
    <p class="descripcion-pagina">Visualiza tus citas agendadas</p>
    <div class="lil-baby">
        <a href="{{ route('home') }}" class="boton">Volver</a>
    </div>

    @if(count($citas) == 0)
        <h2>No hay citas</h2>
    @endif

    <div id="citas-admin">

        <ul class="citas">
            @foreach($citas as $cita)
                <li>
                    <p>Fecha: <span>{{ $cita->fecha }}</span></p>
                    <p>Hora: <span>{{ $cita->hora }}</span></p>

                    <h3>Servicios</h3>
                    <?php $total = 0; ?>
                    @foreach($cita->citasServicios as $servicio)
                        <p class="servicio">{{ $servicio->nombre.' $'.$servicio->precio }}</p>
                        <?php $total = $total + $servicio->precio; ?>
                    @endforeach
                    <p>Total: <span>${{ $total }}</span></p>

                    <form action="{{ route('citas.eliminar-cita', $cita->cita_id) }}" method="POST" id="eliminar-cita">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="boton-eliminar" value="Eliminar" name="btnSubmit" id="btnDelete">
                    </form>

                </li>
            @endforeach
    </div>

@endsection

@section('scripts')

    <script>
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
        eliminarCita()
    </script>

@endsection
