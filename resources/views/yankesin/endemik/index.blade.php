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
                            <h2 class="content-header-title float-left">Daftar Endemik</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#em'><button class="btn btn-primary">Tambah Endemik</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('yankesin.endemik.create')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="endemik">
                                    <thead>
                                        <tr>
                                            <th>Endemik</th>
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
        var table = $('#endemik').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('yankesin/endemik/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_endemik',
                    name: 'nama_endemik'
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

        function edit_endemik(e) {
            let id_endemik = e.attr('data-id');

            let action = `{{ url('yankesin/endemik') }}/${id_endemik}`;
            var url = `{{ url('yankesin/endemik') }}/${id_endemik}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Endemik")
                    $('#em form').attr('action', action);
                    $('#nama_endemik').val(response.nama_endemik);
                    $("[name='_method']").val("PUT");
                    $('#em').modal('show');
                }
            });
        }

        $("#em").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Endemik")
            $('#em form')[0].reset();
            $('#em form').attr('action', "{{ url('yankesin/endemik') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection