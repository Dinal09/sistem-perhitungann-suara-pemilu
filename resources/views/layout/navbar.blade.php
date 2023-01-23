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
