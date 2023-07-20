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
                            <h2 class="content-header-title float-left">Bed Occupancy Ratio</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="/tambah_bor"><button class="btn btn-primary">Tambah Data BOR</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="bor">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">22 Januari 2022</td>
                                            <td class="text-center"><div class='badge badge-light-warning font-small-4'>Diajukan</div></td>
                                            <td class="text-center"><a href="/edit_bor"><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></td>
                                        </tr>
                                    </tbody>
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
        $('#bor').DataTable({
        // ajax: "{{ url('/app-assets/data/distribusi.json') }}",
        columns: [
            {
                data: 'tgl',
                name: 'tgl'
            },
            {
                data: 'status',
                name: 'status'
            },
            {   data: 'action',
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