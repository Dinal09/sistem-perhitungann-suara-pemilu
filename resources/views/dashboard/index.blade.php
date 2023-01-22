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

                <h4 class="page-title">Database Pemilu</h4>
                <p class="text-muted page-title-alt">Selamat Datang Ke Sistem Database Pemilu</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box fadeInDown animated">
                    <div class="bg-icon bg-icon-info pull-left">
                        <i class="md md-people-outline text-info"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['data-umum'] ?></b></h3>
                        <p class="text-muted">Total Data Umum Pemilih</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-pink pull-left">
                        <i class="md md-add-shopping-cart text-pink"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['keluarga'] ?></b></h3>
                        <p class="text-muted">Jumlah Keluarga</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-purple pull-left">
                        <i class="md md-equalizer text-purple"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['simpatisan'] ?></b></h3>
                        <p class="text-muted">Jumlah Simpatisan </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-success pull-left">
                        <i class="md md-remove-red-eye text-success"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['abu-abu'] ?></b></h3>
                        <p class="text-muted">Jumlah Suara Abu-abu</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-success pull-left">
                        <i class="md md-remove-red-eye text-success"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['pengkhianat'] ?></b></h3>
                        <p class="text-muted">Jumlah Pengkhianat</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-success pull-left">
                        <i class="md md-remove-red-eye text-success"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?= $data['total']['daftar-hitam'] ?></b></h3>
                        <p class="text-muted">Jumlah Daftar Hitam</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Bar Chart </h3>
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
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>Series A</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Series B</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Series C</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="morris-bar-example" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>

        </div>
    </div> <!-- container -->
@endsection

@section('add-header')
    {{-- <link href="{{ url('/ubold/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
    <link href="{{ url('/ubold/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/ubold/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />

    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
    <link href="{{ url('/ubold/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('add-footer')
    {{-- <script src="{{ url('/ubold/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ url('/ubold/assets/pages/jquery.form-advanced.init.js') }}"></script> --}}


    <script>
        $('#chart-data-per-kecamatan').change(function() {
            let kec = $(this).val();

        })

        function setDataChart(kec) {
            if (kec == null) {
                kec = 14
            }

            $.post('/dashboard/simpan-target', {
                '_token': '{{ csrf_token() }}',
                id: idDesa,
                target_kunjungan: target
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    location.reload()
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        }
    </script>
@endsection

@section('add-chart-section')
    <!-- Counterup  -->
    <script src="{{ url('/ubold/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ url('/ubold/assets/pages/morris.init.js') }}"></script>
@endsection
