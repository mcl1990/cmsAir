@extends('layouts.app2')

@section('content')
<form id="sign_up" class="form-horizontal" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="msg">Registro de nuevo usuario</div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Usuario" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
        </div>
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
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
        </div>
    </div>

    <div class="input-group">
        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
        <label for="terms">Estoy de acuerdo con los <a href="javascript:void(0);">terminos de uso</a>.</label>
    </div>

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Registrar</button>

    <div class="m-t-25 m-b--5 align-center">
        <a href="/login">¡Ya tengo cuenta aqui!</a>
    </div>
</form>
@endsection
