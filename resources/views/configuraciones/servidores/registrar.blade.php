@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/servidores"><i class="material-icons">assignment</i>Servidores</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Servidor
                        <small>Registro de servidor (Descricpción)</small>
                    </h2>
                </div>
                <div class="body">

                	<form id="form_servidores" enctype="multipart/form-data">
	                    <div class="row clearfix">
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Servidor</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="servidor"  name="servidor" class="form-control" maxlength="20" placeholder="Nombre del servidor">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
	                            <p>
	                                <b>Icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<img id="imgSalida" width="15%" height="15%" src="" />
	                                	<input id="fileinput" type="file" accept="image/jpg, image/jpeg, image/png" onchange="readURL(this);" /> 
	                                </div>
	                            </div>
	                        </div>
	                        <textarea name="pre_icono" id="pre_icono" hidden="hidden"></textarea>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/servidores"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de servidores">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar servidor">
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
	$(window).load(function(){
		$(function() {
		  	$('#fileinput').change(function(e) {
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
		      	$('#imgSalida').attr("src",result);
		    }
	    });
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#falseinput').attr('src', e.target.result);
				$('#pre_icono').val(e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).ready(function() {

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_servidores");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar

	}) //Document 
</script>
@endpush
