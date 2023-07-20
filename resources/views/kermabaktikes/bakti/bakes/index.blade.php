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

        table.dataTable tbody td {
            vertical-align: top;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Data Bakti Kesehatan</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('bakti.bakes.create') }}"><button class="btn btn-primary">Tambah Data Bakti</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist"></div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent"></div>
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
        
        let tahun = ''
        let jenis_kegiatan = {!! $jenis_kegiatan !!};

        $(function(){
            
            $.each(jenis_kegiatan, function( index, value ) {
                var active = '';
                if (index === 0) {
                    active = 'active';
                }
                $( "#nav-tab" ).append( `<a class="nav-item nav-link ml-2 mr-2 mt-2 ${active}" id="${value.id_jenis_keg}-tab"
                                                data-toggle="tab" href="#nav-${value.id_jenis_keg}" role="tab" aria-controls="${value.id_jenis_keg}"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">${value.jenis_keg}</span></a>` );
                $( "#nav-tabContent" ).append( `<div class="tab-pane fade show ${active}" id="nav-${value.id_jenis_keg}" role="tabpanel"
                                            aria-labelledby="${value.id_jenis_keg}-tab">
                                            <table class="table table-striped table-responsive-xl" id="table-${value.id_jenis_keg}">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th style="min-width:200px;">Nama Kegiatan</th>
                                                        <th style="min-width:200px;">Tempat</th>
                                                        <th style="min-width:100px;">Waktu</th>
                                                        <th style="min-width:200px;">Sasaran</th>
                                                        <th style="min-width:200px;">Pencapaian</th>
                                                        <th style="min-width:200px;">File Laporan</th>
                                                        <th style="min-width:100px;" class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>` );

                bakti_table(value.id_jenis_keg);
            });
        })

        $('#tahun').change(function(){
            tahun = $(this).val()
            $.each(jenis_kegiatan, function( index, value ) {
                bakti_table(value.id_jenis_keg,tahun);
            });
        })

        function bakti_table(id_jenis_keg,tahun='') {
                let data = { id_jenis_keg: id_jenis_keg, tahun: tahun }
                var table = $('#table-'+id_jenis_keg).DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    scrollX : true,
                    ajax: {
                            url: "{{ url('bakti/bakes/list') }}",
                            method: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {
                            data: 'nama_acara',
                            name: 'nama_acara'
                        },
                        {
                            data: 'tempat',
                            name: 'tempat'
                        },
                        {
                            data: 'tgl_pelaksanaan',
                            name: 'tgl_pelaksanaan'
                        },
                        {
                            data: 'sasaran',
                            name: 'sasaran'
                        },
                        {
                            data: 'capaian',
                            name: 'capaian'
                        },
                        {
                            data: 'file_laporan',
                            name: 'file_laporan'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "drawCallback": function(settings) {
                        feather.replace();
                    }
                })
            }
    </script>
@endsection
