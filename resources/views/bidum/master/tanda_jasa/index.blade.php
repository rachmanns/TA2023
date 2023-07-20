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
                            <h2 class="content-header-title float-left mb-0">Tanda Jasa</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_tanda_jasa_modal">Tambah Tanda
                                Jasa</button>
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
                                <div class="card-datatable table-responsive">
                                    <table class="table table-striped" id="tanda-jasa-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Tanda Jasa</th>
                                                <th>Keterangan</th>
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
    @include('bidum.master.tanda_jasa.create')
    @include('bidum.master.tanda_jasa.edit')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#tanda-jasa-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('tanda_jasa.list') }}`,
            columns: [{
                    data: 'nama_jasa',
                    name: 'nama_jasa'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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

        function edit_tanda_jasa(e) {
            let id_jasa = e.attr('data-id');

            let action = `{{ route('tanda_jasa.update', ':tanda_jasa') }}`;
            var url = `{{ route('tanda_jasa.edit', ':tanda_jasa') }}`;

            url = url.replace(':tanda_jasa', id_jasa);
            action = action.replace(':tanda_jasa', id_jasa);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_tanda_jasa_modal form').attr('action', action);
                    $('#edit_nama_jasa').val(response.nama_jasa);
                    $('#edit_keterangan').val(response.keterangan);
                    $('#edit_tanda_jasa_modal').modal('show');
                }
            });
        }
    </script>
@endsection
