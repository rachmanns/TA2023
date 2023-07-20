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
                            <h2 class="content-header-title float-left mb-0">Realisasi Anggaran</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#defaultSize">Import Realisasi</button>

                    <!-- Modal Import-->
                    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel18">Import Realisasi Anggaran</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('bidum.anggaran.realisasi_import') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="customFile1">Pilih File Excel Realisasi Anggaran</label>
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                    id="customFile1" required />
                                                <label class="custom-file-label" for="customFile1">Tambah File</label>
                                            </div>
                                        </div>
                                        <div class="text-right mt-25">
                                            <a href="{{ url('bidum/anggaran/realisasi/export-format') }}"> <u>Download Format Realisasi</u> </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-renponsive-xl" id="table">
                                        <thead>
                                            <tr>
                                                <th>Tahun Realisasi</th>
                                                <th>Total Realisasi Anggaran Pusat</th>
                                                <th>Total Realisasi Anggaran Daerah</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
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
        $(function() {

            var table = $('#table').DataTable({
                ajax: "{{ url('bidum/anggaran/get-realisasi-pertahun') }}",
                columns: [{
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'pusat',
                        name: 'pusat'
                    },
                    {
                        data: 'daerah',
                        name: 'daerah'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

        });
    </script>
@endsection
