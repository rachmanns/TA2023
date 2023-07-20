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
                            <h2 class="content-header-title float-left mb-0">Daftar Kategori</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Kategori</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.master_data.form.kategori_duk')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="kategori-duk-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Kategori</th>
                                                <th>Jenis Kategori</th>
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
        var table = $('#kategori-duk-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: `{{ url('dukkesops/kategori-duk/get') }}`,
            columns: [
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'jenis_keg_duk.nama_jenis',
                    name: 'jenis_keg_duk.nama_jenis'
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

        function edit_kategori_duk(e) {
            let id_kat_duk = e.attr('data-id');

            let action = `{{ url('dukkesops/kategori-duk') }}/${id_kat_duk}`;
            var url = `{{ url('dukkesops/kategori-duk') }}/${id_kat_duk}/edit`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Kategori")
                    $('#tambah form').attr('action', action);
                    $('#nama_kategori').val(response.nama_kategori);
                    $('#id_jenis_keg_duk').val(response.id_jenis_keg_duk).trigger('change');
                    $("[name='_method']").val("PUT");
                    $('#tambah').modal('show');
                }
            });
        }

        $("#tambah").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Kategori")
            $('#tambah form')[0].reset();
            $('#tambah form').attr('action', "{{ url('dukkesops/kategori-duk') }}");
            $("[name='_method']").val("POST");

        });


    </script>
@endsection
