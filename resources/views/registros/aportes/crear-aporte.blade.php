@extends('layouts.links')
@section('add-links')
<style>
	#field {
	margin-bottom:20px;
	}
	option.especial{background-color: blue}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">
		<div class="card">
			<div class="header">
				<h4>Registrar aporte</h4>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="/links">Ver todos</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="body">
				<h3 class="card-inside-title text-center" id="titulo-pelicula"></h3>
				<form onsubmit="enviarFormulario(event)" action="{{route('aportes.store')}}" method="POST">
					{{csrf_field()}}
					<div class="row clearfix">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<select name="cat" id="selCategoria" class="form-control selectpicker" data-style="btn-info" name="cat">
								<option value="">Seleccione la categoría</option>
								<option value="película" class="especial">Peliculas</option>
								<option value="serie">Series</option>
								<option value="anime">Animes</option>
								<option value="" disabled>Ebooks</option>
								<option value="" disabled>Programas</option>
								<option value="" disabled>Celulares</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">movie</i>
								</span>
								<div class="form-line">
									<input type="text" class="form-control" id="txtPelicula" oninput="solicitarApi(event)">
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="hidden-xs text-center col-sm-12 col-lg-12" id="lista-peliculas">
							{{-- TODO | Contenedor de lista de peliculas --}}
							<div class="preloader" style='display: none'>
								<div class="spinner-layer pl-teal">
									<div class="circle-clipper left">
										<div class="circle"></div>
									</div>
									<div class="circle-clipper right">
										<div class="circle"></div>
									</div>
								</div>
							</div>
							<table id="tabla-peliculas" class="table table-fixed table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
								<tbody>
									<tr>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row clearfix cont-opciones">
						<div class="col-xs-6 col-sm-3 col-md-1 col-lg-1">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="peso" class="form-control" placeholder="Peso" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
							<select name="unidadPeso" id="" class="form-control">
								<option>Unidad</option>
								@foreach($tamanos as $ta)
								<option value="{{$ta->id}}">{{$ta->tamano}}</option>
								@endforeach
							</select>
						</div>							
					</div>
					<div class="row clearfix cont-opciones" style="margin-bottom: 50px;">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Formato</b></p>
							<select data-etapa='formato' name="formato" class="form-control show-tick">
								<option value="">Seleccione el formato</option>
								@foreach($formatos as $f)
								<option value="{{$f->id}}">{{$f->video}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Audio</b></p>
							<select data-etapa='audio' name="audio" id="" class="form-control show-tick">
								<option value="">Tipo de audio</option>
								@foreach($audios as $a)
								<option value="{{$a->id}}">{{$a->audio}}</option>
								@endforeach
							</select>
						</div>						
					</div>
					<div class="row clearfix cont-opciones" style="margin-bottom: 50px;">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Cálidad</b></p>
							<select data-etapa='calidad' name="calidad" class="form-control show-tick cambiador-titulo" onchange="concatTitulo(event)">
								<option value="">Seleccione la resolución</option>
								@foreach($resoluciones as $r)
								<option value="{{$r->id}}">{{$r->resolucion}}-{{$r->calidad}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Idioma</b></p>
							<select data-etapa='idioma' name="idioma" id="" class="form-control show-tick cambiador-titulo" onchange="concatTitulo(event)">
								<option value="">Idioma del audio</option>
								@foreach($idiomas as $i)
								<option value="{{$i->id}}">{{$i->idioma}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Subtitulos</b></p>
							<select data-etapa='sub' name="subtitulo" id="" class="form-control show-tick cambiador-titulo" onchange="concatTitulo(event)">
								<option value="">Idioma del subtitulo</option>
								@foreach($idiomas as $i)
								<option value="{{$i->id}}">{{$i->idioma}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
							<p><b>Acortador</b></p>
							<select name="acortador" id="" class="form-control show-tick">
								<option value="adf.ly">adf.ly</option>
							</select>
						</div>
					</div>
					<div class="row clearfix" id="cont-enlaces">
						{{-- TODO | Agregar enlaces --}}
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
								<button onclick="aggCampoEnlace()" type="button" class="btn btn-info waves-effect">Agregar enlace</button>
							</div>
							<div class="input-group">
                                <div class="form-line">
                                    <input type="text" name="enlaces[]" class="form-control date" placeholder="https://url.com">
                                </div>
                                <span class="input-group-addon" >
                                    <i class="material-icons">clear</i>
                                </span>
                            </div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-12">
							<input type="hidden" name='titulo' id="txtTitulo">
							<input type="hidden" name='generos[]' id="txtGeneros">
							<input type="hidden" name='imdbID' id="txtImdbID">
							<input type="hidden" name='descripcion' id="txtDescripcion">
							<input type="hidden" name='fecha' id="txtFecha">
							<input type="hidden" name='duracion' id="txtDuracion">
							<input type="hidden" name='calificacion' id="txtCalificacion">
							<button type="button" class="btn btn-default">Cancelar</button>
							<button class="btn btn-success">Registrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" charset="utf-8">
	var apiHost = 'https://api.themoviedb.org/3';
	var key = '48f5c3a8e871801d8ad36d4360ef1f84';
	var tituloCompleto = [];
	var checkbox;
	/*Logica de mostrar la tabla de peliculas para seleccionarla*/
	function seleccionarPelicula(e) {
		let el = e.currentTarget;
		if(el.checked){
			checkbox = el;
			$('.cont-opciones').css('display','block');
			$('#cont-enlaces').css('display','block');
			let tituloPelicula = $(el).closest('tr').find('h3.titulo').text();
			tituloCompleto[0] = tituloPelicula;
			$('#titulo-pelicula').text(tituloCompleto[0]);
			el.classList.add('objetivo');
			$.each($('.unico:not(.objetivo)'),(i,e) => {
				$(e).closest('tr').css('display','none');
			});
		} else {
			$('#titulo-pelicula').text('');
			$('#cont-enlaces').css('display','none');
			$('.cont-opciones').css('display','none');
			$(el).removeClass('objetivo');
			$.each($('.unico:not(.objetivo)'),(i,e) => {
				$(e).closest('tr').css('display','table-row');
			});
		}
	}
	/*Logica para concatenar el titulo de los combos seleccionados al titulo*/
	function concatTitulo(e) {
		let ele = e.currentTarget;
		valor = $(ele).find(':selected').text();
		switch(ele.dataset.etapa){
			case 'calidad':
				tituloCompleto[1] = " ["+valor+"] ";
				break;
			case 'idioma':
				tituloCompleto[2] = " ["+valor+"] ";
				break;
			case 'sub':
				tituloCompleto[3] = " [Sub - "+valor+"] ";
				break;
		}
		let str = '';
		tituloCompleto.forEach(e => {
			str += e;
		});
		$('#titulo-pelicula').text(str);
	}

	function eliminarDiv(e){
		let el = e.currentTarget;
		$(el).closest('.input-group').remove();
	}

	function aggCampoEnlace(){
		$('#cont-enlaces > div')
		.append('<div class="input-group"><div class="form-line"><input type="text" class="form-control" placeholder="https://url.com" name="enlaces[]"></div><span onclick="eliminarDiv(event)" class="input-group-addon" ><i class="material-icons">clear</i></span></div>');
	}

	// Consulta a la API de IMDb
	function solicitarApi(e) {
		let pelicula = e.currentTarget.value;
		if(pelicula == '') {
			$('#lista-peliculas').css('display','none');
			$('.preloader').css('display','none');
			return false;
		}
		if (pelicula.length > 5) {
			$('.preloader').css('margin','auto');
			$('.preloader').css('display','block');
			$.ajax(apiHost + '/search/movie?api_key=' + key + '&query=' + pelicula, {
				success: function(data,status,xml){
					$('.preloader').css('display','none');
					$('#lista-peliculas').css('display','block');
					$('#lista-peliculas').css('height','250px');
					$('#lista-peliculas').css('overflow','auto');
					var tr ='';
					var resultados = data['results'];
					$("#tabla-peliculas > tbody").empty();
					$.each(resultados, function(i,e) {
						tr += "<tr class='bg-black'> <td class='text-center' width='50' valign='middle'><span class='input-group-addon'><input type='checkbox' onchange='seleccionarPelicula(event)' class='filled-in unico' id='ig_checkbox"+i+"' name='codigo' value="+e.id+" ><label for='ig_checkbox"+i+"'></label></span></td><td  class='text-center' width='20'><img src='https://image.tmdb.org/t/p/original"+e.poster_path+"' style='width:60px;height:100px'></td><td class='text-center' width='80'><h3 class='titulo'>"+e.title+"</h3><h3>"+e.release_date+"</h3></td><td class='text-center' width='300'><p style='overflow:auto;height:80px;margin:0;padding:0;'>"+e.overview+"</p></td></tr>";
					});
					$('#tabla-peliculas > tbody:last-child').append(tr);
				},
				error: function(){
					$('.preloader').css('display','none');
					alert('No se pudo encontrar la pelicula.');
				},
				timeout: 4000
			});
		}
	}

	function enviarFormulario(e){
		e.preventDefault();
		let form = e.currentTarget;
		let id = checkbox.value;
		$.ajax(apiHost + '/movie/'+id+'?api_key=' + key + '&language=es-ES', {
			success: function(data,status,xml){
				$('#txtTitulo').val(data.title);
				let generos = [];
				data.genres.forEach(ele => {
					generos.push(ele.name);
				});
				console.log(generos);
				$('#txtGeneros').val(generos);
				$('#txtImdbID').val(data.imdb_id);
				$('#txtDescripcion').val(data.overview);
				$('#txtFecha').val(data.release_date);
				$('#txtDuracion').val(data.runtime);
				$('#txtCalificacion').val(data.vote_average);
				form.submit();
			},
			error: function(){
				console.log('Error');
				alert('No se encontro la pelicula.')
			},
			timeout: 4000
		});
		let titulo = document.getElementById('titulo-pelicula').innerHTML;
		$('#txtTitulo').val(titulo);
	}
	
	$(document).ready(function() {
		$('.cont-opciones').css('display','none');
		$('#cont-enlaces').css('display','none');
		$('#txtPelicula').closest('.input-group').css('display','none');
		var next = 1;
		$('#titulo-pelicula').text(tituloCompleto[0]);
		$('#selCategoria').change(function () {
			$('#txtPelicula').closest('.input-group').css('display','table');
			$('#txtPelicula').attr('placeholder','Nombre de la ' + $(this).val());
		});
	});
</script>
@endpush