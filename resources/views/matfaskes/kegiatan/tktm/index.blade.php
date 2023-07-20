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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Kegiatan TKTM</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" class="form-control bg-white yearpicker" placeholder="Periode" id="tahun" autocomplete="off" />
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="tktm-table">
                                        <thead>
                                            <tr>
                                                <th>No. Kontrak</th>
                                                <th>Tahun</th>
                                                <th>Nominal Kontrak</th>
                                                <th>Tanggal Kontrak</th>
                                                <th>Pelaksana</th>
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
        $(function() {
            let year = moment().format('YYYY');
            list_tktm(year);

        })

        function list_tktm(year) {
            var table = $('#tktm-table').DataTable({
                destroy: true,
                processing: true,
                ajax: {
                    url: `{{ url('matfaskes/tktm/list') }}`,
                    method: 'POST',
                    data: {year: year},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'no_kontrak_tktm',
                        name: 'no_kontrak_tktm'
                    },
                    {
                        data: 'tahun'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'tgl_kontrak_tktm',
                        name: 'tgl_kontrak_tktm'
                    },
                    {
                        data: 'pelaksana_tktm',
                        name: 'pelaksana_tktm'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        $('#tahun').change(function () {
            list_tktm($(this).val());
        });
    </script>
@endsection
