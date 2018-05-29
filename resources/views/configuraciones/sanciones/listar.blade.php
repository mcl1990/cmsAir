@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Sanciones</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Sanciones
                        <small>Registro de sanción (Descripción)</small>
                    </h2>
                    
                </div>

                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('sanciones.create')}}" id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar sancion">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Sanciones</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="sanciones" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Sanciones</th>
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

		$('#sanciones').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'sanciones';
	       	$.get(ruta +'/'+ id, function(data){ 
	            var nom_registro = data[0]['sancion'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		
		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableSanciones = $('#sanciones').DataTable({
		        "searching": true,
		        "processing": true,
		        "iDisplayLength": 10,
		        "lengthChange": false,
		        "serverSide": true,
		        "ajax": "{{ route('datatable.sanciones') }}",
		        "columns": [
		            {data: 'sancion', name: 'sancion', "sWidth": "80%"},
		            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
			        if (perfil === 1) {
				        TableSanciones.column( 1 ).visible( true );
			        }
			    }

		    }); 
	    });
	})
</script>


@endpush
