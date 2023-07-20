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
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Daftar Persediaan Produk Jadi - Tahun <span class="tahun"><?php echo date('Y'); ?></span></h2>
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
                                <table class="table table-striped" id="persediaan">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">No</th>
                                            <th rowspan="2" class="text-center">Aksi</th>
                                            <th rowspan="2" style="white-space: nowrap;">Nama Produk &nbsp; &nbsp;</th>
                                            <th rowspan="2" class="text-center">Renprod</th>
                                            <th rowspan="2" class="text-center">Persediaan Awal</th>
                                            <th colspan="5" class="text-center">Masuk</th>
                                            <th rowspan="2" class="text-center">Total</th>
                                            <th rowspan="2" class="text-center">Prosentase Pemenuhan</th>
                                            <th rowspan="2" class="text-center">Keluar</th>
                                            <th rowspan="2" class="text-center">Sisa</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Lafi Puskesad</th>
                                            <th class="text-center">Lafial</th>
                                            <th class="text-center">Lafiau</th>
                                            <th class="text-center">Labiovak</th>
                                            <th class="text-center">Labiomed</th>
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
        table_ = $('#persediaan').DataTable({
        scrollX: true,
        ajax: "{{ url('/lafibiovak/persediaan/list') }}?" + 'tahun=' + $('#periode').val(),
        destroy: true,
        columns: [{
                data: 'DT_RowIndex',
                className: 'text-center',
            },{
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
            },
            {
                data: 'renprod',
                className: 'text-right',
            },
            {
                data: 'persediaan',
                className: 'text-right',
            },
            {
                data: 'Lafiad',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {
                data: 'Lafial',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {
                data: 'Lafiau',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {
                data: 'Labiovak',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {
                data: 'Labiomed',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return (formatRupiah(data));
                }
            },
            {
                data: 'total',
                className: 'text-right',
            },
            {
                data: 'prosentase',
                className: 'text-center',
            },
            {
                data: 'keluar',
                className: 'text-right',
            },
            {
                data: 'sisa',
                className: 'text-right',
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

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
