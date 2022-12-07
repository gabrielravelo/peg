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
    <h2>Actualizar servicio</h2>

    <div class="paginador-admin">
        <a href="{{ route('home') }}" class="boton">Ver Citas</a>
        <a href="{{ route('servicios') }}" class="boton">Ver Servicios</a>
        <a href="{{ route('servicios.create') }}" class="boton">Nuevo Servicio</a>
    </div>

    <form action="{{ route('servicio.editServicio', $servicio->servicio_id) }}" method="POST" class="formulario" id="actualizar-servicio" novalidate>
        @csrf
        @method('PUT')

        @error('nombre')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @error('precio')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="campo">
            <label for="nombre">Nombre</label>

            <input id="nombre" type="text" @error('nombre') is-invalid @enderror" name="nombre" value="{{ $servicio->nombre }}" autocomplete="nombre" autofocus placeholder="Nombre del servicio">
        </div>

        <div class="campo">
            <label for="precio">Precio ($)</label>

            <input id="precio" type="number" min="1" max="999" @error('precio') is-invalid @enderror" name="precio" value="{{ $servicio->precio }}" autocomplete="precio" autofocus placeholder="Precio del servicio ($)">
        </div>

        {{-- <input type="hidden"> --}}
        <div class="botones-servicios">
            <a href="{{ route('servicios') }}" class="boton">&laquo; Volver</a>
            <input class="boton" type="submit" value="Actualizar Servicio">
        </div>
    </form>
@endsection
