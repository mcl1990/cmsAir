@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin/aportes"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Aportes</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Aportes
                        <small>Listado de Nuevos aportes (Películas, Series y Anime)</small>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="card-content table-responsive">
					    <table id="aportes" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						        	<th style="width: 5%;"></th>
						            <th class="text-center">Caratula</th>
						            <th class="text-center">Aporte</th>
						            <th class="text-center">Tamaño</th>
						            <th class="text-center">Servidor</th>
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
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                	Eliminación de aporte (<span id="titulo_modal"></span>)?
                </h5>
            </div>
            <div class="modal-body" id="text_modal">
            	<div class="row clearfix">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		            	<p>
		                    <b>Motivo</b>
		                </p>
		                <div class="form-group">
					        <select class="form-control" id="motivo_id" name="motivo_id">
					            <option value=''>Seleccione</option>
					        	@foreach($list_sanciones as $sanciones)
								<option value="{{$sanciones->id}}">{{$sanciones->sancion}}</option>
								@endforeach
					        </select>
					    </div>
				    </div>
			    </div>
            </div>
            <input  name="tipo" id="tipo" hidden="hidden">
            <input  name="id_r" id="id_r" hidden="hidden">
            <div class="modal-footer">
                <button id="eliminar" type="button" class="btn btn-link waves-effect bg-red" style="color: white">Eliminar</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script id="extra_aportes" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td style="width: 20%;">Enlace:</td>
            <td>@{{enlace}}</td>
        </tr>
        <tr>
            <td>Etiquetas:</td>
            <td>@{{etiquetas}}</td>
        </tr>
    </table>
</script>
<script >
	$(document).ready(function() {

		$('#aportes').on('click', 'a.delet_p', function (e) {
	        e.preventDefault();

	 		var id = this.getAttribute('id');
	       	$.get('/admin/aportes_pelis/'+ id, function(data){ 
		        $("#titulo_modal").text(data[0]['titulo']); //Monta el titulo en la modal
		        $("#tipo").val('pelis'); //Atributo invisible para identificar el tipo de aporte (pelicula)
		        $("#id_r").val(id); // Id del aporte

		        $("#defaultModal").modal("show");
	        });
		});

		$('#aportes').on('click', 'a.delet_s', function (e) {
	        e.preventDefault();

	 		var id = this.getAttribute('id');
	       	$.get('/admin/aportes_series/'+ id, function(data){ 
		        $("#titulo_modal").text(data[0]['titulo']); //Monta el titulo en la modal
		        $("#tipo").val('series'); //Atributo invisible para identificar el tipo de aporte (serie/anime)
		        $("#id_r").val(id); // Id del aporte

		        $("#defaultModal").modal("show");
	        });
		});
		
		$('#eliminar').on('click', function (e) {
	        e.preventDefault();
	        if($("#motivo_id").val() === ''){ //valida seleccion del motivo de borradodel aporte
	        	swal({
					title: "Debe seleccionar el motivo!",
	                type: "error",
				});
	        }else{
	            var nom_registro = $("#titulo_modal").text();
	            var id = $("#id_r").val(); //id del aporte
	            var tipo = $("#tipo").val(); // tipo (Pelicula o series)
	            var cate = $("#motivo_id").val(); //motivo

	            $.ajax('/admin/aportes_'+tipo+'/'+cate+'/'+id,{
			   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function(data,sta,xhr) {
						swal({
							title: "¡Hecho!",
			                text: "El registro fue Eliminado satisfactoriamente.",
			                type: "success",
						}),
                        $("#aportes").DataTable().ajax.reload();
                        $("#defaultModal").modal("toggle");
					},
					error: function(xhr,sta,error) {
						swal("¡Error!",
								error,
								"error");
					},
				    method: 'delete',
				});
	        }

		});

		$.get('/consultas/get_perfil/', function(data){ 
			
		    var perfil = data;
		    var template = Handlebars.compile($("#extra_aportes").html());
			var TablaAportes = $('#aportes').DataTable({
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
		        "ajax": "{{ route('datatable.admin.aportes') }}",
		        "columns": [
				        {
			                "className":      'details-control',
			                "orderable":      false,
			                "searchable":     false,
			                "data":           null,
			                "defaultContent": ''
			            },
			            {data: 'imagen', name: 'imagen', "sWidth": "5%", "sClass": "text-center"},
			            {data: 'titulo', name: 'titulo', "sWidth": "60%", "sClass": "text-center"},
			            {data: 'peso', name: 'peso', "sWidth": "15%", "sClass": "text-center"},
			            {data: 'servidor', name: 'servidor', "sWidth": "5%", "sClass": "text-center"},
			            {data: 'action', name: 'action', visible: false, orderable: false, searchable: false, "sWidth": "10%", "sClass": "text-center"}
			        ],
			      	createdRow: function (row, data, index) {
			      		$('td:eq(1)', row).html( "<img  style='width:35px;height: 60px' src='../../images/peliculas/"+data['imagen']+"' alt='' >" );
			      		$('td:eq(4)', row).html( "<img  style='width:20px;height: 20px' src='../../images/iconos/"+data['servidor']+"' alt='' >" );
				        if (perfil === 1) {
					        TablaAportes.column( 5 ).visible( true );
				        }
				    }
		    });

		    // Add event listener for opening and closing details
		    $('#aportes tbody').on('click', 'td.details-control', function () {
		        var tr = $(this).closest('tr');
		        var row = TablaAportes.row( tr );

		        if ( row.child.isShown() ) {
		            // This row is already open - close it
		            row.child.hide();
		            tr.removeClass('shown');
		        }
		        else {
		            // Open this row
		            row.child( template(row.data()) ).show();
		            tr.addClass('shown');
		        }
		    });
		});
	})
</script>


@endpush
