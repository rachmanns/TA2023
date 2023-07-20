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
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Daftar Spesialis</h2>
                        </div>
                        <div class="col-md-3 col-12 text-lg-right">
                            <a data-toggle='modal' data-target='#spesialis'><button class="btn btn-primary">Tambah Daftar Spesialis</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-lg" id="jenis-spesialis">
                                    <thead>
                                        <tr>
                                            <th>Kategori Dokter</th>
                                            <th>Spesialis</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Dokter Spesialis</td>
                                            <td>Spesialis Gigi</td>
                                            <td><div class='text-center'><a href=''><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div></td>
                                        </tr>
                                    </tbody> --}}
                                    @include('bangkes.master_data.spesialis.create')
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
        var table = $('#jenis-spesialis').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ url('bangkes/jenis-spesialis/list') }}`,
            columns: [{
                    data: 'kategori_dokter.nama_kategori',
                    name: 'kategori_dokter.nama_kategori'
                },
                {
                    data: 'nama_spesialis',
                    name: 'nama_spesialis'
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

        function edit_jenis_spesialis(e) {
            let id_spesialis = e.attr('data-id');

            let action = `{{ url('bangkes/jenis-spesialis') }}/${id_spesialis}`;
            var url = `{{ url('bangkes/jenis-spesialis') }}/${id_spesialis}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Spesialis")
                    $('#spesialis form').attr('action', action);
                    $('#id_kategori_dokter').val(response.id_kategori_dokter);
                    $('#nama_spesialis').val(response.nama_spesialis);
                    // $('#id_jenis_kerma').val(response.id_jenis_kerma).trigger('change');
                    $("[name='_method']").val("PUT");
                    $('#spesialis').modal('show');
                }
            });
        }

        $("#spesialis").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Spesialis")
            $('#spesialis form')[0].reset();
            $('#spesialis form').attr('action', "{{ url('bangkes/jenis-spesialis') }}");
            $("[name='_method']").val("POST");
            $("#id_kategori_dokter").val('').trigger('change');

        });
    </script>
@endsection