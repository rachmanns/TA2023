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
                            <h2 class="content-header-title float-left">Report Jumlah Keluar - Tahun <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun"
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
                                <table class="table table-striped table-responsive-xl" id="distribusi">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th class="border-right">Faskes / Tujuan</th>
                                            @foreach($prods as $p)
                                            <th class="text-center border-right">{{$p->nama_produk}}</th>
                                            @endforeach
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
        ajax: "{{ url('/lafibiovak/distribusi/report-keluar') }}?tahun=" + $('#tahun').val(),
        scrollX: true,
        destroy: true,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'tujuan',
            },
            @foreach($prods as $p)
            {
                data: 'jml{{$p->id}}',
                className: 'text-right',
            },
            @endforeach
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
