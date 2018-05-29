@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/"><i class="material-icons">home</i> Inicio</a></li>
        <li><a href="/usuarios"><i class="material-icons">people</i>Usuarios</a></li>
        <li class="active"><i class="material-icons">create</i>Actualizar</li>
    </ol>
    <!-- Advanced Select -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h4>
                        Perfil
                        <small>Tu cuenta (Inf. Personal, ubicación, aportes)</small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <form id="form_user_perfil">
	    <div class="row clearfix">
	        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
	            <div class="card">
	            	<div class="header text-center">
	                    <h4>
	                        Avatar
	                    </h4>
	                </div>
	                <div class="body">
	                	<div class="user-info">

						    <div class="image text-center">
						    	<img id="imagen" src='../../images/avatares/{{$usuario->avatar_id}}.jpg' style="border-radius:50%" width="100" height="100" >
						        
						    </div>
						    <br>
						    <div class="row clearfix">
							    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
		                            <button type="button" id="cambiar" class="btn btn-link waves-effect bg-grey" >Cambiar</button>
		                        </div>
		                    </div>
						</div>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	        	<div class="card">
	            	<div class="header text-center">
	                    <h4>Información Personal</h4>
	                </div>
	                <div class="body">
	                		<div class="row clearfix">
							    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                            <p>
		                                <b>Nombre</b>
		                            </p>
		                            <div class="form-group">
		                                <div class="form-line">
		                                    <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" placeholder="Nombre" maxlength="30" required autofocus>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                            <p>
		                                <b>Email</b>
		                            </p>
		                            <div class="form-group">
		                                <div class="form-line">
		                                    <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}" maxlength="100" placeholder="Correo" required>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                            <p>
		                                <b>Contraseña</b>
		                            </p>
		                            <div class="form-group">
		                                <div class="form-line">
		                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" maxlength="12" required>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                            <p>
		                                <b>Confir. Contraseña</b>
		                            </p>
		                            <div class="form-group">
		                                <div class="form-line">
		                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" maxlength="12" required>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                            <p>
		                                <b>País</b>
		                            </p>
		                            <div class="form-group">
		                                <div class="form-line">
		                                    <select class="form-control show-tick" data-live-search="true" id="pais_id" data-size="5"  name="pais_id">
		                                        <option value=0>--Seleccione--</option>
		                                    	@foreach ($list_paises as $pais)
		                                        	<option value="{{$pais->id}}">{{ $pais->pais }}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
		                        	<p>
		                                
		                            </p>
		                        	<button  type="button" id="actulizar" class="btn bg-black waves-effect" data-toggle="tooltip" data-placement="top" title="Actualizar Cliente">
					                    <i class="material-icons">save</i>
					                    <span>Actualizar</span>
					                </button>

	                                <input type="text" id="id" hidden="hidden" value="{{ $usuario->id }}" >
	                                <input type="text" id="seguidores" hidden="hidden" value="{{ $usuario->seguidores }}" >
	                                <input type="text" id="siguiendo" hidden="hidden" value="{{ $usuario->siguiendo }}" >
	                                <input type="text" id="likes" hidden="hidden" value="{{ $usuario->likes }}" >
	                                <input type="text" id="no_likes" hidden="hidden" value="{{ $usuario->no_likes }}" >
	                                <input type="text" id="total_aportes" hidden="hidden" value="{{ $usuario->total_aportes }}" >
	                                <input type="text" id="id" hidden="hidden" value="{{ $usuario->id }}" >
	                                <input type="text" id="perfil_id" hidden="hidden" value="{{ $usuario->perfil_id }}" >
	                                <input type="text" id="avatar_id" name="avatar_id" hidden="hidden" value="{{ $usuario->avatar_id }}" >
	                                <input type="text" id="id_pais" hidden="hidden" value="{{ $usuario->pais_id }}" >
                            	</div>
		                    </div>


	                </div>
	            </div>
	        </div>
	    </div>
	</form>

	<div class="row clearfix">
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

			<a href="#">
				<div class="info-box bg-green hover-expand-effect">
					<div class="icon">
						<i class="material-icons">people</i>
					</div>
					<div class="content">
						<div class="text">
							<h4 style="vertical-align: middle" class="text-center">Seguidores</h4>
						</div>
						<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{ $usuario->seguidores }}</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

			<a href="#">
				<div class="info-box bg-blue-grey hover-expand-effect">
					<div class="icon">
						<i class="material-icons">person_add</i>
					</div>
					<div class="content">
						<div class="text">
							<h4 style="vertical-align: middle" class="text-center">Seguidos</h4>
						</div>
						<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{ $usuario->seguidos }}</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

			<a href="#">
				<div class="info-box bg-indigo hover-expand-effect">
					<div class="icon">
						<i class="material-icons">thumb_up</i>
					</div>
					<div class="content">
						<div class="text">
							<h4 style="vertical-align: middle" class="text-center">Likes</h4>
						</div>
						<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{ $usuario->likes }}</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

			<a href="#">
				<div class="info-box bg-red hover-expand-effect">
					<div class="icon">
						<i class="material-icons">thumb_down</i>
					</div>
					<div class="content">
						<div class="text">
							<h4 style="vertical-align: middle" class="text-center">No Like</h4>
						</div>
						<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{ $usuario->no_likes }}</div>
					</div>
				</div>
			</a>
		</div>
	</div>

</div>

<!-- Default Size -->
<div class="modal fade" id="AvatarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                	Cambiar avatar del usuario
                </h5>
            </div>
            <div class="modal-body" >
            	<div class="row clearfix">
	                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		            	<p>
		                    <b>Seleccione el nuevo avatar</b>
		                </p>
		                <div class="form-group">
					        <select class="form-control" id="icono" name="icono">
					            <option value=''>Seleccione</option>
					        	@foreach($list_avatares as $avatares)
								<option value="{{$avatares->id}}">{{$avatares->avatar}} </option>
								@endforeach
					        </select>
					    </div>
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					    <img id="preview" src='' style="border-radius:50%" width="100" height="100" >
				    </div>
				    
			    </div>
            </div>
            <input  name="tipo" id="tipo" hidden="hidden">
            <input  name="id_r" id="id_r" hidden="hidden">
            <div class="modal-footer">
                <button id="seleccionar" type="button" class="btn btn-link waves-effect bg-grey" style="color: white">Seleccionar</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script >
	$(document).ready(function() {

	var pa = $('#id_pais').val();
	$("#pais_id").selectpicker('val', pa);

	$('#cambiar').on('click', function (e) {
        e.preventDefault();
 		var id = $('#avatar_id').val(); //ID 
	    $('#preview').attr('src', '../../images/avatares/'+id+'.jpg');
	    $("#AvatarModal").modal("show");
	});

	$('#icono').change(function () {
		var icono = $('#icono').val(); //ID 
	    $('#preview').attr('src', '../../images/avatares/'+icono+'.jpg');
	});

	$('#seleccionar').on('click', function (e) {
        e.preventDefault();
 		var icono = $('#icono').val(); //ID 
	    $('#imagen').attr('src', '../../images/avatares/'+icono+'.jpg');
	    $('#avatar_id').val(icono);
	    $("#AvatarModal").modal("toggle");
	});





	$("#actulizar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
   
        var id = $('#id').val();
        var form = $("#form_user_perfil");
        var ruta = window.location.pathname.split("/")[1];

        swal({
                title: "Actualización",
                text: "¿Ya culminó de modificar la Información?",
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
                    $.ajax('/user_perfil/'+id,{
                        data: form.serialize(),
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: 'put',
                            success: function(datos,sta,xhr) {
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
                                    }// For  
                                }else if (typeof datos == 'string'){ //Registro satisfactorio
                                    swal({
                                        title: "¡Actualizado!",
                                        text: "El Regristro fue actualizado satisfactoriamente.",
                                        type: "success",
                                    },
                                    function(){
                                        window.location = '/'+ruta;
                                    })
                                }
                            }, // Success
                            error: function(xhr,sta,error) {
                                swal("¡Error!",
                                        error,
                                        "error");
                            }, // Error
                        }) // Ajax
                    } else {
                        swal("¡Cancelado!",
                        "Actualización Cancelada",
                        "error");
                    }
                }); // isConfirm
        // datos.showNotificationActualizar(id,ruta,form);
    });

	        

})


</script>
@endpush
