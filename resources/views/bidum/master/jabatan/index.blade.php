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
                            <h2 class="content-header-title float-left mb-0">Jabatan</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_jabatan_modal">Tambah
                                Jabatan</button>
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
                                    <table class="table table-striped table-responsive-xl" id="jabatan-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Jabatan</th>
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
    @include('bidum.master.jabatan.create')
    @include('bidum.master.jabatan.edit')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#jabatan-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('jabatan.list') }}`,
            columns: [{
                    data: 'nama_jabatan',
                    name: 'nama_jabatan'
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

        function edit_jabatan(e) {
            let id_jabatan = e.attr('data-id');

            let action = `{{ route('jabatan.update', ':jabatan') }}`;
            var url = `{{ route('jabatan.edit', ':jabatan') }}`;

            url = url.replace(':jabatan', id_jabatan);
            action = action.replace(':jabatan', id_jabatan);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_jabatan_modal form').attr('action', action);
                    $('#edit_nama_jabatan').val(response.nama_jabatan);
                    $('#edit_jabatan_modal').modal('show');
                }
            });
        }
    </script>
@endsection
