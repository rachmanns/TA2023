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

        .flatpickr-wrapper {
            display: block;
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
                        <div class="col-md-9 col-9">
                            <h2 class="content-header-title float-left">Daftar Dukkes</h2>
                        </div>
                        <div class="col-md-3 col-3 text-right">
                            <a data-toggle='modal' data-target='#add'><button class="btn btn-primary">Tambah Dukkes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dukkes">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Dukkes</th>
                                                <th>Tempat</th>
                                                <th>Tanggal</th>
                                                <th>Ket</th>
                                                <th class="text-center" style="min-width: 150px;">Lampiran Surat</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            @include('dukkesops.daftar_dukkes.form')
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
        $('#dukkes').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: "{{ url('dukkesops/dukkes/list') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_dukkes',
                    name: 'nama_dukkes'
                },
                {
                    data: 'tempat',
                    name: 'tempat'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'lampiran_surat',
                    name: 'lampiran_surat'
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

        function edit_dukkes(e) {
            let id_dukkes = e.attr('data-id');

            let action = `{{ url('dukkesops/dukkes') }}/${id_dukkes}`;
            var url = `{{ url('dukkesops/dukkes') }}/${id_dukkes}/edit`;

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.table(response);
                    $("#modal-title").html("Edit Dukkes")
                    $('#add form').attr('action', action);
                    $('#tempat').val(response.tempat);
                    $('#nama_dukkes').val(response.nama_dukkes);
                    $('#tanggal').val(response.tanggal);
                    $('#keterangan').val(response.keterangan);
                    $("[name='_method']").val("PUT");
                    $('#add').modal('show');
                }
            });
        }

        $("#add").on("hide.bs.modal", function() {

            $("#modal-title").html("Input Dukkes")
            $('#add form')[0].reset();
            $('#add form').attr('action', "{{ route('dukkesops.dukkes.store') }}");
            $("[name='_method']").val("POST");

        });

        $("#tanggal").flatpickr({
            static: true,
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
