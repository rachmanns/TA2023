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
                            <h2 class="content-header-title float-left">Daftar Geografis</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#gm'><button class="btn btn-primary">Tambah Geografis</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.geografis.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="geografis">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Geografis</th>
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
        var table = $('#geografis').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('dukkesops/geografis/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'jenis_geografis',
                    name: 'jenis_geografis'
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

        function edit_geografis(e) {
            let id_geografis = e.attr('data-id');

            let action = `{{ url('dukkesops/geografis') }}/${id_geografis}`;
            var url = `{{ url('dukkesops/geografis') }}/${id_geografis}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Geografis")
                    $('#gm form').attr('action', action);
                    $('#jenis_geografis').val(response.jenis_geografis);
                    $("[name='_method']").val("PUT");
                    $('#gm').modal('show');
                }
            });
        }

        $("#gm").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Geografis")
            $('#gm form')[0].reset();
            $('#gm form').attr('action', "{{ url('dukkesops/geografis') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection