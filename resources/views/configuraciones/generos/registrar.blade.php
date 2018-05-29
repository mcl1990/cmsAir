@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/generos"><i class="material-icons">assignment</i>Generos</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Género
                        <small>Registro de genero (Código y Descricpción)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_generos">
	                    <div class="row clearfix">
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Código</b><small>(Api)</small>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="codigo"  name="codigo" class="form-control" maxlength="10" placeholder="Código">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Género</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="genero"  name="genero" class="form-control" maxlength="25" placeholder="Nombre del genero">
	                                </div>
	                            </div>
	                        </div>
	                       
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/generos"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de generos">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar genero">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
                                
                                
                            </div>
                        </div><!-- row clearfix 2 -->
                    </form><!-- Form -->
                </div><!-- Body -->
            </div><!-- Card -->
        </div><!-- col 12 -->
    </div><!-- row clearfix 1-->
</div> <!-- container-fluid -->
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_generos");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar
	}) //Document 
</script>
@endpush
