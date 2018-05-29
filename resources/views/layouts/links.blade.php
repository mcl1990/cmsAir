<!DOCTYPE html>
<html>

@section('htmlheader')
    @include('layouts.base.header')
    <style type="text/css" media="screen">
        section.content {margin-left: 0;}
        footer {padding: 15px 0;}
        footer ul li {
            display: inline;
            padding: 3px 1px;
        }
        footer ul li a {color: #666;}
        footer ul li a:hover {color: #222;}
    </style>
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
        <input type="text" placeholder="TITULO DEL APORTE..." onblur="filtrarAportes(event)" id="txtSearch">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('layouts.base.navbar')
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