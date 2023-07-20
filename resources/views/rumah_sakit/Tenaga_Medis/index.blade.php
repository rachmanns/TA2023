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
                        <div class="col-md-10 col-10">
                            <h2 class="content-header-title float-left">Daftar Tenaga Medis</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg">
                        <option disabled selected>Matra</option>
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg">
                        <option disabled selected>Spesialis</option>
                    </select>
                </div>
                <div class="text-right col-md-8 col-12 d-md-block d-none">
                    <a href="/tenaga/create"><button class="btn btn-primary">Tambah Tenaga Medis</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-lg" id="medis">
                                    <thead>
                                        <tr>
                                            <th class="text-center pl-4 pr-4">Aksi</th>
                                            <th class="text-center">Kategori</th>
                                            <th>Spesialis</th>
                                            <th>Nama</th>
                                            <th>Matra</th>
                                            <th>Pangkat/NRP/NIP</th>
                                            <th>Jabatan Struktural</th>
                                            <th>Jabatan Fungsional</th>
                                            <th>Satuan Asal</th>
                                            <th>Ket</th>
                                            <th>Status</th>
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
        $('#medis').DataTable({
        ajax: "{{ url('/app-assets/data/medis.json') }}",
        scrollX: true,
        columns: [
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'kategori',
                name: 'kategori'
            },
            {
                data: 'spesialis',
                name: 'spesialis'
            },
            {
                data: 'nama',
                name: 'nama',
            },
            {
                data: 'matra',
                name: 'matra'
            },
            {
                data: 'pangkat',
                name: 'pangkat'
            },
            {
                data: 'struktural',
                name: 'struktural'
            },
            {
                data: 'fungsional',
                name: 'fungsional'
            },
            {
                data: 'asal',
                name: 'asal'
            },
            {
                data: 'ket',
                name: 'ket'
            },
            {
                data: 'ket',
                name: 'ket'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });
    </script>
@endsection