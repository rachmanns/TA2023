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
                        <div class="col-md-6">
                            <h2 class="content-header-title float-left">Data Buku</h2>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('bangkes.buku.create') }}"><button class="btn btn-primary">Tambah Data Buku</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="buku">
                                    <thead>
                                        <tr>
                                            <th>No. Buku</th>
                                            <th style="min-width: 300px;">Judul</th>
                                            <th>Kategori</th>
                                            <th>Tahun Terbit</th>
                                            <th style="min-width: 300px;">Abstrak</th>
                                            <th class="text-center"  style="min-width: 150px;">File Buku</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
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
        $('#buku').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{ url('/bangkes/buku/list') }}",
            columns: [
                {
                    data: 'no_buku',
                    name: 'no_buku'
                },
                {
                    data: 'nama_buku',
                    name: 'nama_buku'
                },
                {
                    data: 'kategori_buku.nama_kat_buku',
                    name: 'kategori_buku.nama_kat_buku'
                },
                {
                    data: 'tahun_terbit',
                    name: 'tahun_terbit'
                },
                {
                    data: 'abstraksi',
                    name: 'abstraksi'
                },
                {
                    data: 'file_buku',
                    name: 'file_buku'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }

        });
    </script>
@endsection