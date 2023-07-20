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
                            <h2 class="content-header-title float-left mb-0">Status</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Status</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('kermabaktikes.master_data.form.status')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="status-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Status</th>
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
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#status-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: `{{ route('kerma.status.list') }}`,
            columns: [
                {
                    data: 'nama_status',
                    name: 'nama_status'
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

        function edit_status(e) {
            let id_status = e.attr('data-id');

            let action = `{{ route('kerma.status.update', ':status') }}`;
            var url = `{{ route('kerma.status.show', ':status') }}`;

            url = url.replace(':status', id_status);
            action = action.replace(':status', id_status);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Status")
                    $('#tambah form').attr('action', action);
                    $('#nama_status').val(response.nama_status);
                    $("[name='_method']").val("PUT");
                    $('#tambah').modal('show');
                }
            });
        }

        $("#tambah").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Status")
            $('#tambah form')[0].reset();
            $('#tambah form').attr('action', "{{ route('kerma.status.store') }}");
            $("[name='_method']").val("POST");

        });


    </script>
@endsection
