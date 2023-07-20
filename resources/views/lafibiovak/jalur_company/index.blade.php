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
                        <div class="col-md-9">
                            <h2 class="content-header-title float-left">Data Jalur Company</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="/lafibiovak/jalur-company/create"><button class="btn btn-primary">Tambah Jalur Company</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 200px;">Nama Company</th>
                                                <th style="min-width: 300px;">Lokasi</th>
                                                <th style="min-width: 100px;">Foto/Video</th>
                                                <th>Kemampuan Personil</th>
                                                <th>Jumlah Mesin</th>
                                                <th class="text-center">Izin Operasional</th>
                                                <th class="text-center">Sertifikat CPOB</th>
                                                <th>Sumber Dana Puskes</th>
                                                <th>Sumber Dana Angkatan</th>
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
        var table = $('#table').DataTable({
            scrollX: true,
            ajax: "{{ url('/lafibiovak/jalur-company/list') }}",
            columns: [
                {
                    data: 'nama_jalur'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'foto',
                    render: function(a, b, c, d) {
                        return '<a href="/uploads/jalur_company/' + a + '" target="_blank"><i data-feather="paperclip" class="mr-50"></i>Lihat Foto</a>' + (c.video ? '<br /><a href="' + c.video + '" target="_blank">Lihat Video</a>' : '');
                    },
                },
                {
                    data: 'jml_personil',
                    className: 'text-center'
                },
                {
                    data: 'jml_mesin',
                    className: 'text-center'
                },
                {
                    data: 'izin_opr',
                    className: 'text-center',
                    render: function(a, b, c, d) {
                        return a ? 'Ada' : 'Tidak Ada';
                    },
                },
                {
                    data: 'cpob',
                    className: 'text-center',
                    render: function(a, b, c, d) {
                        return a ? 'Ada' : 'Tidak Ada';
                    },
                },
                {
                    data: 'sumber_puskes'
                },
                {
                    data: 'sumber_angkatan'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection