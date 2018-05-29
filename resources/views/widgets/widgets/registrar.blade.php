@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/widgets"><i class="material-icons">assignment</i>Widgets</a></li>
        <li class="active"><i class="material-icons">create</i>Registrar</li>
    </ol>
    <div class="row clearfix">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card">
                <div class="header">
                	<div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Registrar Widget
		                        <small>Registro de Widget (Título, descripción, tipo)</small>
		                    </h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <label>Inactivo<input type="checkbox" id="activo" checked><span class="lever switch-col-teal"></span>Activo</label>
                            </div>
                        </div>
                    </div>
                    <h2>
                        
                    </h2>
                </div>
                <div class="body">
                	<form id="form_widgets">

	                    <div class="row clearfix">
	                    	
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                    		<p>
	                                <b>Ubicación</b>
	                            </p>
	                            <div class="form-group">
							        <select class="form-control" autofocus="" id="ubicacion"  name="ubicacion">
							            <option value=0>Seleccione</option>
							            <option value="1">Widget Vertical 1</option>
							            <option value="2">Widget Vertical 2</option>
							            <option value="3">Widget Vertical 3</option>
							            <option value="4">Widget Horizontal 1</option>
							            <option value="5">Widget Horizontal 2</option>
							            <option value="6">Widget Horizontal 3</option>
							        </select>
							    </div>
							</div>

	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Título</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="titulo"  name="titulo" oninput="clickInput(event)" class="form-control" maxlength="25" placeholder="Nombre de Widget">
	                                </div>
	                            </div>
	                        </div>
	                        
	                        
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Tipo</b>
	                            </p>
	                            <div class="form-group">
	                            	<select class="show-tick" data-width="100%" id="tipo_widget"  name="tipo_widget">
                                        <option value=0>--Seleccione--</option>
                                        @foreach ($list_tipos as $tipos)
                                        	<option value="{{$tipos->id}}">{{ $tipos->titulo }}</option>
                                        @endforeach
                                    </select>
							    </div>
	                        </div>	                        

	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                            <p>
	                                <b>Color</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <select class="show-tick" data-width="100%" id="color"  name="color">
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

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                            <p>
	                                <b>Descripción</b>
	                            </p>
	                            <div class="form-group">
	                                <div class="form-line">
	                                    <input type="text" id="descripcion"  name="descripcion" class="form-control" maxlength="150" oninput="clickInput2(event)" placeholder="Ej: Breve reseña del Widget">
	                                </div>
	                            </div>
	                        </div>

	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        	<a href="/widgets"><button  type="button" class="btn bg-grey waves-effect" data-toggle="tooltip" data-placement="top" title="Volver a la lista de widgets">
				                    <i class="material-icons">navigate_before</i>
				                    <span>Regresar</span>
				                </button></a>
	                        	<button  type="button" id="registrar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Registrar titulo">
				                    <i class="material-icons">save</i>
				                    <span>Guardar</span>
				                </button>
                            </div>
                        </div><!-- row clearfix 2 -->
                    </form><!-- Form -->
                </div><!-- Body -->
            </div><!-- Card -->

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
	    		<p>
	                <b>Witget Horizonal 1</b>
	            </p>
	    		<div id="cabecera_4" class="info-box hover-expand-effect bg-black">
                        <div class="icon">
                            <i class="material-icons" id="icon_4"></i>
                        </div>
                        <div class="content">
                            <div class="text" id="new_titulo_4"></div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20" id="texto_4"></div>
                        </div>
                    </div>
	    	</div>

	    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
	    		<p>
	                <b>Witget Horizonal 2</b>
	            </p>
	    		<div id="cabecera_5" class="info-box hover-expand-effect bg-black">
                        <div class="icon">
                            <i class="material-icons" id="icon_5"></i>
                        </div>
                        <div class="content">
                            <div class="text" id="new_titulo_5"></div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20" id="texto_5"></div>
                        </div>
                    </div>
	    	</div>

	    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
	    		<p>
	                <b>Witget Horizonal 3</b>
	            </p>
	    		<div id="cabecera_6" class="info-box hover-expand-effect bg-black">
                    <div class="icon">
                        <i class="material-icons" id="icon_6"></i>
                    </div>
                    <div class="content">
                        <div class="text" id="new_titulo_6"></div>
                        <div class="number" id="texto_6"></div>
                    </div>
                </div>
	    	</div>

        </div><!-- col 12 -->
    	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    		<p>
                <b>Witget Vertical 1</b>
            </p>
    		<div class="card">
                <div id="cabecera_1" class="header bg-black">
                    <ul class="header-dropdown m-r-0">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" id="icon_1"></i>
                            </a>
                        </li>
                    </ul>
                    <h2 id="new_titulo_1"><small id="descrip"></small>
                    </h2>
                </div>
    			<div class="body" id="texto_1"></div>
    		</div>
    	</div>

    	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    		<p>
                <b>Witget Vertical 2</b>
            </p>
    		<div class="card">
                <div id="cabecera_2" class="header bg-black">
                    <ul class="header-dropdown m-r-0">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" id="icon_2"></i>
                            </a>
                        </li>
                    </ul>
                    <h2 id="new_titulo_2"><small id="descrip"></small>
                    </h2>
                </div>
    			<div class="body" id="texto_2"></div>
    		</div>
    	</div>

    	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    		<p>
                <b>Witget Vertical 3</b>
            </p>
    		<div class="card">
                <div id="cabecera_3" class="header bg-black">
                    <ul class="header-dropdown m-r-0">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" id="icon_3"></i>
                            </a>
                        </li>
                    </ul>
                    <h2 id="new_titulo_3"><small id="descrip"></small>
                    </h2>
                </div>
    			<div class="body" id="texto_3"></div>
    		</div>
    	</div>





    </div><!-- row clearfix 1-->
</div> <!-- container-fluid -->
@endsection
@push('scripts')
<script >

	function clickInput(e) {
		var titulo = $('#titulo').val();
		var u = $('#ubicacion').val();
		$('#new_titulo_'+u).text(titulo);  
	}

	function clickInput2(e) {
		var descripcion = $('#descripcion').val();
		var u = $('#ubicacion').val();
		$('#texto_'+u).text(descripcion);
	}


	$(document).ready(function() {

		$('#color').change(function () {
			var color = $('#color').val();
			var u = $('#ubicacion').val();
			if(u <= 3){
				i=1;
			}else{
				i=2;
			}
			var cabecera = $('#cabecera_'+u).attr("class");

			cab = cabecera.split(" ");
			$('#cabecera_'+u).removeClass(cab[i]);  
			$('#cabecera_'+u).addClass(' bg-'+color);  

		});

		$('#ubicacion').change(function () {

			$('#cabecera_1,#cabecera_2,#cabecera_3,#cabecera_4,#cabecera_5,#cabecera_6').className = '';
			$('#texto_1,#texto_2,#texto_3,#texto_4,#texto_5,#texto_6').text('');
			$('#new_titulo_1,#new_titulo_2,#new_titulo_3,#new_titulo_4,#new_titulo_5,#new_titulo_6').text('');
			$('#cabecera_4,#cabecera_5,#cabecera_6').addClass('info-box hover-expand-effect bg-black');  
			$('#cabecera_1,#cabecera_2,#cabecera_3').addClass('header bg-black');  

		});

		$('#tipo_widget').change(function () {
			var u = $('#ubicacion').val();
	        var tipo_widget = $('#tipo_widget').val(); //ID 
	        // $('#contenido_id').find('option:gt(0)').remove(); //Se vacian los select restantes
	        	
	 		$.get('/consultas/get_estructura/' + tipo_widget + '', function(data){ 
	 			$('#texto_'+u).append(data);
		    });
	    });

		$("#registrar").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var form = $("#form_widgets");
	        var ruta = window.location.pathname.split("/")[1];
	        datos.showNotificationRegistro(ruta,form);
	    }); //Actualizar

	}) //Document 
</script>
@endpush
