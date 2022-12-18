@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Tabel {{ $title }} </b></h4>
                            <p class="text-muted font-13 m-b-30">
                                {{ $explain }}</code>.
                            </p>
                            <a href="#custom-modal-tambah" class="btn btn-primary btn-rounded waves-effect waves-light m-b-20"
                                data-toggle="modal" data-target="#modal-tambah">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                Tambah Data
                            </a>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>TTL</th>
                                        <th>No HP</th>
                                        <th>TPS</th>
                                        <th>Desa</th>
                                        <th>Kecamatan</th>
                                        <th>Dapil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $idx => $d): ?>
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
                                                <button class="btn btn-warning waves-effect btn-ubah-password"
                                                    data-id="{{ $d->id }}" data-toggle="modal"
                                                    data-target="#modal-password" title="Ubah Password"><i
                                                        class="ti-key"></i></button>
                                                <a href="/<?= $link ?>/hapus/{{ $d->id }}"
                                                    class="btn btn-danger waves-effect ladda-button"
                                                    data-style="slide-right" title="Hapus Data"><i class="ti-trash"></i></a>
                                            </div>
                                        </td>
                                        <td> {{ $d->no_nik }} </td>
                                        <td> {{ $d->nama }} </td>
                                        <td> {{ $d->tempat_lahir . ', ' . date('d M Y', strtotime($d->tanggal_lahir)) }}
                                        </td>
                                        <td> {{ $d->no_hp }} </td>
                                        <td> {{ isset($d->tps->nama) ? $d->tps->nama : 'Belum Dipilih' }} </td>
                                        <td> {{ isset($d->tps->desa->nama) ? $d->tps->desa->nama : 'Belum Dipilih' }} </td>
                                        <td> {{ isset($d->tps->desa->kecamatan->nama) ? $d->tps->desa->kecamatan->nama : 'Belum Dipilih' }}
                                        </td>
                                        <td> {{ isset($d->tps->desa->kecamatan->dapil->nama) ? $d->tps->desa->kecamatan->dapil->nama : 'Belum Dipilih' }}
                                        </td>
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
                                                            placeholder="Masukkan Nomor NIK" minlength="16" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor KK (Kartu
                                                            keluarga)</label>
                                                        <input type="text" class="form-control" name="no_kk"
                                                            placeholder="Masukkan Nomor KK" minlength="16" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            placeholder="Masukkan Nama" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="tempat_lahir"
                                                            placeholder="Masukkan Tempat Lahir" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir"
                                                            placeholder="Masukkan Tanggal Lahir" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor Telepon</label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            placeholder="Masukkan nomor telepon {{ $title }}"
                                                            minlength="11" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Alamat</label>
                                                        <textarea class="form-control autogrow" name="alamat" placeholder="Masukkan alamat {{ $title }}"
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
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
                                                                name="foto" data-buttonname="btn-white" required>
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KTP</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_ktp" data-buttonname="btn-white" required>
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KK</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_kk" data-buttonname="btn-white" required>
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
                                                            minlength="16" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor KK (Kartu
                                                            keluarga)</label>
                                                        <input type="text" class="form-control" name="no_kk"
                                                            id="ubah-no_kk" placeholder="Masukkan Nomor KK"
                                                            minlength="16" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            id="ubah-nama" placeholder="Masukkan Nama" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="tempat_lahir"
                                                            id="ubah-tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                                            required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir"
                                                            id="ubah-tanggal_lahir" placeholder="Masukkan Tanggal Lahir"
                                                            required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Nomor Telepon</label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            id="ubah-no_hp"
                                                            placeholder="Masukkan nomor telepon {{ $title }}"
                                                            minlength="11" required>
                                                    </div>
                                                    <div class="form-group no-margin">
                                                        <label for="field-7" class="control-label">Alamat</label>
                                                        <textarea class="form-control autogrow" id="ubah-alamat" name="alamat"
                                                            placeholder="Masukkan alamat {{ $title }}"
                                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
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
                                                                name="foto" data-buttonname="btn-white" required>
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KTP</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_ktp" data-buttonname="btn-white" required>
                                                            <sup>* File Dengan Extensi .jpg, .png, dengan ukuran maksimal
                                                                2Mb</sup>
                                                        </div>
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Foto KK</label>
                                                            <input type="file" accept=".jpg,.png" class="filestyle"
                                                                name="foto_kk" data-buttonname="btn-white" required>
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
                    <h4 class="modal-title" id="myModalLabel">Ubah Foto {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <div class="profile-detail card-box">
                        <div>
                            <img src="assets/images/users/avatar-2.jpg" id="lihat-data-foto" class="img-circle"
                                alt="profile-image">
                            <ul class="list-inline status-list m-t-20">
                                <li>
                                    <h3 class="text-primary m-b-5">456</h3>
                                    <p class="text-muted">Dapil</p>
                                </li>
                                <li>
                                    <h3 class="text-success m-b-5">5864</h3>
                                    <p class="text-muted">Kecamatan</p>
                                </li>
                                <li>
                                    <h3 class="text-success m-b-5">5864</h3>
                                    <p class="text-muted">Desa</p>
                                </li>
                                <li>
                                    <h3 class="text-success m-b-5">5864</h3>
                                    <p class="text-muted">TPS</p>
                                </li>
                            </ul>
                            <hr>
                            <div class="text-left">
                                <table>
                                    <tr>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>Nama</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>Nomor KK</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>TTL</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>Nomor NIK</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>Alamat</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                        <td style="width: 15%">
                                            <p class="text-muted font-13"><strong>Nomor HP</strong></p>
                                        </td>
                                        <td style="width: 35%">
                                            <p class="text-muted font-13"><span class="m-l-15">: Johnathan
                                                    Deo</span></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
    <link href="{{ url('/ubold/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

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
    <script src="{{ url('/ubold/assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

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
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })


        $('.btn-lihat-data').click(function() {
            let id = $(this).data('id')

            $.post('/data-umum/get-foto-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#lihat-data-foto').attr('src', result.foto)
                    $('#ubah-foto-id').val(result.data.id)
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })

        $('.btn-ubah-password').click(function() {
            let id = $(this).data('id')

            $.post('/pengguna/get-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#ubah-password-id').val(result.data.id)
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })
    </script>
@endsection
