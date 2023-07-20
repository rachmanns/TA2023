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
                        <div class="col-md-8 col-12">
                            <h2 class="content-header-title float-left">Daftar Tipe Pos</h2>
                        </div>
                        <div class="col-md-4 col-4 text-right">
                            {{-- <a href="#" data-toggle='modal' data-target='#add'><button class="btn btn-primary">Tambah Tipe Pos</button></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            @include('dukkesops.tipe_pos.form')
            @include('dukkesops.tipe_pos.show')
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tipe Pos</th>
                                            <th>Icon</th>
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
        $('#rs').DataTable({
            scrollX: true,
            ajax: `{{ url('dukkesops/tipe-pos/get') }}`,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tipe_pos',
                    name: 'tipe_pos'
                },
                {
                    data: 'image',
                    name: 'image'
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

        function edit_data(e) {
            let id_tipe_pos = e.attr('data-id');

            let action = `{{ url('dukkesops/tipe-pos') }}/${id_tipe_pos}`;

            var url = `{{ url('dukkesops/tipe-pos/edit/${id_tipe_pos}') }}`;

            let public = "{{ url('app-assets/images/ico')}}/";

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#modal-title').html('Edit Tipe Pos ' + response.tipe.toUpperCase());
                    $('#add form').attr('action', action);
                    $("[name='_method']").val("PUT");
                    $('#add').modal('show');
                    $('#tipe').val(response.tipe);
                    $('#id').val(response.id_tipe_pos);
                    if (response.image != "") {
                        $('#icon').attr("src", `${public}${response.image}`);
                    } else {
                        if (response.tipe == 'darat') {
                            $('#icon').attr("src", `${public}${response.tipe}.png`);
                        } else {
                            $('#icon').attr("src", `${public}pos-${response.tipe}.png`);
                        }
                    }
                }
            });
        }
    </script>
@endsection
