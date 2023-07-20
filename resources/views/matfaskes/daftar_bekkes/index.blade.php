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
                <div class="d-flex justify-content-between">
                    <h2 class="content-header-title float-left">Daftar Bekkes</h2>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12">
                <div class="input-group input-group-merge form-input">
                    <input type="text" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Berjalan" id="tahun" readonly />
                    <div class="input-group-append">
                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12 mb-1">
                <select class="select2 form-control" id="filter_jenis_tujuan">
                    <option value="all" selected>All</option>
                    <option value="ln">LN</option>
                    <option value="dn">DN</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-4 col-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah Bekkes</button>
            </div>
        </div>
        @include('matfaskes.daftar_bekkes.create_data_bekkes')
        @include('matfaskes.daftar_bekkes.edit_data_bekkes')
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 50px">No</th>
                                            <th>Bekkes</th>
                                            <th>LN/DN</th>
                                            <th>Tahun</th>
                                            <th class="text-center" style="min-width: 100px">Aksi</th>
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

        function data_bekkes_table(year, jenis_tujuan='all') {
            var table = $('#table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('matfaskes/data-bekkes/get') }}",
                    method: 'POST',
                    data: {year: year, jenis_tujuan: jenis_tujuan},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'master_bekkes.nama_bekkes'
                    },
                    {
                        data: 'jenis_tujuan'
                    },
                    {
                        data: 'tahun_anggaran'
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
        }

        $('#add').on('hidden.bs.modal', function(e) {

            var reset_form = $('#add form')[0];
            $(reset_form).removeClass('was-validated');
            reset_form.reset();

        })

        $(function(){
            data_bekkes_table()

            $(document).on('change', '#tahun', function() {
                data_bekkes_table($(this).val(), $('#filter_jenis_tujuan').val());
            });

            $(document).on('change', '#filter_jenis_tujuan', function() {
                data_bekkes_table($('#tahun').val(), $(this).val())
            });
        })

        function edit_data_bekkes(e) {
            let id_data_bekkes = e.attr('data-id');

            let action = `{{ url('matfaskes/data-bekkes/${id_data_bekkes}') }}`;
            var url = `{{ url('matfaskes/data-bekkes/${id_data_bekkes}/edit') }}`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $("#modal-title").html("Edit Jenis Paramedis")
                    $('#edit form').attr('action', action);
                    $('#edit_id_mas_bek').val(response.id_mas_bek).trigger('change');
                    $('#edit_jenis_tujuan').val(response.jenis_tujuan).trigger('change');
                    $('#edit_tahun_anggaran').val(response.tahun_anggaran);
                    $("[name='_method']").val("PUT");
                    $('#edit').modal('show');
                }
            });
        }
    </script>
@endsection