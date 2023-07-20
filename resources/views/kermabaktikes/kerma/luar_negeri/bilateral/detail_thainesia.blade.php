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

        table.dataTable tbody td {
            vertical-align: top;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Thainesia Milmed 7th</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg">
                        <option selected disabled>Keterangan</option>
                        <option value="1">Terencana</option>
                        <option value="2">Terlaksana</option>
                        <option value="3">Batal</option>
                        <option value="4">Tunda</option>
                    </select>
                </div>
                <div class="col-md-9 text-right">
                    <a href="/tambah_kegiatan_bilateral"><button class="btn btn-primary">Tambah Kegiatan</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="detail-thainesia table table-striped table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Tempat</th>
                                            <th>Waktu</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
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
