@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Bed Occupancy Ratio</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-3">
                    <select id="matra" class="select2 form-control form-control-lg"
                        onchange="location.href='/bor_yankesin/'+this.value">
                        <option disabled>Pilih Matra</option>
                        <option value="all" selected>Semua Matra</option>
                        @foreach ($matra as $m)
                            <option value="{{ $m->kode_matra }}" @if (request()->segment(2) == $m->kode_matra) selected @endif>
                                {{ $m->nama_matra }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="content-body">
                <!-- Line Chart Card -->
                <div class="row match-height">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Ruang IGD<h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['IGD_isi'] ?? 0 }}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['IGD'] - $data['IGD_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Kamar Bersalin</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['Kamar Bersalin_isi'] ?? 0 }}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $data['Kamar Bersalin'] - $data['Kamar Bersalin_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">Rawat Inap</h3>
                                    <div class="text-center mt-1">
                                        <span class="bullet bullet-sm bullet-primary mr-1"></span>Terisi
                                        <span class="bullet bullet-sm mr-1 ml-2"
                                            style="background-color: #f8d3ff;"></span>Tersedia
                                    </div>
                                    <div id="rawat-inap"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">ICU</h3>
                                    <div class="text-center mt-1">
                                        <span class="bullet bullet-sm mr-1" style="background-color: #00CFE8;"></span>Terisi
                                        <span class="bullet bullet-sm mr-1 ml-2"
                                            style="background-color: #EA5455;"></span>Tersedia
                                    </div>
                                    <div id="icu"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart Card -->
                <div class="row match-height">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Unit Luka Bakar</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['Unit Luka Bakar_isi'] ?? 0 }}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $data['Unit Luka Bakar'] - $data['Unit Luka Bakar_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Ruang Isolasi</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['Ruang Isolasi Non-Covid_isi'] ?? 0 }}
                                        </h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $data['Ruang Isolasi Non-Covid'] - $data['Ruang Isolasi Non-Covid_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-developer-meetup">
                            <div class="card-header justify-content-center pb-0">
                                <h3 class="font-weight-bolder text-center">Ruang Rawat Khusus</h3><br>
                            </div>
                            <div class="card-header ml-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up"
                                                            class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25">Perina / Bayi</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{ $data['Perina_isi'] ?? 0 }}
                                                        </td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">
                                                            {{ $data['Perina'] - $data['Perina_isi'] }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up"
                                                            class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25">Anak</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{ $data['Anak_isi'] ?? 0 }}
                                                        </td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">
                                                            {{ $data['Anak'] - $data['Anak_isi'] }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up"
                                                            class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25">Trauma Militer</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">
                                                            {{ $data['Trauma Militer_isi'] ?? 0 }}</td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">
                                                            {{ $data['Trauma Militer'] - $data['Trauma Militer_isi'] }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Ruang Operasi IGD<h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['Ruang Operasi IGD_isi'] ?? 0 }}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $data['Ruang Operasi IGD'] - $data['Ruang Operasi IGD_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">Ruang Operasi Central</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{ $data['Ruang Operasi Sentral_isi'] ?? 0 }}
                                        </h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $data['Ruang Operasi Sentral'] - $data['Ruang Operasi Sentral_isi'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            // Rawat Inap
            // --------------------------------------------------------------------
            var columnChartEl = document.querySelector('#rawat-inap'),
                columnChartConfig = {
                    chart: {
                        height: 250,
                        type: 'bar',
                        stacked: true,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '40%',
                            colors: {
                                backgroundBarColors: [
                                    'white'
                                ],
                                backgroundBarRadius: 10
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                        position: 'top',
                        horizontalAlign: 'start'
                    },
                    colors: ['#7367F0', '#f8d3ff'],
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
                    series: [{
                            name: 'Terisi',
                            data: [{{ $data['VIP_isi'] ?? 0 }}, {{ $data['Kelas 1_isi'] ?? 0 }},
                                {{ $data['Kelas 2_isi'] ?? 0 }}, {{ $data['Kelas 3_isi'] ?? 0 }}
                            ]
                        },
                        {
                            name: 'Tersedia',
                            data: [{{ ($data['VIP'] ?? 0) - ($data['VIP_isi'] ?? 0) }},
                                {{ ($data['Kelas 1'] ?? 0) - ($data['Kelas 1_isi'] ?? 0) }},
                                {{ ($data['Kelas 2'] ?? 0) - ($data['Kelas 2_isi'] ?? 0) }},
                                {{ ($data['Kelas 3'] ?? 0) - ($data['Kelas 3_isi'] ?? 0) }}
                            ]
                        }
                    ],
                    xaxis: {
                        categories: ['VIP', 'Kelas 1', 'Kelas 2', 'Kelas 3']
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        shared: true
                    },
                    yaxis: {
                        opposite: $('html').attr('data-textdirection') === 'rtl'
                    }
                };
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }

            // ICU
            // --------------------------------------------------------------------
            var columnChartEl = document.querySelector('#icu'),
                columnChartConfig = {
                    chart: {
                        height: 250,
                        type: 'bar',
                        stacked: true,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '30%',
                            colors: {
                                backgroundBarColors: [
                                    'white'
                                ],
                                backgroundBarRadius: 10
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                        position: 'top',
                        horizontalAlign: 'start'
                    },
                    colors: ['#00CFE8', '#EA5455'],
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
                    series: [{
                            name: 'Terisi',
                            data: [{{ $data['ICU_isi'] ?? 0 }}, {{ $data['NICU_isi'] ?? 0 }},
                                {{ $data['ICCU_isi'] ?? 0 }}, {{ $data['HCU_isi'] ?? 0 }},
                                {{ $data['ICU Isolasi_isi'] ?? 0 }}
                            ]
                        },
                        {
                            name: 'Tersedia',
                            data: [{{ ($data['ICU'] ?? 0) - ($data['ICU_isi'] ?? 0) }},
                                {{ ($data['NICU'] ?? 0) - ($data['NICU_isi'] ?? 0) }},
                                {{ ($data['ICCU'] ?? 0) - ($data['ICCU_isi'] ?? 0) }},
                                {{ ($data['HCU'] ?? 0) - ($data['HCU_isi'] ?? 0) }},
                                {{ ($data['ICU Isolasi'] ?? 0) - ($data['ICU Isolasi_isi'] ?? 0) }}
                            ]
                        }
                    ],
                    xaxis: {
                        categories: ['ICU', 'PICU/NICU', 'ICCU', 'HCU', 'ICU Isolasi']
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        shared: true
                    },
                    yaxis: {
                        opposite: $('html').attr('data-textdirection') === 'rtl'
                    }
                };
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }
        });
    </script>
@endsection
