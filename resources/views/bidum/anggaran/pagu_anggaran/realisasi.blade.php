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
                            <h2 class="content-header-title float-left mb-0">Data Realisasi Anggaran - {{ $year }}</h2>
                            <input type="hidden" name="year" value="{{ $year }}" id="year">
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-3">
                    <select class="select2 form-control form-control-lg">
                        <option selected disabled>Filter Bidang</option>
                        <option value="">Bidang 1</option>
                        <option value="">Bidang 2</option>
                    </select>
                </div>       
            </div> --}}
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
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
                                            <table class="table table-striped table-responsive-lg" id="realisasi-pusat">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th>Uraian</th>
                                                        <th>Tgl Realisasi</th>
                                                        <th>Nilai Realisasi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <table class="table table-striped table-responsive-lg" id="realisasi-daerah">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th>Uraian</th>
                                                        <th>Tgl Realisasi</th>
                                                        <th>Nilai Realisasi</th>
                                                    </tr>
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
            let year = $('#year').val();
            let dipa_pusat = 'DIPPUS';
            let dipa_daerah = 'DIPDAR';

            var url = '{{ route('bidum.anggaran.pagu_list_realisasi', [':year', ':dipa']) }}';
            url = url.replace(':year', year);

            url_pusat = url.replace(':dipa', dipa_pusat);

            url_daerah = url.replace(':dipa', dipa_daerah);


            var table = $('#realisasi-pusat').DataTable({
                processing: true,
                serverSide: true,
                ajax: url_pusat,
                columns: [{
                        data: 'kode_bidang',
                        name: 'uraian.kode_bidang',
                        visible: false
                    },
                    {
                        data: 'kode_akun',
                        name: 'uraian.kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'uraian.nama_uraian'
                    },
                    {
                        data: 'tgl_realisasi',
                        name: 'tgl_realisasi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="6" class="group text-center font-medium-4" style="background-color:#F3F2F7;">' +
                                group + '</th>'

                            );

                            last = group;
                        }
                    });
                }
            });

            var table = $('#realisasi-daerah').DataTable({
                processing: true,
                serverSide: true,
                ajax: url_daerah,
                columns: [{
                        data: 'kode_bidang',
                        name: 'uraian.kode_bidang',
                        visible: false
                    },
                    {
                        data: 'kode_akun',
                        name: 'uraian.kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'uraian.nama_uraian'
                    },
                    {
                        data: 'tgl_realisasi',
                        name: 'tgl_realisasi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="6" class="group text-center font-medium-4" style="background-color:#F3F2F7;">' +
                                group + '</th>'
                            );

                            last = group;
                        }
                    });
                }
            })
        })
    </script>
@endsection
