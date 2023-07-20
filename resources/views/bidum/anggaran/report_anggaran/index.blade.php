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
                            <h2 class="content-header-title float-left mb-0">Report Anggaran - {{ $year }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="input-group input-group-merge bg-white">
                        <input type="text" id="periode" class="form-control flatpickr-range" placeholder="Filter Tanggal" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                            <input type="hidden" id="from_date">
                            <input type="hidden" id="to_date">
                        </div>
                    </div>
                </div>
                <div class="col-9 text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="export">Ekspor Laporan</button>
                    </div>
                </div>
            </div>
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
                                            <table class="table table-striped table-responsive-lg" id="table-pusat">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th class="width-250">Uraian</th>
                                                        <th>Pagu Awal</th>
                                                        <th class="text-center">Revisi Pagu Tambah</th>
                                                        <th class="text-center">Revisi Pagu Kurang</th>
                                                        <th class="text-center">Pagu Setelah Revisi</th>
                                                        <th>Realisasi</th>
                                                        <th>%</th>
                                                        <th>Sisa Anggaran</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <table class="table table-striped table-responsive-lg" id="table-daerah">
                                                <thead>
                                                    <tr>
                                                        <th>Bidang</th>
                                                        <th>Akun</th>
                                                        <th class="width-250">Uraian</th>
                                                        <th>Pagu Awal</th>
                                                        <th class="text-center">Revisi Pagu Tambah</th>
                                                        <th class="text-center">Revisi Pagu Kurang</th>
                                                        <th class="text-center">Pagu Setelah Revisi</th>
                                                        <th>Realisasi</th>
                                                        <th>%</th>
                                                        <th>Sisa Anggaran</th>
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
            let from_date = moment().format('YYYY-01-01'); 
            let to_date = moment().format('YYYY-12-31');
            $('#from_date').val(from_date)
            $('#to_date').val(to_date)
            $('#periode').val(`${from_date} to ${to_date}`)
            report_list(from_date, to_date,"{{ $bidang }}");
        });

        $("#periode").flatpickr({
            mode: 'range',
            onChange: function(selectedDate) {
                let _this = this;
                let dateArr = selectedDate.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });

                let start = dateArr[0];
                let end = dateArr[1];
                $('#from_date').val(start)
                $('#to_date').val(end)

                report_list(start, end);
            }
        })

        $('#export').click(function() {
            let from_date = $('#from_date').val()
            let to_date = $('#to_date').val()

            var url = '{{ route('bidum.anggaran.report_export', [':from_date', ':to_date']) }}';
            url = url.replace(':from_date', from_date);
            url = url.replace(':to_date', to_date);

            window.location.href = url;
        })

        function report_list(from_date, to_date,bidang='') {
            let dipa_pusat = 'DIPPUS';
            let dipa_daerah = 'DIPDAR';
            let url_pusat = `{{ url('bidum/anggaran/report') }}/${from_date}/${to_date}/${dipa_pusat}/${bidang}`
            let url_daerah = `{{ url('bidum/anggaran/report') }}/${from_date}/${to_date}/${dipa_daerah}/${bidang}`
            var table = $('#table-pusat').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url_pusat,
                columns: [{
                        data: 'kode_bidang',
                        name: 'kode_bidang',
                        visible: false
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
                    {
                        data: 'revisi_tambah',
                        name: 'revisi_tambah'
                    },
                    {
                        data: 'revisi_kurang',
                        name: 'revisi_kurang'
                    },
                    {
                        data: 'revisi_pagu',
                        name: 'revisi_pagu'
                    },
                    {
                        data: 'realisasi',
                        name: 'realisasi'
                    },
                    {
                        data: 'persentase',
                        name: 'persentase'
                    },
                    {
                        data: 'sisa_anggaran',
                        name: 'sisa_anggaran'
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
                    feather.replace();

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group text-center"><td colspan="9">' + group +
                                '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            var table = $('#table-daerah').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url_daerah,
                columns: [{
                        data: 'kode_bidang',
                        name: 'kode_bidang',
                        visible: false
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
                    {
                        data: 'revisi_tambah',
                        name: 'revisi_tambah'
                    },
                    {
                        data: 'revisi_kurang',
                        name: 'revisi_kurang'
                    },
                    {
                        data: 'revisi_pagu',
                        name: 'revisi_pagu'
                    },
                    {
                        data: 'realisasi',
                        name: 'realisasi'
                    },
                    {
                        data: 'persentase',
                        name: 'persentase'
                    },
                    {
                        data: 'sisa_anggaran',
                        name: 'sisa_anggaran'
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
                    feather.replace();

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group text-center"><td colspan="9">' + group +
                                '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });
        }
    </script>
@endsection
