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
                            <h2 class="content-header-title float-left mb-0">Kesatuan</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_kesatuan_modal">Tambah
                                Kesatuan</button>
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
                                    <table class="table table-striped" id="kesatuan-table">
                                        <thead>
                                            <tr>
                                                <th>Matra</th>
                                                <th>Nama Kesatuan</th>
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
    @include('bidum.master.kesatuan.create')
    @include('bidum.master.kesatuan.edit')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#kesatuan-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('kesatuan.list') }}`,
            columns: [{
                    data: 'kode_matra',
                    name: 'kode_matra'
                },
                {
                    data: 'nama_kesatuan',
                    name: 'nama_kesatuan'
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

        function edit_kesatuan(e) {
            let id_kesatuan = e.attr('data-id');

            let action = `{{ route('kesatuan.update', ':kesatuan') }}`;
            var url = `{{ route('kesatuan.edit', ':kesatuan') }}`;

            url = url.replace(':kesatuan', id_kesatuan);
            action = action.replace(':kesatuan', id_kesatuan);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_kesatuan_modal form').attr('action', action);
                    $('#edit_kode_matra').val(response.kode_matra);
                    $('#edit_nama_kesatuan').val(response.nama_kesatuan);
                    $('#edit_kesatuan_modal').modal('show');
                }
            });
        }
    </script>
@endsection
