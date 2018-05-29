@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Categorías</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Categorías
                        <small>Registro de categoria (Descripción)</small>
                    </h2>
                    
                </div>

                <div class="body">
                	@if(Auth::user()->perfil_id === 1)
	                <a href="{{route('categorias.create')}}" id="create" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar categoria">
	                    <i class="material-icons">save</i>
	                    <span>Registrar Categorías</span>
	                </a>
	                @endif
                    <div class="card-content table-responsive">
					    <table id="categorias" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th class="text-center">Ícono</th>
						            <th class="text-center">Categorías</th>
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

		$('#categorias').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	        var id = this.getAttribute('id');
	 		var ruta = window.location.pathname.split("/")[2];
	 		var tabla = 'categorias';
	       	$.get(ruta +'/'+ id, function(data){
	            var nom_registro = data[0]['categoria'];
	            datos.showConfirmDelete(nom_registro,id,ruta, tabla);
	        });
		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;

			var TableCategorias = $('#categorias').DataTable({
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
		        "ajax": "{{ route('datatable.categorias') }}",
		        "columns": [
		            {data: 'icono', name: 'icono', "sWidth": "10%", "sClass": "text-center"},
		            {data: 'categoria', name: 'categoria', "sWidth": "80%"},
		            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
		        ],
		      	createdRow: function (row, data, index) {
		      		$('td:eq(0)', row).html( "<i class='material-icons'>"+data['icono']+"</i>" );
			        if (perfil === 1) {
				        TableCategorias.column( 2 ).visible( true );
			        }
			    }
		    });
		});
	})
</script>


@endpush
