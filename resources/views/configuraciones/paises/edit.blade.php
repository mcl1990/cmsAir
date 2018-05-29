@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/paises"><i class="material-icons">public</i>Paises</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar País
                        <small>Actualizar de país (Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_paises">
	                    <div class="row clearfix">

	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>País</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="pais"  name="pais" class="form-control" value="{{ $pais->pais }}" maxlength="50" placeholder="Nombre de la pais">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/paises"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de paises">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar pais">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
				                
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $pais->id }}" >
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
	        var form = $("#form_paises");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
