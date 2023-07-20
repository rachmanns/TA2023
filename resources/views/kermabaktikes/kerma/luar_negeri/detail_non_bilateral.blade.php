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
                            <h2 class="content-header-title float-left mb-0">Dashboard Non Bilateral</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <a href="{{ route('kerma.nonbilateral.dashboard') }}"><button type="button" class="btn btn-icon btn-secondary">
                                            <i data-feather="arrow-left"></i>
                                        </button></a>
                                    <span class="card-title ml-1">{{ $nama_event }} ({{ $kegiatan->nama_kegiatan }})</span>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="detail"></div>
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
                }
            };

        var options = {
            series: {!! json_encode($series) !!},
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
                categories: {!! json_encode($categories) !!},
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

        var chart = new ApexCharts(document.querySelector("#detail"), options);
        chart.render();
    </script>
@endsection
