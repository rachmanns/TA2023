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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Data Pagu Anggaran - 2021</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <select class="select2 form-control form-control-lg">
                        <option selected disabled>Filter Bidang</option>
                        <option value="">Bidang 1</option>
                        <option value="">Bidang 2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-merge bg-white">
                        <input type="text" id="fp-range" class="form-control flatpickr-range"
                            placeholder="Filter Tanggal" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <a href="/view_realisasi"><button type="button" class="btn btn-outline-success">Lihat
                            Realisasi</button></a>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    {{-- <div class="row">
                        <div class="col-6">
                            <form action="{{ route('pagu_anggaran.excel_import') }}" method="post"
                                enctype="multipart/form-data" class="form-row">
                                @csrf
                                <div class="col-auto">
                                    <input class="form-control" type="file" name="file" id="">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-success" type="submit">Import</button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-pusat-tab"
                                                data-toggle="tab" href="#nav-pusat" role="tab" aria-controls="nav-pusat"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Pusat</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-daerah-tab" data-toggle="tab"
                                                href="#nav-daerah" role="tab" aria-controls="nav-daerah"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Daerah</span></a>
                                        </div>
                                    </nav>
                                    <hr class="mb-0">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pusat" role="tabpanel"
                                            aria-labelledby="nav-pusat-tab">
                                            <table class="table table-striped table-responsive-lg" id="table-pusat">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>BIDANG</th>
                                                        <th>TAHUN ANGGARAN</th>
                                                        <th>AKUN</th>
                                                        <th>URAIAN</th>
                                                        <th>PAGU AWAL</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <th colspan="6" class="text-center font-medium-4">BIDDUKESOPS</th>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <table class="table table-striped table-responsive-lg" id="table-daerah">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>BIDANG</th>
                                                        <th>TAHUN ANGGARAN</th>
                                                        <th>AKUN</th>
                                                        <th>URAIAN</th>
                                                        <th>PAGU AWAL</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <th colspan="6" class="text-center font-medium-4">BIDDUKESOPS</th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <table class="dt-nasional table"> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
        $(function() {

            var table = $('#table-pusat').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pagu_anggaran.pusat') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'kode_bidang',
                        name: 'kode_bidang'
                    },
                    {
                        data: 'tahun_anggaran',
                        name: 'tahun_anggaran'
                    },
                    {
                        data: 'kode_akun',
                        name: 'kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'nama_uraian'
                    },
                    {
                        data: 'pagu_awal',
                        name: 'pagu_awal'
                    },
                ]
            });

            var table = $('#table-daerah').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pagu_anggaran.daerah') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'kode_bidang',
                        name: 'kode_bidang'
                    },
                    {
                        data: 'tahun_anggaran',
                        name: 'tahun_anggaran'
                    },
                    {
                        data: 'kode_akun',
                        name: 'kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'nama_uraian'
                    },
                    {
                        data: 'pagu_awal',
                        name: 'pagu_awal'
                    },
                ]
            });

        });
    </script>
@endsection
