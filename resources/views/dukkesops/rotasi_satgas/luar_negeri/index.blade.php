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
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Rotasi Satgas LN - TA 2022</h2>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 text-right">
                            <button class="btn btn-outline-primary mr-75"> <i data-feather="upload" class="mr-50"></i> Export Excell</button>
                            <a href="/tambah_rotasi_satgas_ln"><button class="btn btn-primary"> Tambah Jadwal</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Batalyon</th>
                                            <th>Satgas Ops</th>
                                            <th>Berangkat Ops</th>
                                            <th>Kembali Ops</th>
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
        $('#rs').DataTable({
        scrollX: true,
        ajax: "{{ url('/app-assets/data/rotasi-satgas-ln.json') }}",
        columns: [{
                data: 'no',
                name: 'no'
            },
            {
                data: 'batalyon',
                name: 'batalyon'
            },
            {
                data: 'satgas',
                name: 'satgas'
            },
            {
                data: 'berangkat',
                name: 'berangkat'
            },
            {
                data: 'kembali',
                name: 'kembali'
            },
            {
                data: 'action',
                name: 'action',
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
