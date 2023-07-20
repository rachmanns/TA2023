@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                <div class="content-header-left col-md-12 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Pakaian</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_pakaian_modal">Tambah
                                Pakaian</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="table table-striped" id="pakaian-table">
                                        <thead>
                                            <tr>
                                                <th>Item Pakaian</th>
                                                <th class="text-center" style="min-width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    @include('bidum.master.pakaian.create')
    @include('bidum.master.pakaian.edit')
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#pakaian-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('pakaian.list') }}`,
            columns: [{
                    data: 'item_pakaian',
                    name: 'item_pakaian'
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

        function edit_pakaian(e) {
            let id_pakaian = e.attr('data-id');

            let action = `{{ route('pakaian.update', ':pakaian') }}`;
            var url = `{{ route('pakaian.edit', ':pakaian') }}`;

            url = url.replace(':pakaian', id_pakaian);
            action = action.replace(':pakaian', id_pakaian);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#edit_pakaian_modal form').attr('action', action);
                    $('#edit_item_pakaian').val(response.item_pakaian);
                    $('#edit_pakaian_modal').modal('show');
                }
            });
        }
    </script>
@endsection
