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
                            <h2 class="content-header-title float-left">Bahan Produksi</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="/lafibiovak/bahan-produksi/create"><button class="btn btn-primary">Tambah Bahan Produksi</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="bahan-baku">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No.</th>
                                            <th rowspan="2" class="pr-4 pl-4">Aksi</th>
                                            <th rowspan="2" style="min-width: 200px;">Nama Bahan</th>
                                            <th rowspan="2">Kategori</th>
                                            <th rowspan="2">Satuan</th>
                                            <th rowspan="2" style="min-width: 200px;">Spesifikasi Teknis</th>
                                            <th rowspan="2" class="border-right">Kemasan Minimal</th>
                                            <th colspan="2" class="text-center">Sumber</th>
                                            <th rowspan="2" class="border-left">Renada</th>
                                            <th rowspan="2">Jumlah Awal</th>
                                            <th rowspan="2" class="border-right">Jumlah Masuk</th>
                                            <th colspan="6" class="text-center">Jumlah Keluar</th>
                                            <th rowspan="2" class="border-left">Sisa</th>
                                            <th rowspan="2">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Perusahaan</th>
                                            <th class="text-center">Asal Negara</th>
                                            <th class="text-center">Lafi AD</th>
                                            <th class="text-center">Lafi AL</th>
                                            <th class="text-center">Lafi AU</th>
                                            <th class="text-center">Labiovak</th>
                                            <th class="text-center">Labiomed</th>
                                            <th class="text-center">Total</th>
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
    $(document).ready(function() {
        $('#bahan-baku').DataTable({
        ajax: "{{ url('/lafibiovak/bahan-produksi/list') }}",
        scrollX: true,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {   data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_bahan_produksi',
            },
            {
                data: 'kategori.nama_kategori',
                className: 'text-center',
            },
            {
                data: 'satuan',
                className: 'text-center',
            },
            {
                data: 'spesifikasi',
                className: 'text-center',
            },
            {
                data: 'kemasan_min',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return data ? formatRupiah(data) : '';
                }
            },
            {
                data: 'perusahaan',
                className: 'text-center',
            },
            {
                data: 'negara',
                className: 'text-center',
            },
            {
                data: 'renada',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return data ? formatRupiah(data) : '';
                }
            },
            {
                data: 'jumlah_awal',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'transaksi_sum_jumlah',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafiad',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafial',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafiau',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Labiomed',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Labiovak',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: '',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(full.Lafiad + full.Lafial + full.Lafiau + full.Labiomed + full.Labiovak);
                }
            },
            {
                data: '',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(full.jumlah_awal + parseInt(full.transaksi_sum_jumlah) - full.Lafiad - full.Lafial - full.Lafiau - full.Labiomed - full.Labiovak);
                }
            },
            {
                data: 'keterangan',
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });
    });
    </script>
@endsection
