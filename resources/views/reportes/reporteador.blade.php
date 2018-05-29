@extends('layouts.app')
@section('content')

<style>
    td.estatus {
        color:rgba(255,0,0,1.00);
        font-weight: bold;
    }
    td.estatus2 {
        color: #32A955;
        font-weight: bold;
    }
</style>
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-indigo">
        <li><a href="/rep_campos"><i class="material-icons">home</i> Inicio</a></li>
        <li class="active"><i class="material-icons">insert_chart</i>Reportes</li>   
    </ol>
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Reporteador de Archivos y Gráficos</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<h2 class="card-inside-title">Perido a consultar y tipo de Reporte </h2>
                    	</div>
                    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                    		<p>
                                <b>Desde</b>
                            </p>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="desde" type="text"  class="form-control" placeholder="Seleccione desde">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                    		<p>
                                <b>Hasta</b>
                            </p>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="hasta" type="text" class="form-control" placeholder="Seleccione hasta">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<h2 class="card-inside-title">Perido a consultar y tipo de Reporte </h2>
                    	</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
						    <div class="form-group label-floating">
						        <label class="control-label">Alineacion</label>
						        <select class="form-control" autofocus="" id="alineacion"  name="alineacion">
						            <option value=0>Seleccione</option>
						            <option value="1">Izquierda</option>
						            <option value="2">Derecha</option>
						            <option value="3">Centro</option>
						        </select>
						    </div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
						    <div class="form-group label-floating">
						        <label class="control-label">Orientación</label>
						        <select class="form-control" id="orientacion"  name="orientacion">
						            <option value=0>Seleccione</option>
						            <option value="L">Horizontal</option>
						            <option value="P">Vertical</option>
						        </select>
						    </div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
						    <div class="form-group label-floating">
						        <label class="control-label">Tamaño de Hoja</label>
						        <select class="form-control"  id="tamano"  name="tamano">
						            <option value=0>Seleccione</option>
						            <option value="A3">A3</option>
						            <option value="A4">A4</option>
						            <option value="A5">A5</option>
						            <option value="Letter">Letter</option>
						            <option value="Legal">Legal</option>
						        </select>
						    </div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
						    <div class="form-group label-floating">
						        <label class="control-label">Reportes</label>
						        <select class="form-control"  id="list_rep"  name="list_rep">
						            <option value=0>Seleccione</option>
						            @foreach ($list_reportes as $reporte)
	                                	<option value="{{$reporte->codigo}}">{{ $reporte->descripcion }}</option>
	                                @endforeach
						        </select>
						    </div>
						</div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Categoría del reporte</label>
                                <select class="form-control" data-live-search="true" data-size="5" id="categoria"  name="categoria">
                                    <option value=0>Seleccione</option>
                                    
                                </select>
                            </div>
                        </div>
					</div>
					<div class="row clearfix">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" >
                            <select id="rep_campos" class="ms" multiple="multiple" >
				                @foreach ($list_columnas as $columnas)
                                    <option value="{{$columnas->codigo}}" class="campos" disabled="disabled" >{{ $columnas->descripcion }}</option>
                                @endforeach
                            </select>
                            <span style="color: red; font-size: 10px" >*Debe seleccionar todos los campos, para poder seleccionar los campos</span>
                		</div>
						<div class="col-md-4">
						    <div id="d_destino" class="form-group label-floating">
						        <span >Limite de caracteres del reporte:</span>
						        <span id="max_disp" style="color: green" >0</span><br>
						        <span >Caracteres utilizados:</span>
						        <span id="utilizado" style="color: orange" >0</span><br>
						        <span >Caracteres restantes:</span>
						        <span id="disponible" style="color: blue" >0</span>
						    </div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<button  type="button" id="generar_pdf" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Generar PDF">
			                    <i class="material-icons">picture_as_pdf</i>
			                    <span>PDF</span>
			                </button>
			                <button  type="button" id="generar_csv" class="btn bg-orange waves-effect" data-toggle="tooltip" data-placement="top" title="Generar CSV">
			                    <i class="material-icons">picture_as_pdf</i>
			                    <span>CSV</span>
			                </button>
			                <button  type="button" id="generar_txt" class="btn bg-orange waves-effect" data-toggle="tooltip" data-placement="top" title="Generar TXT">
			                    <i class="material-icons">picture_as_pdf</i>
			                    <span>TXT</span>
			                </button>
			                <button  type="button" id="generar_xls" class="btn btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Generar XLS">
			                    <i class="material-icons">picture_as_pdf</i>
			                    <span>XLS</span>
			                </button>
			                <button  type="button" id="generar_pie" class="btn bg-indigo waves-effect" data-toggle="tooltip" data-placement="top" title="Generar gráfico de torta">
			                    <i class="material-icons">pie_chart</i>
			                    <span>Pie</span>
			                </button>
			                <button  type="button" id="generar_barra" class="btn bg-indigo waves-effect" data-toggle="tooltip" data-placement="top" title="Generar gráfico de barras">
			                    <i class="material-icons">insert_chart</i>
			                    <span>Barra</span>
			                </button>
						</div>
					</div>

                    <input id="selec_campos" type="text"  class="form-control" placeholder="">

                </div><!-- #END# Body -->
            </div><!-- #END# Task Card -->
        </div> <!-- #END# Task Info -->
	</div><!-- #END# row clearfix -->
</div><!-- #END# Container -->
@endsection
@push('scripts')

<script >
    $(document).ready(function() {

        $('#tamano,#orientacion').change(function () {
            var tam = $('#tamano').val();
            var ori = $('#orientacion').val();
            var uti = $('#utilizado').text()
            if ((tam != '0' ) && (ori != '0')){
                $('.campos').removeClass("disabled");

                if (uti == ''){//Si Utilizado aun no tiene algun valor
                    uti = 0; 
                }
                $.get('/get_margenes/' + tam +'@@'+ ori + '', function(data){ 
                    maximo = data[0]['long_max_cel'];
                    document.getElementById("max_disp").textContent=maximo;
                    dispo = parseInt(maximo) - parseInt(uti);
                    if(dispo < 0){
                        document.getElementById("disponible").style.color = "red";
                        datos.showLimiteReporte();
                    }else{
                        document.getElementById("disponible").style.color = "blue";
                    }
                    document.getElementById("utilizado").textContent=uti;
                    document.getElementById("disponible").textContent=dispo;
                });

            }else{
                $('.campos').addClass("disabled");
            }
        });

    	$('#hasta').bootstrapMaterialDatePicker({
    		time: false, 
    		format : 'DD-MM-YYYY',
    		lang : 'es',
    		clearButton: true,
    		clearText : 'Limpiar',
    		cancelText : 'Cancelar',
    		// maxDate: "+1d"
    		
    	});
    	$('#desde').bootstrapMaterialDatePicker({
    		time: false, 
    		format : 'DD-MM-YYYY',
    		lang : 'es',
    		clearButton: true,
    		clearText : 'Limpiar',
    		cancelText : 'Cancelar',
    		// maxDate: "+1d"
    	}).on('change', function(e, date){
			$('#hasta').bootstrapMaterialDatePicker('setMinDate', date);
		});

        var tam = $('#tamano').val();
        var ori = $('#orientacion').val();

        var seleccionados = [];
        $('#rep_campos').multiSelect({
            selectableHeader: "<div class='custom-header text-center bg-indigo'>Campos Disponibles</div>",
            selectionHeader: "<div class='custom-header text-center bg-indigo'>Campos Seleccionados</div>",


            afterSelect: function(values){

                var m_disp = $('#max_disp').text(); //Maximo Disponible
                var dispo = $('#disponible').text(); //Espacio Disponible
                var uti = $('#utilizado').text(); //Espacio Disponible
                seleccionados.push(values);
                $('#selec_campos').val(seleccionados);

                $.get('/get_long_camp/' + values + '', function(data){

                    n_uti = parseInt(uti) + parseInt(data);
                    n_disp = parseInt(m_disp) - parseInt(data) - parseInt(uti);
                    if(n_disp < 0){
                        document.getElementById("disponible").style.color = "red";
                        datos.showLimiteReporte();
                    }else{
                        document.getElementById("disponible").style.color = "blue";
                    }
                    document.getElementById("utilizado").textContent=n_uti;
                    document.getElementById("disponible").textContent=n_disp;
                });
		  	},

			afterDeselect: function(values){

			    var m_disp = $('#max_disp').text(); //Maximo Disponible
                var dispo = $('#disponible').text(); //Espacio Disponible
                var uti = $('#utilizado').text(); //Espacio Disponible
                seleccionados.splice(seleccionados.indexOf(values), 1 );
                $('#selec_campos').val(seleccionados);

                $.get('/get_long_camp/' + values + '', function(data){
                    n_uti = parseInt(uti) - parseInt(data);
                    n_disp = parseInt(dispo) + parseInt(data);
                    document.getElementById("utilizado").textContent=n_uti;
                    document.getElementById("disponible").textContent=n_disp;
                });
			}
		});

        $("#generar_pdf").click(function (e) {
            e.preventDefault();

            var disponible = parseInt($('#disponible').text());

            if(disponible >= 0){

                var desde = $('#desde').val();
                var hasta = $('#hasta').val();
                var alineacion = $('#alineacion').val();
                var orientacion = $('#orientacion').val();
                var tamano = $('#tamano').val();
                var list_rep = $('#list_rep').val();
                var categoria = $('#categoria').val();
                var campos = $('#selec_campos').val();
                
                if(desde === ''){
                    datos.showFechaRequerido('desde');
                }else if(hasta === '0'){
                    datos.showFechaRequerido('hasta');
                }else if(alineacion === '0'){
                    datos.showSelectRequerido('alineación');
                }else if(orientacion === '0'){
                    datos.showSelectRequerido('orientación');
                }else if(tamano === '0'){
                    datos.showSelectRequerido('tamaño');
                }else if(list_rep === '0'){
                    datos.showSelectRequerido('reportes');
                }else if(list_rep != '100' && campos === '0'){
                    datos.showSelectRequerido('categoría');
                }else if(categoria === ''){
                    datos.showSelectRequerido('campos');
                }else {
                    datos.showGenerarReporte(alineacion,orientacion,tamano,list_rep,categoria,campos,desde, hasta);
                }
            }else{
                datos.showLimiteReporte();
            }
            

        });

        // $.ajax('/get_act_visit',{
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //     method: 'get',
        //     success: function(data,sta,xhr) {
        //         var cant = [];
        //         var val = [];
        //         var tot = 0.0;
        //         data.forEach(function (e){
        //             tot =  parseFloat(e.total) + tot;
        //             cant.push(e.total);
        //             val.push(e.estatus);
        //         });
        //         var por1 = (cant[0]*100 / tot).toFixed(2);
        //         var por2 = (cant[1]*100 / tot).toFixed(2);

        //         $('#estatus1').text(val[0]+': '+por1+' %');
        //         $('#estatus2').text(val[1]+': '+por2+' %');

        //         if(por1 == 'NaN' && por2 === 'NaN'){
        //             $('#estatus1').text('En Curso: 0.00%');
        //             $('#estatus2').text('Finalizada: 0.00%');
        //         }else if(por1 == 'NaN'){
        //             $('#estatus1').text('En Curso: 0.00%');
        //         }else if(por2 === 'NaN'){
        //             $('#estatus2').text('Finalizada: 0.00%');
        //         }
        //         var colores = ["rgb(233, 30, 99)", "rgb(255, 193, 7)", "rgb(0, 188, 212)", "rgb(139, 195, 74)"];
                
        //         new Chart(document.getElementById("pie_chart").getContext("2d"), getChartJs('pie'));
        //         function getChartJs(type) {
        //             var config = null;
        //             config = {
        //                 type: 'pie',
        //                 data: {
        //                     datasets: [{
        //                         data: cant,
        //                         backgroundColor: colores,
        //                     }],
        //                     labels: val                                    
        //                 },
        //                 options: {
        //                     responsive: true,
        //                     legend: false
        //                 }
        //             }
        //             return config;
        //         }
        //     },
        // });
    })
</script>


@endpush
