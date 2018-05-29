@extends('layouts.aporte-detalles')
@section('estilos')
<style type="text/css">
	#titulo-pelicula{padding-bottom: 20px;}
	.me-gusta a{margin: 1px 6px;}
	h1,h2,h3,h4,h5,h6,p,
	.media .media-body .media-heading{color:white;}
</style>
@endsection
@section('content')
<div class="row clearfix">
	<h2 class="text-center" id="titulo-pelicula">{{$aporte->titulo}}</h2>
	<div class="col-xs-8 col-sm-4 col-md-3 col-lg-3">
		<div class="media">
            <div class="media-left">
                <img class="media-object" src="/images/avatar.jpg" width="64" height="64">
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$aporte->usuario->name}}</h4>
				<button class="btn btn-primary waves-effect">SUSCRIBIRSE</button>
            </div>
        </div>
	</div>
	<div class="col-xs-4 col-sm-8 col-md-9 col-lg-9">
		<h4 class="text-right" style="padding: 0;margin: 0"><b>{{$aporte->visto}}</b> visualizaciones</h4>
		<div class="me-gusta text-right" style="padding: 0;margin: 0">
			<a href="#" ><i class="material-icons" style="vertical-align: middle">thumb_up</i></a>
			<span>0</span>
			<a href="#"><i class="material-icons" style="vertical-align: middle">thumb_down</i></a>
			<span>0</span>
		</div>
	</div>
</div>
<div class="row clearfix">
	<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
		
	</div>
	<div class="col-xs-12 col-sm-6 text-right">
		
	</div>
</div>
@isset($embed)
<div class="row clearfix" id="embed">
	
</div>
@endisset
<div class="row clearfix">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-md-offset-2">
		<div class="col-xs-12 col-md-6">
			<div class="info-box bg-pink hover-expand-effect">
				<div class="icon">
					<i class="material-icons">dns</i>
				</div>
				<div class="content">
					<div class="text">SERVIDOR</div>
					<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{title_case($aporte->servidor->servidor)}}</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="info-box bg-cyan hover-expand-effect">
				<div class="icon">
					<i class="material-icons">inbox</i>
				</div>
				<div class="content">
					<div class="text">PESO</div>
					<div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{mb_strtoupper($aporte->peso . ' ' . $aporte->tamano->tamano,'UTF-8')}}</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="info-box bg-light-green hover-expand-effect">
				<div class="icon">
					<i class="material-icons">date_range</i>
				</div>
				<div class="content">
					<div class="text">FECHAs</div>
					<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">{{$aporte->pelicula->fecha->format('Y-m-d')}}</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="info-box {{$aporte->status == true ? 'bg-green' : 'bg-red'}} hover-expand-effect">
				<div class="icon">
					<i class="material-icons">{{$aporte->status == true ? 'check' : 'clear'}}</i>
				</div>
				<div class="content">
					<div class="text">
						<H3 style="vertical-align: middle" class="text-center">{{$aporte->status == true ? 'ACTIVO' : 'INACTIVO'}}</H3>
					</div>
					<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row clearfix">
	@if($aporte->status == 1)
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-md-offset-3 col-lg-offset-4">
		<a href="#">
			<div class="info-box bg-green hover-expand-effect">
				<div class="icon">
					<i class="material-icons">cloud_download</i>
				</div>
				<div class="content">
					<div class="text">
						<h2 style="vertical-align: middle" class="text-center">DESCARGAR</h2>
					</div>
					<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
				</div>
			</div>
		</a>
	</div>
	@endif
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
		<ul class="nav nav-tabs tab-nav-right" role="tablist">
			<li role="presentation" class="active"><a href="#enlaces" data-toggle="tab">Comentarios</a></li>
			<li role="presentation"><a href="#profile" data-toggle="tab">Relacionados</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="enlaces">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem delectus quae qui, reiciendis, corrupti quo iusto consectetur? Distinctio placeat nemo suscipit nobis quam quaerat, fugiat veritatis dolorem nulla, autem quasi!</p>
			</table>
		</div>
		<div class="tab-pane fade in" id="profile">
			<p>Jesus Leonardo</p>
		</div>
	</div>
</div>
</div>
@endsection