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
                            <h2 class="content-header-title float-left">Report Jumlah Masuk - Tahun <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="masuk">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            @if(!Auth::user()->id_faskes)
                                            <th>Nama Lafi</th>
                                            @endif
                                            <th>No. Bets</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Produksi</th>
                                            <th>Tanggal Selesai Produksi</th>
                                            <th>Tanggal Expired</th>
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
    var table_;

    function table_reload() {
        table_ = $('#masuk').DataTable({
        ajax: '{{ url("lafibiovak/persediaan/report-masuk") }}?tahun=' + $('#periode').val(),
        destroy: true,
        columns: [
            {   data: 'DT_RowIndex',
                className: 'text-center',   },
            @if(!Auth::user()->id_faskes)
            {   data: 'id_pelaksana',
                className: 'text-center',   },
            @endif
            {   data: 'no_bets',
                className: 'text-center',   },
            {   data: 'nama_produk',
                render: function(data, type, full, meta) {
                    return (data + ' / ' + full.nama_satuan + ' / ' + full.nama_kemasan);
                }
            },
            {   data: 'jml_hasil_produksi',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {   data: 'tgl_selesai_prod',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (data ?
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }) : 'Belum Selesai'
                    );
                }
            },
            {   data: 'tgl_expired',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (data ?
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }) : '-'
                    );
                }
            },
        ],

        });

        $('.tahun').text($('#periode').val());
    }

    $(document).ready(function() {
        $('#periode').change(function() {
            table_reload();
        });
        $('#periode').val(<?php echo date('Y'); ?>).trigger('change');
    });
    </script>
@endsection
