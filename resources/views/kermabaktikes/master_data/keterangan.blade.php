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
                            <h2 class="content-header-title float-left mb-0">Keterangan</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Keterangan</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('kermabaktikes.master_data.form.keterangan')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="keterangan-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Keterangan</th>
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
        var table = $('#keterangan-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('kerma.keterangan.list') }}`,
            columns: [
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

        function edit_keterangan(e) {
            let id_keterangan = e.attr('data-id');

            let action = `{{ route('kerma.keterangan.update', ':keterangan') }}`;
            var url = `{{ route('kerma.keterangan.show', ':keterangan') }}`;

            url = url.replace(':keterangan', id_keterangan);
            action = action.replace(':keterangan', id_keterangan);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Keterangan")
                    $('#tambah form').attr('action', action);
                    $('#keterangan').val(response.keterangan);
                    $("[name='_method']").val("PUT");
                    $('#tambah').modal('show');
                }
            });
        }

        $("#tambah").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Keterangan")
            $('#tambah form')[0].reset();
            $('#tambah form').attr('action', "{{ route('kerma.keterangan.store') }}");
            $("[name='_method']").val("POST");

        });


    </script>
@endsection
