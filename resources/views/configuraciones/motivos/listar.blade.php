@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">motivotrack</i>Motivos</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Motivos
                        <small>Registro de motivo (Descripción)</small>
                    </h2>
                    
                </div>

                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('motivos.create')}}" id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar motivo">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Motivos</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="motivos" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Motivos</th>
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

		$('#motivos').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'motivos';
	       	$.get(ruta +'/'+ id, function(data){ 
	            var nom_registro = data[0]['motivo'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		
		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableMotivos = $('#motivos').DataTable({
		        "searching": true,
		        "processing": true,
		        "iDisplayLength": 10,
		        "lengthChange": false,
		        "serverSide": true,
		        "ajax": "{{ route('datatable.motivos') }}",
		        "columns": [
		            {data: 'motivo', name: 'motivo', "sWidth": "80%"},
		            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
			        if (perfil === 1) {
				        TableMotivos.column( 1 ).visible( true );
			        }
			    }

		    }); 
	    });
	})
</script>


@endpush
