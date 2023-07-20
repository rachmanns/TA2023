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
        <div class="d-flex justify-content-between mb-1">
            <h2 class="content-header-title float-left">Data Litbang</h2>
            <a href="/lafibiovak/litbang/create"><button class="btn btn-primary">Tambah Litbang</button></a>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="litbang">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center" style="min-width: 100px">Aksi</th>
                                            <th style="min-width: 200px">Judul Penelitian</th>
                                            <th style="min-width: 200px">Penanggung Jawab Penelitian</th>
                                            <th style="min-width: 200px">Penyelenggara</th>
                                            <th style="min-width: 200px">Tempat Pelaksanaan</th>
                                            <th style="min-width: 200px">Jenis Litbang</th>
                                            <th style="min-width: 400px">Tahap Pelaksanaan</th>
                                            <th class="text-center">Persentase Pelaksanaan</th>
                                            <th class="text-center" style="min-width: 100px">Hasil Laporan dan evaluasi/LOA/NIE</th>
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
<script src="{{ url('assets/js/dataTables.rowsGroup.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.js') }}"></script>
<script>
    var data;
    $(document).ready(function() {
        load_data();
    });

    function load_data() {
        $.ajax({
            url: "{{ url('lafibiovak/litbang/list') }}",
            success: function(res) {
                data = res;
                load_table();
            }
        });
    }

    function load_table() {
        var table = $('#litbang').DataTable({
            scrollX: true,
            destroy: true,
            columns: [{
                    name: 'id',
                },
                {
                    name: 'aksi',
                    title: 'Aksi',
                },
                {
                    name: 'judul',
                    title: 'Judul Penelitian',
                },
                {
                    name: 'pic',
                    title: 'Penanggung Jawab Penelitian',
                },
                {
                    name: 'penyelenggara',
                    title: 'Penyelenggara',
                },
                {
                    name: 'tempat',
                    title: 'Tempat',
                },
                {
                    title: 'Jenis Litbang',
                },
                {
                    title: 'Tahap Pelaksanaan',
                },
                {
                    title: 'Persentase Pelaksanaan',
                },
                {
                    title: 'Hasil Laporan dan evaluasi/LOA/NIE',
                },
            ],
            data: data,
            buttons: [
                'excelHtml5',
            ],
            dom: '<""<"head-label"><"text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-3"l><"col-sm-12 col-md-8 pr-0"f><"col-sm-12 col-md-1 gx-0 text-right pl-0"B>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            "drawCallback": function(settings) {
                $('.buttons-excel').addClass('btn btn-primary mt-50 p-50 mr-50').html('<i class="font-medium-2 mr-50" data-feather="download"></i> Excel');
                feather.replace();
            },
            rowsGroup: [
                'id:name',
                'aksi:name',
                'judul:name',
                'pic:name',
                'penyelenggara:name',
                'tempat:name'
            ]
        });
    }
</script>
@endsection