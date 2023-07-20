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
                        <div class="col-md-10">
                            <h2 class="content-header-title float-left">Preview Detail Barang</h2>
                        </div>
                        <div class="col-md-2 text-right">
                        <form action="{{ url('matfaskes/detail-bekkes/store-excel') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Impor Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="preview">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_detail_bekkes['data'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $item['kategori_brg'] }}</td>
                                                <td class="text-center">{{ $item['jenis_brg'] }}</td>
                                                <td class="text-center">{{ $item['nama_brg'] }}</td>
                                                <td class="text-center">{{ $item['satuan'] }}</td>
                                                <td class="text-center">{{ $item['jml'] }}</td>
                                                <td class="text-center">{{ $item['keterangan'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Impor Data</button>
                        </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $('#preview').DataTable({
            scrollX: true
        });
    </script>
@endsection