@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Temporadas</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Temporadas
                        <small>Registro de Temporada (Título, fecha, sinopsis, imagen)</small>
                    </h2>
                    
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <button id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar Temporada">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Temporadas</span>
	                </button>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="temporadas" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Caratula</th>
						            <th class="text-center">Serie</th>
						            <th class="text-center">Estreno</th>
						            <th class="text-center">Temporadas</th>
						            <th class="text-center">Episodios</th>
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
			url = '/temporadas/create';
			window.location = url;
	    });

		$('#temporadas').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname;
	 		var tabla = 'temporadas';
	       	$.get('/temporadas/' + id + '', function(data){ 
	            var nom_registro = data[0]['titulo'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableTemporadas = $('#temporadas').DataTable({
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
		        "ajax": "{{ route('datatable.temporadas') }}",
		        "columns": [
			            {data: 'imagen', name: 'imagen', "sWidth": "10%", "sClass": "text-center"},
			            {data: 'serie', name: 'serie', "sWidth": "50%", "sClass": "text-center"},
			            {data: 'fecha_estreno', name: 'fecha_estreno', "sWidth": "10%", "sClass": "text-center"},
			            {data: 'titulo', name: 'titulo', "sWidth": "10%", "sClass": "text-center"},
			            {data: 'episodios', name: 'episodios', "sWidth": "10%", "sClass": "text-center"},
			            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td:eq(0)', row).html( "<img  style='width:40px;height: 60px' src='../../images/temporadas/"+data['imagen']+"' alt='' >" );
				        if (perfil === 1) {
					        TableTemporadas.column( 5 ).visible( true );
				        }
				    }
		    });
		});
	})
</script>


@endpush
