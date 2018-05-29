@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/usuarios"><i class="material-icons">people</i>Usuarios</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    	Registrar Usuarios
                        <small>Información de cada usuario (Inf. Personal, ubicación, cargo)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_usuarios">
	                    <div class="row clearfix">
	                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    		<h2 class="card-inside-title">Información Personal</h2>
	                    	</div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Nombre</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	                            <p>
	                                <b>Email</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Contraseña</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Confirmar Contraseña</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Perfil</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="form-control show-tick" id="perfil_id"  name="perfil_id">
	                                        <option value=0>--Seleccione--</option>
	                                    	@foreach ($list_perfiles as $perfil)
	                                        	<option value="{{$perfil->id}}">{{ $perfil->perfil }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row clearfix"> 
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/usuarios" type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de Usuarios">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar usuario">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
				                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_usuarios");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationRegistro(ruta,form);
	    });
	})
</script>
@endpush
