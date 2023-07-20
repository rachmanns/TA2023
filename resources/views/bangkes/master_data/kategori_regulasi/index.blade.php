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
                        <div class="col-md-8">
                            <h2 class="content-header-title float-left">Daftar Kategori Buku & Regulasi</h2>
                        </div>
                        <div class="col-md-4 text-right">
                            <a data-toggle='modal' data-target='#jp'><button class="btn btn-primary">Tambah Kategori Buku & Regulasi</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('bangkes.master_data.kategori_regulasi.create')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="kategori">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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
        var table = $('#kategori').DataTable({
            destroy: true,
            ajax: `{{ url('bangkes/kategori-buku/get') }}`,
            columns: [
                {
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama_kat_buku'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });

        function edit_kat_buku(e) {
            let id_kat_buku = e.attr('data-id');

            let action = `{{ url('bangkes/kategori-buku') }}/${id_kat_buku}`;
            var url = `{{ url('bangkes/kategori-buku') }}/${id_kat_buku}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Kategori Regulasi")
                    $('#jp form').attr('action', action);
                    $('#nama_kat_buku').val(response.nama_kat_buku);
                    $("[name='_method']").val("PUT");
                    $('#jp').modal('show');
                }
            });
        }

        $("#jp").on("hide.bs.modal", function() {
            $("#modal-title").html("Tambah Kategori Regulasi")
            $('#jp form')[0].reset();
            $('#jp form').attr('action', "{{ url('bangkes/kategori-buku') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection