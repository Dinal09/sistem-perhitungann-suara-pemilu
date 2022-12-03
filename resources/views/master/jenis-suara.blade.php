@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>Tabel {{ $title }} </b></h4>
                    <p class="text-muted font-13 m-b-20">
                        {{ $explain }}
                    </p>

                    <a href="#custom-modal-tambah" class="btn btn-primary btn-rounded waves-effect waves-light m-b-20"
                        data-animation="slidetogether" data-plugin="custommodal" data-overlaySpeed="100"
                        data-overlayColor="#36404a">
                        <span class="btn-label"><i class="fa fa-plus"></i></span>
                        Tambah Data
                    </a>

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="max-width: 20px">No</th>
                                <th>Deskripsi</th>
                                <th style="max-width: 50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $idx => $d): ?>
                            <tr>
                                <td> {{ $idx + 1 }} </td>
                                <td> {{ $d->deskripsi }} </td>
                                <td>
                                    <div class="btn-group m-b-20">
                                        <a href="#custom-modal-ubah" class="btn btn-info waves-effect btn-ubah"
                                            data-id="{{ $d->id }}" data-animation="slidetogether"
                                            data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"
                                            title="Ubah Data"><i class="ti-pencil-alt"></i></a>
                                        <a href="/jenis-suara/hapus/{{ $d->id }}"
                                            class="btn btn-danger waves-effect ladda-button" data-style="slide-right"
                                            title="Hapus Data"><i class="ti-trash"></i></a>
                                    </div>
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
    <div id="custom-modal-tambah" class="modal-demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/jenis-suara/tambah" method="POST">
                    @csrf
                    <div class="modal-header bg-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Tambah {{ $title }} </h4>
                    </div>
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
                        <button type="button" class="btn btn-default waves-effect"
                            onclick="Custombox.close();">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

    {{-- Modal Ubah --}}
    <div id="custom-modal-ubah" class="modal-demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/jenis-suara/ubah" method="POST">
                    @csrf
                    <div class="modal-header bg-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Ubah {{ $title }} </h4>
                    </div>
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
                        <button type="button" class="btn btn-default waves-effect"
                            onclick="Custombox.close();">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('add-header')
    <link href="{{ url('/ubold/assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">

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
            $('#datatable-scroller').DataTable({
                ajax: "assets/plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
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
                } else [
                    $.Notification.autoHideNotify('warning', 'top right', 'Berhasil...!!',
                        result.pesan
                    )
                ]
            })
        })
    </script>
@endsection
