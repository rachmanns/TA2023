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
                            <h2 class="content-header-title float-left mb-0">Event</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Event</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('kermabaktikes.master_data.form.event')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="event-table">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kerma</th>
                                                <th>Nama Event</th>
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
        var table = $('#event-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('kerma.event.list') }}`,
            columns: [{
                    data: 'jenis_kerma.jenis_kerma',
                    name: 'jenis_kerma.jenis_kerma'
                },
                {
                    data: 'nama_event',
                    name: 'nama_event'
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

        function edit_event(e) {
            let id_event = e.attr('data-id');

            let action = `{{ route('kerma.event.update', ':event') }}`;
            var url = `{{ route('kerma.event.show', ':event') }}`;

            url = url.replace(':event', id_event);
            action = action.replace(':event', id_event);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Event")
                    $('#tambah form').attr('action', action);
                    $('#nama_event').val(response.nama_event);
                    $('#id_jenis_kerma').val(response.id_jenis_kerma).trigger('change');
                    $("[name='_method']").val("PUT");
                    $('#tambah').modal('show');
                }
            });
        }

        $("#tambah").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Event")
            $('#tambah form')[0].reset();
            $('#tambah form').attr('action', "{{ route('kerma.event.store') }}");
            $("[name='_method']").val("POST");
            $("#id_jenis_kerma").val('').trigger('change');

        });


    </script>
@endsection
