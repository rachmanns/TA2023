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
            max-width: 200px;
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
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Log Perubahan Data Fasilitas Faskes</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- Code Changes: Remove table-responsive-xl -->
                                <table class="table table-striped" id="pengajuan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            @if(!isset(Auth::user()->id_faskes))
                                            <th>Nama RS</th>
                                            @endif
                                            <th class="text-center">Fasilitas</th>
                                            <th class="text-center">Tanggal Perubahan</th>
                                            <th>Summary</th>
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
        $('#pengajuan').DataTable({
        ajax: "{{ url('/faskes/perubahan_faskes/list') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            @if(!isset(Auth::user()->id_faskes))
            {
                data: 'rs.nama_rs',
            },
            @endif
            {
                data: 'fasilitas.nama_fasilitas',
            },
            {
                data: 'updated_at',
                className: 'text-center',
                render: function(data) {
                    return '<span style="display:none">' + data + '</span>' + new Date(data).toLocaleString('id-ID', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour12: false,
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    }).replace(/\./g, ':');
                }
            },
            {
                data: 'status',
                render: function(data) {
                    return data ?? '-';
                }
            },
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });
    </script>
@endsection
