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
                    <h2 class="content-header-title float-left">Dokumen SDM</h2>
                    <a data-toggle='modal' data-target='#add'><button class="btn btn-primary">Tambah Dokumen SDM</button></a>

                    @include('bangkes.dokumen_tenaga_medis.form')
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="demo-spacing-0 mb-1">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <i data-feather="info" class="mr-50 align-middle"></i>
                                    <span> Dokumen yang ditambahkan hanya sebagai arsip dan tidak terhubung dengan data lain. </span>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Tahun</th>
                                            <th class="text-center">File</th>
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
    var table = $('#table').DataTable({
        ajax: "{{ url('bangkes/dokumen-tenaga-medis/get') }}",
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'judul'
            },
            {
                data: 'tahun'
            },
            {
                data: 'file'
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

    $("#add").on("hide.bs.modal", function() {
        $("#modal-title").html("Tambah Dokumen SDM")
        $('#add form')[0].reset();
        $('#add form').attr('action', "{{ url('bangkes/dokumen-tenaga-medis') }}" );
        $("[name='_method']").val("POST");
    });

    function edit_doc(e) {
            let id_doc_tenaga_medis = e.attr('data-id');

            let action = `{{ url('bangkes/dokumen-tenaga-medis') }}/${id_doc_tenaga_medis}`;
            var url = `{{ url('bangkes/dokumen-tenaga-medis') }}/${id_doc_tenaga_medis}/edit`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Dokumen SDM")
                    $('#add form').attr('action', action);
                    $('#judul').val(response.judul);
                    $('#tahun').val(response.tahun);
                    $("[name='_method']").val("PUT");
                    $('#add').modal('show');
                }
            });
        }
</script>
@endsection