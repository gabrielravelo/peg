@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                </div>
            </div>
        </div>
    </div>
</div> --}}

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <input href="{{ route('logout') }}" class="boton" type="submit" value="{{ __('Logout') }}">
    </form>

    <h1 class="nombre-pagina">Crear nueva cita</h1>
    <p class="descripcion-pagina">Elige tus servicios y escribe tus datos</p>

    <div id="app">

        <nav class="tabs">
            <button type="button" data-paso="1" class="actual">Servicios</button>
            <button type="button" data-paso="2">Información Cita</button>
            <button type="button" data-paso="3">Resumen</button>
        </nav>

        <form class="formulario">

            <div id="paso-1" class="seccion">
                <h2>Servicios</h2>
                <p class="text-center">Elige tus servicios a continuación</p>
                <div id="servicios" class="listado-servicios">
                    {{-- @foreach ($servicios as $servicio)
                        <div class="servicio" data-id-servicio="{{ $servicio->servicio_id }}">
                            <p class="nombre-servicio">{{ $servicio->nombre }}</p>
                            <p class="precio-servicio">${{ $servicio->precio }}</p>
                        </div>
                    @endforeach --}}
                </div>
            </div>

            <div id="paso-2" class="seccion">
                <h2>Tus datos y cita</h2>
                <p class="text-center">Escribe tus datos y fecha de tu cita</p>

                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" placeholder="{{ $usuario->nombre }} {{ $usuario->apellido }}"
                        value="{{ $usuario->nombre }} {{ $usuario->apellido }}" disabled>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" min="<?php echo date('Y-m-d') ?>">
                </div>

                <div class="campo">
                    <label for="hora">Hora</label>
                    <input type="time" id="hora">
                </div>

                <input type="hidden" id="id" value="{{ $usuario->usuario_id }}">
            </div>

        </form>

        <div id="paso-3" class="seccion contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la información sea correcta</p>
        </div>

        <div class="paginacion">
            <button id="anterior" class="boton">&laquo; Anterior</button>

            <button id="siguiente" class="boton">Siguiente &raquo;</button>
        </div>
    </div>
@endsection
