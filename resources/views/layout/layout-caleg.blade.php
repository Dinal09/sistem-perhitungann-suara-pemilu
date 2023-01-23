<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ url('/ubold/assets/images/favicon_1.ico') }}">

    <title>{{ env('APP_NAME') }} | {{ $title }}</title>
    <!--Morris Chart CSS -->
    <link href="{{ url('/ubold/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
    <link href="{{ url('/ubold/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />

    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
    <link href="{{ url('/ubold/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ url('/ubold/assets/plugins/morris/morris.css') }}">

    <link href="{{ url('/ubold/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ url('/ubold/assets/js/modernizr.min.js') }}"></script>

</head>


<body class="widescreen fixed-left-void">

    <!-- Begin page -->
    <div id="wrapper" class="enlarged forced">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo">
                        <i class="icon-magnet icon-c-logo"></i>
                        <span>DATABASE PEMILU</span>
                    </a>
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                        class="icon-size-fullscreen"></i></a>
                            </li>
                            {{-- <li class="hidden-xs">
                        <a href="#" class="right-bar-toggle waves-effect waves-light"><i
                                class="icon-settings"></i></a>
                    </li> --}}
                            <li class="dropdown top-menu-item-xs">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light"
                                    data-toggle="dropdown" aria-expanded="true">
                                    <img src="{{ asset('storage/data-aplikasi/foto-user/' . Auth::user()->foto) }}"
                                        alt="user-img" class="img-circle">
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i>
                                            Profile</a></li>
                                    <li><a href="/auth/logout"><i class="ti-power-off m-r-10 text-danger"></i>
                                            Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li class="has_sub">
                            <a href="/" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard </span>
                            </a>
                        </li>

                        <li class="text-muted menu-title">Hasil Pemilu</li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="ti-user"></i>
                                <span>Hasil </span>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                @yield('content')

            </div>
            <!-- content -->

            <footer class="footer">
                © 2016. All rights reserved.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <!-- Right Sidebar -->
        <div class="side-bar right-bar nicescroll">
            <h4 class="text-center">Chat</h4>
            <div class="contact-list nicescroll">
                <ul class="list-group contacts-list">
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-1.jpg') }}" alt="">
                            </div> <span class="name">Chadengle</span> <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-2.jpg') }}" alt="">
                            </div> <span class="name">Tomaslau</span> <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-3.jpg') }}" alt="">
                            </div> <span class="name">Stillnotdavid</span> <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-4.jpg') }}" alt="">
                            </div> <span class="name">Kurafire</span> <i class="fa fa-circle online"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-5.jpg') }}" alt="">
                            </div> <span class="name">Shahedk</span> <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-6.jpg') }}" alt="">
                            </div> <span class="name">Adhamdannaway</span> <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-7.jpg') }}" alt="">
                            </div> <span class="name">Ok</span> <i class="fa fa-circle away"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-8.jpg') }}" alt="">
                            </div> <span class="name">Arashasghari</span> <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-9.jpg') }}" alt="">
                            </div> <span class="name">Joshaustin</span> <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <div class="avatar">
                                <img src="{{ url('/ubold/assets/images/users/avatar-10.jpg') }}" alt="">
                            </div> <span class="name">Sortino</span> <i class="fa fa-circle offline"></i>
                        </a>
                        <span class="clearfix"></span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ url('/ubold/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/detect.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/fastclick.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/waves.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/wow.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/jquery.scrollTo.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ url('/ubold/assets/pages/jquery.form-advanced.init.js') }}"></script>

    <script src="{{ url('/ubold/assets/js/jquery.core.js') }}"></script>
    <script src="{{ url('/ubold/assets/js/jquery.app.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ url('/ubold/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/raphael/raphael-min.js') }}"></script>

    @yield('chart-setting')
    {{-- <script src="{{ url('/ubold/assets/pages/morris.init.js') }}"></script> --}}
</body>

</html>
