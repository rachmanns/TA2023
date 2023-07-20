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
                    <!-- Code Changes: split breakpoints into lg & md -->
                    <div class="col-lg-7 col-md-6">
                        <h2 class="content-header-title float-left">Data Posyandu</h2>
                    </div>
                    <!-- Code Changes: split breakpoints into lg & md -->
                    <div class="col-lg-5 col-md-6 text-right">
                        <button class="btn btn-outline-primary mr-75" data-toggle='modal' data-target='#import'> Import
                            excel</button>
                        {{-- Modal Import --}}
                        <div class="modal fade text-left" id="import" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title">Upload Excel Posyandu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('yankesin/posyandu/upload/' . request()->segment(3)) }}"
                                        method="POST" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="customFile1">Upload excel</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file"
                                                        required />
                                                    <label class="custom-file-label">Upload excel</label>
                                                </div>
                                                <div class="text-right">
                                                    <a href="{{ url('yankesin/posyandu/download-template/') }}"
                                                        class="font-small-3"> <u>Download Template Excel</u> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('yankesin/posyandu/create') }}"><button class="btn btn-primary">Tambah Posyandu</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped text-center" id="posyandu">
                                <thead>
                                    <tr>
                                        <th style="min-width: 100px;">Aksi</th>
                                        <th>No</th>
                                        <th style="min-width: 200px;">Nama Posyandu</th>
                                        <th style="min-width: 100px;">Matra</th>
                                        <th style="min-width: 200px;">Alamat Posyandu</th>
                                        <th style="min-width: 150px;">Program Germas</th>
                                        <th style="min-width: 150px;">Program Posyandu</th>
                                        <th style="min-width: 150px;">Hubungan Lintas Sektoral</th>
                                        <th>Jml Kader Germas</th>
                                        <th>Jml Kader Posyandu</th>
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
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.js') }}"></script>
<script>
    var table = $('#posyandu').DataTable({
        destroy: true,
        processing: true,
        ajax: "{{ url('yankesin/posyandu/get') }}",
        scrollX: true,
        columns: [
            {
                data: 'action'
            },
            {
                data: 'DT_RowIndex'
            },
            {
                data: 'nama_posy'
            },
            {
                data: 'satker'
            },
            {
                data: 'alamat_posy'
            },
            {
                data: 'prog_germas'
            },
            {
                data: 'prog_posy'
            },
            {
                data: 'hub_sektoral'
            },
            {
                data: 'jml_kader_germas'
            },
            {
                data: 'jml_kader_posy'
            }
        ],
        buttons: [
            'excelHtml5',
        ],
        dom: '<""<"head-label"><"text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-3"l><"col-sm-12 col-md-8 pr-0"f><"col-sm-12 col-md-1 gx-0 text-right pl-0"B>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        "drawCallback": function(settings) {
            $('.buttons-excel').addClass('btn btn-primary mt-50 p-50').html('<i class="font-medium-2 mr-50" data-feather="download"></i> Excel');
            feather.replace();
        }
    });
</script>
@endsection