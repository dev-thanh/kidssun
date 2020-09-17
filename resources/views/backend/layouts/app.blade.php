<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ getOptions('dev-config', 'title') }}</title>
    <link rel="shortcut icon" href="{{ getOptions('dev-config', 'favicon') }}">
    <meta name="robots" content="index, follow">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">


    <link rel="stylesheet" href="{{ url('public/backend/plugins/datepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ url('public/backend/plugins/iconpicker/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/backend/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ url('public/backend/dist/css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

     <!-- My style -->
    <link href="{{ url('public/upimgs/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/upimgs/themes/explorer/theme.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="{{ url('public/backend/cus/mystyle.css') }}">
    <script type="text/javascript">
        function homeUrl() {
            return "{!! url('/') !!}";
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('public/backend/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/backend/plugins/ckfinder/ckfinder.js') }}"></script>

    @yield('css')

    <style>
        .box.box-primary {
             border-top-color: #d2d6de; 
        }
    </style>
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo" target="_blank">
                <b>Xem Website</b>
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
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                @if (!empty( Auth::user()->image ))
                                     <img src="{{ Auth::user()->image }}"
                                     class="user-image" alt="User Image"/>
                                    
                                @else
                                    <img src="http://infyom.com/images/logo/blue_logo_150x150.jpg"
                                     class="user-image" alt="User Image"/>
                                @endif
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header" style="height: 130px">
                                    @if (!empty( Auth::user()->image ))
                                         <img src="{{ Auth::user()->image }}"
                                         class="user-image" alt="User Image"/>
                                        
                                    @else
                                        <img src="http://infyom.com/images/logo/blue_logo_150x150.jpg"
                                         class="user-image" alt="User Image"/>
                                    @endif
                                    <p>
                                        {{ Auth::user()->name }}
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer" style="background: #3c8dbc">
                                    <div class="pull-left">
                                        <a href="{{ route('users.edit', Auth::user()->id ) }}" class="btn btn-default btn-flat">Thông tin</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); check();">
                                            Đăng xuất
                                        </a>

                                        <script>
                                            function check(){
                                                var check = confirm('Bạn có chắc chắn muốn đăng xuất ?');
                                                if(check == true){
                                                    document.getElementById('logout-form').submit();
                                                }
                                                return false;
                                                
                                            }
                                        </script>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('backend.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(URL::current() != url('backend/home'))
                <section class="content-header">
                    <h1>
                        <a href="@yield('controller_route')">@yield('controller')</a>
                        <small>@yield('action')</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{!! url('backend/home') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="@yield('controller_route')">@yield('controller')</a></li>
                        <li class="active">@yield('action')</li>
                    </ol>
                </section>
            @endif
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                    Admin
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    
    <script src="{{ url('public/upimgs/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/upimgs/js/vi.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/upimgs/themes/explorer/theme.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/backend/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ url('public/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('public/backend/plugins/datepicker/moment.min.js') }}"></script>
    <script src="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('public/backend/plugins/iconpicker/fontawesome-iconpicker.min.js') }}"></script>
    <script src="{{ url('public/backend/plugins/datepicker/daterangepicker.js') }}"></script>
    <script src="{!! asset('public/tinymce/tinymce.min.js') !!}"></script>
    <script src="{{ url('public/backend/dist/js/jquery.toast.min.js') }}"></script>
    <script src="{{ url('public/backend/cus/myscript.js') }}"></script>
    <!-- My Script -->
    <script src="{{ url('public/backend/cus/jquery.nestable.js') }}"></script>
    @yield('scripts')

    @include('backend.layouts.modal-confim-delete')
</body>
</html>