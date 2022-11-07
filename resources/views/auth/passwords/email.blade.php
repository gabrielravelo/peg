@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <h1 class="nombre-pagina">{{ __('Reset Password') }}</h1>
    <p class="descripcion-pagina">Restablece tu contraseña escribiendo tu email a continuación</p>

    @if (session('status'))
        <div class="alerta exito">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        @error('email')
            <span class="alerta error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="campo">
            <label for="email">Email</label>

            <input id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Tu email" autocomplete="email" autofocus>
        </div>

        <div class="centrado">
            <input type="submit" class="boton" value="Restablecer contraseña"/>
        </div>
    </form>

    <div class="acciones">
        <a href="{{ route('login') }}">Ya tienes una cuenta? Inicia sesión</a>
        <a href="{{ route('register') }}">Aún no tienes una cuenta? Crear una</a>
    </div>
@endsection
