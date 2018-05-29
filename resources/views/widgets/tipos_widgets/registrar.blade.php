@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/tipos_widgets"><i class="material-icons">assignment</i>Tipos de Widgets</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Tipo de Widget
                        <small>Registro de Tipo de Widget (Título, descripción, icono, estructura)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_tipos_widgets">

	                    <div class="row clearfix">
	                    	
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Título</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="titulo"  name="titulo" class="form-control" maxlength="25" placeholder="Nombre de Widget">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Descripción</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="descripcion"  name="descripcion" class="form-control" maxlength="50" placeholder="Ej: Breve reseña del Widget">
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="icono"  name="icono" class="form-control" maxlength="25" placeholder="Ej: save">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Estructura HTML</b>
	                            </p>	                           
                            	<textarea id="estructura" name="estructura" type="text" rows="4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></textarea>
	                        </div>


	                        

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/tipos_widgets"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de tipos_widgets">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
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

	        var form = $("#form_tipos_widgets");
	        var ruta = window.location.pathname.split("/")[1];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar

	}) //Document 
</script>
@endpush
