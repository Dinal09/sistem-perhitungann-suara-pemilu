@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Dapil</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $idx => $d): ?>
                            <tr>
                                <td>
                                    <div class="btn-group m-b-20">
                                        <button class="btn btn-info waves-effect btn-ubah" data-id="{{ $d->id }}"
                                            data-toggle="modal" data-target="#modal-edit" title="Ubah Data"><i
                                                class="ti-pencil-alt"></i></button>
                                        <a href="/<?= $link ?>/hapus/{{ $d->id }}"
                                            class="btn btn-danger waves-effect ladda-button" data-style="slide-right"
                                            title="Hapus Data"><i class="ti-trash"></i></a>
                                    </div>
                                </td>
                                <td> {{ $d->nama }} </td>
                                <td> {{ $d->desa->nama }} </td>
                                <td> {{ $d->desa->kecamatan->nama }} </td>
                                <td> {{ $d->desa->kecamatan->dapil->nama }} </td>
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
                                        <label for="field-7" class="control-label">Desa</label>
                                        <select class="form-control select2" name="id_desa" required>
                                            <option>--- Pilih Desa ---</option>
                                            <?php foreach($desa as $dap): ?>
                                            <optgroup label=" {{ $dap->nama }} ">
                                                <?php foreach ($dap->desa as $des): ?>
                                                <option value={{ $des->id }}> {{ $des->nama }} </option>
                                                <?php endforeach ?>
                                            </optgroup>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Nama {{ $title }} </label>
                                        <textarea class="form-control autogrow" name="nama" placeholder="Masukkan Nama {{ $title }}"
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
                    <h4 class="modal-title" id="myModalLabel">Ubah {{ $title }} </h4>
                </div>
                <div class="modal-body">
                    <form action="/<?= $link ?>/ubah" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Kecamatan</label>
                                        <select class="form-control select2" name="id_desa" id="ubah-id_desa" required>
                                            <option>--- Pilih Kecamatan ---</option>
                                            <?php foreach($desa as $dap): ?>
                                            <optgroup label=" {{ $dap->nama }} ">
                                                <?php foreach ($dap->desa as $des): ?>
                                                <option value={{ $des->id }}> {{ $des->nama }} </option>
                                                <?php endforeach ?>
                                            </optgroup>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Nama</label>
                                        <input type="hidden" id="ubah-id" name="id">
                                        <textarea class="form-control autogrow" name="nama" id="ubah-nama"
                                            placeholder="Masukkan Nama {{ $title }}"
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

            $.post('/tps/get-by-id?id=' + id, {
                '_token': '{{ csrf_token() }}',
                idJenis: id
            }).done(function(output) {
                let result = $.parseJSON(output);
                console.log(result)
                if (result.kode == 200) {
                    $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                        result.pesan
                    )

                    $('#ubah-nama').val(result.data.nama)
                    $('#ubah-id_desa').val(result.data.desa_id).trigger('change')
                    $('#ubah-id').val(result.data.id)
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })
    </script>
@endsection
