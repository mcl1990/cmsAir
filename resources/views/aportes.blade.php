@extends('layouts.links')
@section('titulo')
Aportes | AIRLINK
@endsection
@section('htmlheader')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('css/themes/theme-black.css')}}">
<style type="text/css">
	tbody td {vertical-align: middle}
	td a.enlace-titulo {
		text-decoration: none;
		width: 100%;
		height: 100%;
	}
	div.dataTables_wrapper div.dataTables_paginate{text-align: center;}
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n+1){background-color: #14110F}
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n){background-color: #221E1B}
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n+1) td,
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n) td,
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n) td a{color: white}
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n+1) a{color: white}
	.table#tabla-enlaces > tbody > tr:nth-of-type(2n+1) i{color: white}
	.table#tabla-enlaces > tbody > tr:hover {background-color: #373534}
	.table#tabla-enlaces > tbody > tr > td{padding: 3px;}
	#tabla-enlaces > tbody > tr > td > .btn{padding: 2px;}
	#tabla-enlaces > tbody > tr > td > .enlace-titulo{font-size: 0.9em;}
	#tabla-enlaces > tbody > tr > td{border:none;}
	#tabla-enlaces > tbody > tr > td{white-space: nowrap;}
	div.dataTables_wrapper div.dataTables_filter {text-align: center;}
	@media only screen and (min-width: 800px) {
		#widget-busqueda {
			padding-right: 0;
			width: 21%;
		}
		#widget-tabla {
			width: 79%;
		}
	}
	@media only screen and (max-width: 768px){
		.table-responsive {
			border: none;
		}
	}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3" id="widget-busqueda">
		<div class="card">
			<div class="body bg-black">
				<div class="row clearfix">
					<div class="col-md-12">
						<select class="form-control show-tick selectpicker" multiple data-max-options=4 data-size=4 id="selCategoria" data-style="btn-trans">
							<option value="">-- Categoría --</option>
							@foreach($categorias as $c)
								<option value="{{$c->id}}" {{$c->status == 0 ? 'disabled' : ''}}>{{$c->categoria}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-12">
						<select class="form-control show-tick selectpicker" multiple data-max-options=4 data-size=4 id="selServidor" data-style="btn-trans">
							<option value="">-- Servidores --</option>
							@foreach($servidores as $s)
								<option value="{{$s->id}}">{{$s->servidor}}</option>
							@endforeach
						</select>
					</div>
					{{-- <div class="col-md-12">
						<select class="form-control show-tick" id="selOrdenar">
							<option value="">-- Ordenar por --</option>
							<option>Relevantes</option>
						</select>
					</div> --}}
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">bookmark</i>
							</span>
							<div class="form-line">
								<input type="text" id="txtTags" class="form-control" placeholder="Etiquetas" data-role="tagsinput">
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">person</i>
							</span>
							<div class="form-line">
								<input type="text" id="txtUsuario" class="form-control" placeholder="Usuario">
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">info</i>
							</span>
							<div class="form-line">
								<input type="text" id="txtTamanoMax" class="form-control" placeholder="Tamaño máximo (MB)">
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">info</i>
							</span>
							<div class="form-line">
								<input type="text" id="txtTamanoMin" class="form-control" placeholder="Tamaño mínimo (MB)">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<button onclick="filtrarAportes(event)" type="button" class="btn btn-block btn-lg btn-primary waves-effect">BUSCAR</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9" id="widget-tabla" >
		<div class="card">
			<div class="header bg-black">
				<h3>Enlaces</h3>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="{{route('aportes.create')}}">Agregar enlace</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="body bg-black">
				<div class="card-content table-responsive">
					<table id="tabla-enlaces" class="table display table-striped table-hover table-condensed dt-responsive table-responsive">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="{{asset('js/jquery.faviconPrefixer.min.js')}}"></script>
<script type="text/javascript">
	$('#tabla-enlaces a.icono').faviconPrefixer({
		apiURL: 'http://favicon.yandex.net/favicon/',
		iconClassName: "fp-icon",
		glueMethod: 'prepend'
	});
</script>
<script type="text/javascript" charset="utf-8">
	function filtrarAportes (e) {
		tablaEnlaces.draw();
	}
	var tablaEnlaces = $('#tabla-enlaces').DataTable({
		dom: '<"row"<"col-xs-12 text-center"f><"col-xs-12 text-center"prt><"col-xs-12 text-center"p>>',
		paging: true,
		lengthChange: false,
		autoWidth: false,
		searching: true,
		ordering: false,
		info: false,
		iDisplayLength: 7,
		iDisplayStart: 0,
		sPaginationType: "simple_numbers",
		language: {
			paginate: {
				previous: '<',
				next: '>'
			}
		},
		aLengthMenu: false,
		processing: true,
		serverSide: true,
		{{-- "ajax": "{{ route('datatable.aportes') }}", --}}
		ajax: {
			url: "{{ route('datatable.aportes') }}",
			data: function(d) {
				d.categoria = $('#selCategoria').val();
				d.usuario = $('#txtUsuario').val();
				d.tmin = $('#txtTamanoMin').val();
				d.tmax = $('#txtTamanoMax').val();
				d.etiquetas = $('#txtTags').val();
			}
		},
		columns: [
			{data: 'icono', name: 'icono', sWidth: "4%", sClass: "text-center"},
			{data: 'categoria', name: 'categoria', sWidth: "4%", sClass: "text-center"},
			{data: 'titulo', name: 'titulo', sWidth: "15%", sClass: "text-left"},
			{data: 'usuario', name: 'usuario', sWidth: "10%", sClass: "text-center"},
			{data: 'vistas', name: 'vistas', sWidth: "8%", sClass: "text-left"},
			{data: 'peso', name: 'peso', sWidth: "8%", sClass: "text-center"},
			{data: 'codigo', name: 'codigo', sWidth: "25%", sClass: "text-center", visible:false}
			// {data: 'action', name: 'action', orderable: false, searchable: false, sWidth: "5%", sClass: "text-center"}
		],
		fixedHeader: {
			header: false
		},
		createdRow: function(row,data,dataIndex){
			let url = '/aportes/p' + data['codigo'] + '/detalles';
			var a = document.createElement('a');
			a.href = data['icono'];
			a.className = 'icono';
			a.dataset.host = a.hostname;
			a.href = 'javascript:void(0)';
			$('td:eq(0)', row).html(a);
			// $('td:eq(1)', row).html( "<a href='javascript:void(0)'><img  style='width:20px;height: 20px' src='images/iconos/"+data['categoria']+"' alt='' ></a>" );
			$('td:eq(1)', row).html( "<a href='javascript:void(0)'><i class='material-icons' style='font-size: 20px;vertical-align:middle; color: orange'>theaters</i></a>" );
			$('td:eq(2)', row).html( "<a href='/aportes/"+data['cid']+"/"+data['codigo']+"' class='enlace-titulo'>"+data['titulo']+"</a>" );
			$('td:eq(0)', row).css('vertical-align','middle');
			$('td:eq(1)', row).css('vertical-align','middle');
			$('td:eq(2)', row).css('vertical-align','middle');
			$('td:eq(3)', row).css('vertical-align','middle');
			$('td:eq(4)', row).css('vertical-align','middle');
			$('td:eq(5)', row).css('vertical-align','middle');

			$('td:eq(3)', row).html("<a href='javascript:void(0)' class='btn btn-block waves-effect'><i class='material-icons'>person</i>"+data['usuario']+"</a>");			
			$('td:eq(4)', row).html( "<div><i style='vertical-align:middle' class='material-icons' style='font-size: 18px'>remove_red_eye</i> "+data['vistas']+"</div>" );
		}
	});
	tablaEnlaces.on( 'draw', function () {
		$('#tabla-enlaces a.icono').faviconPrefixer({
			apiURL: 'http://favicon.yandex.net/favicon/',
			iconClassName: "fp-icon",
			glueMethod: 'prepend'
		});
	    $('#tabla-enlaces tr .btn').mouseover(function(e){
			e.currentTarget.classList.add('btn-primary');
		});
		$('#tabla-enlaces tr .btn').mouseleave(function(e){
			e.currentTarget.classList.remove('btn-primary');
		});
	});
</script>
@endpush