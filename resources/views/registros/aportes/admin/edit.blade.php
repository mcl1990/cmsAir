@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/aportes_peliculas"><i class="material-icons">assignment</i>Películas</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Película
                        <small>Actualizar de titulo (Código y Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_peliculas">
                		<div class="row clearfix">
	                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
	                            <p>
	                                <b>Película</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="pelicula_id"  name="pelicula_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_peliculas as $peliculas)
	                                        	<option value="{{$peliculas->id}}">{{ $peliculas->titulo }} {{ $peliculas->fecha }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	                            <p>
	                                <b>Titulo</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" readonly="readonly" id="titulo"  name="titulo" class="form-control" value="{{$aporte->titulo}}"   placeholder="Nombre del titulo">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row clearfix">
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                            <p>
	                                <b>Resolución</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="resolucion_id"  name="resolucion_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_resoluciones as $resoluciones)
	                                        	<option value="{{$resoluciones->id}}">{{ $resoluciones->resolucion }} {{ $resoluciones->calidad }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                    		<p>
	                                <b>Duración</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input id="duracion" name="duracion" type="text"  class="form-control" value="{{$aporte->duracion}}" placeholder="Seleccione duracion">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Audio</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="formato_audio_id"  name="formato_audio_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_audios as $audios)
	                                        	<option value="{{$audios->id}}">{{ $audios->audio }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Video</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="formato_video_id"  name="formato_video_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_formatos as $formatos)
	                                        	<option value="{{$formatos->id}}">{{ $formatos->formato }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
	                            <p>
	                                <b>Peso</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="peso"  name="peso" class="form-control" maxlength="6" value="{{$aporte->peso}}" placeholder="Ej: 650.5">
	                                </div>
	                            </div>
	                            
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                            <p>
	                                <b>T. Peso</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="tamano_archivo_id"  name="tamano_archivo_id">
	                                        <option value=0>----</option>
	                                        @foreach ($list_tamanos as $tamano_archivos)
	                                        	<option value="{{$tamano_archivos->id}}">{{ $tamano_archivos->unidad }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        
	                    </div>
	                    <div class="row learfix">
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                            <p>
	                                <b>Idioma</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick" data-width="100%" id="idiomas_id"  name="idiomas_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_idiomas as $idiomas)
	                                        	<option value="{{$idiomas->id}}">{{ $idiomas->idioma }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                            <p>
	                                <b>Sub títulos</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="selectpicker show-tick"  data-width="100%" id="sub_titulo_id"  name="sub_titulo_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_idiomas as $idiomas)
	                                        	<option value="{{$idiomas->id}}">{{ $idiomas->idioma }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        
	                    </div>
	                    <div class="row clearfix">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/aportes_peliculas"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de peliculas">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar película">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
				                
                                <input type="text" id="user_update" name="user_update" hidden="hidden" value="{{ Auth::user()->id }}" >
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $aporte->id }}" >

                                <input type="text" id="id_pelicula" hidden="hidden" value="{{ $aporte->pelicula_id }}" >
                                <input type="text" id="id_resolucion" hidden="hidden" value="{{ $aporte->resolucion_id }}" >
                                <input type="text" id="id_idiomas" hidden="hidden" value="{{ $aporte->idiomas }}" >
                                <input type="text" id="id_sub_titulo_id" hidden="hidden" value="{{ $aporte->sub_titulos }}" >
                                <input type="text" id="id_formato_video" hidden="hidden" value="{{ $aporte->formato_video_id }}" >
                                <input type="text" id="id_audio" hidden="hidden" value="{{ $aporte->formato_audio_id }}" >
                                <input type="text" id="id_tamano_archivo" hidden="hidden" value="{{ $aporte->tamano_archivo_id }}" >

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

		var e = $('#id_pelicula').val();
		var p = $('#id_tamano_archivo').val();
		var m = $('#id_resolucion').val();
		var pa = $('#id_idiomas').val();
		var b = $('#id_sub_titulo_id').val();
		var ru = $('#id_audio').val();
		var z = $('#id_formato_video').val();

		$("#tamano_archivo_id").selectpicker('val', p);
		$("#pelicula_id").selectpicker('val', e);
		$("#resolucion_id").selectpicker('val', m);
		$("#idiomas_id").selectpicker('val', pa);
		$("#formato_video_id").selectpicker('val', z);
		$("#sub_titulo_id").selectpicker('val', b);
		$("#formato_audio_id").selectpicker('val', ru);

		$("#actulizar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var id = $('#id').val();
	        var form = $("#form_peliculas");
	        var ruta = window.location.pathname.split("/")[1];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
