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
                            <h2 class="content-header-title float-left">Daftar Satgas Ops</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#so'><button class="btn btn-primary">Tambah Satgas Ops</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.satgas_ops.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="satgas-ops">
                                    <thead>
                                        <tr>
                                            <th>Satgas Ops</th>
                                            <th>Jenis Satgas</th>
                                            <th>Keterangan</th>
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
        var table = $('#satgas-ops').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('dukkesops/satgas-ops/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_kat_satgas',
                    name: 'nama_kat_satgas'
                },
                {
                    data: 'jenis_satgas',
                    name: 'jenis_satgas'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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

        function edit_satgas_ops(e) {
            let id_satgas_ops = e.attr('data-id');

            let action = `{{ url('dukkesops/satgas-ops') }}/${id_satgas_ops}`;
            var url = `{{ url('dukkesops/satgas-ops') }}/${id_satgas_ops}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Satgas Ops")
                    $('#so form').attr('action', action);
                    $('#nama_kat_satgas').val(response.nama_kat_satgas);
                    $('#keterangan').val(response.keterangan);
                    $(`#${response.jenis_satgas}`).prop("checked", true);
                    $(`#${response.jenis_satgas.toLowerCase()}`).prop("checked", true);
                    $("[name='_method']").val("PUT");
                    $('#so').modal('show');
                }
            });
        }

        $("#so").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Satgas Ops")
            $('#so form')[0].reset();
            $('#so form').attr('action', "{{ url('dukkesops/satgas-ops') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection