@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">assignment</i>Mensajes</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Enviar Mensaje a nuestro staff
                        <small>Registro de Mensaje (Motivo, Mensaje)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_mensajes">
	                    <div class="row clearfix">
	                    	
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                    		<p>
	                                <b>Motivo</b>
	                            </p>
	                            <div class="form-group">
							        <select class="form-control" id="motivo_id" name="motivo_id">
							            <option value=''>Seleccione</option>
							        	@foreach($list_motivos as $motivos)
										<option value="{{$motivos->id}}">{{$motivos->motivo}}</option>
										@endforeach
							        </select>
							    </div>
							</div>
	                        
	                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<p>
	                                <b>Mensaje</b>
	                            </p>	                           
                            	<textarea id="mensaje" name="mensaje" type="text" rows="4" maxlength="350" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ></textarea>
	                        </div>

	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                        	<br>
				                <button id="registrar" type="button" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar Mensaje">
				                    <i class="material-icons">save</i>
				                    <span>Registrar Mensajes</span>
				                </button>
				            </div>
                        </div><!-- row clearfix 2 -->
                    </form><!-- Form -->



	                
                    <div class="card-content table-responsive">
					    <table id="mensajes" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						        	<th style="width: 5%;"></th>
						            <th class="text-center">Motivo</th>
						            <th class="text-center">Status</th>
						            <th class="text-center">Fecha Emisión</th>
						            <th class="text-center">Fecha Respuesta</th>
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
<script id="extra_mensajes" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td style="width: 15%;">Mensaje:</td>
            <td>@{{mensaje}}</td>
        </tr>
        <tr>
            <td>Respuesta:</td>
            <td>@{{respuesta}}</td>
        </tr>
    </table>
</script>
<script >
	$(document).ready(function() {

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defect

		    var form = $("#form_mensajes");

		    swal({
	            title: "Enviar Mensaje",
	            text: "¿Ya culminó de escribir su mensaje?",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: "#DD6B55",
	            confirmButtonText: "¡Si!",
	            cancelButtonText: "No, aún no",
	            closeOnConfirm: false,
	            closeOnCancel: false,
	            showLoaderOnConfirm: true 
	        }, // swal

	        function(isConfirm){
	            if (isConfirm) {
			        $.ajax('/contactenos/',{
				    	data: form.serialize(),
				   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},success:function(datos){
					   			if (typeof datos == 'object'){ //Errores en el formulario
	                                    swal.close();
	                                        for (i=0;i<datos.length;i++) {
	                                            $.notify({
	                                                icon: "glyphicon glyphicon-warning-sign",
	                                                message: "Disculpe,\n "+datos[i],
	                                            }, {
	                                                element: 'body',
	                                                position: null,
	                                                type: "danger",
	                                                allow_dismiss: true,
	                                                newest_on_top: false,
	                                                showProgressbar: false,
	                                                placement: {
	                                                    from: "top",
	                                                    align: "right"
	                                                }
	                                            });

	                                        }
	                                }else{ //Registro satisfactorio
	                                    swal({
				                            title: "¡Hecho!",
				                            text: "Mensaje enviado satisfactoriamente.",
				                            type: "success",
				                        },
					                    function(){
							              	window.location = '/contactenos';
							            })

	                                }
		                        
		                    },
		                    error: function(xhr,sta,error) {
		                        swal("¡Error!",
		                                error,
		                                "error");
						    },
					    method: 'post',
					});
				} else {
		            swal("¡Cancelado!",
		            "Envio Cancelado",
		            "error");
		        }
        	}); // isConfirm
	   	}); //Registrar

		var template = Handlebars.compile($("#extra_mensajes").html());

		var TableMensajes = $('#mensajes').DataTable({
	        "searching": false,
	        "processing": true,
	        "iDisplayLength": 10,
	        "lengthChange": false,
	        "ajax": "{{ route('datatable.mis_mensajes') }}",
	        "columns": [
		        {
	                "className":      'details-control',
	                "orderable":      false,
	                "searchable":     false,
	                "data":           null,
	                "defaultContent": ''
	            },
	            {data: 'motivo', name: 'motivo', "sWidth": "20%", "sClass": "text-center"},
	            {data: 'status', name: 'status', "sWidth": "20%", "sClass": "text-center"},
	            {data: 'created_at', name: 'created_at', "sWidth": "20%", "sClass": "text-center"},
	            {data: 'updated_at', name: 'updated_at', "sWidth": "20%", "sClass": "text-center"},
	        ],
	    });

	     // Add event listener for opening and closing details
	    $('#mensajes tbody').on('click', 'td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = TableMensajes.row( tr );

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

	})
</script>


@endpush
