@extends('partials.template')

@section('page_style')
    <style>
        button.fc-today-button.fc-button.fc-button-primary {
            display: none;
        }

        .highcharts-title,
        .highcharts-exporting-group,
        .highcharts-credits {
            display: none;
        }
    </style>
    <script src="{{ url('assets/js/highcharts.js') }}"></script>
    <script src="{{ url('assets/js/sunburst.js') }}"></script>
    <script src="{{ url('assets/js/exporting.js') }}"></script>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Dashboard Bilateral</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-8 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <a href="/dashboard_bilateral"><button type="button" class="btn btn-icon btn-secondary">
                                            <i data-feather="arrow-left"></i>
                                        </button></a>
                                    <span class="card-title ml-1">THAINESIA (JCOESC THAINESIA)</span>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="detail-thainesia"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Persentase Kegiatan THAINESIA</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-1">
                                        <div id="chartdiv" class="mb-50"></div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-12 my-auto ml-1">
                                        <div class="row p-0">
                                            <div class="col-2 pr-0">
                                                <span class="bullet mt-25" style="background-color: #EA5455;"></span>
                                            </div>
                                            <div class="col-10 pr-0">
                                                <span class="font-small-4">HA/DR</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 pr-0">
                                                <span class="bullet mt-50" style="background-color: #28C76F;"></span>
                                            </div>
                                            <div class="col-10 pr-0">
                                                <span class="font-small-4">SMEE<span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-12 my-auto mr-1">
                                        <div class="row">
                                            <div class="col-2 pr-0">
                                                <span class="bullet mt-25" style="background-color: #FF9F43;"></span>
                                            </div>
                                            <div class="col-10 pr-0">
                                                <span class="font-small-4">Medical Exercise</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 pr-0">
                                                <span class="bullet mt-25" style="background-color: #005EFF;"></span>
                                            </div>
                                            <div class="col-10 pr-0">
                                                <span class="font-small-4">Baksos</span>
                                            </div>
                                        </div>
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

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            chartColors = {
                column: {
                    series1: '#826af9',
                    series2: '#d2b0ff',
                    series3: '#FF9F43',
                    series4: '#efc1f7',
                    series5: '#2045B8',
                    series6: '#FFAB00',
                    series7: '#28C76F',
                    bg: '#f8d3ff'
                },
                pie: {
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
                    white: '#FFFFFF'
                }
            };

        // Donat Chart

        var data = [{
                'id': '0.0',
                'parent': '',
                'name': 'USIBDD APMHE'
            }, {
                'id': 'HA/DR',
                'parent': '0.0',
                'name': 'HA/DR'
            }, {
                'id': 'SMEE',
                'parent': '0.0',
                'name': 'SMEE'
            }, {
                'id': 'Medical Exercise',
                'parent': '0.0',
                'name': 'Medical Exercise'
            }, {
                'id': 'Baksos',
                'parent': '0.0',
                'name': 'Baksos'
            },

            /* Africa */
            {
                'id': '2.1',
                'parent': 'HA/DR',
                'name': 'Tunda',
                'value': 1
            },

            {
                'id': '2.2',
                'parent': 'HA/DR',
                'name': 'Batal',
                'value': 1
            },
            {
                'id': '2.3',
                'parent': 'HA/DR',
                'name': 'Terlaksana',
                'value': 1
            },

            {
                'id': '3.1',
                'parent': 'SMEE',
                'name': 'Tunda',
                'value': 1
            },
            {
                'id': '3.2',
                'parent': 'SMEE',
                'name': 'Batal',
                'value': 1
            },
            {
                'id': '3.3',
                'parent': 'SMEE',
                'name': 'Terlaksana',
                'value': 1
            },

            {
                'id': '4.1',
                'parent': 'Medical Exercise',
                'name': 'Tunda',
                'value': 1
            },
            {
                'id': '4.2',
                'parent': 'Medical Exercise',
                'name': 'Batal',
                'value': 1
            },
            {
                'id': '4.3',
                'parent': 'Medical Exercise',
                'name': 'Terlaksana',
                'value': 1
            },

            {
                'id': '5.1',
                'parent': 'Baksos',
                'name': 'Tunda',
                'value': 1
            },
            {
                'id': '5.2',
                'parent': 'Baksos',
                'name': 'Batal',
                'value': 1
            },
            {
                'id': '5.3',
                'parent': 'Baksos',
                'name': 'Terlaksana',
                'value': 1
            },

        ];

        Highcharts.chart('chartdiv', {

            chart: {
                height: '330'
            },
            colors: [chartColors.pie.white, chartColors.pie.merah, chartColors.pie.ijo, chartColors.pie.kuning,
                chartColors.pie.biru, chartColors.pie.birmud, chartColors.pie.ijommud, chartColors.pie.pink,
                chartColors.pie.orange, chartColors.pie.peach
            ],
            plotOptions: {
                series: {}
            },
            series: [{
                type: "sunburst",
                data: data,
                allowDrillToNode: true,
                cursor: 'pointer',
                levels: [{
                    level: 1,
                    size: 500,
                    dataLabels: {
                        rotationMode: 'auto'
                    }
                }, {
                    level: 2,
                    size: 100,
                    colorByPoint: true,
                    dataLabels: {
                        rotationMode: 'auto'
                    }
                }, {
                    level: 3,
                    colorVariation: {
                        key: 'brightness',
                        to: -0.5
                    }
                }, {
                    level: 4,
                    colorVariation: {
                        key: 'brightness',
                        to: 0.5
                    }
                }]

            }]
        });

        var options = {
            series: [{
                    name: '2020',
                    data: [44, 55, 66]
                },
                {
                    name: '2021',
                    data: [27, 40, 86]
                },
                {
                    name: '2022',
                    data: [44, 35, 16]
                }
            ],
            chart: {
                type: 'bar',
                height: 400
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
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
                categories: ['HA/DR', 'BAKSOS', 'Lain-lain'],
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            colors: [chartColors.column.series6, chartColors.column.series5, chartColors.column.series7],
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#detail-thainesia"), options);
        chart.render();
    </script>
@endsection
