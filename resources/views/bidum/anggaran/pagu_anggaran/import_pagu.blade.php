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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Review Data Import Pagu Anggaran</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-footer text-right">
                                    <form action="{{ route('bidum.anggaran.pagu_import_store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pagu_awal_data" value="{{ json_encode($pagu_awal) }}">
                                        <button type="submit" class="btn btn-primary">Import Data</button>
                                    </form>
                                </div>
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-lg" id="pagu_awal_table">
                                        <thead>
                                            <tr>
                                                <th>Bidang</th>
                                                <th>Akun</th>
                                                <th>Uraian</th>
                                                <th>Pagu Awal</th>
                                                <th>Kewenangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pagu_awal as $item)
                                                <tr class="{{ $item['pagu_awal'] == null ? 'bg-warning' : '' }} ">
                                                    <td>{{ $item['kode_bidang'] }}</td>
                                                    <td>{{ $item['kode_akun'] }}</td>
                                                    <td>{{ $item['nama_uraian'] }}</td>
                                                    <td>{{ $item['pagu_awal'] }}</td>
                                                    <td>{{ $item['kode_dipa'] == 'DIPPUS' ? 'Pusat' : 'Daerah' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    <form action="{{ route('bidum.anggaran.pagu_import_store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pagu_awal_data" value="{{ json_encode($pagu_awal) }}">
                                        <button type="submit" class="btn btn-primary">Import Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
