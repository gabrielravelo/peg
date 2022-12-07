@extends('layouts.app')

@section('content')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <div class="logout">
            <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
            <input href="{{ route('logout') }}" class="boton" type="submit" value="{{ __('Logout') }}">
        </div>
    </form>

    <h1 class="nombre-pagina">Panel de Adminitración</h1>
    <h2>Ver servicios</h2>

    <div class="paginador-admin">
        <a href="{{ route('home') }}" class="boton">Ver Citas</a>
        <a href="{{ route('servicios') }}" class="boton">Ver Servicios</a>
        <a href="{{ route('servicios.create') }}" class="boton">Nuevo Servicio</a>
    </div>

    <div>
        <ul class="servicios">
            @foreach($servicios as $servicio)
                <li>
                    <p>Nombre: <span>{{ $servicio->nombre }}</span></p>
                    <p>Precio: <span>${{ $servicio->precio }}</span></p>
                </li>
                <div class="botones-servicios">
                    <a href="{{ route('servicios.edit', $servicio->servicio_id) }}" class="boton">Actualizar</a>

                    <form action="{{ route('servicios.delete', $servicio->servicio_id) }}" method="POST" id="eliminar-servicio">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="boton-eliminar" value="Eliminar" name="btnSubmit" id="btnDelete">
                    </form>
                </div>
            @endforeach
        </ul>
    </div>
@endsection

@section('scripts')

    @if(session('agregar') == 'ok')
        <div id="agregado"></div>
    @endif

    @if(session('actualizar') == 'ok')
        <div id="actualizado"></div>
    @endif

    @if(session('eliminar') == 'ok')
        <div id="eliminado"></div>
    @endif

    <script>
        const agregado = document.getElementById('agregado');
        const actualizado = document.getElementById('actualizado');
        const eliminado = document.getElementById('eliminado');

        if(agregado) {
            Swal.fire({
                title: 'Creado!',
                text: 'El servicio se ha creado exitosamente.',
                icon: 'success'
            })
        }

        if(actualizado) {
            Swal.fire({
                title: 'Actualizado!',
                text: 'El servicio se ha actualizado exitosamente.',
                icon: 'success'
            })
        }

        if(eliminado) {
            Swal.fire({
                title: 'Eliminado!',
                text: 'El servicio se ha eliminado exitosamente.',
                icon: 'success'
            })
        }
    </script>
@endsection

