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
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery-ui.css') }}">
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
                            <h2 class="content-header-title float-left">Daftar Master Bekkes</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#mb'><button class="btn btn-primary">Tambah Master Bekkes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.master_bekkes.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="master_bekkes">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Bekkes</th>
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
<script src="{{ url('assets/js/jquery-ui.js') }}"></script>
    <script>
        var table = $('#master_bekkes').DataTable({
            destroy: true,
            "pageLength": 100,
            processing: true,
            serverSide: true,
            ajax:"{{ url('dukkesops/master-bekkes/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_bekkes',
                    name: 'nama_bekkes'
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
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).attr('id', data.id_mas_bek);
            }
        });

        function edit_master_bekkes(e) {
            let id_master_bekkes = e.attr('data-id');

            let action = `{{ url('dukkesops/master-bekkes') }}/${id_master_bekkes}`;
            var url = `{{ url('dukkesops/master-bekkes') }}/${id_master_bekkes}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Master Bekkes")
                    $('#mb form').attr('action', action);
                    $('#nama_bekkes').val(response.nama_bekkes);
                    $("[name='_method']").val("PUT");
                    $('#mb').modal('show');
                }
            });
        }

        $("#mb").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Master Bekkes")
            $('#mb form')[0].reset();
            $('#mb form').attr('action', "{{ url('dukkesops/master-bekkes') }}" );
            $("[name='_method']").val("POST");
        });

        var sortable_bekkes = $("tbody").sortable({
            update: function(event, ui) {
                var sortedIDs = $(this).sortable("toArray");
                
                $.ajax({
                    type: "POST",
                    url: `{{ url('dukkesops/master-bekkes/update-urutan') }}`,
                    data: {_token: `{{ csrf_token() }}`, urutan: sortedIDs},
                    success: function (response) {
                        $('#master_bekkes').DataTable().ajax.reload();
                    }
                });
            }
        });
    </script>
@endsection