<!-- Jquery Core Js -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Core Js -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Slimscroll Plugin Js -->
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- Waves Effect Plugin Js -->
<script src="{{ asset('plugins/node-waves/waves.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script> --}}
<!-- Custom Js -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
<!-- Demo Js -->
{{-- <script src="{{ asset('js/demo.js') }}"></script> --}}
<!-- Validation Plugin Js -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>
<!-- Bootstrap Notify Plugin Js -->
<script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
<!-- SweetAlert Plugin Js -->
<!-- Autosize Plugin Js -->
<script src="{{asset('plugins/autosize/autosize.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{asset('plugins/momentjs/moment.js') }}"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- Custom Js -->
{{-- <script src="{{asset('js/pages/forms/basic-form-elements.js') }}"></script> --}}
<!-- Multi Select Plugin Js -->
<script src="{{asset('plugins/multi-select/js/jquery.multi-select.js') }}"></script>

<!-- Chart Plugins Js -->
{{-- <script src="{{asset('plugins/chartjs/Chart.bundle.js') }}"></script> --}}
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/pages/ui/tooltips-popovers.js') }}"></script>
<script src="{{ asset('js/config_alerts.js') }}"></script>
<script src="{{ asset('js/jquery.numeric.js') }}"></script>
<script src="{{ asset('js/handlebars.js') }}"></script>
<script >
	$(document).ready(function() {
		moment.lang('es', {
		  months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
		  monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
		  weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
		  weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
		  weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
		});

		$("#suscribirse").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto
	        
	        var ruta = window.location.pathname.split("/");
	        var cate = ruta[2];
	        var id = ruta[3];
        	$.ajax('/nuevo_seguidor/'+cate+'/'+id,{
		   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},success:function(response){
		   			swal({
						title: "Seguido!",
						text: "Ahora sigues a "+response,
					});
			    },
			    method: 'post',
			});
	    });
	    $("#like,#no_like").click(function (e) {
	        e.preventDefault();  // Para evitar que se envíe por defecto

	        var tipo = this.getAttribute('id');
	        var ruta = window.location.pathname.split("/");
	        var cate = ruta[2];
	        var id = ruta[3];
        	$.ajax('/like_no_like/'+cate+'/'+id+'/'+tipo,{
		   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},success:function(response){
		   			swal({
						title: "Gracias!",
						text: "Tu opinión es importante ",
					});
			    },
			    method: 'post',
			});
	    }); //Actualizar
	});
</script>
