@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/idiomas"><i class="material-icons">assignment</i>Idiomas</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Idioma
                        <small>Actualizar de idioma (Código y Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_idiomas">
	                    <div class="row clearfix">
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Idioma</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="idioma"  name="idioma" class="form-control" value="{{ $idioma->idioma }}" maxlength="25" placeholder="Nombre del idioma">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/idiomas"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de idiomas">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar idioma">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $idioma->id }}" >
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
	        var form = $("#form_idiomas");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
