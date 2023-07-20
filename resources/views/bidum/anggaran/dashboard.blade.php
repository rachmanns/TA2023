@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

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

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
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
                            <h2 class="content-header-title float-left mb-0">Bidang Anggaran</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">(Periode 1 Januari <span
                                    class="year"></span> - 31 Desember <span class="year"></span>)</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun_anggaran" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-1">Total Anggaran</h3>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <div class="font-small-3">
                                            Pusat <span id="pagu_revisi_pusat"></span>
                                        </div>
                                        <div class="font-small-3">
                                            Daerah <span id="pagu_revisi_daerah"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-12">
                                        <h1 class="font-weight-bolder mb-0" id="total_anggaran"></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 font-small-3">
                                        Pagu Awal Pusat <span class="text-danger" id="total_pagu_awal_pusat"></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="font-small-3">
                                        Pagu Awal Daerah <span class="text-danger" id="total_pagu_awal_daerah"></span>
                                    </div>
                                    <a href="{{ route('bidum.anggaran.pagu') }}" class="underline">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-1">Realisasi Anggaran</h3>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <div class="font-small-3">
                                            Pusat &emsp; <span id="total_realisasi_pusat"></span>
                                        </div>
                                        <div class="font-small-3">
                                            Daerah &emsp; <span id="total_realisasi_daerah"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-12">
                                        <h1 class="font-weight-bolder text-center mb-0" id="total_realisasi"></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right mt-2">
                                        <a href="{{ url('bidum/anggaran/realisasi-pertahun') }}" class="underline">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-1">Sisa Anggaran</h3>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <div class="font-small-3">
                                            Pusat &emsp; <span id="sisa_anggaran_pusat"></span>
                                        </div>
                                        <div class="font-small-3">
                                            Daerah &emsp; <span id="sisa_anggaran_daerah"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-12">
                                        <h1 class="font-weight-bolder text-center mb-0"
                                            id="sisa_anggaran"></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right mt-2">
                                        <a href="{{ route('bidum.anggaran.report_pagu') }}"
                                            class="underline">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="font-weight-bolder">Pagu dan Realisasi Anggaran Tiap Bidang</span> <br> 
                                    Tahun Anggaran <span id="pagu_realisasi_per_bidang_text"></span>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="card-body pb-0">
                                <div id="realisasi-anggaran"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="font-weight-bolder">Penyerapan Anggaran TA <span id="penyerapan_anggaran_text"></span></span><br><br>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="card-body pb-0">
                                <div id="penyerapan-anggaran"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Progress Realisasi Anggaran Perbulan</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="realisasi-chart"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0" id="periode_text"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                        <div class="form-group bg-white">
                            <input type="month" class="form-control" placeholder="Filter Bulan" id="periode_gaji" />
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <h3 class="font-weight-bolder mb-0">Gaji PNS</h3>
                                        <span class="font-small-3">Bulan <span class="font-weight-bold">November</span> </span>
                                    </div>
                                    <div class="col-12">
                                        <h2 id="gaji_pns"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <h3 class="font-weight-bolder mb-0">Gaji TNI</h3>
                                        <span class="font-small-3">Bulan <span class="font-weight-bold">November</span> </span>
                                    </div>
                                    <div class="col-12">
                                        <h2 id="gaji_tni"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <h3 class="font-weight-bolder mb-0">Total Tunjangan Kinerja</h3>
                                        <span class="font-small-3">Bulan <span class="font-weight-bold">November</span> </span>
                                    </div>
                                    <div class="col-12">
                                        <h2 id="tunjangan_tni_pns"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0" id="periode_text"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                        <div class="form-group bg-white">
                            <input type="month" class="form-control" placeholder="Filter Bulan" id="periode_gaji" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Grafik Penyerapan - November 2022
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="card-body">
                                <div id="penyerapan"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Laporan Setiap Bidang (Per 1 Januari <span
                                        class="periode_setiap_bidang"></span> - 31 Desember <span
                                        class="periode_setiap_bidang"></span>)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                        <div class="input-group input-group-merge form-input">
                            <input type="text" id="periode_setiap_bidang"
                                class="yearpicker form-control bg-white cursor-pointer" placeholder="Filter Tahun"
                                readonly />
                            <div class="input-group-append">
                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="laporan_bidang">
                                        <thead>
                                            <tr>
                                                {{-- <th>Kode</th> --}}
                                                <th>Nama Bidang</th>
                                                <th>Anggaran</th>
                                                {{-- <th>Realisasi %</th> --}}
                                                <th>Realisasi</th>
                                                <th>%</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
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
    <!-- Send Invoice Sidebar -->
    <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">
                        <span class="align-middle">Filter Dashboard</span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <form>
                        <div class="form-group">
                            <label for="invoice-from" class="form-label">Komando</label>
                            <select class="select2-data-ajax form-control" required id="komando-ajax"></select>
                        </div>
                        <div class="form-group">
                            <label for="subkomando" class="form-label">Sub Komando</label>
                            <select class="select2-data-ajax form-control" disabled id="subkomando-ajax"></select>
                        </div>

                        <div class="form-group d-flex flex-wrap mt-2">
                            <button type="button" class="btn btn-primary mr-1" data-dismiss="modal">Filter</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Send Invoice Sidebar -->
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>

        $('#periode_gaji').flatpickr({
            altInput: true,
            altFormat: 'F Y',
            plugins: [
                new monthSelectPlugin({
                    dateFormat: "Y-m",
                })
            ]
        });


        $(function() {
            $('#periode_setiap_bidang').val(moment(new Date()).format("YYYY"));
            gaji_tunjangan(moment(new Date()).format("YYYY-MM"));
            total_anggaran(moment(new Date()).format("YYYY"));
            pagu_realisasi_per_bidang(moment(new Date()).format("YYYY"));
            penyerapan_anggaran(moment(new Date()).format("YYYY"));
            $('#periode_gaji').val(moment(new Date()).format("YYYY-MM"));
            $('#tahun_anggaran').val(moment(new Date()).format("YYYY"));
        });

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            chartColors = {
                column: {
                    series1: '#2045B8',
                    series2: '#B5C1E7',
                    series3: '#FF9F43',
                    series4: '#efc1f7',
                    series5: 'rgb(29, 85, 224)',
                    bg: '#f8d3ff'
                },
                success: {
                    shade_100: '#7eefc7',
                    shade_200: '#06774f'
                },
                donut: {
                    series1: '#ffe700',
                    series2: '#00d4bd',
                    series3: '#826bf8',
                    series4: '#2b9bf4',
                    series5: '#FFA1A1'
                },
                area: {
                    series3: '#a4f8cd',
                    series2: '#60f2ca',
                    series1: '#2bdac7'
                },
                stacked: {
                    merah: '#EE3124',
                    ijo: '#28C76F',
                    kuning: '#FFAB00',
                    biru: '#2045B8',
                    ungu: '#BD5C91',
                    birmud: '#00CFE8',
                    ijomud: '#85C808',
                    pink: '#EA5455',
                    orange: '#F24E1E',
                    peach: '#FF9F43',
                    series5: '#FFA1A1',
                    series1: '#ffe700'
                },
            };

        var columnChartEl = document.querySelector('#realisasi-chart'),
            columnChartConfig = {
                series: {!! json_encode($chart_realisasi['series']) !!},
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                dataLabels:{
                    enabled:false
                },
                // colors: [chartColors.stacked.merah, chartColors.stacked.ijo, chartColors.stacked.kuning, chartColors.stacked.biru,
                //         chartColors.stacked.ungu, chartColors.stacked.birmud, chartColors.stacked.ijommud, chartColors.stacked.pink,
                //         chartColors.stacked.orange, chartColors.stacked.peach,chartColors.stacked.series5,chartColors.stacked.series1
                //     ],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10
                    },
                },
                xaxis: {
                    categories: {!! json_encode($chart_realisasi['categories']) !!},
                },
                legend: {
                    position: 'right',
                    offsetY: 40
                },
                fill: {
                    opacity: 1
                },
                yaxis: {
                    opposite: isRtl,
                    labels: {
                        formatter: function(value) {
                            return formatRupiah(value);
                        }
                    },
                }
            };
        if (typeof columnChartEl !== undefined && columnChartEl !== null) {
            var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
            columnChart.render();
        }

        function formatRupiah(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return `Rp${rupiah}`;
        }

        $('#periode_gaji').change(function() {
            gaji_tunjangan($(this).val())
        })

        $('#tahun_anggaran').change(function() {
            total_anggaran($(this).val());
            pagu_realisasi_per_bidang($(this).val());
            penyerapan_anggaran($(this).val());
        })

        $('#periode_setiap_bidang').change(function() {
            if ($(this).val() == '') {
                laporan_setiap_bidang(moment(new Date()).format("YYYY"))
            } else {
                laporan_setiap_bidang($(this).val())
            }
            $('.periode_setiap_bidang').html($(this).val() || moment(new Date()).format("YYYY"));
        })

        function gaji_tunjangan(month_year) {
            var url = "{{ route('bidum.anggaran.dashboard_count_gaji', ':month_year') }}";
            url = url.replace(':month_year', month_year);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#periode_text').html(`(Periode ${response.periode})`)
                    $('#gaji_pns').html(response.gaji_pns)
                    $('#gaji_tni').html(response.gaji_tni)
                    $('#tunjangan_tni_pns').html(response.tunjangan_tni_pns)
                }
            });
        }

        function pagu_realisasi_per_bidang(tahun) {
            $('#pagu_realisasi_per_bidang_text').text(tahun);
            $.ajax({
                type: 'POST',
                data:{_token:"{{ csrf_token() }}",tahun:tahun},
                url: "{{ url('bidum/anggaran/dashboard/pagu-realisasi-per-bidang') }}",
                success: function(response) {
                    // chart_pagu_realisasi(response.categories, response.series);
                    chart_pagu_realisasi(response.categories, response.series,"#realisasi-anggaran");
                }
            });
        }

        function penyerapan_anggaran(tahun) {
            $('#penyerapan_anggaran_text').text(tahun);
            $.ajax({
                type: 'POST',
                data:{_token:"{{ csrf_token() }}",tahun:tahun},
                url: "{{ url('bidum/anggaran/dashboard/penyerapan-anggaran') }}",
                success: function(response) {
                    // chart_pagu_realisasi(response.categories, response.series);
                    chart_pagu_realisasi(response.categories, response.series,"#penyerapan-anggaran");
                }
            });
        }

        function total_anggaran(year) {
            var url = "{{ route('bidum.anggaran.dashboard_count_anggaran', ':year') }}";
            url = url.replace(':year', year);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    // $('#periode_text').html(`Periode ${response.periode}`)                
                    $('#pagu_revisi_pusat').html(response.pagu_revisi_pusat)
                    $('#pagu_revisi_daerah').html(response.pagu_revisi_daerah)
                    $('#total_anggaran').html(response.total_anggaran)
                    $('#total_pagu_awal_pusat').html(response.total_pagu_awal_pusat)
                    $('#total_pagu_awal_daerah').html(response.total_pagu_awal_daerah)
                    $('#total_realisasi_pusat').html(response.total_realisasi_pusat)
                    $('#total_realisasi_daerah').html(response.total_realisasi_daerah)
                    $('#total_realisasi').html(response.total_realisasi)
                    $('#sisa_anggaran_pusat').html(response.sisa_anggaran_pusat)
                    $('#sisa_anggaran_daerah').html(response.sisa_anggaran_daerah)
                    $('#sisa_anggaran').html(response.sisa_anggaran)
                    $('.year').html(response.periode_anggaran)
                }
            });
        }

        function laporan_setiap_bidang(year) {
            var table = $('#laporan_bidang').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: "{{ url('bidum/anggaran/dashboard/bidang') }}" + '/' + year,
                columns: [
                    // {
                    //     data: null,
                    //     name: 'kode'
                    // },
                    {
                        data: 'kode_bidang',
                        name: 'kode_bidang'
                    },
                    {
                        data: 'anggaran',
                        name: 'anggaran'
                    },
                    // {
                    //     data: null,
                    //     name: 'realisasi_persen'
                    // },
                    {
                        data: 'realisasi',
                        name: 'realisasi'
                    },
                    {
                        data: 'prosentase',
                        name: 'prosentase'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
    <script>
        $(function () {
            // Column Chart
            // --------------------------------------------------------------------
            var columnChartEl = document.querySelector('#penyerapan'),
                columnChartConfig = {
                chart: {
                    height: 400,
                    type: 'bar',
                    stacked: true,
                    parentHeightOffset: 0,
                    toolbar: {
                    show: false
                    }
                },
                plotOptions: {
                    bar: {
                    columnWidth: '25%'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'start'
                },
                colors: [chartColors.column.series1, chartColors.column.series2],
                stroke: {
                    show: true,
                    colors: ['transparent']
                },
                grid: {
                    xaxis: {
                    lines: {
                        show: true
                    }
                    }
                },
                series: [
                    {
                    name: 'Anggaran',
                    data: [90, 120, 55, 100, 80, 125, 175, 88, 180]
                    },
                    {
                    name: 'Realisasi',
                    data: [85, 100, 30, 40, 95, 90, 110, 62, 80]
                    }
                ],
                xaxis: {
                    categories: ['Bidum', 'Biddukkesops', 'Bidyankesin', 'Bidmatfaskes', 'Kemabaktikes', 'Bidbangkes', 'Taud', 'Dobekkes', 'Lafibiovak']
                },
                fill: {
                    opacity: 1
                },
                yaxis: {
                    opposite: isRtl
                }
                };
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }
        });
    </script>

    <script>
        var chart_init = {};
        
        function chart_pagu_realisasi(categories, series,selector) {
            var bar_element = document.querySelector(selector)
            var options = {
              series: series,
              chart: {
              type: 'bar',
              height: 350
            },
            colors: [chartColors.stacked.biru, chartColors.stacked.merah],
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: categories
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return formatRupiah(value);
                    }
                }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val,{ series, seriesIndex, dataPointIndex, w }) {
                    if (w['config']['series'][seriesIndex]['name'] == 'Realisasi') {
                        let pagu = series[0][dataPointIndex];
                        let persen = val / pagu * 100;
                        let persen_dec = (Math.round(persen * 100) / 100).toFixed(2);
                      return formatRupiah(val) + `| ${persen_dec}%` 
                        
                    }else{
                        return formatRupiah(val)
                    }
                }
              },
            }
            };

            // if (window.myChart)
            //     window.myChart.destroy();

            // // window.myChart = new ApexCharts(document.querySelector("#realisasi-anggaran"), options);
            // window.myChart = new ApexCharts(document.querySelector(selector), options);
            // window.myChart.render();

            if (typeof bar_element !== undefined && bar_element !== null) {
                radialChart = new ApexCharts(bar_element, options);
                if($(`${selector} svg`).length){

                    chart_init[selector].destroy();
                }
                    chart_init[selector]= radialChart
                    chart_init[selector].render();
                
            }
        }
      
    </script>

@endsection
