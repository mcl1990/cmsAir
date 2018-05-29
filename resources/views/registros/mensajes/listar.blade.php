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
                        Responder Mensajes
                        <small>Respuesta a las dudas y solicitudes de los editores</small>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="card-content table-responsive">
					    <table id="mensajes" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
					        <thead>
						        <tr class="bg-black">
						            <th style="width: 5%;"></th>
						            <th class="text-center">Motivo</th>
						            <th class="text-center">Status</th>
						            <th class="text-center">Fecha Emisión</th>
						            <th class="text-center">Fecha Respuesta</th>
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

		$('#mensajes').on('click', 'a.delet', function (e) {
	        e.preventDefault();
	 		var id = this.getAttribute('id');
	 		var ruta = window.location.pathname;
	 		var tabla = 'mensajes';
	        var nom_registro = 'Mensaje';
	        datos.showConfirmDelete(nom_registro,id,ruta, tabla);
		});

		var template = Handlebars.compile($("#extra_mensajes").html());

		var TableMensajes = $('#mensajes').DataTable({
	        "searching": false,
	        "processing": true,
	        "iDisplayLength": 10,
	        "lengthChange": false,
	        "ajax": "{{ route('datatable.mensajes') }}",
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
	            {data: 'action', name: 'action', "sWidth": "10%", "sClass": "text-center"},
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
