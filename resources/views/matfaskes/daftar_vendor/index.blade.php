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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-9">
                            <h2 class="content-header-title float-left mb-0">Data Vendor</h2>
                        </div>
                        <div class="col-3 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_vendor">Tambah
                                Vendor</button>
                            @include('matfaskes.daftar_vendor.form')
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-datatable">
                                <table class="table table-striped table-responsive-xl" id="table-vendor">
                                    <thead>
                                        <tr>
                                            <th>Nama Penyedia</th>
                                            <th>Alamat Penyedia</th>
                                            <th>Direktur</th>
                                            <th>NPWP Badan</th>
                                            <th class="text-center" style="min-width: 100px;">AKSI</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(function() {
            var table = $('#table-vendor').DataTable({
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: "{{ route('matfaskes.vendor.list') }}",
                columns: [{
                        data: 'nama_vendor',
                        name: 'nama_vendor'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'direktur',
                        name: 'direktur'
                    },
                    {
                        data: 'npwp',
                        name: 'npwp'
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
        })

        $("#modal_vendor").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Vendor")
            $('#modal_vendor form')[0].reset();
            $('#modal_vendor form').attr('action', "{{ route('matfaskes.vendor.store') }}");
            $("[name='_method']").val("POST");

        });

        function edit_vendor(e) {
            var id_vendor = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('matfaskes/vendor/edit') }}" + '/' + id_vendor,
                success: function(response) {
                    $('#modal_vendor').modal('show');
                    $("#modal-title").html("Edit Vendor")
                    $('#modal_vendor form').attr('action', action);
                    $("[name='_method']").val("PUT");
                    $("#nama_vendor").val(response.nama_vendor);
                    $("#alamat").val(response.alamat);
                    $("#direktur").val(response.direktur);
                    $("#npwp").val(response.npwp);


                }
            });

        }
    </script>
@endsection
