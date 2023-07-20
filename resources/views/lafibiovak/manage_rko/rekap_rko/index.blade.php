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
                            <h2 class="content-header-title float-left">Rekap Data RKO - TA <span class="tahun"><?php echo date('Y'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2 col-12">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode_setiap_bidang"
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
                                <table class="table table-striped" id="rekap">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Nama Produk</th>
                                            <th rowspan="2" class="text-center">Faskes Mabes TNI</th>
                                            <th colspan="3" class="text-center">Faskes TNI AD</th>
                                            <th colspan="3" class="text-center">Faskes TNI AL</th>
                                            <th colspan="3" class="text-center">Faskes TNI AU</th>
                                            <th rowspan="2" class="text-center">Total</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">FKTP</th>
                                            <th class="text-center">FKTL</th>
                                            <th class="text-center">RS Sandaran</th>
                                            <th class="text-center">FKTP</th>
                                            <th class="text-center">FKTL</th>
                                            <th class="text-center">RS Sandaran</th>
                                            <th class="text-center">FKTP</th>
                                            <th class="text-center">FKTL</th>
                                            <th class="text-center">RS Sandaran</th>
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
    var param = '',
        table_;

    function table_reload() {
        param = 'tahun=' + $('#periode_setiap_bidang').val();

        $('#rekap').DataTable({
        scrollX: true,
        ajax: "{{ url('/lafibiovak/rko/list-rekap') }}?" + param,
        destroy: true,
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'nama_produk',
            },
            {
                data: 'MABES',
                className: 'text-right'
            },
            {
                data: 'AD_FKTP',
                className: 'text-right'
            },
            {
                data: 'AD_FKTL',
                className: 'text-right'
            },
            {
                data: 'AD_RSS',
                className: 'text-right'
            },
            {
                data: 'AL_FKTP',
                className: 'text-right'
            },
            {
                data: 'AL_FKTL',
                className: 'text-right'
            },
            {
                data: 'AL_RSS',
                className: 'text-right'
            },
            {
                data: 'AU_FKTP',
                className: 'text-right'
            },
            {
                data: 'AU_FKTL',
                className: 'text-right'
            },
            {
                data: 'AU_RSS',
                className: 'text-right'
            },
            {
                data: 'total',
                className: 'text-right'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });

        $('.tahun').text($('#periode_setiap_bidang').val());
    }

    $(document).ready(function() {
        $('#periode_setiap_bidang').val(<?php echo date('Y'); ?>);
        table_reload();
        $('#periode_setiap_bidang').change(function() {
            table_reload();
        });
    });
    </script>
@endsection
