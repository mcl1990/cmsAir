@extends('layouts.app')
@section('content')
<style>
	td.on {
	  	color: #32A955;
		font-weight: bold;
	}
	td.off {
		color:rgba(255,0,0,1.00);
	  	font-weight: bold;
	}
</style>
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Series</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Series
                        <small>Registro de Serie (Título, fecha, sinopsis, imagen)</small>
                    </h2>
                    
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <button id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Series</span>
	                </button>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="series" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Caratula</th>
						            <th class="text-center">Series</th>
						            <th class="text-center">Temporadas</th>
						            <th class="text-center">Episodios</th>
						            <th class="text-center">Calificación</th>
						            <th class="text-center">Estado</th>
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

		$('#create').click(function () {
			url = '/series/create';
			window.location = url;
	    });

		$('#series').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname;
	 		var tabla = 'series';
	       	$.get('/series/' + id + '', function(data){ 
	            var nom_registro = data[0]['titulo'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableSeries = $('#series').DataTable({
		        "paging": true,
		        "lengthChange": false,
		        "autoWidth": false,
		        "searching": true,
		        "ordering": true,
		        "info": true,
		        "iDisplayLength": 25,
		        "iDisplayStart": 0,
		        "sPaginationType": "full_numbers",
		        "aLengthMenu": false,
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ route('datatable.series') }}",
		        "columns": [
		        		{data: 'imagen', name: 'imagen', "sWidth": "10%"},
			            {data: 'titulo', name: 'titulo', "sWidth": "40%"},
			            {data: 'temporadas', name: 'temporadas', "sWidth": "10%"},
			            {data: 'episodios', name: 'episodios', "sWidth": "10%"},
			            {data: 'calificacion', name: 'calificacion', "sWidth": "10%"},
			            {data: 'estado', name: 'estado', "sWidth": "10%", "sClass": "on"},
			            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td', row).addClass('text-center');
				        if (data['estado'] === 'Finalizada') {
				            $(row).find('td:eq(5)').addClass('off');
				        }
			      		$('td:eq(0)', row).html( "<img  style='width:40px;height: 60px' src='../../images/series/"+data['imagen']+"' alt='' >" );
				        if (perfil === 1) {
					        TableSeries.column( 6 ).visible( true );
				        }
				    }
		    });
		});
	})
</script>


@endpush
