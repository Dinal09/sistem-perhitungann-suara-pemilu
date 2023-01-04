@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>Tabel {{ $title }} </b></h4>
                        <p class="text-muted font-13">
                            {{ $explain }}</p>

                        <div class="p-20">

                            <a href="#custom-modal-tambah" class="btn btn-primary btn-rounded waves-effect waves-light m-b-20"
                                data-toggle="modal" data-target="#modal-tambah">
                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                Tambah Data
                            </a>

                            <table class="table table-striped m-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Deskripsi</th>
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
                                                <a href="/<?= $link ?>/hapus/{{ $d->id }}"
                                                    class="btn btn-danger waves-effect ladda-button"
                                                    data-style="slide-right" title="Hapus Data"><i class="ti-trash"></i></a>
                                            </div>
                                        </td>
                                        <td> {{ $idx + 1 }} </td>
                                        <td> {{ $d->deskripsi }} </td>
                                        <td> {{ is_null($d->created_at) ? '-' : date('d-m-Y H:i:s', strtotime($d->created_at)) }}
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
    <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/tambah" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Deskripsi</label>
                                        <textarea class="form-control autogrow" name="deskripsi" placeholder="Masukkan Deskripsi {{ $title }}"
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    {{-- Modal Ubah --}}
    <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <label for="field-7" class="control-label">Deskripsi</label>
                                        <input type="hidden" id="ubah-id" name="id">
                                        <textarea class="form-control autogrow" name="deskripsi" id="ubah-deskripsi"
                                            placeholder="Masukkan Deskripsi {{ $title }}"
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
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

            $.post('/jenis-suara/get-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#ubah-deskripsi').val(result.data.deskripsi)
                    $('#ubah-id').val(result.data.id)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Perhatian...!!',
                        result.pesan
                    )
                }
            })
        })
    </script>
@endsection
