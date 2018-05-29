datos = {
    /**
     * Validar eliminacion de registro desde vista index
     * @param nom_registro (nombre registro)
     * @param id (id del registro a eliminar)
     * @param ruta (ruta base)
     * @param ruta (id de la tabla)
     */   
	showConfirmDelete: function(nom_registro,id, ruta, tabla) {
	    swal({
			title: "Eliminar",
			text: "¿Está seguro que quiere Eliminar  ("+nom_registro+")?",
			type: "error",
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
				$.ajax(ruta+'/'+id,{
			   		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function(data,sta,xhr) {
						if (data == 99){
							swal("¡Registro en uso!",
							"Disculpe, no ha podido elimarse este registro posee 1 o más registros asociadas él",
							"warning");
						}else{
							swal({
								title: "¡Hecho!",
				                text: "El registro fue Eliminado satisfactoriamente.",
				                type: "success",
							}),
                            $("#"+tabla+"").DataTable().ajax.reload();
						}
					},
					error: function(xhr,sta,error) {
						swal("¡Error!",
								error,
								"error");
					},
				    method: 'delete',
				});
			} else {
				swal("¡Cancelado!",
				"Eliminación Cancelada",
				"error");
			}
		}); // isConfirm
    },

    /**
     * Validar Crear registro desde vista create
     * @param ruta (ruta base)
     * @param form (formulario)
     */ 
    showNotificationRegistro: function(ruta, form) {
        swal({
                title: "Registrar",
                text: "¿Ya culminó de colocar la Información?",
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
					$.ajax('/admin/'+ruta,{
                        data: form.serialize(),
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: 'post',
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

                                        }
                                }else if (typeof datos == 'string'){ //Registro satisfactorio
                                    swal({
                                        title: "¡Registrado!",
                                        text: "El Regristro fue creado satisfactoriamente.",
                                        type: "success",
                                    },
									function(){
						              	window.location = '/admin/'+ruta;
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
                        "Registro Cancelado",
                        "error");
                    }
                }); // isConfirm
    },


    /**
     * Validar Crear registro desde vista create
     * @param id (id del registro)
     * @param ruta (ruta base)
     * @param form (formulario)
     */ 
    showNotificationActualizar: function(id, ruta, form) {
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
                    $.ajax('/admin/'+ruta+'/'+id,{
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
                                        window.location = '/admin/'+ruta;
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
    },

    /**
     * Funcion para Cambios de Estatus
     * @param nom_registro (nombre registro)
     * @param id (id del registro a cambiar)
     * @param ruta (ruta base)
     * @param ruta (Estatus)
     * @param ruta (id de la tabla)
     */   
    showActDesc: function(nom_registro,id, ruta, estatus, tabla) {

        if (estatus == 1){
            ti = 'Desactivación';
            te = 'desactivar';
        }else if(estatus == 2){
            ti = 'Activación';
            te = 'activar';            
        }else if(estatus == 3){
            ti = 'Aprobar';
            te = 'aprobar';
        }
        swal({
            title: ti+" Registro",
            text: "¿Quiere "+te+" este registro ("+nom_registro+") ?",
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
                $.ajax(ruta+'/'+id+'/'+estatus,{
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data,sta,xhr) {
                        swal({
                            title: "¡Hecho!",
                            text: ti+" de registro satisfactoriamente.",
                            type: "success",
                        })
                        $("#"+tabla+"").DataTable().ajax.reload();
                    },
                    error: function(xhr,sta,error) {
                        swal("¡Error!",
                                error,
                                "error");
                    },
                    method: 'get',
                });
            } else {
                swal("¡Cancelado!",
                ti+" Cancelada",
                "error");
            }
        }); // isConfirm
    },

    /**
     * Aprobar o Desaprobar un post
     * @param nom_registro (nombre registro)
     * @param id (id del registro a eliminar)
     * @param ruta (ruta base)
     */   
    showConfirmVisita: function(nom_registro,id, ruta) {
        swal({
            title: "Cerrar Visita",
            text: "¿Culminó la vista de "+nom_registro+" ?",
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
                $.ajax('cerrar_visitas/'+id,{
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data,sta,xhr) {
                        swal({
                            title: "¡Hecho!",
                            text: "El registro fue Eliminado satisfactoriamente.",
                            type: "success",
                        },
                        function(){
                            window.location = ruta;
                        })
                    },
                    error: function(xhr,sta,error) {
                        swal("¡Error!",
                                error,
                                "error");
                    },
                    method: 'get',
                });
            } else {
                swal("¡Cancelado!",
                "Eliminación Cancelada",
                "error");
            }
        }); // isConfirm
    },


    /**
     * Notificacion Select Requeridos
     * @param nom_registro (campo)
     */   
    // showSelectRequerido: function(campo) {
    //     $.notify({
    //         icon: "glyphicon glyphicon-warning-sign",
    //         message: "Disculpe, debe seleccionar el campo "+campo,

    //     }, {
    //         element: 'body',
    //         position: null,
    //         type: "danger",
    //         allow_dismiss: true,
    //         newest_on_top: false,
    //         showProgressbar: false,
    //         placement: {
    //             from: "bottom",
    //             align: "center"
    //         }
    //     });
    // },
    /**
     * Notificacion Campo Fecha Requeridos
     * @param nom_registro (campo)
     */ 
    // showFechaRequerido: function(campo) {
    //     $.notify({
    //         icon: "glyphicon glyphicon-warning-sign",
    //         message: "Disculpe, debe seleccionar "+campo+" que fecha va generar el reporte",

    //     }, {
    //         element: 'body',
    //         position: null,
    //         type: "danger",
    //         allow_dismiss: true,
    //         newest_on_top: false,
    //         showProgressbar: false,
    //         placement: {
    //             from: "bottom",
    //             align: "center"
    //         }
    //     });
    // },

    /**
     * Mensaje de limite de reporte excedido
     * @param nom_registro (nombre registro)
     * @param id (id del registro a eliminar)
     * @param ruta (ruta base)
     */   
    // showLimiteReporte: function() {
    //     $.notify({
    //         icon: "glyphicon glyphicon-warning-sign",
    //         message: "Disculpe, ha excedido el limite de espacios para el reporte",

    //     }, {
    //         element: 'body',
    //         position: null,
    //         type: "danger",
    //         allow_dismiss: true,
    //         newest_on_top: false,
    //         showProgressbar: false,
    //         placement: {
    //             from: "bottom",
    //             align: "right"
    //         }
    //     });
    // },

    /**
     * Validador de reporte
     * @param form (alineacion)
     * @param form (orientacion)
     * @param form (tamaño)
     * @param form (reporte)
     * @param form (categoria)
     * @param form (campos)
     * @param form (desde)
     * @param form (hasta)
     */ 
    // showGenerarReporte: function(alin,ori,tam,rep,cate,campos,desde,hasta) {

    //     swal({
    //             title: "Registrar",
    //             text: "¿Ya culminó de seleccionar los elementos del reporte?",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#DD6B55",
    //             confirmButtonText: "¡Si!",
    //             cancelButtonText: "No, aún no",
    //             closeOnConfirm: false,
    //             closeOnCancel: false,
    //             showLoaderOnConfirm: true 
    //         }, // swal

    //         function(isConfirm){
    //             if (isConfirm) {
    //                 $.get('/verif_generar_reporte/'+rep+'/'+cate+'/'+desde+'/'+hasta , function(data){ 
    //                     if (data === '404'){ //Errores en el formulario
    //                         swal.close();
    //                         $.notify({
    //                             icon: "glyphicon glyphicon-warning-sign",
    //                             message: "Disculpe no hay registros para el periodo y/o reporte solicitado ",

    //                         }, {
    //                             element: 'body',
    //                             position: null,
    //                             type: "danger",
    //                             allow_dismiss: true,
    //                             newest_on_top: false,
    //                             showProgressbar: false,
    //                             placement: {
    //                                 from: "bottom",
    //                                 align: "right"
    //                             }
    //                         });
    //                     }else{ //Registro satisfactorio
    //                         swal({
    //                             title: "¡Generado!",
    //                             text: "El reporte fue creado satisfactoriamente.",
    //                             type: "success",
    //                         },
    //                         function(){
    //                             url = '/reporte/'+alin+'/'+ori+'/'+tam+'/'+rep+'/'+cate+'/'+campos+'/'+desde+'/'+hasta;
    //                             window.open(url);
    //                         })
    //                     }
    //                 });
    //             } else {
    //                 swal("¡Cancelado!",
    //                 "Generación de reporte Cancelada",
    //                 "error");
    //             }
    //         }); // isConfirm
    // },
}



