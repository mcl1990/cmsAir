@extends('layouts.peliculas')
@section('estilos')
<style>
	.img-aporte, figure {height: 250px;}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4>Estrenos de cartelera</h4>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="{{route('aportes.index')}}">+ Colabora</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-lg-12">
						<nav class="text-center">
							{{ $aportes->links() }}
						</nav>
					</div>
					@foreach($aportes as $a)
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 text-center">
						<a href="{{route('peliculas.show',['id' => $a->id])}}">
							
						<figure class="imghvr-fade">
							<img class="img-aporte" src="images/peliculas/{{$a->imagen}}">
							<figcaption>
							<p>{{$a->titulo}}</p>
							</figcaption>
							{{-- <a href="#">Ir</a> --}}
						</figure>
						</a>
						{{-- <h4><b>{{$a->titulo}}</b></h4> --}}
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{asset('plugins/light-gallery/js/lightgallery-all.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('plugins/light-gallery/js/lg-thumbnail.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('plugins/light-gallery/js/lg-fullscreen.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script >
	$(document).ready(function() {
		$('#aniimated-thumbnials').lightGallery({
			thumbnail:true,
			selector: 'a'
		});
		// var TableGeneros = $('#generos').DataTable({
	//        "paging": true,
	//        "lengthChange": false,
	//        "autoWidth": false,
	//        "searching": true,
	//        "ordering": true,
	//        "info": true,
	//        "iDisplayLength": 25,
	//        "iDisplayStart": 0,
	//        "sPaginationType": "full_numbers",
	//        "aLengthMenu": false,
	//        "processing": true,
	//        "serverSide": true,
	{{-- //        "ajax": "{{ route('datatable.generos') }}", --}}
	//        "columns": [
	//            {data: 'row_number', name: 'row_number', "sWidth": "5%", "sClass": "text-center"},
	//            {data: 'genero', name: 'generos', "sWidth": "90%"},
	//            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"}
	//        ]
	//    });
	})
</script>
@endpush