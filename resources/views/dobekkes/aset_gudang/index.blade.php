@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_length label {
            margin-left: 1.5rem;
            margin-right: 1.5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin-right: 1.5rem;
        }

        div.dataTables_wrapper .dataTables_info {
            margin-left: 1.5rem;
        }

    </style>
@endsection
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Aset Gudang</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#form_aset">Tambah Aset</button>

                    <!-- Modal Add-->
                    <div class="modal fade text-left" id="form_aset" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel18">Tambah Aset</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form novalidate>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label" for="nama">Nama Aset*</label>
                                            <input type="text" id="nama" name="nama_aset" class="form-control"
                                                placeholder="Nama Aset" required />
                                            <div class="invalid-feedback">Nama harus diisi</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="satuan">Satuan*</label>
                                            <input type="text" id="satuan" name="satuan" class="form-control"
                                                placeholder="Satuan" required />
                                            <div class="invalid-feedback">Satuan harus diisi</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="jumlah">Jumlah*</label>
                                            <input type="number" id="jumlah" name="jml_aset" class="form-control"
                                                placeholder="Jumlah" required min="0" />
                                            <div class="invalid-feedback">Jumlah harus diisi</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="keterangan">Keterangan</label>
                                            <textarea id="keterangan" name="keterangan" class="form-control"
                                                placeholder="Keterangan"></textarea>
                                        </div>
                                        @csrf
                                        @method('POST')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="aset-gudang table table-striped table-responsive-xl">
                                        <thead>
                                            <tr>
                                                <th>Nama Aset</th>
                                                <th class="text-center">Satuan</th>
                                                <th class="text-center">Jumlah</th>
                                                <th>Keterangan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            var table_ = $('.aset-gudang').DataTable({
                // scrollX: true,
                ajax: '/dobekkes/aset-gudang',
                columns: [{
                        data: 'nama_aset'
                    },
                    {
                        className: 'text-center',
                        data: 'satuan'
                    },
                    {
                        className: 'text-center',
                        data: 'jml_aset'
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: 'action'
                    },
                ],
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                }, ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

            $("#form_aset").on("hide.bs.modal", function() {
                id = '';
                $(".modal-title").html("Tambah Aset");
                $('#nama').val("");
                $('#satuan').val("");
                $('#jumlah').val("");
                $('#keterangan').val("");
                $("[name='_method']").val("POST");
            });

            $("form").submit(function(event) {
                event.preventDefault();
                event.stopPropagation();
                $('form').addClass('was-validated');
            });

            $(".modal-footer button").click(function() {
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('dobekkes/aset-gudang') }}/" + id,
                        method: $("[name='_method']").val(),
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            if (!res.error) {
                                table_.ajax.reload();
                                Swal.fire({
                                    title: 'Info',
                                    text: res.message,
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    }).always(function() {
                        $(".modal-footer button").prop('disabled', false);
                        $(".modal-footer button").text('Simpan');
                        $('#form_aset').modal('hide');
                    });
                }
            });
        });
        var id = '';

        function edit_aset(e) {
            id = e.attr('data-id');

            $.ajax({
                type: 'GET',
                url: "{{ url('dobekkes/aset-gudang') }}/" + id,
                success: function(response) {
                    $(".modal-title").html("Edit Aset");
                    $("[name='_method']").val("PUT");
                    $('#nama').val(response.data.nama_aset);
                    $('#jumlah').val(response.data.jml_aset);
                    $('#satuan').val(response.data.satuan);
                    $('#keterangan').val(response.data.keterangan);
                    $('#form_aset').modal('show');
                }
            });
        }
    </script>
@endsection
