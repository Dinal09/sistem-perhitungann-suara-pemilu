@extends('layout.main')

@section('content')
    <?php
    $color = ['bg-info', 'bg-warning', 'bg-pink', 'bg-success', 'bg-primary', 'bg-danger', 'bg-purple', 'bg-inverse'];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-border panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pilih Kecamatan</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Kecamatan</label>
                            <select class="selectpicker" data-live-search="true" data-style="btn-white" name="id_kecamatan"
                                id="ubah-id-kecamatan" required>
                                <option>--- Pilih Kecamatan ---</option>
                                <?php foreach($dapil as $dap): ?>
                                <optgroup label=" {{ $dap->nama }} ">
                                    <?php foreach ($dap->kecamatan as $kec): ?>
                                    <option value={{ $kec->id }}> {{ $kec->nama }} </option>
                                    <?php endforeach ?>
                                </optgroup>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach($kecamatan as $idx => $kec): ?>
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-heading bg-inverse">
                        <h3 class="portlet-title">
                            KECAMATAN {{ $kec->nama }}
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 row">
                <?php
                    $idxColor = 0;
                    $idxLogo = 1;
                    foreach($kec->desa as $des):
                 ?>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon <?= $color[$idxColor] ?> btn-ubah" data-id="{{ $des->id }}"
                            data-toggle="modal" data-target="#modal-edit">
                            <i class="md-filter-<?= $idxLogo ?> text-white"></i>
                        </span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark"
                                data-plugin="counterup"><?= is_null($des->jumlah_penduduk) ? 0 : $des->jumlah_penduduk ?></span>
                            <?= $des->nama ?>
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase">Target<span
                                        class="pull-right"><?= $persen[$idx][$des->id]['kunjungan'] ?>/<?= is_null($des->target_kunjungan) ? 0 : $des->target_kunjungan ?></span>
                                </h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar"
                                        aria-valuenow="<?= $persen[$idx][$des->id]['persen'] ?>" aria-valuemin="0"
                                        aria-valuemax="100" style="width: <?= $persen[$idx][$des->id]['persen'] ?>%">
                                        <span class="sr-only"><?= $persen[$idx][$des->id]['persen'] ?>% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $idxColor++;
                    $idxLogo++;
                    if($idxColor >= count($color)){
                        $idxColor = 0;
                    }
                    if($idxLogo >= 9){
                        $idxLogo = 1;
                    }
                    endforeach
                ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>

    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" style="cursor: pointer;" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Data Kunjungan Desa <span id="nama-desa"></span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Target Kunjungan</label>
                            <div class="col-md-8">
                                <input type="hidden" id="id_desa">
                                <input type="number" id="target-kunjungan" class="form-control"
                                    placeholder="Masukkan Jumlah Target Kunjungan">
                            </div>
                            <button type="button" onclick="simpanTargetKunjungan()" class="ladda-button btn btn-primary"
                                data-style="expand-left">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('add-header')
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
@endsection

@section('add-footer')
    <script src="{{ url('/ubold/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    {{-- <script src="{{ url('/ubold/assets/plugins/autocomplete/jquery.mockjax.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/autocomplete/countries.js') }}"></script>
    <script src="{{ url('/ubold/assets/pages/autocomplete.js') }}"></script> --}}

    <script src="{{ url('/ubold/assets/pages/jquery.form-advanced.init.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/moment/moment.js') }}"></script>

    <!-- jQuery  -->
    <script src="{{ url('/ubold/assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/counterup/jquery.counterup.min.js') }}"></script>

    <!-- skycons -->
    <script src="{{ url('/ubold/assets/plugins/skyicons/skycons.min.js') }}" type="text/javascript"></script>

    <script src="{{ url('/ubold/assets/plugins/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/pages/jquery.widgets.js') }}"></script>

    <!-- Todojs  -->
    <script src="{{ url('/ubold/assets/pages/jquery.todo.js') }}"></script>

    <!-- chatjs  -->
    <script src="{{ url('/ubold/assets/pages/jquery.chat.js') }}"></script>

    <!-- Knob -->
    <script src="{{ url('/ubold/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script>
        $('#ubah-id-kecamatan').change(function() {
            let kec = $(this).val()
            window.location.href = '/data-kunjungan/' + kec
        })

        $('.btn-ubah').click(function() {
            let id = $(this).data('id')
            console.log(id)

            $.post('/data-kunjungan/get-penduduk?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#target-kunjungan').val(result.data.target_kunjungan)
                    $('#id_desa').val(result.data.id)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        })

        function simpanTargetKunjungan() {
            let idDesa = $('#id_desa').val()
            let target = $('#target-kunjungan').val()

            $.post('/data-kunjungan/simpan-target', {
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
