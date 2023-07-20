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
                            <h2 class="content-header-title float-left mb-0">Data Pagu Anggaran - 2022</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="input-group input-group-merge">
                        <input type="text" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-9 text-right">
                    <div class="btn-group">
                        <button class="btn btn-outline-primary dropdown-toggle mr-75" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Lihat Realisasi</a>
                            <a class="dropdown-item" href="#">Download Format Excel Revisi</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#defaultSize">Import Revisi Pagu</a>
                        </div>
                        <!-- Modal Import-->
                        <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Import Revisi Pagu Anggaran</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="customFile1">Pilih File Excel Pagu Anggaran</label>
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="customFile1"
                                                    required />
                                                <label class="custom-file-label" for="customFile1">Tambah File</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/import_revisi"><button type="submit"
                                                class="btn btn-primary">Upload</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#"><button type="button" class="btn btn-primary">Tambah Anggaran</button></a>
                    </div>
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
