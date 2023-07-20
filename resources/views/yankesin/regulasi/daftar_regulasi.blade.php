@extends('partials.template')

@section('page_style')
    <style>
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

        table td {
            word-wrap: break-word;
            max-width: 300px;
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
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Daftar Regulasi Bidang Yankesin</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah Regulasi</button>

                            <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modal-title">Tambah Regulasi Bidang</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row d-flex align-items-end">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nama">Nama Regulasi</label>
                                                        <input type="text" class="form-control" id="nama" placeholder="Isi Nama Regulasi" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="customFile1">Pilih File</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile1" required />
                                                            <label class="custom-file-label" for="customFile1">Pilih File</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer text-left">
                                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                                        </div>
                                    </div>
                                </div>
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
                                <table class="table table-striped table-responsive-xl" id="regulasi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Regulasi</th>
                                            <th>Tanggal Upload</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
        $('#regulasi').DataTable({
            // scrollX: true,
            ajax: "{{ url('/app-assets/data/daftar-regulasi.json') }}",
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection
