@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Tipos de Notificaciones</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Tipos de Notificaciones
                        <small>Registro de Tipo de Notificacion (Tipo, descripción, icono, estructura)</small>
                    </h2>
                    
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('tipos_notificaciones.create')}}" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar Tipo de Notificacion">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Tipos de Notificaciones</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="tipos_notificaciones" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Icono</th>
						            <th class="text-center">Estilo Css</th>
						            <th class="text-center">Nombre</th>
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

		$('#tipos_notificaciones').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'tipos_notificaciones';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['tipo_notificacion'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableTiposdeNotificaciones = $('#tipos_notificaciones').DataTable({
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
		        "ajax": "{{ route('datatable.tipos_notificaciones') }}",
		        "columns": [
			            {data: 'icono', name: 'icono', "sWidth": "10%"},
			            {data: 'style', name: 'style', "sWidth": "25%"},
			            {data: 'tipo_notificacion', name: 'tipo_notificacion', "sWidth": "50%"},
			            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td', row).addClass('text-center');
			      		
			      		$('td:eq(0)', row).html( "<div class='bg-"+data['style']+"'><i class='material-icons'>"+data['icono']+"</i></div>" );
				        if (perfil === 1) {
					        TableTiposdeNotificaciones.column( 3 ).visible( true );
				        }
				    }
		    });
		});
	})
</script>


@endpush
