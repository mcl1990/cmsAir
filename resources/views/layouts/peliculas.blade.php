<!DOCTYPE html>
<html>
    @section('htmlheader')
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Películas | Dominicana</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Google Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->
        <link href="{{ asset('css/material-icon.css') }}" rel="stylesheet">
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />
        <!-- Gallery Plugin -->
        {{-- <link href="{{ asset('plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet" />         --}}
        <link href="{{ asset('css/imagehover.css') }}" rel="stylesheet" />        
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        <!-- Custom Css -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('css/themes/theme-black.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
        <!-- Bootstrap Material Datetime Picker Css -->
        {{-- <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" /> --}}
        <!-- Wait Me Css -->
        <link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
        <!-- Multi Select Css -->
        <link href="{{ asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">
        <!-- Bootstrap Material Datetime Picker Css -->
        {{-- <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" /> --}}
        <!-- Sweetalert Css -->
        <link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
        <style>
            footer {padding: 15px 0;}
            footer ul li {
                display: inline;
                padding: 3px 1px;
            }
            footer ul li a {color: #666;}
            footer ul li a:hover {color: #222;}
            .quitar{display: none;}
        </style>
    @yield('estilos')        
    </head>
    @show
    <body class="theme-black">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Por favor espere...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        {{-- <div class="overlay"></div> --}}
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="../../index.html">MEDIA</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Call Search -->
                        {{-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> --}}
                        <li>
                            <a href="javascript:void(0)"><i class="material-icons">menu</i></a>
                        </li>
                        <!-- #END# Call Search -->
                        <!-- Notifications -->
                        {{-- <li>
                            <a href="javascript:void(0)"><i class="material-icons">attach_money</i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="material-icons">help</i></a>
                        </li> --}}
                        <li>
                            <a href="javascript:void(0)"><i style="vertical-align: middle" class="material-icons">person</i>Entrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- @include('layouts.base.navbar') --}}
        <!-- #Top Bar -->
        {{-- <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                @include('layouts.base.user_info')
                <!-- #User Info -->
                <!-- Menu -->
                @include('layouts.base.sidebar_left')
                #Menu
                <!-- Footer -->
                @include('layouts.base.footer')
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            @include('layouts.base.sidebar_right')
            <!-- #END# Right Sidebar -->
        </section> --}}
        
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                {{-- @include('layouts.base.user_info') --}}
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        @isset($categorias)
                        @foreach($categorias as $c)
                            <li class="header">
                                <h4>{{$c->categoria}}</h4>
                            </li>
                            @foreach($c->menus as $fila)
                            {{-- Imprime los menus --}}
                            {{-- Si tiene hijos los muestra --}}
                                @if($fila->lista->count() > 0)
                                <li>
                                    <a class="menu-toggle">
                                        <i class="material-icons">settings</i>
                                        <span>{{$fila->titulo}}</span>
                                    </a>
                                    <ul class="ml-menu">
                                    {{-- TODO --}}
                                    {{-- Insertar los generos desde BD --}}
                                        @foreach($fila->lista as $hijo)
                                        <li>
                                            <a href="{{$hijo->url}}">{{$hijo->titulo}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                    <li>
                                        <a href="{{$fila->url}}"><i class="material-icons">{{$fila->icono}}</i>
                                        <span>{{$fila->titulo}}</span></a>
                                    </li>                                
                                @endif
                            @endforeach
                        @endforeach
                        @endisset
                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                {{-- @include('layouts.base.footer') --}}
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            {{-- @include('layouts.base.sidebar_right') --}}
            <!-- #END# Right Sidebar -->
        </section>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center" id="cont-derechos-autor">
                        <h5>Copyright &copy 2017</h5>
                        <ul>
                            <li class="text-center"><a href="#" class="font-italic">Home</a></li>
                            <li class="text-center"><a href="#" class="font-italic">Dashboard</a></li>
                            <li class="text-center"><a href="#" class="font-italic">Reports</a></li>
                            <li class="text-center"><a href="#" class="font-italic">Support</a></li>
                            <li class="text-center"><a href="#" class="font-italic">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        @include('layouts.base.scripts')
        @stack('scripts')
    </body>
</html>