@extends('layouts.app')

@section('content')

    @if($usuario->usuario_grupo_id != 1)
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <div class="logout">
                <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                <input href="{{ route('logout') }}" class="boton" type="submit" value="{{ __('Logout') }}">
            </div>
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
                    <div id="servicios" class="listado-servicios"></div>
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
                        <input type="date" id="fecha" min="<?php $a = date('Y-m-d'); $b = strtotime($a.'+ 1 day'); echo date('Y-m-d', $b); ?>">
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

    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <div class="logout">
                <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                <input href="{{ route('logout') }}" class="boton" type="submit" value="{{ __('Logout') }}">
            </div>
        </form>

        <h1 class="nombre-pagina">Panel de Adminitración</h1>
        <h2>Buscar citas</h2>

        <div class="paginador-admin">
            <a href="{{ route('home') }}" class="boton">Ver Citas</a>
            <a href="{{ route('servicios') }}" class="boton">Ver Servicios</a>
            <a href="{{ route('servicios.create') }}" class="boton">Nuevo Servicio</a>
        </div>

        <div class="busqueda">
            <form class="formulario" action="">
                <div class="campo">
                    <label for="fecha-admin">Fecha</label>
                    <input type="date" id="fecha-admin" name='fecha-admin' value="{{ $fecha }}">
                </div>
            </form>
        </div>

        @if(count($citas) == 0)
            <h2>No hay citas en esta fecha</h2>
        @endif

        <div id="citas-admin">
            <ul class="citas">
                <?php $idCita = ''; ?>
                @foreach($citas as $key => $cita)
                <?php if($idCita !== $cita->cita_id) {
                    $total = 0;
                    ?>
                    <li>
                        <p>Cita id: <span>{{ $cita->cita_id }}</span></p>
                        <p>Hora: <span>{{ $cita->hora }}</span></p>
                        <p>Nombre: <span>{{ $cita->nombre_cliente }} {{ $cita->apellido }}</span></p>
                        <p>Email: <span>{{ $cita->email }}</span></p>
                        <p>Teléfono: <span>{{ $cita->telefono }}</span></p>

                        <h3>Servicios</h3>
                <?php $idCita = $cita->cita_id;
                }
                    $total += $cita->precio;
                ?>
                        <p class="servicio">{{ $cita->nombre_servicio.' $'.$cita->precio }}</p>

                    <?php
                        $actual = $cita->cita_id;
                        $proximo = $citas[$key + 1]->cita_id ?? 0;

                        if($actual !== $proximo) { ?>
                            <p class="total">Total: <span>${{ $total }}</span></p>

                            <form action="{{ route('home.eliminar-cita', $cita->cita_id) }}" method="POST" id="eliminar-cita">
                                @csrf
                                @method('DELETE')

                                <input type="submit" class="boton-eliminar" value="Eliminar" name="btnSubmit" id="btnDelete">
                            </form>
                        <?php } ?>

                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('scripts')
    @if($usuario->usuario_grupo_id == 1)
        <script src="js/admin.js" defer></script>
    @else
        <script src="js/cliente.js" defer></script>
    @endif
@endsection
