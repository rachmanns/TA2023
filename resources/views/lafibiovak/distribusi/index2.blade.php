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
                                <table class="table table-striped table-responsive-xl" id="distribusi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Faskes / Tujuan</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Tanggal Distribusi</th>
                                            <th class="text-center">Aksi</th>
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
                    data: 'tujuan',
                },
                {
                    data: 'nama_produk',
                },
                {
                    data: 'kategori',
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
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
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
