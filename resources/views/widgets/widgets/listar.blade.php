@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Widgets</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Widgets
                        <small>Registro de Widget (Título, descripción, tipo)</small>
                    </h2>
                    
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <button id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar Widget">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Widgets</span>
	                </button>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="widgets" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Nombre</th>
						            <th class="text-center">Descripcion</th>
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
			url = '/widgets/create';
			window.location = url;
	    });

		$('#widgets').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname;
	 		var tabla = 'widgets';
	       	$.get('/widgets/' + id + '', function(data){ 
	            var nom_registro = data[0]['titulo'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableWidgets = $('#widgets').DataTable({
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
		        "ajax": "{{ route('datatable.widgets') }}",
		        "columns": [
			            {data: 'titulo', name: 'titulo', "sWidth": "25%"},
			            {data: 'descripcion', name: 'descripcion', "sWidth": "50%"},
			            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td', row).addClass('text-center');
			      		$('td:eq(0)', row).html( "<i class='material-icons'>"+data['icono']+"</i>" );
				        if (perfil === 1) {
					        TableWidgets.column( 2 ).visible( true );
				        }
				    }
		    });
		});
	})
</script>


@endpush
