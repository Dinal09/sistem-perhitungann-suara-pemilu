@extends('layout.layout-caleg')

@section('content')
    <div class="container">

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

        <!-- BAR Chart -->
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
                        <h3 class="portlet-title text-dark"> Chart <span id="bar-chart-nama"></span> </h3>
                        <a href="javascript:;" id="btn-refresh" data-toggle="reload"></a>
                        <div class="portlet-widgets">
                            <div class="form-group no-margin">
                                <select class="selectpicker" data-live-search="true" data-style="btn-white" name="id_dapil"
                                    id="ubah-dapil" required>
                                    <option>--- Pilih Dapil ---</option>
                                    <?php foreach($dapil as $dap): ?>
                                    <option value={{ $dap->id }}> {{ $dap->nama }} </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-default1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>Simpatisan</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Pengkhianat</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Daftar Hitam</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="morris-bar-example-0" style="height: 300px;display: none"></div>
                            <div id="morris-bar-example-1" style="height: 300px;display: none"></div>
                            <div id="morris-bar-example-2" style="height: 300px;display: none"></div>
                            <div id="morris-bar-example-3" style="height: 300px;display: none"></div>
                            <div id="morris-bar-example-4" style="height: 300px;display: none"></div>
                            <div id="morris-bar-example-5" style="height: 300px;display: none"></div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <div class="col-lg-3">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Total Kunjungan Kecamatan <span
                                id="donut-kunjungan-nama"></span></h3>
                        <a href="javascript:;" id="btn-refresh-donut-kunjungan" data-toggle="reload"></a>
                        {{-- <div class="portlet-widgets"> --}}
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Kecamatan</label>
                            <select class="selectpicker" data-live-search="true" data-style="btn-white"
                                name="id_kecamatan" id="ubah-donut-kunjungan" required>
                                <option>--- Pilih Kecamatan ---</option>
                                <?php foreach($kecamatan as $dap): ?>
                                <optgroup label=" {{ $dap->nama }} ">
                                    <?php foreach ($dap->kecamatan as $kec): ?>
                                    <option value={{ $kec->id }}> {{ $kec->nama }} </option>
                                    <?php endforeach ?>
                                </optgroup>
                                <?php endforeach ?>
                            </select>
                            {{-- </div> --}}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet3" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div id="morris-donut-kunjungan" style="height: 300px;"></div>

                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>Belum Dikunjungai
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Sudah Dikunjungi
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>

            <!-- col -->
            <div class="col-sm-9">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Data Kunjungan kecamatan </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload" id="btn-refresh-stacked-kunjungan"></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-default" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <p>Total Pemilih : <b><span id="total-pemilih-kunjungan-kecamatan"></span></b> Orang</p>
                            <p>Total Target : <b><span id="total-target-kunjungan-kecamatan"></span></b> Orang</p>
                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Sudah Dikunjungi
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Belum Dikunjungi
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="morris-bar-stacked-kunjungan" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
        </div>
        <div class="row">
            <!-- col -->
            <!-- Donut Chart -->
            <div class="col-lg-3">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Donut Chart </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet3" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div id="morris-donut-example" style="height: 300px;"></div>

                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>In-Store Sales</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Mail-Order Sales
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Download Sales</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <div class="col-lg-3">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Donut Chart </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet3" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div id="morris-donut-example" style="height: 300px;"></div>

                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>In-Store Sales</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Mail-Order Sales
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Download Sales</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <div class="col-lg-3">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Donut Chart </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet3" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div id="morris-donut-example" style="height: 300px;"></div>

                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>In-Store Sales</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Mail-Order Sales
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Download Sales</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
            <div class="col-lg-3">
                <div class="portlet">
                    <!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark"> Donut Chart </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i
                                    class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet3" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div id="morris-donut-example" style="height: 300px;"></div>

                            <div class="text-center">
                                <ul class="list-inline chart-detail-list">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>In-Store Sales</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Mail-Order Sales
                                        </h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Download Sales</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Portlet -->
            </div>
        </div>
        <!-- End row-->

    </div>
@endsection

@section('chart-setting')
    <script>
        let barChartData = [];
        let donutChartKunjungan = [];
        let stackedChartKunjungan = [];

        function setBarChartData(id) {
            $('#btn-refresh').click()

            $.get('/dashboard-caleg/bar-chart-data/' + id, {
                dataId: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    console.log(result.data)
                    barChartData = [];

                    for (let c = 0; c < 6; c++) {
                        $('#morris-bar-example-' + c).empty()
                    }
                    for (let d = 0; d < 6; d++) {
                        $('#morris-bar-example-' + d).css('display', 'none')
                    }

                    $('#bar-chart-nama').html(result.nama)

                    for (let a = 0; a < result.data.length; a++) {
                        barChartData.push(result.data[a])
                        $('#morris-bar-example-' + a).css('display', 'block')
                    }

                    $.MorrisChartsBar.init();
                } else {
                    console.log(result.pesan)
                }
            })
        }

        function setDataKunjunganDonut(id) {
            $('#btn-refresh-donut-kunjungan').click()
            $('#btn-refresh-stacked-kunjungan').click()

            $.get('/dashboard-caleg/data-kunjungan-per-kecamatan/' + id, {
                dataId: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    console.log(result)
                    donutChartKunjungan = [];

                    $('#morris-donut-kunjungan').empty()
                    $('#donut-kunjungan-nama').html(result.nama)

                    $('#total-pemilih-kunjungan-kecamatan').html(result.total_pemilih)
                    $('#total-target-kunjungan-kecamatan').html(result.total_target)

                    donutChartKunjungan = result.data.donut
                    stackedChartKunjungan = result.data.stacked

                    $.MorrisChartsDonutKunjungan.init();
                } else {
                    console.log(result.pesan)
                }
            })
        }

        setBarChartData(9);
        setDataKunjunganDonut(1);

        $('#ubah-dapil').change(function() {
            let id = $(this).val();
            setBarChartData(id)
        })
        $('#ubah-donut-kunjungan').change(function() {
            let id = $(this).val();
            setDataKunjunganDonut(id);
        })
    </script>
    <script>
        ! function($) {
            "use strict";

            var MorrisChartsBar = function() {};
            var MorrisChartsDonutKunjungan = function() {};

            MorrisChartsBar.prototype.createBarChart = function(element, data, xkey, ykeys, labels, lineColors) {
                    Morris.Bar({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        labels: labels,
                        hideHover: 'auto',
                        resize: true, //defaulted to true
                        gridLineColor: '#eeeeee',
                        barColors: lineColors
                    });
                },
                MorrisChartsBar.prototype.init = function() {

                    for (let b = 0; b < barChartData.length; b++) {
                        this.createBarChart('morris-bar-example-' + b, barChartData[b], 'y', ['a', 'b', 'c'], [
                            'Simpatisan',
                            'Pengkhianat',
                            'Daftar Hitam'
                        ], ['#5fbeaa', '#5d9cec', '#ebeff2']);
                    }

                },
                $.MorrisChartsBar = new MorrisChartsBar, $.MorrisChartsBar.Constructor = MorrisChartsBar


            //creates Donut chart
            MorrisChartsDonutKunjungan.prototype.createDonutChart = function(element, data, colors) {
                    Morris.Donut({
                        element: element,
                        data: data,
                        resize: true, //defaulted to true
                        colors: colors
                    });
                },
                //creates Stacked chart
                MorrisChartsDonutKunjungan.prototype.createStackedChart = function(element, data, xkey, ykeys, labels,
                    lineColors) {
                    Morris.Bar({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        stacked: true,
                        labels: labels,
                        hideHover: 'auto',
                        resize: true, //defaulted to true
                        gridLineColor: '#eeeeee',
                        barColors: lineColors
                    });
                },
                MorrisChartsDonutKunjungan.prototype.init = function() {
                    this.createDonutChart('morris-donut-kunjungan', donutChartKunjungan, ['#ebeff2', '#5fbeaa']);
                    this.createStackedChart('morris-bar-stacked-kunjungan', stackedChartKunjungan, 'y', ['a', 'b'], [
                        'Sudah Dikunjungi',
                        'Belum Dikunjungi'
                    ], [
                        '#5d9cec', '#ebeff2'
                    ]);
                },

                $.MorrisChartsDonutKunjungan = new MorrisChartsDonutKunjungan, $.MorrisChartsDonutKunjungan.Constructor =
                MorrisChartsDonutKunjungan
            //init
        }(window.jQuery);
    </script>
@endsection
