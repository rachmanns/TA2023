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
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Data Fasilitas Ambulance</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="fasilitas">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Rumkit</th>
                                            <th>Ambulance Intensif</th>
                                            <th>Ambulance Jenazah</th>
                                            <th>Ambulance Transport</th>
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
        $('#fasilitas').DataTable({
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'intensif'
                },
                {
                    data: 'jenazah'
                },
                {
                    data: 'transport'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection
