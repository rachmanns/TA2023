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
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Daftar Kemasan Produk</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <a href="/lafibiovak/kemasan/create"><button class="btn btn-primary">Tambah Kemasan Produk</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="kemasan">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Nama Produk</th>
                                            <th>Zat Aktif</th>
                                            <th>Satuan</th>
                                            <th>Kemasan</th>
                                            <th>Bets</th>
                                            <th>Nie</th>
                                            <th>Gambar</th>
                                            <th class="text-center" style="min-width:150px;">Aksi</th>
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
        $('#kemasan').DataTable({
        // scrollX: true,
        ajax: "{{ url('/lafibiovak/kemasan/list') }}",
        columns: [{
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'produk',
                render: function(data, type, full, meta) {
                    return data ? data.nama_produk : '-';
                }
            },
            {
                data: 'produk',
                render: function(data, type, full, meta) {
                    if (!data) return '-';
                    var res = '';
                    for(i=0;i<data.zat_aktif.length;i++) res += data.zat_aktif[i].nama_zat;
                    return res;
                }
            },
            {
                data: 'satuan_produk',
                render: function(data, type, full, meta) {
                    return data ? data.nama_satuan : '-';
                }
            },
            {
                data: 'nama_kemasan',
            },
            {
                data: 'bets',
            },
            {
                data: 'NIE',
            },
            {
                data: 'id_kemasan',
                render: function(data, type, full, meta) {
                    return '<img src="{{url('uploads/kemasan')}}/' + data + '.jpg" alt="Gambar belum di-upload" height="100" />';
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
    });
 </script>
@endsection
