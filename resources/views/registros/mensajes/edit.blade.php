@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/mensajes"><i class="material-icons">assignment</i>Mensajes</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Actualizar Mensaje
                        <small>Actualizar de Mensaje (Título, fecha, sinopsis, imagen)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_mensajes">
                		
	                    <div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                    		<p>
	                                <b>Estatus</b>
	                            </p>
	                            <div class="form-group">
	                            	@if (@$mensaje->status === 1)
									    <b><span class="font-bold text-danger">Pendiente</span></b>
									@else
									    <b><span class="font-bold text-success">Canalizado</span></b>
									@endif
							    </div>
							</div>
	                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                    		<p>
	                                <b>Motivo</b>
	                            </p>
	                            <div class="form-group">
	                            	@if (@$mensaje->motivo === 1)
									    <span>Reclamo</span>
									@elseif (@$mensaje->motivo === 2)
									    <span>Pregunta</span>
									@elseif (@$mensaje->motivo === 3)
									    <span>Solicitud</span>
									@else
									    <span>Sugerencia</span>
									@endif
							    </div>
							</div>
	                        
	                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<p>
	                                <b>Mensaje</b>
	                            </p>
	                            <span>{{ $mensaje->mensaje }}</span>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Respuesta</b>
	                            </p>	                           
                            	<textarea id="respuesta" name="respuesta" type="text" rows="4" maxlength="350" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ></textarea>
	                        </div>

	                        

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/mensajes"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de mensajes">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
				                    <i class="material-icons">save</i>
				                    <span>Actualizar</span>
				                </button>
				                
                                <input type="text" id="id" name="id" hidden="hidden" value="{{ $mensaje->id }}" >
                                <input type="text" id="mensaje" hidden="hidden" name="mensaje"  value="{{$mensaje->mensaje}}">
		                        <input type="text" id="motivo_id" hidden="hidden" name="motivo_id"  value="{{$mensaje->motivo_id}}">
	                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script >


	$(document).ready(function() {
		
		$("#actulizar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var id = $('#id').val();
	        var form = $("#form_mensajes");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationActualizar(id,ruta,form);
	   
	    }); //Actualizar
	}) //Document 
</script>
@endpush
