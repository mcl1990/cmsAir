@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Perfiles</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Perfiles 2
                        <small>Registro de perfil (Descripción)</small>
                    </h2>
                    
                </div>

                <div class="body">
	                <a href="{{route('perfiles.create')}}" id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar perfil">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Perfiles</span>
	                </a>
                    <div class="card-content table-responsive">
					    <table id="perfiles" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Id</th>
						            <th class="text-center">Perfiles</th>
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
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

		$('#perfiles').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'perfiles';
	       	$.get(ruta +'/'+ id + '', function(data){ 
	            var nom_registro = data[0]['perfil'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});


		var TablePerfiles = $('#perfiles').DataTable({
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
	        "ajax": "{{ route('datatable.perfiles') }}",
	        "columns": [
	            {data: 'id', name: 'id', "sWidth": "5%", "sClass": "text-center"},
	            {data: 'perfil', name: 'perfiles', "sWidth": "90%"},
	            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"}
	        ]
	    });
	})
</script>


@endpush
