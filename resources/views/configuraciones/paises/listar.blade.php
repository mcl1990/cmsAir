@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">public</i>Paises</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Paises
                        <small>Registro de país (Nombre)</small>
                    </h2>
                </div>
                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('paises.create')}}" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar pais">
	                    <i class="material-icons">save</i>
	                    <span>Registrar País</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="paises" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Paises</th>
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
			var TablePaises = $('#paises').DataTable({
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
		        "ajax": "{{ route('datatable.paises') }}",
		        "columns": [
		            {data: 'pais', name: 'pais', "sWidth": "80%"},
		            {data: 'action', name: 'action', orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
			        if (perfil === 1) {
				        TablePaises.column( 1 ).visible( true );
			        }
			    }
		    });
		});


	    $('#paises').on('click', 'a.activar_desactivar', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'paises';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['pais'];
	            var status = data[0]['status'];
	            datos.showActDesc(nom_registro,id,ruta,status,tabla);
	        });
		});

		$('#paises').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'paises';
	       	$.get(ruta +'/'+ id, function(data){ 
	            var nom_registro = data[0]['pais'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

	})//DOCUMENT
</script>
@endpush
