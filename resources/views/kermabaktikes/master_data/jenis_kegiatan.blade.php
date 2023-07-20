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
                            <h2 class="content-header-title float-left mb-0">Jenis Kegiatan</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Jenis Kegiatan</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('kermabaktikes.master_data.form.jenis_kegiatan')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="jenis-kegiatan-table">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kegiatan</th>
                                                <th>Kategori Kegiatan</th>
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
        var table = $('#jenis-kegiatan-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('kerma.jenis_kegiatan.list') }}`,
            columns: [{
                    data: 'jenis_keg',
                    name: 'jenis_keg'
                },
                {
                    data: 'kategori_keg',
                    name: 'kategori_keg'
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

        function edit_jenis_kegiatan(e) {
            let id_jenis_keg = e.attr('data-id');

            let action = `{{ route('kerma.jenis_kegiatan.update', ':jenis_kegiatan') }}`;
            var url = `{{ route('kerma.jenis_kegiatan.show', ':jenis_kegiatan') }}`;

            url = url.replace(':jenis_kegiatan', id_jenis_keg);
            action = action.replace(':jenis_kegiatan', id_jenis_keg);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Jenis Kegiatan")
                    $('#tambah form').attr('action', action);
                    $('#jenis_keg').val(response.jenis_keg);
                    $("#" + response.kategori_keg).prop("checked", true).trigger('change');
                    $("[name='_method']").val("PUT");
                    $('#tambah').modal('show');
                }
            });
        }

        $("#tambah").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Jenis Kegiatan")
            $('#tambah form')[0].reset();
            $('#tambah form').attr('action', "{{ route('kerma.jenis_kegiatan.store') }}");
            $("[name='_method']").val("POST");
            $("[name='kategori_keg']").prop("checked", false);

        });
    </script>
@endsection
