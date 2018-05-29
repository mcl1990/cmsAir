@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Generos</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Generos
                        <small>Registro de genero (Descripción)</small>
                    </h2>
                    
                </div>

                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('generos.create')}}" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar genero">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Generos</span>
	                </a>
	                <button id="descargar" type="button" class="btn bg-brown waves-effect" data-toggle="tooltip" data-placement="top" title="Descargar genero">
	                    <i class="material-icons">save</i>
	                    <span>Descargar Generos</span>
	                </button>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="generos" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						        	<th class="text-center">#</th>
						        	<th class="text-center">Código</th>
						            <th class="text-center">Generos</th>
						            @if(Auth::user()->perfil_id === 1)
						            <th class="text-center">Acción</th>
						            @endif
						        </tr>
					        </thead>
					        
					    </table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

	    $('#descargar').click(function () {

	    	var hosting = "api.themoviedb.org/3/genre/tv/list?api_key=48f5c3a8e871801d8ad36d4360ef1f84&language=es-ES";
	    	$.get("http://"+hosting, function(data) {
	    		$.ajax('/admin/descargar_generos/',{
			    	data:{val: data},
			   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},success:function(response){
			   			$("#generos").DataTable().ajax.reload();
				    },
				    method: 'post',
				});
			});
			var hosting = "api.themoviedb.org/3/genre/movie/list?api_key=48f5c3a8e871801d8ad36d4360ef1f84&language=es-ES";
	    	$.get("http://"+hosting, function(data) {
	    		$.ajax('/admin/descargar_generos/',{
			    	data:{val: data},
			   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},success:function(response){
			   			$("#generos").DataTable().ajax.reload();
				    },
				    method: 'post',
				});
			});
	    });

		$('#generos').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	        var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'generos';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['genero'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableGeneros = $('#generos').DataTable({
		        "searching": true,
		        "processing": true,
		        "iDisplayLength": 10,
		        "lengthChange": false,
		        "serverSide": true,
		        "ajax": "{{ route('datatable.generos') }}",
		        "columns": [
		        	{data: 'id', name: 'id', "sWidth": "10%"},
		        	{data: 'codigo', name: 'codigo', "sWidth": "20%"},
		            {data: 'genero', name: 'genero', "sWidth": "60%"},
		            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
		      		$('td', row).addClass('text-center');
			        if (perfil === 1) {
				        TableGeneros.column( 3 ).visible( true );
			        }
			    }
		    });
		});
	})
</script>


@endpush
