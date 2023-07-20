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
                    <div class="row">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Daftar Anggaran Dukkesops - 2022</h2>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                    placeholder="Tahun" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="min-width: 300px">Uraian</th>
                                                <th style="min-width: 150px">Sumber Pendanaan</th>
                                                <th>Jumlah Pagu</th>
                                                <th>Realisasi</th>
                                                <th class="text-center" style="min-width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
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
@section('page_script')
    <script>
        var table = $('#table').DataTable({
            // scrollX: true,
            ajax: "{{ url('/app-assets/data/anggaran_dukkesops.json') }}",
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'uraian'
                },
                {
                    data: 'sumber'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'realisasi'
                },                             
                {
                    data: 'action',
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
