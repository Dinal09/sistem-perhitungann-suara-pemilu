@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-box" style="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Tabel {{ $title }} </b></h4>
                            <p class="text-muted font-13 m-b-15">
                                {{ $explain }}</code>.
                            </p>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#custom-modal-tambah"
                                        class="btn btn-primary btn-rounded waves-effect waves-light m-b-20"
                                        id="btn-tambah-pemilih">
                                        <span class="btn-label"><i class="fa fa-plus"></i></span>
                                        Tambah Data
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group no-margin">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-white"
                                            name="id_desa" id="filter-desa" required>
                                            <option value="all" <?= $filter_id == 'all' ? 'selected' : '' ?>>Semua Desa
                                            </option>
                                            <?php foreach($selectDesa as $dap): ?>
                                            <optgroup label=" {{ $dap->nama }} ">
                                                <?php foreach ($dap->desa as $des): ?>
                                                <option value={{ $des->id }}
                                                    <?= $filter_id == $des->id ? 'selected' : '' ?>>
                                                    {{ $des->nama }} </option>
                                                <?php endforeach ?>
                                            </optgroup>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Desa</th>
                                        <th>Nama</th>
                                        <th>Umur</th>
                                        <th>No HP</th>
                                        <th>TPS</th>
                                        <th>Jenis</th>
                                        <th>Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $idx => $d): ?>
                                    <?php
                                    $tgl = '';
                                    if (!is_null($d->tanggal_lahir)) {
                                        $tgl = date('m.d.Y', strtotime($d->tanggal_lahir));
                                        $lahir = DateTime::createFromFormat('m.d.Y', $tgl);
                                        $sekarang = DateTime::createFromFormat('m.d.Y', date('m.d.Y'));
                                        $umur = $sekarang->diff($lahir);
                                    }
                                    $jenis = [];
                                    $jenis[0] = '-';
                                    if ($d->is_keluarga != 'tidak') {
                                        if ($d->is_keluarga == 'keluarga-mendukung') {
                                            $jenis[0] = 'Keluarga | Mendukung';
                                            $jenis[1] = 'primary';
                                        } else {
                                            $jenis[0] = 'Keluarga | Tidak Mendukung';
                                            $jenis[1] = 'warning';
                                        }
                                    } elseif ($d->is_simpatisan == 'iya') {
                                        $jenis[0] = 'Simpatisan';
                                        $jenis[1] = 'success';
                                    } elseif ($d->is_pengkhianat == 'iya') {
                                        $jenis[0] = 'Pengkhianat';
                                        $jenis[1] = 'danger';
                                    } elseif ($d->is_daftar_hitam == 'iya') {
                                        $jenis[0] = 'Daftar Hitam';
                                        $jenis[1] = 'inverse';
                                    } elseif (!is_null($d->id_suara_abu)) {
                                        $jenis[0] = 'Suara Abu-abu';
                                        $jenis[1] = 'default';
                                    } ?>

                                    <tr>
                                        <td>
                                            <div class="btn-group m-b-20">
                                                <button class="btn btn-info waves-effect btn-ubah"
                                                    data-id="{{ $d->id }}" data-toggle="modal"
                                                    data-target="#modal-edit" title="Ubah Data"><i
                                                        class="ti-pencil-alt"></i></button>
                                                <button class="btn btn-success waves-effect btn-lihat-data"
                                                    data-id="{{ $d->id }}" data-toggle="modal"
                                                    data-target="#modal-lihat" title="Lihat Detail Pemilih"><i
                                                        class="ti-eye"></i></button>
                                                <button class="btn btn-warning waves-effect btn-pilih-tps"
                                                    data-id="{{ $d->id }}" title="Pilih TPS"><i
                                                        class="ti-map-alt"></i></button>
                                                <a href="/<?= $link ?>/hapus/{{ $d->id }}"
                                                    class="btn btn-danger waves-effect ladda-button"
                                                    data-style="slide-right" title="Hapus Data"><i class="ti-trash"></i></a>
                                            </div>
                                        </td>
                                        <td> {{ isset($d->desa->nama) ? $d->desa->nama : '-' }} </td>
                                        <td> {{ $d->nama }} </td>
                                        <td> {{ $tgl != '' ? $umur->y . ' Tahun' : '-' }}
                                        </td>
                                        <td> {{ $d->no_hp }} </td>
                                        <td> {{ isset($d->tps->nama) ? $d->tps->nama : '-' }} </td>
                                        <td><span
                                                class="label label-{{ isset($jenis[1]) ? $jenis[1] : 'white' }}">{{ $jenis[0] }}
                                            </span></td>
                                        <td><span
                                                class="label label-{{ $d->is_kunjungan == 'sudah' ? 'primary' : 'danger' }}">
                                                {{ $d->is_kunjungan == 'sudah' ? 'Sudah' : 'Belum' }} </span></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah {{ $title }} </h4>
                </div>
                <div class="modal-body pt-0">
                    <form action="/<?= $link ?>/tambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="portlet">
                                        <div class="portlet-heading bg-custom">
                                            <h3 class="portlet-title">
                                                Data Pemilih
                                            </h3>
                                            <div class="portlet-widgets">
                                                <a data-toggle="collapse" data-parent="#accordion1"
                                                    href="#panel-tambah-data"><i class="ion-minus-round"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="panel-tambah-data" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div class="col-md-12">
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor NIK (Nomor Induk
                                                            Kependudukan)</label>
                                                        <input type="text" class="form-control" name="no_nik"
                                                            placeholder="Masukkan Nomor NIK" minlength="16">
                                                        <input type="hidden" name="id_desa" id="id_desa_tambah"
                                                            value="<?= $filter_id ?>">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor KK (Kartu
                                                            keluarga)</label>
                                                        <input type="text" class="form-control" name="no_kk"
                                                            placeholder="Masukkan Nomor KK" minlength="16">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nama <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <input type="text" class="form-control" name="nama"
                                                            placeholder="Masukkan Nama" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="tempat_lahir"
                                                            placeholder="Masukkan Tempat Lahir">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir"
                                                            placeholder="Masukkan Tanggal Lahir">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor Telepon <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            placeholder="Masukkan nomor telepon {{ $title }}"
                                                            minlength="11" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Alamat <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <textarea class="form-control autogrow" name="alamat" placeholder="Masukkan alamat {{ $title }}"
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <div class="checkbox checkbox-primary">
                                                            <input id="checkbox2" type="checkbox" value="iya"
                                                                name="is_kunjungan[]">
                                                            <label for="checkbox2">
                                                                Sudah Dikunjungi
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="portlet">
                                                <div class="portlet-heading bg-custom">
                                                    <h3 class="portlet-title">
                                                        Data Berkas Pemilih
                                                    </h3>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion1"
                                                            href="#panel-tambah-berkas">
                                                            <i class="ion-minus-round"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="panel-tambah-berkas" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KTP</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_ktp" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KK</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_kk" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <img src="{{ url('/image/ilustrator-1.png') }}" alt=""
                                                style="width: 100%; height: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Simpan
                            </button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    {{-- Modal Ubah --}}
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Ubah Data {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="portlet">
                                        <div class="portlet-heading bg-custom">
                                            <h3 class="portlet-title">
                                                Data Pemilih
                                            </h3>
                                            <div class="portlet-widgets">
                                                <a data-toggle="collapse" data-parent="#accordion1"
                                                    href="#panel-ubah-data"><i class="ion-minus-round"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="panel-ubah-data" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div class="col-md-12">
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor NIK (Nomor Induk
                                                            Kependudukan)</label>
                                                        <input type="text" class="form-control" name="no_nik"
                                                            id="ubah-no_nik" placeholder="Masukkan Nomor NIK"
                                                            minlength="16">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor KK (Kartu
                                                            keluarga)</label>
                                                        <input type="text" class="form-control" name="no_kk"
                                                            id="ubah-no_kk" placeholder="Masukkan Nomor KK"
                                                            minlength="16">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nama <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <input type="text" class="form-control" name="nama"
                                                            id="ubah-nama" placeholder="Masukkan Nama" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="tempat_lahir"
                                                            id="ubah-tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir"
                                                            id="ubah-tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor Telepon <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            id="ubah-no_hp"
                                                            placeholder="Masukkan nomor telepon {{ $title }}"
                                                            minlength="11" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Alamat <sup
                                                                style="color: red">* Wajib
                                                                Diisi</sup></label>
                                                        <textarea class="form-control autogrow" id="ubah-alamat" name="alamat"
                                                            placeholder="Masukkan alamat {{ $title }}"
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" value="iya" name="is_kunjungan[]"
                                                                id="ubah-is_kunjungan">
                                                            <label for="checkbox2">
                                                                Sudah Dikunjungi
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="portlet">
                                                <div class="portlet-heading bg-custom">
                                                    <h3 class="portlet-title">
                                                        Data Berkas Pemilih
                                                    </h3>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion1"
                                                            href="#panel-ubah-berkas"><i class="ion-minus-round"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="panel-ubah-berkas" class="panel-collapse collapse">
                                                    <div class="portlet-body">
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KTP</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_ktp" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KK</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_kk" data-buttonname="btn-white">
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <img src="{{ url('/image/ilustrator-2.png') }}" alt=""
                                                style="width: 100%; height: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Data --}}
    <div id="modal-lihat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Lihat {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <div class="widget-profile-one">
                        <div class="card-box m-b-0 b-0 bg-primary p-lg text-center">
                            <div class="m-b-30">
                                <input type="hidden" id="lihat-data-id">
                                <h3 class="text-white m-b-5" id="lihat-data-nama"></h3>
                                <small id="lihat-data-ttl"></small>
                            </div>
                            <img id="lihat-data-foto" src="" class="img-circle thumb-lg" alt="profile">
                            <div class="m-t-10">
                                <span><b>TPS</b> <span id="lihat-data-tps"></span> </span> |
                                <span><b>Desa</b> <span id="lihat-data-desa"></span> </span> |
                                <span><b>Kecamatan</b> <span id="lihat-data-kecamatan"></span> </span> |
                                <span><b>Dapil</b> <span id="lihat-data-dapil"></span> </span>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6"><b>Nomor KK</b></div>
                                <div class="col-lg-6 text-right mb-2" id="lihat-data-nomor-kk"></div>
                                <div class="col-lg-6"><b>Nomor NIK</b></div>
                                <div class="col-lg-6 text-right mb-2" id="lihat-data-nomor-nik"></div>
                                <div class="col-lg-6"><b>Nomor HP</b></div>
                                <div class="col-lg-6 text-right mb-2" id="lihat-data-nomor-hp"></div>
                                <div class="col-lg-6"><b>Alamat</b></div>
                                <div class="col-lg-6 text-right mb-2" id="lihat-data-nomor-alamat"></div>
                            </div>
                            <hr>
                            <div class="roe">
                                <button type="button" class="btn btn-success waves-effect waves-light col-lg-6 m-1"
                                    onclick="lihatKtp()" data-toggle="modal" data-target="#modal-lihat-foto">Lihat
                                    Foto
                                    KTP</button>
                                <button type="button" class="btn btn-info waves-effect waves-light col-lg-6 m-1"
                                    onclick="lihatKk()" data-toggle="modal" data-target="#modal-lihat-foto">Lihat
                                    Foto
                                    KK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Pilih TPS --}}
    <div id="modal-pilih-tps" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Pilih TPS {{ $title }}</h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-7" class="control-label">Kecamatan</label>
                                    <input type="hidden" id="pilih-tps-id" name="id">
                                    <select class="selectpicker" data-live-search="true" data-style="btn-white"
                                        id="id_tps" name="id_tps" required>
                                        <option selected>--- Pilih TPS ---</option>
                                        <?php foreach ($tps as $t): ?>
                                        <option value={{ $t->id }}> {{ $t->nama }} </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Foto --}}
    <div id="modal-lihat-foto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Lihat Foto</h4>
                </div>
                <div class="modal-body pt-0">
                    <div class="modal-body">
                        <img src="" id="lihat-foto-foto" alt="" style="width: 100%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    {{-- Modal Ubah Password --}}
    <div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Ubah Password {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <input type="hidden" id="ubah-password-id" name="id">
                                        <label for="field-7" class="control-label">Password Baru</label>
                                        <input type="password" class="form-control" id="ubah-password-baru"
                                            name="password" placeholder="Masukkan password {{ $title }} Baru"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Tutup</button>
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

    <link href="{{ url('/ubold/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('/ubold/assets/plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
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

    <script src="{{ url('/ubold/assets/pages/jquery.form-advanced.init.js') }}"></script>

    <script src="{{ url('/ubold/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.colVis.js') }}"></script>
    <script src="{{ url('/ubold/assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>

    <script src="{{ url('/ubold/assets/pages/datatables.init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
                keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            var table = $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();

        $('.btn-ubah').click(function() {
            let id = $(this).data('id')

            $.post('/data-umum/get-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#ubah-nama').val(result.data.nama)
                    $('#ubah-no_kk').val(result.data.no_kk)
                    $('#ubah-no_nik').val(result.data.no_nik)
                    $('#ubah-tempat_lahir').val(result.data.tempat_lahir)
                    $('#ubah-tanggal_lahir').val(result.data.tanggal_lahir)
                    $('#ubah-alamat').val(result.data.alamat)
                    $('#ubah-no_hp').val(result.data.no_hp)
                    $('#ubah-id').val(result.data.id)

                    if (result.data.is_kunjungan == 'sudah') {
                        $('#ubah-is_kunjungan').attr('checked', true)
                    }
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        })


        $('.btn-lihat-data').click(function() {
            let id = $(this).data('id')

            $.post('/data-umum/get-data-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                    $('#lihat-data-foto').attr('src', result.foto)
                    $('#lihat-data-nama').html(result.data.nama)
                    $('#lihat-data-tps').html((result.hasOwnProperty('tps')) ? result.data.tps
                        .nama : '-')
                    $('#lihat-data-desa').html((result.hasOwnProperty('desa')) ? result.data.tps.desa.nama :
                        '-')
                    $('#lihat-data-kecamatan').html((result.hasOwnProperty('kecamatan')) ? result.data.tps
                        .desa.kecamatan.nama : '-')
                    $('#lihat-data-dapil').html((result.hasOwnProperty('dapil')) ? result.data.tps.desa
                        .kecamatan.dapil.nama : '-')
                    $('#lihat-data-ttl').html(result.data.tempat_lahir + ', ' + result.data.tanggal_lahir)

                    $('#lihat-data-nomor-kk').html(result.data.no_kk)
                    $('#lihat-data-nomor-nik').html(result.data.no_nik)
                    $('#lihat-data-nomor-hp').html(result.data.no_hp)
                    $('#lihat-data-alamat').html(result.data.alamat)

                    $('#lihat-data-id').val(result.data.id)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        })


        function lihatKtp() {
            let idLihat = $('#lihat-data-id').val()
            console.log(idLihat)
            $.post('/data-umum/get-foto-by-id?id=' + idLihat + '&jenis=ktp', {
                '_token': '{{ csrf_token() }}',
                idJenis: idLihat
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#lihat-foto-foto').attr('src', result.foto)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        }

        function lihatKk() {
            let idLihat = $('#lihat-data-id').val()
            console.log(idLihat)
            $.post('/data-umum/get-foto-by-id?id=' + idLihat + '&jenis=kk', {
                '_token': '{{ csrf_token() }}',
                idJenis: idLihat
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#lihat-foto-foto').attr('src', result.foto)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        }

        $('#filter-desa').change(function() {
            let id = $(this).val()

            window.location.href = '/data-umum/' + id
        })

        $('#btn-tambah-pemilih').click(function(event) {
            event.preventDefault();

            let id_desa = $('#id_desa_tambah').val()
            if (id_desa == 'all') {
                $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                    "Pilih Desa Terlebih Dahulu Sebelum Menambah Pemilih"
                )
            } else {
                $('#modal-tambah').modal('show')
            }
        })


        $('.btn-pilih-tps').click(function(event) {
            event.preventDefault();

            let id = $(this).data('id')

            let id_desa = $('#id_desa_tambah').val()
            if (id_desa == 'all') {
                $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                    "Pilih Desa Terlebih Dahulu Sebelum Menambah Pemilih"
                )
            } else {
                $('#modal-pilih-tps').modal('show')

                $.post('/data-umum/get-by-id?id=' + id, {
                    '_token': '{{ csrf_token() }}',
                    idJenis: id
                }).done(function(output) {
                    let result = $.parseJSON(output);
                    if (result.kode == 200) {
                        $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                            result.pesan
                        )

                        if (result.data.tps != null) {
                            $('#id_tps').val(result.data.tps.id).trigger('change')
                        } else {
                            $('#id_tps').val('').trigger('change')
                        }
                        $('#pilih-tps-id').val(result.data.id)
                    } else {
                        $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                            result.pesan
                        )
                    }
                })
            }
        })
    </script>
@endsection
