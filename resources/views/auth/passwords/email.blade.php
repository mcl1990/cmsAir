@extends('layouts.app2')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form id="forgot_password" method="POST">
    {{ csrf_field() }}
    <div class="msg">
        Ingrese su dirección de correo electrónico que utilizó para registrarse. Le enviaremos un correo electrónico con su nombre de usuario y un enlace para restablecer su contraseña.
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">email</i>
        </span>
        <div class="form-line">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Resetear mi contraseña</button>

    <div class="row m-t-20 m-b--5 align-center">
        <a href="/login">¡Iniciar Sesión!</a>
    </div>
</form>
@endsection
