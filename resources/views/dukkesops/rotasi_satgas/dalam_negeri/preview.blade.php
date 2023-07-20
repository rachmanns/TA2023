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
                            <h2 class="content-header-title float-left">Preview File Excel</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <form action="{{ url('dukkesops/rotasi-satgas/import') }}" method="POST" id="myForm">
                                @csrf
                                <button class="btn btn-outline-primary" type="submit">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Pos</th>
                                            <th>Batalyon</th>
                                            <th>Satgas Ops</th>
                                            <th>Berangkat Ops</th>
                                            <th>Kembali Ops</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ps as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p['nama_pos'] }}</td>
                                                <td>{{ $p['nama_batalyon'] }}</td>
                                                <td>{{ $p['nama_satgas'] }}</td>
                                                <td>{{ date('j F Y', strtotime($p['dept_date'])) }}</td>
                                                <td>{{ date('j F Y', strtotime($p['arrv_date'])) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <button class="btn btn-outline-primary" type="submit">Simpan Data</button>
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
@section('page_script')
    <script>
        $('#myForm').one('submit', function() {
            $('.btn').attr('disabled', 'disabled').html('Loading...');
        });
    </script>
@endsection
