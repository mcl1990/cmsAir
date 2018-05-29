@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Notificaciones</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Notificaciones
                        <small>Registro de Tipo de Notificacion (Tipo, descripción, icono, estructura)</small>
                    </h2>
                    
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <button id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar Tipo de Notificacion">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Notificaciones</span>
	                </button>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="notificaciones" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center"></th>
						            <th class="text-center">Notificaciones</th>
						            <th class="text-center">Fecha</th>
						            <th class="text-center">Acción</th>
						        </tr>
					        </thead>
					        
					    </table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo_modal"></h4>
            </div>
            <div class="modal-body" id="text_modal">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

		$('#create').click(function () {
			url = '/notificaciones/create';
			window.location = url;
	    });

		$('#notificaciones').on('click', 'a.show', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	       	$.get('/notificaciones/' + id + '', function(data){ 

	        $("#titulo_modal").text(data[0]['tipo']);
	        $("#text_modal").text(data[0]['mensaje']);
	        $("#defaultModal").modal("show");
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableTiposdeNotificaciones = $('#notificaciones').DataTable({
		        "paging": true,
		        "lengthChange": false,
		        "autoWidth": false,
		        "searching": true,
		        "ordering": false,
		        "info": true,
		        "iDisplayLength": 25,
		        "iDisplayStart": 0,
		        "sPaginationType": "full_numbers",
		        "aLengthMenu": false,
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ route('datatable.notificaciones') }}",
		        "columns": [
			            {data: 'icono', name: 'icono', "sWidth": "5%", orderable: false,},
			            {data: 'tipo', name: 'tipo', "sWidth": "70%"},
			            {data: 'created_at', name: 'created_at', "sWidth": "15%"},
			            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td', row).addClass('text-center');
			      		$('td:eq(0)', row).html( "<div class='bg-"+data['style']+"'><i class='material-icons'>"+data['icono']+"</i></div>" );
				    }
		    });
		});
	})
</script>


@endpush
