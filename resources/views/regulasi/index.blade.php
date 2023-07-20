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

        table td {
            word-wrap: break-word;
            max-width: 300px;
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
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Daftar Regulasi & SOP {{ $kode_bidang }}</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#rf">Tambah Regulasi & SOP</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('regulasi.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- Code Changes: Remove table-responsive-xl -->
                                <table class="table table-striped" id="regulasi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Regulasi & SOP</th>
                                            <th>Tanggal Upload</th>
                                            <th>Kategori</th>
                                            <th class="text-center" style="min-width: 150px;">Aksi</th>
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
        $('#regulasi').DataTable({
            // scrollX: true,
            ajax: "{{ url('regulasi/get/'.$id_bidang) }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_regulasi',
                    name: 'nama_regulasi'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });

        function edit_regulasi(e) {
            let id_regulasi = e.attr('data-id');

            let action = `{{ url('regulasi') }}/${id_regulasi}`;
            var url = `{{ url('regulasi/${id_regulasi}/edit') }}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $("#modal-title").html("Edit Regulasi & SOP Bidang")
                    $('#rf form').attr('action', action);
                    $('#nama_regulasi').val(response.nama_regulasi);
                    $('#id_kat_buku').val(response.id_kat_buku).trigger('change');
                    // $('#id_jenis_kerma').val(response.id_jenis_kerma).trigger('change');
                    $("[name='_method']").val("PUT");
                    $('#rf').modal('show');
                }
            });
        }

        $("#rf").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Regulasi & SOP Bidang")
            $('#rf form')[0].reset();
            $('#rf form').attr('action', "{{ url('regulasi') }}");
            $("[name='_method']").val("POST");
            $("#id_kat_buku").val('').trigger('change');

        });
    </script>
@endsection
