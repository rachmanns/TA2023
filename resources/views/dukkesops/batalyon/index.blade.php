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
                            <h2 class="content-header-title float-left">Daftar Batalyon</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#batalyon-modal'><button class="btn btn-primary">Tambah Batalyon</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.batalyon.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="batalyon">
                                    <thead>
                                        <tr>
                                            <th>Batalyon</th>
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
        var table = $('#batalyon').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('dukkesops/batalyon/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_batalyon',
                    name: 'nama_batalyon'
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

        function edit_batalyon(e) {
            let id_batalyon = e.attr('data-id');

            let action = `{{ url('dukkesops/batalyon') }}/${id_batalyon}`;
            var url = `{{ url('dukkesops/batalyon') }}/${id_batalyon}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Batalyon")
                    $('#batalyon-modal form').attr('action', action);
                    $('#nama_batalyon').val(response.nama_batalyon);
                    $("[name='_method']").val("PUT");
                    $('#batalyon-modal').modal('show');
                }
            });
        }

        $("#batalyon-modal").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Batalyon")
            $('#batalyon-modal form')[0].reset();
            $('#batalyon-modal form').attr('action', "{{ url('dukkesops/batalyon') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection