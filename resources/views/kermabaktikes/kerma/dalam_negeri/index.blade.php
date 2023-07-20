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
                            <h2 class="content-header-title float-left">Data Kerma Dalam Negeri</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="id_jenis_keg">
                        <option selected disabled>Filter Kegiatan</option>
                        @foreach ($jenis_kegiatan as $item)
                            <option value="{{ $item->id_jenis_keg }}">{{ $item->jenis_keg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('kerma.kdn.create') }}"><button class="btn btn-primary">Tambah Data Kerma</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="kdn-table">
                                    <thead>
                                        <tr>
                                            <th>Kegiatan</th>
                                            <th>No.</th>
                                            <th style="min-width: 200px;">Jenis Kegiatan</th>
                                            <th style="min-width: 200px;">Nama Acara</th>
                                            <th style="min-width: 150px;">Tanggal Kegiatan</th>
                                            <th style="min-width: 200px;">Tempat</th>
                                            <th>Tahun</th>
                                            <th style="min-width: 150px;">Keterangan</th>
                                            <th style="min-width: 100px;">Status</th>
                                            <th style="min-width: 200px;">File Laporan</th>
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

        let id_jenis_keg = ''
        let tahun = ''

        $('#id_jenis_keg').change(function(){
            id_jenis_keg = $(this).val()
            kerma_dn_table(id_jenis_keg,tahun)
        })

        $('#tahun').change(function(){
            tahun = $(this).val()
            kerma_dn_table(id_jenis_keg,tahun)
        })

        $(function () {
            kerma_dn_table()
        })

        function kerma_dn_table(id_jenis_keg='',tahun='') {
            let data = { id_jenis_keg: id_jenis_keg, tahun: tahun }
            var table = $('#kdn-table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('kerma/kdn/list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'kegiatan.nama_kegiatan',
                        name: 'kegiatan.nama_kegiatan',
                        visible: false
                    },
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'jenis_kegiatan.jenis_keg',
                        name: 'jenis_kegiatan.jenis_keg'
                    },
                    {
                        data: 'nama_acara'
                    },
                    {
                        data: 'tgl_pelaksanaan',
                        name: 'tgl_pelaksanaan'
                    },
                    {
                        data: 'tempat',
                        name: 'tempat'
                    },
                    {
                        data: 'periode',
                        name: 'periode'
                    },
                    {
                        data: 'keterangan.keterangan',
                        name: 'keterangan.keterangan'
                    },
                    {
                        data: 'status.nama_status',
                        name: 'status.nama_status'
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
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    feather.replace();
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="10" class="group font-medium-1" style="background-color:#F3F2F7;">' +
                                group + '</th>'
                            );

                            last = group;
                        }
                    });
                }
            })
        }
    </script>
@endsection
