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
                            <h2 class="content-header-title float-left">Daftar Fasilitas</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#kf'><button class="btn btn-primary">Tambah Fasilitas</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('yankesin.fasilitas.form')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="fasilitas">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Fasilitas</th>
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
        var table = $('#fasilitas').DataTable({
            destroy: true,
            processing: true,
            ajax:"{{ url('yankesin/fasilitas/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'kategori_fasilitas.nama_kategori',
                    name: 'kategori_fasilitas.nama_kategori'
                },
                {
                    data: 'nama_fasilitas',
                    name: 'nama_fasilitas'
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

        function edit_fasilitas(e) {
            let id_fasilitas = e.attr('data-id');

            let action = `{{ url('yankesin/fasilitas') }}/${id_fasilitas}`;
            var url = `{{ url('yankesin/fasilitas') }}/${id_fasilitas}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Fasilitas")
                    $('#kf form').attr('action', action);
                    $('#id_kategori').val(response.id_kategori);
                    $('#nama_fasilitas').val(response.nama_fasilitas);
                    $("[name='_method']").val("PUT");
                    $('#kf').modal('show');
                }
            });
        }

        $("#kf").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Fasilitas")
            $('#kf form')[0].reset();
            $('#kf form').attr('action', "{{ url('yankesin/fasilitas') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection