@extends('layouts.app')

@section('content')

    <h1>Restablecer contraseña</h1>

    <form action="{{ route('password.update') }}" method="POST" class="formulario" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        @error('email')
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
            <label for="email">{{ __('Email') }}</label>

            <input id="id" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus placeholder="Tu email">
        </div>

        <div class="campo">
            <label for="password">{{ __('Password') }}</label>

            <input id="password" type="password" @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Tu contraseña">
        </div>

        <div class="campo">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Confirmar contraseña">
        </div>

        <div class="centrado">
            <input class="boton" type="submit" value="{{ __('Reset Password') }}">
        </div>

    </form>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>


                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
