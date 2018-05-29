@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/series"><i class="material-icons">assignment</i>Series</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Serie
                        <small>Registro de titulo (Título, fecha, sinopsis, imagen)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_series">
                		<div class="row clearfix">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Caratula</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<img id="preview" width="15%" height="15%" src="" />
	                                	<input id="caratula" type="file" accept="image/jpg, image/jpeg, image/png" onchange="readURL(this);" />
	                                </div>
	                            </div>
	                        </div>
                        </div><!-- row clearfix 2 -->
                		
	                    <div class="row clearfix">
	                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                            <p>
	                                <b>Título</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="titulo"  name="titulo" class="form-control" maxlength="100" placeholder="Titulo de la película">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Primera Emisión</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="primera_emision"  name="primera_emision" class="form-control" maxlength="15" placeholder="Ej: 2018">
	                                </div>
	                            </div>
	                            
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Última Emisión</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="ultima_emision"  name="ultima_emision" class="form-control" maxlength="15" placeholder="Ej: 2018">
	                                </div>
	                            </div>
	                            
	                        </div>
	                        
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Codigo <small>(Api)</small></b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="codigo"  name="codigo" class="form-control" maxlength="10" placeholder="Ej: 2018">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Temporadas</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="temporadas"  name="temporadas" class="form-control" maxlength="2" placeholder="Ej: 4">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Episodios</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="episodios"  name="episodios" class="form-control" maxlength="4" placeholder="Ej: 20">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>Calificación</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="calificacion"  name="calificacion" class="form-control" maxlength="3" placeholder="Ej: 7.5">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                            <p>
	                                <b>Estado</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="estado"  name="estado">
	                                        <option value=0>--Seleccione--</option>
	                                        <option value=1>En Emisión</option>
	                                        <option value=2>Finalizada</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>

	                        <textarea name="pre_imagen" id="pre_imagen" hidden="hidden"></textarea>
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Sinopsis</b>
	                            </p>	                           
                            	<textarea id="descripcion" name="descripcion" type="text" rows="4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></textarea>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/series"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de series">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
                                <input type="text" id="activo" name="activo" hidden="hidden" value="true" >
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

		$('#primera_emision').bootstrapMaterialDatePicker({
    		time: false, 
    		format : 'YYYY-MM-DD',
    		lang : 'es',
    		clearButton: true,
    		clearText : 'Limpiar',
    		cancelText : 'Cancelar',
    	});

    	$('#ultima_emision').bootstrapMaterialDatePicker({
    		time: false, 
    		format : 'YYYY-MM-DD',
    		lang : 'es',
    		clearButton: true,
    		clearText : 'Limpiar',
    		cancelText : 'Cancelar',
    	});
		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_series");
	        var ruta = window.location.pathname.split("/")[1];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar

	}) //Document 
</script>
@endpush
