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
                    <div class="col-md-12 col-12">
                        <h2 class="content-header-title float-left">Kebutuhan Perangkat Kesehatan Satgas Operasi DN</h2>
                    </div>
                    <div class="col-md-3 col-6">
                        <select class="select2 form-control">
                            <option>Satgas DN</option>
                            <option>Satgas LN</option>
                        </select>
                    </div>
                    <div class="col-md-9 col-6 text-right">
                        <button class="btn btn-outline-primary"> <i data-feather="upload" class="mr-50"></i> Export Excell</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped text-center" id="report">
                                <thead>
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left" style="min-width: 150px;">Batalyon</th>
                                        <th style="min-width: 150px;">Satgas Ops</th>
                                        <th style="min-width: 100px;">Berangkat Ops</th>
                                        <th>Jumlah Personil</th>
                                        <th>Kat Prapas</th>
                                        <th>Kat Dokter</th>
                                        <th>Kat Wat</th>
                                        <th>Kat Banwat</th>
                                        <th>Kat Ambulans</th>
                                        <th>Kat Pratugas</th>
                                        <th>Kat Pos Satgas Ops</th>
                                        <th>Kat Serpas</th>
                                        <th>Kat Kesyon</th>
                                        <th>Kat Endemik A</th>
                                        <th>Kat Endemik B</th>
                                        <th>Endemik/Non Endemik</th>
                                        <th>Ket</th>
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
    var table = $('#report').DataTable({
        ajax: "{{ url('/app-assets/data/report.json') }}",
        scrollX: true,
        columns: [
            {
                data: 'no'
            },
            {
                data: 'batalyon'
            },
            {
                data: 'satgas'
            },
            {
                data: 'berangkat'
            },
            {
                data: 'jml'
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
                data: 'endemik_non'
            },
            {
                data: 'ket'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }
    });
</script>
@endsection