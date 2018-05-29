@extends('layouts.app2')

@section('content')
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="msg">Iniciar Sesión</div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required autofocus>
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
    <div class="row">

        {{-- <div class="col-xs-8 p-t-5">
            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
            <label for="rememberme">Recordarme</label>
        </div> --}}
        <div class="col-xs-12">
            <button class="btn btn-block bg-indigo waves-effect" type="submit">INGRESAR</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-4">
            <a href="/register">¡Registrarme!</a>
        </div>
        {{-- <div class="col-xs-8 align-right">
            <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
        </div> --}}
    </div>
</form>
<br>
@include('layouts.base.footer')
@endsection
