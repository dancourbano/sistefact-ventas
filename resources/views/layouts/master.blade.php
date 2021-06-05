<!doctype html>
<html class="fixed sidebar-left-collapsed">
    
<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:49:15 GMT -->
<head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Sistefact</title>
        <meta name="keywords" content="Sistefact" />
        <meta name="description" content="Sistefact Gpsjnisi">
        <meta name="author" content="gpsjnisi">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/select2/css/select2.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/magnific-popup/magnific-popup.css" /
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/select2-bootstrap-theme/select2-bootstrap.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/jquery-ui/jquery-ui.css" />      <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/jquery-ui/jquery-ui.theme.css" />        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />      <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/morris.js/morris.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/jquery-ui/jquery-ui.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/jquery-ui/jquery-ui.theme.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/morris.js/morris.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/sweetalert/sweetalert.css" />
        <link rel="stylesheet" href="{{ url('public') }}/assets/vendor/pnotify/pnotify.custom.css" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ url('public') }}/assets/stylesheets/theme.css" />

        <!-- Theme Custom CSS -->

        <link rel="stylesheet" href="{{ url('public') }}/assets/css/theme.custom.css" />
        <!-- Head Libs -->
        <script src="{{ url('public') }}/assets/vendor/modernizr/modernizr.js"></script>
    </head>
    <body>
        <section class="body">

            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="{{url('/')}}" class="logo">
                        <img src="{{ url('public') }}/assets/images/gpsjnisi-1.png" height="45" alt="Gpsjnisi" />
                    </a>

                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">

                    <form action="#" class="search nav-form">

                    </form>
            
                    <span class="separator"></span>
            
                    <ul class="notifications">


                    </ul>
            
                    <span class="separator"></span>
                    @if (Route::has('login'))
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">

                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name">{{ Auth::user()->name }}</span>

                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>

                                <li>

                                    <a role="menuitem" tabindex="-1" href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Menú
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">

                                <ul class="nav nav-main">

                                    @if(Auth::user()->role_id==1)
                                        <li class="nav">
                                            <a href="{{URL::action('HomeController@index')}}">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <span>Inicio</span>
                                            </a>
                                        </li>
                                        <li class="nav-parent">
                                            <a>
                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <span>Productos y Servicios</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{ URL::action('ProductController@index') }}">
                                                        Productos
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ServiceController@index') }}">
                                                        Servicios
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-user" aria-hidden="true"></i>
                                                <span>Clientes</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li class="nav-active">
                                                    <a href="{{URL::action('CustomerController@index')}}">
                                                        Clientes
                                                    </a>
                                                </li>


                                            </ul>
                                        </li>
                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-automobile" aria-hidden="true"></i>
                                                <span>Vehiculo y Conductor</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{URL::action('VehicleController@index')}}">
                                                        Vehiculo
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('DriverController@index') }}">
                                                        Conductor
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('MaintenanceController@index') }}">
                                                <i class="glyphicon glyphicon-wrench" aria-hidden="true"></i>
                                                <span>Mantenimientos</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('PackageController@index') }}">
                                                <i class="glyphicon glyphicon-tags" aria-hidden="true"></i>
                                                <span>Paquetes</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('InvoiceController@index') }}">
                                                <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                                                <span>Facturacion</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('MovementController@index') }}">
                                                <i class="glyphicon glyphicon-tasks" aria-hidden="true"></i>
                                                <span>Movimientos</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('PaymentController@index') }}">
                                                <i class="glyphicon glyphicon-usd" aria-hidden="true"></i>
                                                <span>Pagos</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('UsersController@index') }}">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                <span>Usuarios</span>
                                            </a>
                                        </li>

                                        <li class="nav-parent">
                                            <a>
                                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                                <span>Reportes</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{ URL::action('ReportProfitController@index') }}">
                                                        Reporte de Ganancias
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ReportInvoicingController@index') }}">
                                                        Reporte de Facturacion
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ReportMovementsController@index') }}">
                                                        Reporte de Movimientos
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent">
                                            <a>
                                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                                <span>Envio SMS</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{ URL::action('SmsSendController@index') }}">
                                                        Recarga Paquetes 
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('SmsSendController@typeSMS') }}">
                                                        Tipo de Comandos 
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if(Auth::user()->role_id==2)
                                        <li class="nav-active">
                                            <a href="{{URL::action('DashboardController@index')}}">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <span>Inicio</span>
                                            </a>
                                        </li>
                                        <li class="nav-parent">
                                            <a>
                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <span>Productos y Servicios</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{ URL::action('ProductController@index') }}">
                                                        Productos
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ServiceController@index') }}">
                                                        Servicios
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-user" aria-hidden="true"></i>
                                                <span>Clientes</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li >
                                                    <a href="{{URL::action('CustomerController@index')}}">
                                                        Clientes
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-automobile" aria-hidden="true"></i>
                                                <span>Vehiculo y Conductor</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{URL::action('VehicleController@index')}}">
                                                        Vehiculo
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('DriverController@index') }}">
                                                        Conductor
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('MaintenanceController@index') }}">
                                                <i class="glyphicon glyphicon-wrench" aria-hidden="true"></i>
                                                <span>Mantenimientos</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('PackageController@index') }}">
                                                <i class="glyphicon glyphicon-tags" aria-hidden="true"></i>
                                                <span>Paquetes</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('InvoiceController@index') }}">
                                                <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                                                <span>Facturacion</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('MovementController@index') }}">
                                                <i class="glyphicon glyphicon-tasks" aria-hidden="true"></i>
                                                <span>Movimientos</span>
                                            </a>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('PaymentController@index') }}">
                                                <i class="glyphicon glyphicon-usd" aria-hidden="true"></i>
                                                <span>Pagos</span>
                                            </a>
                                        </li>

                                        <li class="nav-parent">
                                            <a>
                                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                                <span>Reportes</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{ URL::action('ReportProfitController@index') }}">
                                                        Reporte de Ganancias
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ReportInvoicingController@index') }}">
                                                        Reporte de Facturacion
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('ReportMovementsController@index') }}">
                                                        Reporte de Movimientos
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    @if(Auth::user()->role_id==3)

                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-user" aria-hidden="true"></i>
                                                <span>Clientes</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{URL::action('CustomerController@index')}}">
                                                        Clientes
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li  class="nav-parent">
                                            <a>
                                                <i class="fa fa fa-automobile" aria-hidden="true"></i>
                                                <span>Vehiculo y Conductor</span>
                                            </a>
                                            <ul class="nav nav-children">
                                                <li>
                                                    <a href="{{URL::action('VehicleController@index')}}">
                                                        Vehiculo
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::action('DriverController@index') }}">
                                                        Conductor
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li  class="nav">
                                            <a href="{{ URL::action('MaintenanceController@index') }}">
                                                <i class="glyphicon glyphicon-wrench" aria-hidden="true"></i>
                                                <span>Mantenimientos</span>
                                            </a>
                                        </li>

                                    @endif
                                <hr class="separator" />



                                </ul>
                            </nav>
                        </div>
                
                    </div>
                
                </aside>
                <!-- end: sidebar -->

                <section role="main" class="content-body">

                    <header class="page-header">
                        <h2>@yield('title')</h2>

                        <div class="right-wrapper pull-right">
                           @yield('breadcrumb')


                        </div>
                    </header>

                    <!-- start: page -->

                    @yield('content')
                </section>
            </div>

            <aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close visible-xs">
                            Collapse <i class="fa fa-chevron-right"></i>
                        </a>
            
                        <div class="sidebar-right-wrapper">
            
                            <div class="sidebar-widget widget-calendar">
                                <h6>Upcoming Tasks</h6>
                                <div data-plugin-datepicker data-plugin-skin="dark" ></div>
            
                                <ul>
                                    <li>
                                        <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                        <span>Company Meeting</span>
                                    </li>
                                </ul>
                            </div>
            
                            <div class="sidebar-widget widget-friends">
                                <h6>Friends</h6>
                                <ul>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="{{ url('public') }}/assets/images/%21sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="{{ url('public') }}/assets/images/%21sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="{{ url('public') }}/assets/images/%21sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="{{ url('public') }}/assets/images/%21sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
            
                        </div>
                    </div>
                </div>
            </aside>
        </section>



        <!-- Vendor -->
        <script src="{{ url('public') }}/assets/vendor/jquery/jquery.js"></script>
        <script>
            $(document).ready(function(){
                active_menu()
            });
            function active_menu() {
                var url = window.location.href;
                $('.nav a').filter(function() {
                    return this.href == url;
                }).addClass('selected');
            }
        </script>
        <script src="{{ url('public') }}/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-cookie/jquery-cookie.js"></script>
        <script src="{{ url('public') }}/assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="{{ url('public') }}/assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="{{ url('public') }}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="{{ url('public') }}/assets/vendor/bootstrap-datepicker/moment.js"></script>
        <script src="{{ url('public') }}/assets/vendor/bootstrap-datepicker/bootstrap-datetimepicker.js"></script>

        <script src="{{ url('public') }}/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
        
        <!-- Specific Page Vendor -->
        <script src="{{ url('public') }}/assets/vendor/jquery-ui/jquery-ui.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-appear/jquery-appear.js"></script>
        <script src="{{ url('public') }}/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="{{ url('public') }}/assets/vendor/flot/jquery.flot.js"></script>
        <script src="{{ url('public') }}/assets/vendor/flot.tooltip/flot.tooltip.js"></script>
        <script src="{{ url('public') }}/assets/vendor/flot/jquery.flot.pie.js"></script>
        <script src="{{ url('public') }}/assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="{{ url('public') }}/assets/vendor/flot/jquery.flot.resize.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-sparkline/jquery-sparkline.js"></script>
        <script src="{{ url('public') }}/assets/vendor/raphael/raphael.js"></script>
        <script src="{{ url('public') }}/assets/vendor/morris.js/morris.js"></script>
        <script src="{{ url('public') }}/assets/vendor/gauge/gauge.js"></script>
        <script src="{{ url('public') }}/assets/vendor/snap.svg/snap.svg.js"></script>
        <script src="{{ url('public') }}/assets/vendor/liquid-meter/liquid.meter.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/jquery.vmap.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
        <script src="{{ url('public') }}/assets/vendor/pnotify/pnotify.custom.js"></script>

        <!-- Theme Base, Components and Settings -->
        
        <script src="{{ url('public') }}/assets/vendor/sweetalert/sweetalert.min.js"></script>
        <script src="{{ url('public') }}/assets/vendor/select2/js/select2.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="{{ url('public') }}/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

        <!-- Theme Custom -->
        <script src="{{ url('public') }}/assets/javascripts/jquery.validate.min.js"></script>
        <!-- Theme Initialization Files -->
        <script src="{{ url('public') }}/assets/javascripts/theme.js"></script>
        <script src="{{ url('public') }}/js/theme.custom.js"></script>
        <script src="{{ url('public') }}/assets/javascripts/theme.init.js"></script>
    </body>
@yield('scripts')
<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.4.2/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2015 03:53:27 GMT -->
</html>


