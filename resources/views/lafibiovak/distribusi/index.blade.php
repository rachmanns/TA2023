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
                            <h2 class="content-header-title float-left">Daftar Distribusi Tahun Anggaran <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Tahun Anggaran" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 text-right">
                    <a href="/lafibiovak/distribusi/form"><button class="btn btn-primary">Tambah Distribusi</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive" id="distribusi">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="3">No.</th>
                                            <th class="text-center" rowspan="3">Nama Produk</th>
                                            <th class="text-center" rowspan="3">Satuan</th>
                                            <th class="text-center" rowspan="3">Tanggal Distribusi</th>
                                            <th class="text-center" rowspan="3">Produsen</th>
                                            <th class="text-center" rowspan="3">Kode Produksi</th>
                                            <th class="text-center" rowspan="3">ED</th>
                                            <th class="text-center" colspan="8">Monitoring</th>
                                            <th class="text-center" rowspan="3">Total Sisa Barang</th>
                                            <th class="text-center" rowspan="3">Laporan</th>
                                            <th class="text-center" rowspan="3">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" colspan="4">Dobekkes</th>
                                            <th class="text-center" colspan="4">Distributor</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Jumlah Masuk</th>
                                            <th class="text-center">Jumlah Keluar</th>
                                            <th class="text-center">Ket. Keluar</th>
                                            <th class="text-center">Sisa Barang</th>
                                            <th class="text-center">Masuk (Dobekkes / Faskes)</th>
                                            <th class="text-center">Keluar (Faskes dan Lainnya)</th>
                                            <th class="text-center">Ket. Keluar</th>
                                            <th class="text-center">Sisa Barang</th>
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

    function table_reload() {
        $('#distribusi').DataTable({
            ajax: "{{ url('/lafibiovak/distribusi/list') }}?" + 'tahun=' + $('#tahun').val(),
            destroy: true,
            columns: [
                {
                    data: 'DT_RowIndex',
                    className: 'text-center',
                },
                {
                    data: 'nama_produk',
                },
                {
                    data: 'nama_satuan',
                    className: 'text-center',
                },
                {
                    data: 'tgl_distribusi',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (data ?
                            new Date(data).toLocaleString('id-ID', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }) : ''
                        );
                    }
                },
                {
                    data: 'produsen',
                    className: 'text-center',
                },
                {
                    data: 'no_bets',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return data ?? full.kode_produksi;
                    }
                },
                {
                    data: 'exp_date',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (data ?
                            new Date(data).toLocaleString('id-ID', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }) : ''
                        );
                    }
                },
                {
                    data: 'dobek_masuk',
                    className: 'text-center',
                },
                {
                    data: 'dobek_keluar',
                    className: 'text-center',
                },
                {
                    data: 'dobek_ket',
                    className: 'text-center',
                },
                {
                    data: '',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return full.dobek_masuk - full.dobek_keluar;
                    }
                },
                {
                    data: 'dist_masuk',
                    className: 'text-center',
                },
                {
                    data: 'dist_keluar',
                    className: 'text-center',
                },
                {
                    data: 'dist_ket',
                    className: 'text-center',
                },
                {
                    data: '',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return full.dist_masuk - full.dist_keluar;
                    }
                },
                {
                    data: '',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return full.dobek_masuk - full.dobek_keluar + full.dist_masuk - full.dist_keluar;
                    }
                },
                {
                    data: 'laporan',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return data == null ? '-' : '<a href="/lafibiovak/distribusi/download/' + data + '" target="_blank">Laporan</a>';
                    }
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });

        $('.tahun').text($('#tahun').val());
    }

    $(document).ready(function() {
        $('#tahun').change(function() {
            table_reload();
        });
        $('#tahun').val(<?php echo date('Y'); ?>).trigger('change');
    });
    </script>
@endsection
