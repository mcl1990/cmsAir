@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/tipos_widgets"><i class="material-icons">assignment</i>Tipos de Widgets</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Tipo de Widget
                        <small>Actualizar de Tipo de Widget (Título, descripción, icono, estructura)</small>
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
	                                    <input type="text" id="titulo"  name="titulo" class="form-control" maxlength="25" value="{{ $tipo->titulo }}"placeholder="Nombre de Widget">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Descripción</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="descripcion"  name="descripcion" class="form-control" maxlength="50" value="{{ $tipo->descripcion }}" placeholder="Ej: Breve reseña del Widget">
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="icono"  name="icono" class="form-control" maxlength="25" value="{{ $tipo->icono }}" placeholder="Ej: save">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Estructura HTML</b>
	                            </p>	                           
                            	<textarea id="estructura" name="estructura" type="text" rows="4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">{{ $tipo->estructura }}</textarea>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/tipos_widgets"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de tipos_widgets">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
                                
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $tipo->id }}" >
                                <input type="text" id="id_serie" name="id_serie" hidden="hidden" value="{{ $tipo->serie_id }}" >

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

	$(window).load(function(){
		$(function() {
		  	$('#caratula').change(function(e) {
		    	addImage(e); 
		    });

		    function addImage(e){
			    var file = e.target.files[0],
			    imageType = /image.*/;
		    
		      	if (!file.type.match(imageType))
		       	return;
		  
			    var reader = new FileReader();
			    reader.onload = fileOnload;
			    reader.readAsDataURL(file);
		    }
		  
		    function fileOnload(e) {
		      	var result=e.target.result;
		      	$('#preview').attr("src",result);
		    }
	    });
	});


	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#falseinput').attr('src', e.target.result);
				$('#pre_imagen').val(e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function() {
		
		var se = $('#id_serie').val();
		$("#serie_id").selectpicker('val', se);

		$("#actulizar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var id = $('#id').val();
	        var form = $("#form_tipos_widgets");
	        var ruta = window.location.pathname.split("/")[1];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
