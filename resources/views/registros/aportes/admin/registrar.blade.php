@extends('layouts.app')
@section('content')
<style type="text/css">
	
	.tabla-peliculas {
	    display: block;
	    max-height: 200px;
	    overflow-y: auto;
	    -ms-overflow-style: -ms-autohiding-scrollbar;
	}
</style>
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/aportes_peliculas"><i class="material-icons">assignment</i>Películas</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Película
                        <small>Registro de titulo (Descricpción)</small>
                    </h2>
                </div>
                <div class="body">

                	<form id="form_peliculas" accept-charset="UTF-8" enctype="multipart/form-data">
                		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    <div class="row clearfix">
	                    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
	                            <p>
	                                <b>Película</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" oninput="clickInput(event)" id="pelicula"  name="pelicula" class="form-control" placeholder="Pelicula">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	                            <p>
	                                <b>Titulo</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" readonly="readonly" id="titulo_aporte"  name="titulo_aporte" class="form-control" >
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row clearfix">
	                    	<div class="card-content table-responsive tabla-peliculas">
							    <table id="new_pelicula"  class="table table-fixed table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
							        <tbody >
							        	<tr> 
							        	</tr>
							        </tbody>
							    </table>
							</div>
	                    </div>
	                    <br>
	                    <div class="row clearfix">
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                            <p>
	                                <b>Resolución</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="resolucion_id"  name="resolucion_id">
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
	                                    <input id="duracion" name="duracion" type="text"  class="form-control" placeholder="Seleccione duracion">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
	                            <p>
	                                <b>Audio</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="formato_audio_id"  name="formato_audio_id">
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
	                                    <select class="show-tick" data-width="100%" id="formato_video_id"  name="formato_video_id">
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
	                                    <input type="text" id="peso"  name="peso" class="form-control" maxlength="6" placeholder="Ej: 650.5">
	                                </div>
	                            </div>
	                            
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                            <p>
	                                <b>T. Peso</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="tamano_archivo_id"  name="tamano_archivo_id">
	                                        <option value=0>----</option>
	                                        @foreach ($list_tamanos as $tamanos)
	                                        	<option value="{{$tamanos->id}}">{{ $tamanos->unidad }}</option>
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
	                                    <select class="show-tick" data-width="100%" id="idiomas_id"  name="idiomas_id">
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
	                                    <select class="show-tick"  data-width="100%" id="sub_titulo_id"  name="sub_titulo_id">
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
	                                <b>Película</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="serie_id"  name="serie_id">
	                                        <option value=0>--Seleccione--</option>
	                                        @foreach ($list_peliculas as $peliculas)
	                                        	<option value="{{$peliculas->id}}">{{ $peliculas->titulo }} {{ $peliculas->fecha }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                            <p>
	                                <b>Cateogria</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="categoria"  name="categoria">
	                                        <option value=0>--Seleccione--</option>
	                                        <option value=1>Pelicula</option>
	                                        <option value=2>Serie</option>
	                                        <option value=3>Anime</option> 
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        
	                    </div>
	                    <input type="text" id="codigo"  name="codigo" class="form-control" >
	                    <input type="text" id="ultima_emision"  name="ultima_emision" class="form-control" >
	                    <input type="text" id="primera_emision"  name="primera_emision" class="form-control" >
	                    <input type="text" id="descripcion"  name="descripcion" class="form-control" >
	                    <input type="text" id="imagen"  name="imagen" class="form-control" >
	                    <input type="text" id="titulo"  name="titulo" class="form-control" >
	                    <!--  -->
	                    <input type="text" id="episodios" name="episodios" class="form-control" >
	                    <input type="text" id="temporadas" name="temporadas" class="form-control" >
	                    <input type="text" id="status"  name="status" class="form-control" >
	                    <input type="text" id="calificacion"  name="calificacion" class="form-control" >

		                <div class="row clearfix">
		                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                		<p>
	                                <b>Links</b>
	                            </p>
			                    <div class="field_wrapper">
								    <div>
								        <input type="text" name="url[]" value=""/>
								        <a href="javascript:void(0);" class="add_url" title="Agregar Link"><i class="material-icons text-success">add_circle</i></a>
								    </div>
								</div>
						</div>
	                    <div class="row clearfix">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/aportes_peliculas"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de peliculas">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
                                <input id="activo" name="activo" hidden="hidden" value="true" >
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


	$('#new_pelicula').on('change',function(){
		$('input:checkbox[name="checkbox"]:checked').each( function(){

			var codigo = $(this).val();
			var hosting = "api.themoviedb.org/3/tv/"+codigo+"?api_key=48f5c3a8e871801d8ad36d4360ef1f84&language=es-ES";

			$.get("http://"+hosting, function(data) {
				$('#descripcion').val(data.overview);
				$('#imagen').val('https://image.tmdb.org/t/p/original'+data.poster_path);
				$('#primera_emision').val(data.first_air_date);
				$('#titulo').val(data.name);
				$('#codigo').val(codigo);
				$('#episodios').val(data.number_of_episodes);
				$('#temporadas').val(data.number_of_seasons);
				$('#status').val(data.status);
				$('#calificacion').val(data.vote_average);
				$('#ultima_emision').val(data.last_air_date);
				
				var temp = data.number_of_seasons;

				for (i = 0; i < temp; i++) { 

				    var hosting2 = "api.themoviedb.org/3/tv/"+codigo+"/season/"+i+"?api_key=48f5c3a8e871801d8ad36d4360ef1f84&language=es-ES";

					$.get("http://"+hosting2, function(data) {
						var info = $('#info_temp').val();
						$('#info_temp').val(info+','+JSON.stringify(data));

					});
				}

	
					
				
			});
				// alert($chkbox);
		});
	})
	function clickInput(e) {

		var pelicula = $('#pelicula').val(); 
		var cantidad = pelicula.length;
		var hosting = "api.themoviedb.org/3/search/tv?api_key=48f5c3a8e871801d8ad36d4360ef1f84&language=es-ES&query=";

		if (cantidad >= 4) {
			$.get("http://"+hosting+pelicula, function(data) {
				var tr ='';
				var resultados = data['results'];
				$("#new_pelicula > tbody").empty();
				$.each(resultados, function(i) {
		        	tr += "<tr class='bg-black'> <td class='text-center' width='50' valign='middle'><span class='input-group-addon'><input type='checkbox' class='filled-in unico' id='ig_checkbox"+[i]+"' name='checkbox' value="+resultados[i].id+" ><label for='ig_checkbox"+[i]+"'></label></span></td><td  class='text-center' width='20'><img src='https://image.tmdb.org/t/p/original"+resultados[i].poster_path+"' style='width:60px;height:100px'></td><td class='text-center' width='80'><H3>"+resultados[i].name+"</H3><H3>"+resultados[i].first_air_date+"</H3></td><td class='text-center' width='300'><p style='overflow:auto;height:80px;margin:0;padding:0;'>"+resultados[i].overview+"</p></td></tr>";
	            });
	            $('#new_pelicula > tbody:last-child').append(tr);
	
				});

		}
		
	} 
	$(document).ready(function() {

		$('#serie_id,#idiomas_id,#sub_titulo_id,#resolucion_id').change(function () {

			var pelicula = $('#serie_id').find(":selected").text();
			var idioma = '['+$('#idiomas_id').find(":selected").text()+']';
			var sub_titulo = '[Sub - '+$('#sub_titulo_id').find(":selected").text()+']';
			var resolucion = '['+$('#resolucion_id').find(":selected").text()+']';
			
			var peli = '';
			var idio = '';
			var sub = '';
			var re = '';

			if($('#serie_id').val() > 0){
				var peli = pelicula;
			}
			if($('#idiomas_id').val() > 0){
				var idio = idioma;
			}
			if($('#sub_titulo_id').val() > 0){
				var sub = sub_titulo;
			}
			if($('#resolucion_id').val() > 0){
				var re = resolucion;
			}

            $('#titulo_aporte').val(peli+' '+idio+' '+sub+' '+re);
	    });

	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_url'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
	    var fieldHTML = '<div><input type="text" name="url[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Quitar Link"><i class="material-icons text-danger">remove_circle</i></a></div>'; //New input field html 
	    var x = 1; //Initial field counter is 1
	    $(addButton).click(function(){ //Once add button is clicked
	        if(x < maxField){ //Check maximum number of input fields
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); // Add field html
	        }
	    });
	    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	        e.preventDefault();
	        $(this).parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defect

		        var form = $("#form_peliculas");
		        var ruta = window.location.pathname.split("/")[1];
		        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar
	}) //Document 
</script>
@endpush
