@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Review Data Barang</h2>
                        </div>
                        <div class="col-6 text-right">
                            <form action="{{ url('matfaskes/pengadaan/update-excel-brg') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Import Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah Harga</th>
                                                <th>Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item['kategori_barang'] }}</td>
                                                    <td>{{ $item['nama_matkes'] }}</td>
                                                    <td>{{ $item['satuan_brg'] }}</td>
                                                    <td>{{ $item['jumlah'] }}</td>
                                                    <td>{{ $item['harga_satuan'] }}</td>
                                                    <td>{{ $item['harga_satuan'] * $item['jumlah'] }}</td>
                                                    <td>{{ $item['keterangan'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Import Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
