@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Bitácora</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Bitácora de acciones en la plataforma
                        <small>Descripción del módulo afectado, acción realizada, id del registro, usuario que realizó la acción y fecha</small>
                    </h2>
                    
                </div>

                <div class="body">
                    <div class="card-content table-responsive">
					    <table id="bitacora" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Modulo</th>
						            <th class="text-center">Acción</th>
						            <th class="text-center">ID Registro</th>
						            <th class="text-center">Usuario</th>
						            <th class="text-center">Fecha</th>
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
			url = '/bitacora/create';
			window.location = url;
	    });

		$('#bitacora').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname;

	       	// $.get('/bitacora/' + id + '', function(data){ 
	        //     var nom_registro = data[0]['audio'];
	        //     datos.showConfirmDelete(nom_registro,id,ruta);
	        // });
		});

		
		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableBitacora = $('#bitacora').DataTable({
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
		        "ajax": "{{ route('datatable.bitacora_admin') }}",
		        "columns": [
		            {data: 'modulo', name: 'modulo', "sWidth": "20%", "sClass": "text-center"},
		            {data: 'accion', name: 'accion', "sWidth": "15%", "sClass": "text-center"},
		            {data: 'registro_id', name: 'registro_id', "sWidth": "10%", "sClass": "text-center"},
		            {data: 'name', name: 'name', "sWidth": "20%", "sClass": "text-center"},
		            {data: 'created_at', name: 'created_at', "sWidth": "20%", "sClass": "text-center"},
		        ],
		    }); 
	    });
	})
</script>


@endpush
