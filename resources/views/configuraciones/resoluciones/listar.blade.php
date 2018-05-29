@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">tv</i>Resoluciones</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Resoluciones
                        <small>Registro de resolucion (Resolución y calidad)</small>
                    </h2>
                    
                </div>

                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('resoluciones.create')}}" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar resolucion">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Resoluciones</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="resoluciones" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Resoluciones</th>
						            <th class="text-center">Calidad</th>
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

		$('#resoluciones').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'resoluciones';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['resolucion'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableResoluciones = $('#resoluciones').DataTable({
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
		        "ajax": "{{ route('datatable.resoluciones') }}",
		        "columns": [
		            {data: 'resolucion', name: 'resolucion', "sWidth": "70%", "sClass": "text-center"},
		            {data: 'calidad', name: 'calidad', "sWidth": "20%", "sClass": "text-center"},
		            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
			        if (perfil === 1) {
				        TableResoluciones.column( 2 ).visible( true );
			        }
			    }
		    });
		});

	})
</script>


@endpush
