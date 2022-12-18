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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No. Telepon</th>
                                        <th>Alamat</th>
                                        <th>Role</th>
                                        <th>Tanggal</th>
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
                                                <button class="btn btn-success waves-effect btn-ubah-foto"
                                                    data-id="{{ $d->id }}" data-toggle="modal"
                                                    data-target="#modal-foto" title="Ubah Foto"><i
                                                        class="ti-camera"></i></button>
                                                <button class="btn btn-warning waves-effect btn-ubah-password"
                                                    data-id="{{ $d->id }}" data-toggle="modal"
                                                    data-target="#modal-password" title="Ubah Password"><i
                                                        class="ti-key"></i></button>
                                                <a href="/<?= $link ?>/hapus/{{ $d->id }}"
                                                    class="btn btn-danger waves-effect ladda-button"
                                                    data-style="slide-right" title="Hapus Data"><i class="ti-trash"></i></a>
                                            </div>
                                        </td>
                                        <td> {{ $d->nama }} </td>
                                        <td> {{ $d->username }} </td>
                                        <td> {{ $d->email }} </td>
                                        <td> {{ $d->no_telp }} </td>
                                        <td> {{ $d->alamat }} </td>
                                        <td><?php
                                        if ($d->role == 'super admin') {
                                            echo '<span class="label label-danger">Super Admin</span>';
                                        } elseif ($d->role == 'admin') {
                                            echo '<span class="label label-primary">Admin</span>';
                                        } else {
                                            echo '<span class="label label-success">Calon Legislatif</span>';
                                        } ?>
                                        </td>
                                        <td> {{ is_null($d->created_at) ? '-' : date('d-m-Y H:i:s', strtotime($d->created_at)) }}
                                        </td>
                                        <td>
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
    <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/tambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan nama {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Masukkan username {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">E-mail</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukkan e-mail {{ $title }}">
                                        <sup>*Boleh Kosong</sup>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukkan password {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Foto</label>
                                        <input type="file" accept=".jpg,.png" class="filestyle" name="foto"
                                            data-buttonname="btn-white" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Role</label>
                                        <select class="form-control select2" name="role" required>
                                            <option>--- Pilih Role ---</option>
                                            <option value="super admin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                            <option value="caleg">Calon Legislatif</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="no_telp"
                                            placeholder="Masukkan nomor telepon {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Alamat</label>
                                        <textarea class="form-control autogrow" name="alamat" placeholder="Masukkan alamat {{ $title }}"
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
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
    </div><!-- /.modal -->

    {{-- Modal Ubah --}}
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <input type="hidden" id="ubah-id" name="id">
                                        <label for="field-7" class="control-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="ubah-nama"
                                            placeholder="Masukkan nama {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="ubah-username"
                                            placeholder="Masukkan username {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="ubah-email"
                                            placeholder="Masukkan e-mail {{ $title }}" required>
                                        <sup>*Boleh Kosong</sup>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Role</label>
                                        <select class="form-control select2" name="role" id="ubah-role" required>
                                            <option>--- Pilih Role ---</option>
                                            <option value="super admin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                            <option value="caleg">Calon Legislatif</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="no_telp" id="ubah-no_telp"
                                            placeholder="Masukkan nomor telepon {{ $title }}" required>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Alamat</label>
                                        <textarea class="form-control autogrow" name="alamat" id="ubah-alamat"
                                            placeholder="Masukkan alamat {{ $title }}"
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
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

    {{-- Modal Ubah Foto --}}
    <div id="modal-foto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Ubah Foto {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <img class="img-circle img-responsive" src="" id="ubah-foto-lama"
                                            alt="">
                                    </div>
                                    <div class="form-group no-margin">
                                        <input type="hidden" id="ubah-foto-id" name="id">
                                        <label for="field-7" class="control-label">Foto Baru</label>
                                        <input type="file" accept=".jpg,.png" class="filestyle" name="foto"
                                            data-buttonname="btn-white" required>
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
@endsection

@section('add-footer')
    <script type="text/javascript">
        $('.btn-ubah').click(function() {
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

                    $('#ubah-nama').val(result.data.nama)
                    $('#ubah-username').val(result.data.username)
                    $('#ubah-role').val(result.data.role).trigger('change')
                    $('#ubah-email').val(result.data.email)
                    $('#ubah-alamat').val(result.data.alamat)
                    $('#ubah-no_telp').val(result.data.no_telp)
                    $('#ubah-id').val(result.data.id)
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })


        $('.btn-ubah-foto').click(function() {
            let id = $(this).data('id')

            $.post('/pengguna/get-foto-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#ubah-foto-lama').attr('src', result.foto)
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
