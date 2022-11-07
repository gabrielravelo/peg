@extends('layouts.app')

@section('content')

    <h1 class="nombre-pagina">{{ __('Verify Your Email Address') }}</h1>


    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            <p class="descripcion-pagina">{{ __('A fresh verification link has been sent to your email address.') }}</p>
        </div>
    @endif

    <p class="descripcion-pagina">{{ __('Before proceeding, please check your email for a verification link.') }}</p>

    <p class="descripcion-pagina">{{ __('If you did not receive the email') }},</p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <div class="centrado">
            <button type="submit" class="boton">Pulsa aquí para recibir otro</button>
        </div>
    </form>
@endsection
