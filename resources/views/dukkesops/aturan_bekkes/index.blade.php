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
                        <h2 class="content-header-title float-left">Daftar Aturan Bekkes</h2>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="/tambah_aturan_bekkes"><button class="btn btn-primary">Tambah Aturan Bekkes</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped" id="aturan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="min-width: 150px;">Nama Pos</th>
                                        <th>Kat Prapas</th>
                                        <th>Kat Dokter</th>
                                        <th>Kat Wat</th>
                                        <th>Kat Banwat</th>
                                        <th>Kat Ambulans</th>
                                        <th>Kat Pratugas</th>
                                        <th>Kat Pos Satgasops</th>
                                        <th>Kat Serpas</th>
                                        <th>Kat Kesyon</th>
                                        <th>Kat Endemik A</th>
                                        <th>Kat Endemik B</th>
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
    var table = $('#aturan').DataTable({
        ajax: "{{ url('/app-assets/data/aturan.json') }}",
        scrollX: true,
        columns: [
            {
                data: 'no'
            },
            {
                data: 'nama'
            },
            {
                data: 'prapas'
            },
            {
                data: 'dokter'
            },
            {
                data: 'wat'
            },
            {
                data: 'banwat'
            },
            {
                data: 'ambulans'
            },
            {
                data: 'pratugas'
            },
            {
                data: 'satgasops'
            },
            {
                data: 'serpas'
            },
            {
                data: 'kesyon'
            },
            {
                data: 'endemik_a'
            },
            {
                data: 'endemik_b'
            },
            {
                data: 'action'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }
    });
</script>
@endsection