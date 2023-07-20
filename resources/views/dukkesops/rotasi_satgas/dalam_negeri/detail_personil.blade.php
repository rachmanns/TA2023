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
                        <div class="col-12 mb-1">
                            <a href="{{ url('dukkesops/rotasi-satgas/show/'.$penugasan_pos->penugasan_satgas->id_tugas) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail Rotasi Satgas</h4>
                                </div>
                                <hr class="m-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <h5>Satgas Ops</h5>
                                            <span>{{ $penugasan_pos->penugasan_satgas->nama_satgas }}</span>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <h5>Batalyon</h5>
                                            <span>{{ $penugasan_pos->penugasan_satgas->nama_batalyon }}</span>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <h5>Nama Pos</h5>
                                            <span>{{ $penugasan_pos->pos_satgas->nama_pos }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <a href="{{ url('dukkesops/penugasan-pos/create-anggota/'.$penugasan_pos->id_penugasan_pos) }}"><button class="btn btn-primary">Tambah Personil</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NRP/Jabatan</th>
                                            <th>Pangkat</th>
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
        $('#table').DataTable({
            scrollX: true,
            ajax: "{{ url('dukkesops/detail-anggota/get/'. $penugasan_pos->id_penugasan_pos) }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nrp_jabatan'
                },
                {
                    data: 'pangkat',
                    name: 'pangkat'
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
