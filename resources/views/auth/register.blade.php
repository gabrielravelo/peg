@extends('layouts.app')

@section('content')

    <h1 class="nombre-pagina">Crear cuenta</h1>
    <p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

    <form method="POST" action="{{ route('register') }}" class="formulario" novalidate>
        @csrf

        @error('nombre')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @error('apellido')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @error('email')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @error('telefono')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @error('password')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="campo">
            <label for="nombre">Nombre</label>

            <input id="nombre" type="text" @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre" autocomplete="nombre" autofocus>
        </div>

        <div class="campo">
            <label for="apellido">Apellido</label>

            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Tu apellido" autocomplete="apellido" autofocus>
        </div>

        <div class="campo">
            <label for="email">Email</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Tu email" autocomplete="email" autofocus>
        </div>

        <div class="campo">
            <label for="telefono">Teléfono</label>

            <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Tu telefono" autocomplete="telefono" autofocus>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Tu contraseña" autocomplete="password" autofocus>
        </div>

        <div class="campo">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar contraseña" autocomplete="new-password">
        </div>

        <div class="centrado">
            <input class="boton" type="submit" value="Crear cuenta">
        </div>
    </form>

    <div class="acciones">
        <a href="{{ route('login') }}">Ya tienes una cuenta? Inicia sesión</a>
        <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
    </div>
@endsection
