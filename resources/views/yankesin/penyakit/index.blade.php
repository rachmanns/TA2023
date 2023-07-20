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
                        <div class="col-md-9">
                            <h2 class="content-header-title float-left">Daftar Penyakit</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#pm'><button class="btn btn-primary">Tambah Penyakit</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('yankesin.penyakit.create')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="penyakit">
                                    <thead>
                                        <tr>
                                            <th>Penyakit</th>
                                            <th class="text-center pl-4 pr-4">Aksi</th>
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
        var table = $('#penyakit').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('yankesin/penyakit/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_penyakit',
                    name: 'nama_penyakit'
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

        function edit_penyakit(e) {
            let id_penyakit = e.attr('data-id');

            let action = `{{ url('yankesin/penyakit') }}/${id_penyakit}`;
            var url = `{{ url('yankesin/penyakit') }}/${id_penyakit}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Penyakit")
                    $('#pm form').attr('action', action);
                    $('#nama_penyakit').val(response.nama_penyakit);
                    $("[name='_method']").val("PUT");
                    $('#pm').modal('show');
                }
            });
        }

        $("#pm").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Penyakit")
            $('#pm form')[0].reset();
            $('#pm form').attr('action', "{{ url('yankesin/penyakit') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection