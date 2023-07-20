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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Kegiatan Hibah</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" class="form-control bg-white yearpicker" placeholder="Periode" id="tahun" autocomplete="off" />
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('matfaskes.hibah.create') }}"><button class="btn btn-primary">Tambah
                            Hibah</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    {{-- <table class="hibah table table-striped"> --}}
                                    <table class="table table-striped" id="hibah-table">
                                        <thead>
                                            <tr>
                                                <th>Berita Acara</th>
                                                <th>Tahun</th>
                                                <th>Nominal Hibah</th>
                                                <th>Pemberi Hibah</th>
                                                <th class="text-center">Jenis Barang</th>
                                                <th class="text-center">Aksi</th>
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
        $(function() {
            let year = moment().format('YYYY');
            list_hibah(year);
        })

        function list_hibah(year) {
            var table = $('#hibah-table').DataTable({
                destroy:true,
                processing: true,
                ajax: {
                    url: `{{ url('matfaskes/hibah/list') }}`,
                    method: 'POST',
                    data: {year: year},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'ba',
                        name: 'ba'
                    },
                    {
                        data: 'tahun'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'vendor.nama_vendor',
                        name: 'vendor.nama_vendor'
                    },
                    {
                        data: 'jenis_barang',
                        name: 'jenis_barang'
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
        }

        $('#tahun').change(function () {
            list_hibah($(this).val());
        });
    </script>
@endsection
