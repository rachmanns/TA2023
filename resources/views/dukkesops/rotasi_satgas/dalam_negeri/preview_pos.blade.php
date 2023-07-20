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
                            <form action="{{ url('dukkesops/penugasan-pos/import') }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn btn-outline-primary" type="submit"> Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable">
                                <table class="table table-striped table-responsive" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pos</th>
                                            <th>Nama Pers Kegiatan</th>
                                            <th>No Telp</th>
                                            <th>Jumlah Personil</th>
                                            @foreach (array_keys($ps[0]['bekkes']) as $b)
                                                <th>{{ $temp_bekkes[$b] }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ps as $key1 => $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p['nama_pos'] }}</td>
                                                <td>{{ $p['nama_ketua'] }}</td>
                                                <td>{{ $p['no_telp'] }}</td>
                                                <td>{{ $p['jml_personil'] }}</td>
                                                @foreach ($ps[$key1]['bekkes'] as $c)
                                                    <th>{{ $c }}</th>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <button class="btn btn-outline-primary" type="submit"> Simpan Data</button>
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
