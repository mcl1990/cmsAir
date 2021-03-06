@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/categorias"><i class="material-icons">assignment</i>Categorías</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Categoría
                        <small>Actualizar de categoria (Descripción)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_categorias">
	                    <div class="row clearfix">
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Categoría</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="categoria"  name="categoria" class="form-control" value="{{ $categoria->categoria }}" maxlength="15" placeholder="Nombre del categoria">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="icono"  name="icono" class="form-control" maxlength="50" value="{{ $categoria->icono }}" placeholder="codigo del icono">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/categorias"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de categorias">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar categoria">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $categoria->id }}" >
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

		$("#actulizar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var id = $('#id').val();
	        var form = $("#form_categorias");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
