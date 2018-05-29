@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">public</i>Etiquetas</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Etiquetas
                        <small>Registro de país (Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('etiquetas.create')}}" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar etiqueta">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Etiqueta</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="etiquetas" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Etiquetas</th>
						            @if(Auth::user()->perfil_id === 1)
						            <th class="text-center">Acción</th>
						            @endif
						        </tr>
					        </thead>
					    </table>
					</div><!-- card-content -->
                </div><!-- Body -->
            </div><!-- Card -->
        </div><!-- col 12 -->
    </div><!-- row clearfix 1 -->
</div> <!-- container-fluid -->
@endsection
@push('scripts')

<script >
	$(document).ready(function() {

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;
			var TableEtiquetas = $('#etiquetas').DataTable({
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
		        "ajax": "{{ route('datatable.etiquetas') }}",
		        "columns": [
		            {data: 'etiqueta', name: 'etiqueta', "sWidth": "80%"},
		            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
			        if (perfil === 1) {
				        TableEtiquetas.column( 1 ).visible( true );
			        }
			    }
		    });
		});

	    $('#etiquetas').on('click', 'a.activar_desactivar', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'etiquetas';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['etiqueta'];
	            var estatus = data[0]['status'];
	            datos.showActDesc(nom_registro,id,'estatus_etiqueta',estatus,tabla);
	        });
		});

		$('#etiquetas').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'etiquetas';
	       	$.get(ruta +'/'+ id, function(data){ 
	            var nom_registro = data[0]['etiqueta'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

	})//DOCUMENT
</script>
@endpush
