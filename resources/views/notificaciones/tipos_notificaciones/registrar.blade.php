@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/admin/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/admin/tipos_notificaciones"><i class="material-icons">assignment</i>Tipos de Notificaciones</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Registrar Tipo de Notificacion
                        <small>Registro de Tipo de Notificacion (Tipo, descripción, icono, estructura)</small>
                    </h2>
                </div>
                <div class="body">
                	<form id="form_tipos_notificaciones">

	                    <div class="row clearfix">
	                    	
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Tipo</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="tipo_notificacion"  name="tipo_notificacion" class="form-control" maxlength="25" placeholder="Nombre de Notificacion">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Estilo css</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="style"  name="style">
	                                        <option value=0>--Seleccione--</option>
	                                        <option value="red" style="background: #F44336; color: #fff;">Red</option>
											<option value="pink" style="background: #E91E63; color: #fff;"><span>Pink</span></option>
											<option value="purple" style="background: #9C27B0; color: #fff;"><span>Purple</span></option>
											<option value="deep-purple" style="background: #673AB7; color: #fff;"><span>Deep Purple</span></option>
											<option value="indigo" style="background: #3F51B5; color: #fff;"><span>Indigo</span></option>
											<option value="blue" style="background: #2196F3; color: #fff;"><span>Blue</span></option>
											<option value="light-blue" style="background: #03A9F4; color: #fff;"><span>Light Blue</span></option>
											<option value="cyan" style="background: #00BCD4; color: #fff;"><span>Cyan</span></option>
											<option value="teal" style="background: #009688; color: #fff;"><span>Teal</span></option>
											<option value="green" style="background: #4CAF50; color: #fff;"><span>Green</span></option>
											<option value="light-green" style="background: #8BC34A; color: #fff;"><span>Light Green</span></option>
											<option value="lime" style="background: #CDDC39; color: #fff;"><span>Lime</span></option>
											<option value="yellow" style="background: #FFEB3B; color: #fff;"><span>Yellow</span></option>
											<option value="amber" style="background: #FFC107; color: #fff;"><span>Amber</span></option>
											<option value="orange" style="background: #FF9800; color: #fff;"><span>Orange</span></option>
											<option value="deep-orange" style="background: #FF5722; color: #fff;"><span>Deep Orange</span></option>
											<option value="brown" style="background: #795548; color: #fff;"><span>Brown</span></option>
											<option value="grey" style="background: #9E9E9E; color: #fff;"><span>Grey</span></option>
											<option value="blue-grey" style="background: #607D8B; color: #fff;"><span>Blue Grey</span></option>
											<option value="black" style="background: #000000; color: #fff;"><span>Black</span></option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
	                            <p>
	                                <b>icono</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="icono"  name="icono" class="form-control" maxlength="25" placeholder="Ej: save">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p>
	                                <b>Mensaje</b>
	                            </p>	                           
                            	<textarea id="mensaje" name="mensaje" type="text" rows="4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></textarea>
	                        </div>
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/admin/tipos_notificaciones" type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de tipos_notificaciones">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar tipo_notificacion">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
                            </div>
                        </div><!-- row clearfix 2 -->
                    </form><!-- Form -->
                </div><!-- Body -->
            </div><!-- Card -->
        </div><!-- col 12 -->
    </div><!-- row clearfix 1-->
</div> <!-- container-fluid -->
@endsection
@push('scripts')
<script >
	$(document).ready(function() {

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_tipos_notificaciones");
	        var ruta = window.location.pathname.split("/")[2];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar

	}) //Document 
</script>
@endpush
