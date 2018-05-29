@extends('layouts.aporte-detalles')
@section('estilos')
<link rel="stylesheet" href="css/rating.css">
<style>
	.img-aporte, figure {height: 250px;}
	.pelicula section{background-color: gray; padding: 15px; margin-bottom: 20px;border-radius: 4px;}
	/*section h2,section h3,section h4{color: white;}*/
	.poster{margin-bottom: 15px;}
	.rating{padding: 20px 0;background-color: #321}
	#info-general .meta li {display: inline;}
	.puntuacion{font-size: 3em;}
	ul.list-group i {vertical-align: middle;}
</style>
@endsection
@section('content')
<div class="row clearfix">
	{{-- Breadcrumb --}}
	<div class="col-xs-12">
		<div class="card">
            <div class="body bg-black">
                <ol class="breadcrumb breadcrumb-col-cyan">
                    <li><a href="{{route('peliculas.index')}}"><i class="material-icons">home</i> Principal</a></li>
                    <li><a href="{{route('peliculas.index')}}"><i class="material-icons">movie</i> Películas</a></li>
                    <li class="active"><i class="material-icons">archive</i> Detalle</li>
                </ol>
            </div>
        </div>
	</div>
</div>
<div class="row">
	{{-- Parte izquierda --}}
	<div class="col-xs-12 col-sm-3">
		<div class="card">
			<div class="body bg-black">
				<img class="img-responsive" src="/images/peliculas/{{$pelicula->imagen}}" alt="{{$pelicula->titulo}}" style="margin:auto">		
			</div>		
		</div>
		<div class="card">
			<div class="body bg-black">
				<div class="text-center puntuacion">
					<p>{{$pelicula->calificacion}}</p>
				</div>
				<div class="text-center">
					<i class="material-icons">person</i>
					<span>450 Total</span>
				</div>				
			</div>
		</div>
		{{-- <div class="card">
			Metadatos de pelicula
			<div class="header bg-black"><h4>General</h4></div>
			<div class="body bg-black">
				<ul class="list-group">
                    <li class="list-group-item"><i class="material-icons">movie</i>Saga</li>
                    <li class="list-group-item"><i class="material-icons">person</i>Director</li>
                    <li class="list-group-item"><i class="material-icons">question_answer</i>Comentarios <span class="badge bg-pink">14 new</span></li>
                    <li class="list-group-item"><i class="material-icons">perm_media</i>Multimedia</li>
                </ul>
			</div>
		</div> --}}
		{{-- <div class="card" id='seguidores'>
			Widget de seguidores
		</div> --}}
	</div>
	{{-- Parte derecha --}}
	<div class="col-xs-12 col-sm-9">
		{{-- Inf General --}}
		<div class="card">
			<div class="header bg-black">
				<h1>{{$pelicula->titulo}} <small>{{$pelicula->fecha->format('Y')}}</small></h1>
			</div>
			<div class="body bg-black" id="info-general">
				<p>{{$pelicula->titulo}}</p>
				<span class="badge bg-orange">{{$pelicula->duracion}} min</span>
				<span>- 3712 visitas - </span>
				@foreach($pelicula->generos as $genero)
				<a href="javascript:void(0)" class="btn btn-primary waves-effect">{{$genero->genero}}</a>
				@endforeach
			</div>
		</div> {{-- Fin de Inf General --}}
		{{-- Sinopsis --}}
		<div class="card">
			<div class="body bg-black">
				<h2>Sinopsis</h2>
				<p>{{$pelicula->descripcion}}.</p>
			</div>
		</div> {{-- Fin de sinopsis --}}
		{{-- Pestañas --}}
		<div class="card">
			<div class="body bg-black">
				<ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#comentarios" data-toggle="tab">DESCARGAS</a></li>
                    <li role="presentation"><a href="#relacionados" data-toggle="tab">VER ONLINE</a></li>
                </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane fade in active" id="comentarios">
                        <table class="table table-hover table-responsive" id="aportes-tabla">
                        	<thead>
                        		<tr>
                        			<th>Opción</th>
                        			<th>Servidor</th>
                        			<th>Audio</th>
                        			<th>Calidad</th>
                        			<th>Usuario</th>
                        			<th>Visto</th>
                        			<th>Peso</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        	</tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="relacionados">
                        <b>Ver online</b>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                </div>                
			</div>
		</div> {{-- Fin de pestañas --}}
	</div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/rating.js')}}"></script>
<script src="{{asset('js/jquery.faviconPrefixer.min.js')}}"></script>
<script type="text/javascript">
	$('a, i[data-host]').faviconPrefixer({
		apiURL: 'http://favicon.yandex.net/favicon/',
		iconClassName: "fp-icon",
		glueMethod: 'prepend'
	});
</script>
<script src="{{asset('plugins/light-gallery/js/lightgallery-all.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('plugins/light-gallery/js/lg-thumbnail.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('plugins/light-gallery/js/lg-fullscreen.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script >
	var tablaAportes = $('#aportes-tabla').DataTable({
			dom: '<"row"<"col-xs-12 text-center"f><"col-xs-12 text-center"prt><"col-xs-12 text-center"p>>',
	       paging: true,
	       lengthChange: false,
	       autoWidth: false,
	       searching: true,
	       ordering: false,
	       info: false,
	       iDisplayLength: 25,
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
	       ajax: "{{ route('data.aportes.id', ['id' => Request::segment(2)]) }}",
	       columns: [
	           {data: 'opcion', name: 'opcion', "sWidth": "5%", "sClass": "text-center"},
	           {data: 'servidor', name: 'servidor', "sWidth": "10%"},
	           {data: 'audio', name: 'audio', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"},
	           {data: 'calidad', name: 'calidad', orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"},
	           {data: 'usuario', name: 'usuario', orderable: false, searchable: false, "sWidth": "15%", "sClass": "text-center"},
	           {data: 'visto', name: 'visto', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"},
	           {data: 'peso', name: 'visto', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"}
	       ]
	   });
</script>
@endpush