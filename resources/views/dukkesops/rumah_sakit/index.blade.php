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
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-8 col-12">
                            <h2 class="content-header-title float-left">Rumah Sakit Umum / Swasta</h2>
                        </div>
                        <div class="col-md-4 col-4 text-right">
                            <a href="#" data-toggle='modal' data-target='#add'><button class="btn btn-primary">Tambah Rumah Sakit</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.rumah_sakit.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama RS</th>
                                            <th>Kategori</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
        $('#rs').DataTable({
            scrollX: true,
            ajax: "{{ url('dukkesops/rs/get') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_rs',
                    name: 'nama_rs'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'latitude',
                    name: 'latitude'
                },
                {
                    data: 'longitude',
                    name: 'longitude'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }

        });

        function edit_rs_pemda_swasta(e) {
            let id_rs_pem_swas = e.attr('data-id');

            let action = `{{ url('dukkesops/rs') }}/${id_rs_pem_swas}`;
            var url = `{{ url('dukkesops/rs') }}/${id_rs_pem_swas}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Rumah Sakit")
                    $('#add form').attr('action', action);
                    $('#nama_rs').val(response.nama_rs);
                    $('#latitude').val(response.latitude);
                    $('#longitude').val(response.longitude);
                    $("[name='_method']").val("PUT");
                    $('#add').modal('show');
                }
            });
        }

        $("#add").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Rumah Sakit")
            $('#add form')[0].reset();
            $('#add form').attr('action', "{{ url('dukkesops/rs') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection
