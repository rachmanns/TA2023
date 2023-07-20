@extends('partials.template') 

@section('page_style')
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/calendars/fullcalendar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-calendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
    <style>
        .fc .fc-daygrid-event-harness .fc-event {
            white-space: unset !important;
        }
    </style>
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
                                <h2 class="content-header-title float-left mb-0">Jadwal Multilateral</h2>
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
                                    <h6 class="text-center">Kegiatan yang akan datang</h6>
                                    @foreach ($kegiatan_akan_datang as $kad)
                                        <div class="border rounded shadow p-75 mt-1">
                                            <div class="row">
                                                <div class="col-2"><span class="bullet bullet-primary bullet-sm"></span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="font-medium-1">{{ indonesian_date_format($kad['tgl_pelaksanaan']) }}</span>
                                                    <h5 class="font-weight-bolder mt-50">{{ $kad['nama_kegiatan'] }}</h5>
                                                    <h5 class="font-weight-bolder mt-50">{{ $kad['nama_acara'] }}</h5>
                                                    <h6 class="text-muted mb-0">{{ $kad['tempat'] }}</h6>
                                                    <h6 class="text-muted mb-0">{{ $kad['keterangan'] }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="app-calendar overflow-hidden border">
                                <div class="row no-gutters">
                                    <!-- Calendar -->
                                    <div class="col position-relative">
                                        <div class="card shadow-none border-0 mb-0 rounded-0">
                                            <div class="card-body pb-0">
                                                <div id="calendar"></div>
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
                                <h2 class="content-header-title float-left mb-0">Multilateral</h2>
                            </div>
                        </div>
                    </div>
                </div>                         
                <div class="row match-height">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Multilateral</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="multilateral"></div>
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
            height: 400,
            events: {
                    dataPointSelection: function(event, chartContext, config) {
                        let tahun = config.w.config.series[config.seriesIndex].name;
                        let nama_kegiatan = config.w.config.xaxis.categories[config.dataPointIndex];
                        window.open("{{ url('kerma/nonbilateral/detail-dashboard') }}/"+tahun+'/'+nama_kegiatan);
                    }
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
            categories: {!! json_encode($categories) !!},
        },
        yaxis: {
            title: {
            // text: '$ (thousands)'
            }
        },
        colors: [chartColors.column.series6, chartColors.column.series5, chartColors.column.series7, chartColors.column.series1, chartColors.column.series4],
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
            formatter: function (val) {
                return val
            }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#multilateral"), options);
    chart.render();

    // Calendar
    document.addEventListener('DOMContentLoaded', function() {
        function loadCalendar() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                navLinks: true,
                height: 300,
                initialView: 'dayGridMonth',
                height: '70%',
                dayHeaders: true,
                initialDate: $('#periode').val(),
                editable: false,
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
                url: '{{ url("kerma/nonbilateral/jadwal-bilateral") }}',
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

    </script>
    <script src="{{ url('app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
@endsection