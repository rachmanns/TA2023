@extends('partials.template')

@section('page_style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>

    <style>
        button.fc-today-button.fc-button.fc-button-primary {
            display: none;
        }

        .highcharts-title,
        .highcharts-exporting-group,
        .highcharts-credits {
            display: none;
        }

        .fc .fc-daygrid-event-harness .fc-event {
            white-space: unset !important;
        }
        .chart {
            overflow: auto;
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
            <div class="content-body">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-md-9 col-12 d-md-block d-none">
                                <h2 class="content-header-title float-left mb-0">Jadwal Bilateral</h2>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <input type="text" id="periode" class="form-control bg-white" placeholder="Periode" />
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="row match-height">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body" style="max-height: 55rem; overflow-y:scroll;">
                                    <h5 class="text-center">Kegiatan yang akan datang</h5>
                                    @if (!empty($kegiatan_akan_datang))
                                        @foreach ($kegiatan_akan_datang as $item)
                                            <div class="border rounded shadow p-75 mt-1">
                                                <div class="row">
                                                    <div class="col-2"><span class="bullet bullet-primary bullet-sm"></span>
                                                    </div>
                                                    <div class="col-10">
                                                        <span class="font-medium-1">{{ indonesian_date_format($item['tgl_pelaksanaan']) }}</span>
                                                        <h5 class="font-weight-bolder mt-50">{{ $item['nama_kegiatan'] }}</h5>
                                                        <h5 class="font-weight-bolder mt-50">{{ $item['nama_acara'] }}</h5>
                                                        <h6 class="text-muted mb-0">{{ $item['tempat'] }}</h6>
                                                        <h6 class="text-muted mb-0">{{ $item['keterangan'] }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="app-calendar overflow-hidden border">
                                <div class="row no-gutters">
                                    <!-- Calendar -->
                                    <div class="col position-relative">
                                        <div class="card shadow-none border-2 mb-2 rounded-2">
                                            <div class="card-body pb-0">
                                                <div id="calendar-bilateral"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Calendar -->
                                    <div class="body-content-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>                
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Bilateral</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">USIBDD</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="usibdd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">THAINESIA</h4>
                                </div>
                            </div>
                            <div class="card-body my-auto">
                                <div id="thainesia"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Persentase Kegiatan USIBDD {{ date('Y') }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="pku" class="chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Persentase Kegiatan THAINESIA {{ date('Y') }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="pkt"></div>
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
    <script src="{{ url('app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bar_chart("#pku", {!! json_encode($usibdd['series']) !!}, {!! json_encode($usibdd['categories']) !!});
            bar_chart("#pkt", {!! json_encode($thainesia['series']) !!}, {!! json_encode($thainesia['categories']) !!});
            // @if((!empty($usibdd['series'])) && (!empty($usibdd['labels'])))
            //     var usibdd_series = {!! json_encode($usibdd['series']) !!}
            //     var usibdd_labels = {!! json_encode($usibdd['labels']) !!}
            // @else
            //     var usibdd_series = []
            //     var usibdd_labels = []
            // @endif

            // @if((!empty($thainesia['series'])) && (!empty($thainesia['labels'])))
            //     var thainesia_series = {!! json_encode($thainesia['series']) !!}
            //     var thainesia_labels = {!! json_encode($thainesia['labels']) !!}
            // @else
            //     var thainesia_series = []
            //     var thainesia_labels = []
            // @endif

            // donat_chart("#pku", usibdd_series, usibdd_labels);
            // donat_chart("#pkt", thainesia_series, thainesia_labels);
            // donat_chart("#pkt", thainesia_series, thainesia_labels);


        });

        $('#periode').flatpickr({
            altInput: true,
            altFormat: 'F Y',
            defaultDate: '{{date("Y-m")}}',
            plugins: [
                new monthSelectPlugin({
                    dateFormat: "Y-m",
                })
            ]
        });

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
                    series3: '#EE3124',
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
                    abu: '#2d3333'
                }
            };

        // Donat Chart

        function donat_chart(selector, series, labels) {
            var bor_covid_element = document.querySelector(selector),
                bor_covid_config = {
                    chart: {
                        height: 350,
                        type: 'pie'
                    },
                    colors: [chartColors.pie.merah, chartColors.pie.ijo, chartColors.pie.kuning, chartColors.pie.biru,
                        chartColors.pie.ungu, chartColors.pie.birmud, chartColors.pie.ijommud, chartColors.pie.pink,
                        chartColors.pie.orange, chartColors.pie.peach,chartColors.pie.abu
                    ],
                    plotOptions: {
                        radialBar: {
                            size: 185,
                            hollow: {
                                size: '25%'
                            },
                            track: {
                                margin: 15
                            },
                            dataLabels: {
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Montserrat'
                                },
                                value: {
                                    fontSize: '1rem',
                                    fontFamily: 'Montserrat'
                                },
                                total: {
                                    show: true,
                                    fontSize: '1rem',
                                    label: 'Comments',
                                    formatter: function(w) {
                                        return '80%';
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        show: true,
                        position: 'bottom'
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    series: series,
                    labels: labels
                };
            if (typeof bor_covid_element !== undefined && bor_covid_element !== null) {
                var radialChart = new ApexCharts(bor_covid_element, bor_covid_config);
                radialChart.render();
            }

        }

        // BarChart USIBDD

        var options = {
            series: {!! json_encode($bar_usibdd['series']) !!},
            chart: {
                type: 'bar',
                height: 400,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        var nama_kegiatan = config.w.config.xaxis.categories[config.dataPointIndex];
                        var tahun = config.w.config.series[config.seriesIndex]['name'];
                        var data = {nama_event:"usibdd",nama_kegiatan:nama_kegiatan,tahun:tahun};

                        window.open("{{ url('kerma/bilateral/detail-dashboard') }}?collection="+encodeURIComponent(JSON.stringify(data)));
                    },
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '100%',
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
                categories: {!! json_encode($bar_usibdd['categories']) !!},
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            colors: [chartColors.column.series1, chartColors.column.series3,chartColors.column.series6, chartColors.column.series5, chartColors.column.series7],
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

        var chart = new ApexCharts(document.querySelector("#usibdd"), options);
        chart.render();

        // BarChart THAINESIA

        var options = {
            series: {!! json_encode($bar_thainesia['series']) !!},
            chart: {
                type: 'bar',
                height: 300,
                events: {
                    dataPointSelection: function(event, chartContext, config) {
                        var nama_kegiatan = config.w.config.xaxis.categories[config.dataPointIndex];
                        var tahun = config.w.config.series[config.seriesIndex]['name'];
                        var data = {nama_event:"thainesia",nama_kegiatan:nama_kegiatan,tahun:tahun};

                        window.open("{{ url('kerma/bilateral/detail-dashboard') }}?collection="+encodeURIComponent(JSON.stringify(data)));
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
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
                categories: {!! json_encode($bar_thainesia['categories']) !!},
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            colors: [chartColors.column.series1, chartColors.column.series3,chartColors.column.series6, chartColors.column.series5, chartColors.column.series7],
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

        var chart = new ApexCharts(document.querySelector("#thainesia"), options);
        chart.render();

        document.addEventListener('DOMContentLoaded', function() {
            function loadCalendar() {
                var calendarEl = document.getElementById('calendar-bilateral');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    navLinks: true,
                    height: 300,
                    initialView: 'dayGridMonth',
                    height: '70%',
                    dayHeaders: true,
                    initialDate: $('#periode').val(),
                    editable: true,
                    eventContent: function( arg ) {
                        return { html: arg.event.title };
                    },
                    events: fetchEvents
                });

                    calendar.render();
            }
            loadCalendar();

            $('#periode').change(function(){
                loadCalendar();
            })
        });


        function fetchEvents(info, successCallback) {
            // Fetch Events from API endpoint reference
            let start = info.startStr.substr(0, 10)
            let end = info.endStr.substr(0, 10)
            let data = {_token:"{{ csrf_token() }}",start:start,end:end}

            $.ajax({
                url: '{{ url("kerma/bilateral/jadwal-bilateral") }}',
                type: 'POST',
                data: data,
                success: function(result) {
                    // Get requested calendars as Array
                    successCallback(result);
                },
                error: function(error) {
                    // console.log(error);
                }
            });

        }

        var chart_init = {};
        
        function bar_chart(selector, series, categories) {
            var bar_element = document.querySelector(selector)
            var options = {
                series: series,
                chart: {
                    type: 'bar',
                    height: 300
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '100%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 40,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: categories,
                },
                yaxis: {
                    title: {
                        // text: '$ (thousands)'
                    }
                },
                colors: [chartColors.column.series1, chartColors.column.series3,chartColors.column.series6, chartColors.column.series5, chartColors.column.series7],
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

            if (typeof bar_element !== undefined && bar_element !== null) {
                var radialChart = new ApexCharts(bar_element, options);
                radialChart.render();
            }
            // if (typeof bar_element !== undefined && bar_element !== null) {
            //     radialChart = new ApexCharts(bar_element, options);
            //     if($(`${selector} svg`).length){

            //         chart_init[selector].destroy();
            //     }
            //         chart_init[selector]= radialChart
            //         chart_init[selector].render();
                
            // }
        }
    </script>
@endsection
