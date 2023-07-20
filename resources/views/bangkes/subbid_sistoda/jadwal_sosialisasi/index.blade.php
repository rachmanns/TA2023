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
                        <div class="col-md-9 col-10">
                            <h2 class="content-header-title float-left">Jadwal Sosialisasi</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{ route('bangkes.jadwal-sosialisasi.create') }}"><button class="btn btn-primary">Tambah Jadwal Sosialisasi</button></a>
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
                                    <table class="table table-striped" id="sosialisasi">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center" style="min-width: 150px;">Tanggal</th>
                                                <th rowspan="2" class="text-center">No. Buku</th>
                                                <th rowspan="2" class="border-right">Judul Buku</th>
                                                <th colspan="2" class="text-center">Lokasi Sosialisasi</th>
                                                <th rowspan="2" class="text-center border-left">Jumlah Peserta</th>
                                                <th rowspan="2" class="text-center">Jumlah Panitia</th>
                                                <th rowspan="2" class="text-center" style="min-width: 100px;">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Satuan</th>
                                                <th class="text-center">Kota</th>
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
        $('#sosialisasi').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ url('bangkes/jadwal-sosialisasi/list') }}",
            columns: [
                {
                    data: 'tgl_event',
                    name: 'tgl_event'
                },
                {
                    data: 'no_buku',
                    name: 'no_buku'
                },
                {
                    data: 'nama_buku',
                    name: 'nama_buku'
                },
                {
                    data: 'satuan',
                    name: 'satuan'
                },
                {
                    data: 'kota_kab.nama_kotakab',
                    name: 'kota_kab.nama_kotakab'
                },
                {
                    data: 'jml_peserta',
                    name: 'jml_peserta'
                },
                {
                    data: 'id_personil',
                    name: 'id_personil'
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
