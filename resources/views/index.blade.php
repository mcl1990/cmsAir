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
	<ol class="breadcrumb breadcrumb-bg-black">
        <li><a href="/nodos"><i class="material-icons">home</i> Inicio</a></li>
       
    </ol>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        BIENVENIDO {{ Auth::user()->name }}
                    </h2>
                </div>
                <div class="body">
                	<p class="category">Puede ir a alguna sección en el menu a la izquierda.</p>
                </div>

			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')


@endpush
