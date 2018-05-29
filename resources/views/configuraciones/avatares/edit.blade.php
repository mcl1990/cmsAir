@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/avatares"><i class="material-icons">assignment</i>Avatares</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Avatar
                        <small>Actualizar de avatar (Código y Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_avatares" >
	                    <div class="row clearfix">
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
	                            <p>
	                                <b>Avatar</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="avatar"  name="avatar" class="form-control" value="{{ $avatar->avatar }}" maxlength="20" placeholder="Nombre del avatar">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
	                            <p>
	                                <b>Icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<img id="preview" width="15%" height="15%" src="../../images/avatares/{{ $avatar->icono }}" />
	                                    <input type="file" id="fileinput"  name="fileinput" class="form-control" onchange="readURL(this);">
	                                </div>
	                            </div>
	                        </div>
	                        <textarea name="pre_icono" id="pre_icono" hidden="hidden"></textarea>
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/avatares"  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de avatares">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar avatar">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
				                
                                
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $avatar->id }}" >
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
		      	$('#preview').attr("src",result);
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

		$("#actulizar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var id = $('#id').val();
	        var form = $("#form_avatares");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
