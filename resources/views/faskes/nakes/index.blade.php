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
                    <select class="select2 form-control form-control-lg" id="matra_filters" name="matra_filters">
                        <option value="Semua" selected>Semua Matra</option>
                        <option value="AD">AD</option>
                        <option value="AL">AL</option>
                        <option value="AU">AU</option>
                        <option value="Null">PNS</option>
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="jenis_spesialisasi_filters" name="jenis_spesialisasi_filters">
                        <option value="Semua" selected>Semua Spesialis</option>
                        @foreach ($jenis_spesialisasi as $item)
                            <option value="{{ $item->id_spesialis }}">{{ $item->nama_spesialis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right col-md-8 col-12 d-md-block d-none">
                    <a href="{{ url('faskes/tenaga-medis/create') }}"><button class="btn btn-primary">Tambah Daftar Tenaga Medis</button></a>
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
                                            <th>Sebaran</th>
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

        // $(function(){
        //     medis_list()
        // })

        // function medis_list() {
            
        //     $('#medis').DataTable({
        //         destroy: true,
        //         processing: true,
        //         serverSide: true,
        //         scrollX: true,
        //         ajax: {
        //             url: "{{ url('faskes/tenaga-medis/list') }}",
        //             method: 'POST',
        //             // data: data,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         },
        //         columns: [
        //             {
        //                 data: 'action',
        //                 name: 'action',
        //                 orderable: false,
        //                 searchable: false
        //             },
        //             {
        //                 data: 'sebaran',
        //                 name: 'sebaran'
        //             },
        //             {
        //                 data: 'kategori_dokter',
        //                 name: 'kategori_dokter'
        //             },
        //             {
        //                 data: 'id_spesialis',
        //                 name: 'id_spesialis'
        //             },
        //             {
        //                 data: 'nama_dokter',
        //                 name: 'nama_dokter',
        //             },
        //             {
        //                 data: 'matra',
        //                 name: 'matra'
        //             },
        //             {
        //                 data: 'pangkat_korps',
        //                 name: 'pangkat_korps'
        //             },
        //             {
        //                 data: 'jabatan_struktural',
        //                 name: 'jabatan_struktural'
        //             },
        //             {
        //                 data: 'jabatan_fungsional',
        //                 name: 'jabatan_fungsional'
        //             },
        //             {
        //                 data: 'satuan_asal',
        //                 name: 'satuan_asal'
        //             },
        //             {
        //                 data: 'keterangan',
        //                 name: 'keterangan'
        //             },
        //             {
        //                 data: 'status',
        //                 name: 'status'
        //             }
        //         ],
        //         "drawCallback": function(settings) {
        //             feather.replace();
        //     }
    
        //     });
        // }

        $(function() {
            matra = $('#matra_filters').val();
            id_spesialis = $('#jenis_spesialisasi_filters').val();
            // status = $('#status_filters').val();
            table_ajax(matra, id_spesialis);

        });

        function table_ajax(matra = "", id_spesialis = "") {

            var url = `{{ url('faskes/tenaga-medis/list/filter/') }}` + "/?matra=" + matra + "&id_spesialis=" + id_spesialis ;

            var table = $('#medis').DataTable({
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
                        data: 'kategori_dokter',
                        name: 'kategori_dokter'
                    },
                    {
                        data: 'id_spesialis',
                        name: 'id_spesialis'
                    },
                    {
                        data: 'nama_dokter',
                        name: 'nama_dokter',
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'pangkat_korps',
                        name: 'pangkat_korps'
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

        table_ajax($(this).val(), ($('#jenis_spesialisasi_filters').val()));
        // console.log($(this).val(),($('#tahun').val()));
        });

        $('#jenis_spesialisasi_filters').change(function() {

        table_ajax($('#matra_filters').val(), ($(this).val()));
        // console.log($(this).val(),($('#tahun').val()));
        });
    </script>
@endsection