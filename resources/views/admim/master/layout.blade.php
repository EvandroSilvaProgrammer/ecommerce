<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') - Doriema Admin</title>

    {{-- Tell the browser to be responsive to screen width --}}
    <link rel="stylesheet" href="{{asset('admim/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admim/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admim/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admim/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('admim/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('admim/dist/css/skins/skin-blue.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admim/bower_components/select2/dist/css/select2.min.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admim/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('admim/dist/css/newStyleSkeBug.css')}}">

    <link rel="shortcut icon" href="{{asset('site/img/icon.ico')}}" />

    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @stack('stylesDashboard')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{route('admim')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>D</b>Lda</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Doriema</b> Lda</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        {{-- <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <img src="{{asset('admim/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                    </ul>
                                    <!-- /.menu -->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li> --}}
                        <!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        {{-- <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li> --}}
                        <!-- Tasks Menu -->
                        {{-- <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <!-- Task title and progress text -->
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <!-- The progress bar -->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress -->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul> --}}
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{asset('admim/images/icons/user.png')}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset('admim/images/icons/user.png')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href=" {{route('admim.users.profile')}} " class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('admim.logout')}}" class="btn btn-default btn-flat">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('admim/images/icons/user.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name }}</p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{ (Route::current()->getName() === 'admim' ? 'active' : '') }}"><a href="{{route('admim')}}"><i class="fa fa-fw fa-home"></i> <span>Início</span></a></li>

                <li class="treeview @if((Route::current()->getName() === 'admim.dashboards.index') ) active @endif">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span>Dashboards</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admim.dashboards.index')}}"><i class="fa fa-bar-chart-o"></i>Visitas</a></li>
                    </ul>
                </li>

                <li class="treeview @if((Route::current()->getName() === 'admim.request.news') ) active @endif
                    @if((Route::current()->getName() === 'admim.request.canceled') ) active  @endif
                    @if((Route::current()->getName() === 'admim.request.pay') ) active  @endif
                    @if((Route::current()->getName() === 'admim.request.delivery') ) active  @endif
                    @if((Route::current()->getName() === 'admim.request.show') ) active  @endif
                    @if((Route::current()->getName() === 'admim.request.reports') ) active  @endif">

                    <a href="#"><i class="fa fa-cart-arrow-down"></i> <span>Pedidos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admim.request.news')}}"><i class="fa fa-cart-arrow-down"></i> Pedidos Novos</a></li>
                        <li><a href="{{route('admim.request.canceled')}}"><i class="fa fa-cart-arrow-down"></i> Pedidos Cancelados</a></li>
                        <li><a href="{{route('admim.request.pay')}}"><i class="fa fa-cart-arrow-down"></i> Pedidos Pagos</a></li>
                        <li><a href="{{route('admim.request.delivery')}}"><i class="fa fa-cart-arrow-down"></i> Pedidos Entregues</a></li>
                        <li><a href="{{route('admim.request.reports')}}"><i class="fa fa-cart-arrow-down"></i> Gerar Relatórios</a></li>
                    </ul>
                </li>

                <li class="treeview @if((Route::current()->getName() === 'admim.products.index') ) active @endif
                    @if((Route::current()->getName() === 'admim.productCategories.index') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productCategories.edit') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productSubCategories.index') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productSubCategories.edit') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productSubCategories.show') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productBrands.index') ) active  @endif
                    @if((Route::current()->getName() === 'admim.productBrands.edit') ) active  @endif
                    @if((Route::current()->getName() === 'admim.products.show') ) active  @endif>
                    @if((Route::current()->getName() === 'admim.products.edit') ) active  @endif>
                    @if((Route::current()->getName() === 'admim.product.slideShow') ) active  @endif">
                    <a href=""><i class="fa fa-edit"></i> <span>Produtos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li ><a href="{{route('admim.products.index')}}">Gestão de Produto</a></li>
                        <li><a href="{{route('admim.productCategories.index')}}">Gestão de Categorias</a></li>
                        <li><a href="{{route('admim.productSubCategories.index')}}">Gestão de Sub-Categorias</a></li>
                        <li><a href="{{route('admim.productBrands.index')}}">Gestão de Marcas</a></li>
                        <li><a href="{{route('admim.product.slideShow')}}">Gestão do Slide</a></li>
                    </ul>
                </li>

                <li class="treeview @if((Route::current()->getName() === 'admim.services.index') ) active @endif
                    @if((Route::current()->getName() === 'admim.services.edit') ) active @endif
                    @if((Route::current()->getName() === 'admim.services.show') ) active  @endif">
                    <a href="#"><i class="fa fa-wrench"></i> <span>Serviços</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admim.services.index')}}"> <i class="fa fa-wrench"></i> Gestão de Serviços</a></li>
                    </ul>
                </li>

                <li class="treeview @if((Route::current()->getName() === 'admim.promotion.index') ) active @endif">
                    <a href="#"><i class="fa fa-truck"></i> <span>Campanha</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admim.promotion.index')}}"> <i class="fa fa-truck"></i> Gestão de Campanha</a></li>
                    </ul>
                </li>

                {{-- <li class="treeview @if((Route::current()->getName() === 'admim.supplying.index') ) active @endif">
                    <a href="#"><i class="fa fa-truck"></i> <span>Fornecedores</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admim.supplying.index')}}"> <i class="fa fa-truck"></i> Gestão de Fornecedores</a></li>
                    </ul>
                </li> --}}

                <li class="treeview @if((Route::current()->getName() === 'admim.contacts.index') ) active @endif
                    @if((Route::current()->getName() === 'admim.coordenadas.index') ) active  @endif ">
                    <a href=""><i class="fa fa-info"></i> <span>Informações</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li ><a href="{{route('admim.contacts.index')}}">Informações de Contacto</a></li>
                        <li><a href="{{route('admim.coordenadas.index')}}">Coordenadas Bancárias</a></li>
                    </ul>
                </li>

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('pageHeader')  <a class="datetime"> <?php echo (date('d/m/Y')); ?> </a>
            </h1>
        </section>

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Desenvolvido por <strong> <a href="#">Evandro Silva</a> </strong> e <strong><a href="#">Sandro Cardoso</a></strong>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="{{route('products.showHome')}}">Doriema Lda</a>.</strong> Todos direitos reservados.
    </footer>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab1" data-toggle="tab"><i class="fa fa-fw fa-percent"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-fw fa-dollar"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Configurações Gerais</h3>
                <ul class="control-sidebar-menu">


                    <li>
                        <a href="{{route('admim.users.index')}}">
                            <i class="menu-icon fa fa-users bg-green"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Usuários</h4>
                                <p>Gestão de usuários do sistema</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admim.roles.index')}}">
                            <i class="menu-icon fa fa-lock bg-green"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Funções</h4>
                                <p>Gestão de funções para os usuários do sistema</p>
                            </div>
                        </a>
                    </li>

                </ul>
                <!-- /.control-sidebar-menu -->
            </div>
            <!-- /.tab-pane -->


            @can('Actualizar Taxa de Câmbio')
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <h3 class="control-sidebar-heading">Actualizar taxa de câmbio</h3>

                <div class="form-group">
                    <!-- form start -->
                    <form action="{{route('admim.exchange.update')}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="exampleInputFile" for="exampleInputEmail1" style="color: #fff">Nova taxa</label>
                            <input name="exchange" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nova taxa de câmbio" value="">
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </form>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.tab-pane -->
            @endcan

            @can('Actualizar Taxa de Câmbio')
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab1">
                <h3 class="control-sidebar-heading">Actualizar percentagem de subida ou descida de preços </h3>

                <div class="form-group">
                    <!-- form start -->
                    <form action="{{route('admim.taxa.update')}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="exampleInputFile" for="exampleInputEmail1" style="color: #fff">Percentagem </label>
                            <input name="percent" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nova taxa de câmbio" value="">
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </form>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.tab-pane -->
            @endcan
        </div>
    </aside>
    <!-- /.control-sidebar -->


    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="{{asset('admim/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admim/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admim/dist/js/adminlte.min.js')}}"></script>


    <!-- Select2 -->
    <script src="{{asset('admim/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('admim/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admim/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <!-- FastClick -->
    <script src="{{asset('admim/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admim/dist/js/demo.js')}}"></script>
    <!-- CK Editor -->
    <script src="{{asset('admim/bower_components/ckeditor/ckeditor.js')}}"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('admim/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1')
                //bootstrap WYSIHTML5 - text editor
                $('.textarea').wysihtml5()
            })
        </script>

        <link rel="stylesheet" href="{{asset('admim/dist/css/newStyleSkeBug.css')}}">

        <script src="{{asset('admim/js/province_district.js')}}"></script>
        <script src="{{asset('admim/js/subcategorie_brand.js')}}"></script>


        @if ($plugin==1)
        <!-- jQuery Plugins -->
        <script src="{{asset('site/js/jquery.min.js')}}"></script>
        <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('site/js/slick.min.js')}}"></script>
        <script src="{{asset('site/js/nouislider.min.js')}}"></script>
        <script src="{{asset('site/js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('site/js/main.js')}}"></script>
        @endif

        @stack('scriptsDashboard')
    </body>
    </html>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
            //Date range as a button
            $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

    <!-- page script -->
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>

    @stack('scriptsProducts')
