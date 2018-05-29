<?php
/*
 * Redireccion si esta o no Logueado
 */
Route::get('/admin',function () {
	if (Auth::guest()){
		return view('welcome');
	}else{
		return view('index');
	}
});
Auth::routes();
// Administrador
	/* ////////////////////////////////////////////////////////////////
	 * ////////////// REGISTROS (Peliculas, Series, Anime) ////////////
	 */////////////////////////////////////////////////////////////////

	Route::resource('/admin/peliculas', 'Registros\PeliculaController');
	Route::resource('/admin/series', 'Registros\SerieController');
	Route::resource('/admin/temporadas', 'Registros\TemporadaController');
	Route::get('/admin/aportes_pelis/{id}','Registros\AportePeliculaController@show');
	Route::get('/admin/aportes_pelis/{id}/edit','Registros\AportePeliculaController@edit');
	Route::put('/admin/aportes_pelis/{id}','Registros\AportePeliculaController@update');
	Route::delete('/admin/aportes_pelis/{cate}/{id}','Registros\AportePeliculaController@destroy');
	Route::resource('/admin/aportes', 'Registros\AporteController',[
		'except' => 'show',
		'except' => 'destroy',
	]);

	Route::post('/nuevo_seguidor/{cate}/{id}','Registros\AporteController@nuevo_seguidor');
	Route::post('/like_no_like/{cate}/{id}/{tipo}','Registros\AporteController@like_no_like_aporte');
	/* ////////////////////////////////////////////////////////////////
	 * ////////// Mensajes (Admininstrador / Editores) ///////////////
	 */////////////////////////////////////////////////////////////////

	Route::get('/contactenos', 'Registros\MensajeController@create');
	Route::post('/contactenos', 'Registros\MensajeController@store');
	Route::get('/admin/mensajes', 'Registros\MensajeController@index');
	Route::get('/admin/mensajes/{id}/{post}', 'Registros\MensajeController@edit');
	Route::put('/admin/mensajes/{id}', 'Registros\MensajeController@update');
	Route::delete('/admin/mensajes/{id}', 'Registros\MensajeController@destroy');

	/* ////////////////////////////////////////////////////////////////
	 * ////////// Bitacoras (Admininstrador / Editores) ///////////////
	 */////////////////////////////////////////////////////////////////

	Route::resource('/admin/bitacora_admin', 'BitacoraAdminController');
	Route::resource('/admin/bitacora_editor', 'BitacoraEditorController');

	/* ////////////////////////////////////////////////////////////////
	 * ////////// Configuraciones (Solo - Admininstrador) /////////////
	 */////////////////////////////////////////////////////////////////

	//Acciones (Activar/Estatus)
	Route::post('/admin/descargar_generos', 'Configuraciones\GeneroController@descargar_generos');
	Route::get('/admin/paises/{id}/{status}', 'Configuraciones\PaisController@act_des_pais');
	Route::get('/admin/estatus_etiqueta/{id}/{status}', 'Configuraciones\EtiquetaController@estatus_etiqueta');

	Route::resource('/admin/audios', 'Configuraciones\AudioController');
	Route::resource('/admin/avatares', 'Configuraciones\AvatarController');
	Route::resource('/admin/categorias', 'Configuraciones\CategoriaController');
	Route::resource('/admin/etiquetas', 'Configuraciones\EtiquetaController');
	Route::resource('/admin/generos', 'Configuraciones\GeneroController');
	Route::resource('/admin/idiomas', 'Configuraciones\IdiomaController');
	Route::resource('/admin/formatos', 'Configuraciones\FormatoController');
	Route::resource('/admin/motivos', 'Configuraciones\MotivoController');
	Route::resource('/admin/paises', 'Configuraciones\PaisController');
	Route::resource('/admin/servidores', 'Configuraciones\ServidorController');
	Route::resource('/admin/resoluciones', 'Configuraciones\ResolucionController');
	Route::resource('/admin/sanciones', 'Configuraciones\SancionController');
	Route::resource('/admin/tamanos', 'Configuraciones\TamanoController');

	/* ////////////////////////////////////////////////////////////////
	 * ////////////////////// Notificaciones  /////////////////////////
	 */////////////////////////////////////////////////////////////////

	Route::resource('/admin/tipos_notificaciones', 'Notificaciones\TipoNotificacionController');

	/* ////////////////////////////////////////////////////////////////
	 * ////////////// USuarios (Solo - Admininstrador) ////////////////
	 */////////////////////////////////////////////////////////////////

	Route::resource('/admin/perfiles', 'Usuarios\PerfilesController');
	Route::resource('/admin/usuarios', 'Usuarios\UserController');
	Route::put('/user_perfil/{id}', 'Usuarios\UserController@update_perfil');

	 ////////////////////////////////////////////////////////////////
	  ///////////////////////  DataTables ////////////////////////////
	 ////////////////////////////////////////////////////////////////

	/////////////////
	//Configuraciones
	Route::get('/get_avatares', 'Configuraciones\AvatarController@getListAvatares')->name('datatable.avatares');
	Route::get('/get_aportes', 'AporteController@getData')->name('datatable.aportes');
	Route::get('/dt-aportes-peli/{id}','PeliculasController@aportesData')->name('data.aportes.id');
	Route::get('/get_audios', 'Configuraciones\AudioController@getListAudio')->name('datatable.audios');
	Route::get('/get_categorias', 'Configuraciones\CategoriaController@getListCategoria')->name('datatable.categorias');
	Route::get('/get_formatos', 'Configuraciones\FormatoController@getListFormato')->name('datatable.formatos');
	Route::get('/get_etiquetas', 'Configuraciones\EtiquetaController@getListEtiquetas')->name('datatable.etiquetas');
	Route::get('/get_generos', 'Configuraciones\GeneroController@getListGenero')->name('datatable.generos');
	Route::get('/get_idiomas', 'Configuraciones\IdiomaController@getListIdioma')->name('datatable.idiomas');
	Route::get('/get_motivos', 'Configuraciones\MotivoController@getListMotivo')->name('datatable.motivos');
	Route::get('/get_paises', 'Configuraciones\PaisController@getListPais')->name('datatable.paises');
	Route::get('/get_resoluciones', 'Configuraciones\ResolucionController@getListResolucion')->name('datatable.resoluciones');
	Route::get('/get_sanciones', 'Configuraciones\SancionController@getListSanciones')->name('datatable.sanciones');
	Route::get('/get_servidores', 'Configuraciones\ServidorController@getListServidores')->name('datatable.servidores');
	Route::get('/get_tamanos', 'Configuraciones\TamanoController@getListTamano')->name('datatable.tamanos');
	///////////
	//Bitacora
	Route::get('/get_bitacora_admin', 'BitacoraAdminController@getListBitacoraAdmin')->name('datatable.bitacora_admin');
	Route::get('/get_bitacora_editor', 'BitacoraEditorController@getListBitacoraEditor')->name('datatable.bitacora_editor');
	///////////
	//Mensajes
	Route::get('/get_mis_mensajes', 'Registros\MensajeController@getListMisMensajes')->name('datatable.mis_mensajes');
	Route::get('/get_mensajes', 'Registros\MensajeController@getListMensajes')->name('datatable.mensajes');

	///////////
	//Notifiaciones
	Route::get('/get_tipos_notificaciones', 'Notificaciones\TipoNotificacionController@getListTipoNotificaciones')->name('datatable.tipos_notificaciones');
	///////////
	//Registros
	Route::get('/admin/get_aportes', 'Registros\AporteController@getListAportes')->name('datatable.admin.aportes');
	Route::get('/get_peliculas', 'Registros\PeliculaController@getListPeliculas')->name('datatable.peliculas');
	Route::get('/get_series', 'Registros\SerieController@getListSeries')->name('datatable.series');
	Route::get('/get_temporadas', 'Registros\TemporadaController@getListTemporadas')->name('datatable.temporadas');
	///////////
	//Usuarios
	Route::get('/get_usuarios', 'Usuarios\UserController@getListUser')->name('datatable.usuarios');
	Route::get('/get_perfiles', 'Usuarios\PerfilesController@getListPerfiles')->name('datatable.perfiles');

	///////////
	//Consultas
	Route::get('/consultas/get_perfil', 'ConsultasController@getPerfil');
// Editores
	// Route::get('/aportes/{}/');
	Route::get('/aportes/{categoria}/{id}',[
		'as' => 'aportes.show',
		'uses' => 'AporteController@show',
	]);
	Route::resource('/aportes', 'AporteController',[
		'except' => 'show',
	]);
	Route::resource('/peliculas','PeliculasController');

	Route::get('/perfil','Usuarios\UserController@perfiles');
	// Route::resource('/admin/usuarios', 'Usuarios\UserController');

	Route::post('/actualizar_notifiaciones', 'Notificaciones\NotificacionController@up_notificaciones');
	Route::resource('/notificaciones', 'Notificaciones\NotificacionController');
	Route::get('/get_notificaciones', 'Notificaciones\NotificacionController@getListNotificaciones')->name('datatable.notificaciones');
