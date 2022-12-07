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
    <h2>Nuevo servicio</h2>

    <div class="paginador-admin">
        <a href="{{ route('home') }}" class="boton">Ver Citas</a>
        <a href="{{ route('servicios') }}" class="boton">Ver Servicios</a>
        <a href="{{ route('servicios.create') }}" class="boton">Nuevo Servicio</a>
    </div>

    <form action="{{ route('servicio.createServicio') }}" method="POST" class="formulario" id="crear-servicio" novalidate>
        @csrf

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

            <input id="nombre" type="text" @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Nombre del servicio">
        </div>

        <div class="campo">
            <label for="precio">Precio ($)</label>

            <input id="precio" type="number" min="1" max="999" @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" autocomplete="precio" autofocus placeholder="Precio del servicio ($)">
        </div>

        <div class="centrado">
            <input class="boton" type="submit" value="Crear Servicio">
        </div>
    </form>
@endsection
