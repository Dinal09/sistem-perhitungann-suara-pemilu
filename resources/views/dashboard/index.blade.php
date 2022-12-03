@extends('layout.main')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown"
                        aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                    <ul class="dropdown-menu drop-menu-right" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <h4 class="page-title">Dashboard 4</h4>
                <p class="text-muted page-title-alt">Welcome to Ubold admin panel !</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="card-box widget-box-1 bg-white">
                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Last 24 Hours"></i>
                    <h4 class="text-dark">Income status</h4>
                    <h2 class="text-primary text-center">$<span data-plugin="counterup">5623</span></h2>
                    <p class="text-muted">Total income: $22506 <span class="pull-right"><i
                                class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="card-box widget-box-1 bg-white">
                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Last 24 Hours"></i>
                    <h4 class="text-dark">Sales status</h4>
                    <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                    <p class="text-muted">Total sales: 2398 <span class="pull-right"><i
                                class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="card-box widget-box-1 bg-white">
                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Last 24 Hours"></i>
                    <h4 class="text-dark">Income status</h4>
                    <h2 class="text-success text-center">$<span data-plugin="counterup">9562</span></h2>
                    <p class="text-muted">Total income: $22506 <span class="pull-right"><i
                                class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="card-box widget-box-1 bg-white">
                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Last 24 Hours"></i>
                    <h4 class="text-dark">Sales status</h4>
                    <h2 class="text-warning text-center"><span data-plugin="counterup">874</span></h2>
                    <p class="text-muted">Total sales: 2398 <span class="pull-right"><i
                                class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                </div>
            </div>

        </div>

        <!-- BAR Chart -->
        <div class="row">
            <div class="col-lg-6">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Total Revenue </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-default1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #3ac9d6;"></i>Series A</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #f9c851;"></i>Series B</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #ebeff2;"></i>Series C</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="morris-bar-example" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <!-- col -->
            <div class="col-lg-6">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Sales Analytics </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-default" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #4793f5;"></i>Mobiles</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #ff3f4e;"></i>Tablets</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #bbbbbb;"></i>Desktops</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="morris-area-example" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <!-- col -->
        </div>
        <!-- End row-->


        <div class="row">

            <div class="col-lg-12">

                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark text-uppercase">
                            Projects
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet2" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-hover mails m-0 table table-actions-bar">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 95px;">
                                                <div class="checkbox checkbox-primary checkbox-single m-r-15">
                                                    <input id="action-checkbox" type="checkbox">
                                                    <label for="action-checkbox"></label>
                                                </div>
                                                <div class="btn-group dropdown">
                                                    <button type="button"
                                                        class="btn btn-white btn-xs dropdown-toggle waves-effect waves-light"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="caret"></i></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Action</a></li>
                                                        <li><a href="#">Another action</a></li>
                                                        <li><a href="#">Something else here</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#">Separated link</a></li>
                                                    </ul>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Products</th>
                                            <th>Start Date</th>
                                            <th style="min-width: 90px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="active">
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox2" type="checkbox" checked="">
                                                    <label for="checkbox2"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-2.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Tomaslau
                                            </td>

                                            <td>
                                                <a href="#">tomaslau@dummy.com</a>
                                            </td>

                                            <td>
                                                <b><a href="" class="text-dark"><b>356</b></a> </b>
                                            </td>

                                            <td>
                                                01/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-1.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Chadengle
                                            </td>

                                            <td>
                                                <a href="#">chadengle@dummy.com</a>
                                            </td>

                                            <td>
                                                <b><a href="" class="text-dark"><b>568</b></a> </b>
                                            </td>
                                            <td>
                                                01/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox3" type="checkbox">
                                                    <label for="checkbox3"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-3.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Stillnotdavid
                                            </td>

                                            <td>
                                                <a href="#">stillnotdavid@dummy.com</a>
                                            </td>
                                            <td>
                                                <b><a href="" class="text-dark"><b>201</b></a> </b>
                                            </td>

                                            <td>
                                                12/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox4" type="checkbox">
                                                    <label for="checkbox4"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-4.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Kurafire
                                            </td>

                                            <td>
                                                <a href="#">kurafire@dummy.com</a>
                                            </td>

                                            <td>
                                                <b><a href="" class="text-dark"><b>56</b></a> </b>
                                            </td>

                                            <td>
                                                14/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox5" type="checkbox">
                                                    <label for="checkbox5"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-5.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Shahedk
                                            </td>

                                            <td>
                                                <a href="#">shahedk@dummy.com</a>
                                            </td>

                                            <td>
                                                <b><a href="" class="text-dark"><b>356</b></a> </b>
                                            </td>

                                            <td>
                                                20/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-primary m-r-15">
                                                    <input id="checkbox6" type="checkbox">
                                                    <label for="checkbox6"></label>
                                                </div>

                                                <img src="{{ url('/ubold/assets/images/users/avatar-6.jpg') }}"
                                                    alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                            </td>

                                            <td>
                                                Adhamdannaway
                                            </td>

                                            <td>
                                                <a href="#">adhamdannaway@dummy.com</a>
                                            </td>

                                            <td>
                                                <b><a href="" class="text-dark"><b>956</b></a> </b>
                                            </td>

                                            <td>
                                                24/11/2003
                                            </td>
                                            <td>
                                                <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                <a href="#" class="table-action-btn"><i
                                                        class="md md-close"></i></a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div> <!-- container -->
@endsection

@section('add-footer')
    <!-- Counterup  -->
    <script src="{{ url('/ubold/assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/counterup/jquery.counterup.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/raphael/raphael-min.js') }}"></script>

    <script src="{{ url('/ubold/assets/pages/jquery.dashboard_4.js') }}"></script>
@endsection
