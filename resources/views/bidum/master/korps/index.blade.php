@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Korps</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_korps">Tambah Korps</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="korps-table">
                                        <thead>
                                            <tr>
                                                <th>Matra</th>
                                                <th>Kode Korps</th>
                                                <th>Nama Korps</th>
                                                <th class="text-center" style="min-width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    @include('bidum.master.korps.create', ['matra' => $matra])
    @include('bidum.master.korps.edit')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#korps-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('korps.list') }}`,
            columns: [{
                    data: 'kode_matra',
                    name: 'kode_matra'
                },
                {
                    data: 'kode_korps',
                    name: 'kode_korps'
                },
                {
                    data: 'nama_korps',
                    name: 'nama_korps'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });

        function edit_korps(e) {
            let id_korps = e.attr('data-id');

            let action = `{{ route('korps.update', ':korps') }}`;
            var url = `{{ route('korps.edit', ':korps') }}`;

            url = url.replace(':korps', id_korps);
            action = action.replace(':korps', id_korps);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_korps form').attr('action', action);
                    $('#edit_kode_matra').val(response.kode_matra);
                    $('#edit_kode_korps').val(response.kode_korps);
                    $('#edit_nama_korps').val(response.nama_korps);
                    $('#edit_korps').modal('show');
                }
            });
        }
    </script>
@endsection
