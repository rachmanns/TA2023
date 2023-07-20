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
                            <h2 class="content-header-title float-left">Daftar Jenis Pelatihan</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#jp'><button class="btn btn-primary">Tambah Jenis Pelatihan</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('bangkes.master_data.jenis_pelatihan.create')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="jenis-pelatihan">
                                    <thead>
                                        <tr>
                                            <th>Jenis Pelatihan</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
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
        var table = $('#jenis-pelatihan').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax:"{{ url('bangkes/jenis-pelatihan/get') }}",
            // scrollX: true,
            columns: [
                {
                    data: 'nama_pelatihan',
                    name: 'nama_pelatihan'
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

        function edit_jenis_pelatihan(e) {
            let id_jenis_pelatihan = e.attr('data-id');

            let action = `{{ url('bangkes/jenis-pelatihan') }}/${id_jenis_pelatihan}`;
            var url = `{{ url('bangkes/jenis-pelatihan') }}/${id_jenis_pelatihan}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Jenis Pelatihan")
                    $('#jp form').attr('action', action);
                    $('#nama_pelatihan').val(response.nama_pelatihan);
                    $("[name='_method']").val("PUT");
                    $('#jp').modal('show');
                }
            });
        }

        $("#jp").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Jenis Pelatihan")
            $('#jp form')[0].reset();
            $('#jp form').attr('action', "{{ url('bangkes/jenis-pelatihan') }}" );
            $("[name='_method']").val("POST");
        });
    </script>
@endsection