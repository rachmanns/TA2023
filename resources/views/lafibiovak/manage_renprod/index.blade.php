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
                            <h2 class="content-header-title float-left">Tabel Rencana Produksi - TA <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode_setiap_bidang"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <a href="/lafibiovak/renprod/form"><button class="btn btn-primary">Tambah Renprod</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="renprod">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">No</th>
                                            <th rowspan="2" class="text-center" style="min-width: 100px;">Aksi</th>
                                            <th rowspan="2" style="white-space: nowrap;">Nama Produk &nbsp; &nbsp;</th>
                                            <th rowspan="2" class="text-center">Bets</th>
                                            <th rowspan="2" class="text-center">Jumlah Renbut (RKO)</th>
                                            <th rowspan="2" class="text-center">Persediaan Awal</th>
                                            <th rowspan="2" class="text-center">Total Renprod (Batch)</th>
                                            <th rowspan="2" class="text-center">Jumlah Renprod</th>
                                            <th colspan="5" class="text-center">Detil Renprod (Batch)</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Lafi Puskesad</th>
                                            <th class="text-center">Lafial</th>
                                            <th class="text-center">Lafiau</th>
                                            <th class="text-center">Labiomed Puskesad</th>
                                            <th class="text-center">Labiovak Puskesad</th>
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
        id = '',
        table_;

    function table_reload() {
        param = 'tahun=' + $('#periode_setiap_bidang').val();
        @if(isset(request()->produksi))
        param += '&produksi=true';
        @endif

        table_ = $('#renprod').DataTable({
        scrollX: true,
        ajax: "{{ url('/lafibiovak/renprod/list') }}?" + param,
        destroy: true,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
            },
            {
                data: 'bets',
            },
            {
                data: 'jml_renbut',
                className: 'text-center',
            },
            {
                data: 'persediaan',
                className: 'text-center',
            },
            {
                data: 'ssp',
                className: 'text-center',
            },
            {
                data: 'jml_renprod',
                className: 'text-center',
            },
            {
                data: 'Lafiad',
                className: 'text-center',
            },
            {
                data: 'Lafial',
                className: 'text-center',
            },
            {
                data: 'Lafiau',
                className: 'text-center',
            },
            {
                data: 'Labiomed',
                className: 'text-center',
            },
            {
                data: 'Labiovak',
                className: 'text-center',
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
