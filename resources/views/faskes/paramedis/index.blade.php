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
                            <h2 class="content-header-title float-left">Daftar Paramedis</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="matra_filters" name="matra_filters">
                        <option value="Semua" selected>Semua Matra</option>
                        <option value="AD">AD</option>
                        <option value="AL">AL</option>
                        <option value="AU">AU</option>
                        <option value="Null">PNS</option>
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="jenis_paramedis_filters" name="jenis_paramedis_filters">
                        <option value="Semua" selected>Semua Jenis Paramedis</option>
                        @foreach ($jenis_paramedis as $item)
                            <option value="{{ $item->id_jenis_paramedis }}">{{ $item->nama_jenis_paramedis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right col-md-8 col-12 d-md-block d-none">
                    <a href="{{ url('faskes/paramedis/create') }}"><button class="btn btn-primary">Tambah Daftar Paramedis</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="paramedis">
                                    <thead>
                                        <tr>
                                            <th class="text-center pl-4 pr-4">Aksi</th>
                                            <th>Sebaran</th>
                                            <th>Kategori</th>
                                            <th>Ijazah</th>
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

        $(function() {
            matra = $('#matra_filters').val();
            jenis_paramedis = $('#jenis_paramedis_filters').val();
            // status = $('#status_filters').val();
            table_ajax(matra, jenis_paramedis);

        });

        function table_ajax(matra = "", id_jenis_paramedis = "") {

            var url = `{{ url('faskes/paramedis/list/filter/') }}` + "/?matra=" + matra + "&id_jenis_paramedis=" + id_jenis_paramedis ;

            var table = $('#paramedis').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                        // url : "{{ url('/faskes/paramedis/list/filter') }}` + "/?matra=" + matra + "&jenis_paramedis=" + jenis_paramedis" , 
                        url,  
                        method: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                },
                columns: [
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'sebaran',
                            name: 'sebaran'
                        },
                        {
                            data: 'jenis_paramedis',
                            name: 'jenis_paramedis'
                        },
                        {
                            data: 'jenis_ijazah',
                            name: 'jenis_ijazah'
                        },
                        {
                            data: 'nama_paramedis',
                            name: 'nama_paramedis'
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
                            data: 'jabatan_struktural',
                            name: 'jabatan_struktural'
                        },
                        {
                            data: 'jabatan_fungsional',
                            name: 'jabatan_fungsional'
                        },
                        {
                            data: 'satuan_asal',
                            name: 'satuan_asal'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        }
                ],
                // "rowCallback": function(row, data) {},
                "drawCallback": function(settings) {
                    feather.replace();
                }

            });
        }

        $('#matra_filters').change(function() {

        table_ajax($(this).val(), ($('#jenis_paramedis_filters').val()));
        // console.log($(this).val(),($('#tahun').val()));
        });

        $('#jenis_paramedis_filters').change(function() {

        table_ajax($('#matra_filters').val(), ($(this).val()));
        // console.log($(this).val(),($('#tahun').val()));
        });

    </script>
@endsection