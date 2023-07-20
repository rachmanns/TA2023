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
                            <h2 class="content-header-title float-left">Daftar Tingkat RS</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#tr'><button class="btn btn-primary">Tambah Tingkat RS</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('yankesin.tingkat_rs.create')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="tingkat-rs">
                                    <thead>
                                        <tr>
                                            <th>Tingkat RS</th>
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
        var table = $('#tingkat-rs').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('yankesin/tingkat-rs/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_tingkat_rs',
                    name: 'nama_tingkat_rs'
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

        function edit_tingkat_rs(e) {
            let id_tingkat_rs = e.attr('data-id');

            let action = `{{ url('yankesin/tingkat-rs') }}/${id_tingkat_rs}`;
            var url = `{{ url('yankesin/tingkat-rs') }}/${id_tingkat_rs}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Tingkat RS")
                    $('#tr form').attr('action', action);
                    $('#nama_tingkat_rs').val(response.nama_tingkat_rs);
                    $("[name='_method']").val("PUT");
                    $('#tr').modal('show');
                }
            });
        }

        $("#tr").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Tingkat RS")
            $('#tr form')[0].reset();
            $('#tr form').attr('action', "{{ url('yankesin/tingkat-rs') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection