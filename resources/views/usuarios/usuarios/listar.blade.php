@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">people</i>Usuarios</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Usuarios
                        <small>Información de cada usuario (Inf. Personal, ubicación, cargo)</small>
                    </h2>
                    
                </div>

                <div class="body">
	                <a href="{{route('usuarios.create')}}" id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar usuario">
	                    <i class="material-icons">save</i>
	                    <span>Registrar usuario</span>
	                </a>
                    <div class="card-content table-responsive">
					    <table id="usuarios" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">#</th>
						            <th class="text-center">Nombre</th>
						            <th class="text-center">Correo</th>
						            <th class="text-center">Perfil</th>
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

		$('#create').click(function () {
			url = '/usuarios/create';
			window.location = url;
	    });

		$('#usuarios').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'usuarios';
	       	$.get(ruta +'/'+ id + '', function(data){
	            var nom_registro = data[0]['name'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		Tableperfiles = $('#usuarios').DataTable({
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
	        "ajax": "{{ route('datatable.usuarios') }}",
	        "columns": [
	            {data: 'row_number', name: 'row_number', "sWidth": "5%", "sClass": "text-center"},
	            {data: 'name', name: 'name', "sWidth": "30%"},
	            {data: 'email', name: 'email', "sWidth": "30%"},
	            {data: 'perfil', name: 'perfil', "sWidth": "30%"},
	            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "5%", "sClass": "text-center"}
	        ],
	        createdRow: function (row, data, index) {
		        $('td', row).addClass('text-center');
		    }
	    });
	})
</script>


@endpush
