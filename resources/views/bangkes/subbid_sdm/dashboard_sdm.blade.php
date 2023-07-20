@extends('partials.template')

@section('page_style')
    <style>
        .icon-size {
            width: 5rem;
            height: 5rem;
        }

        .underline {
            text-decoration: underline;
        }

        [pointer-events="bounding-box"] {
            display: none
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
                            <h2 class="content-header-title float-left mb-0">Dashboard SDM</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title">Tenaga Medis</h5>
                                <div class="d-flex align-items-center">
                                    <span class="font-medium-2 mr-1">Jumlah Tenaga Medis : </span> <span class="font-large-1 font-weight-bolder">{{ $count_dokter }}</span> 
                                </div>
                            </div>
                            <div class="card-body mt-1 pb-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right">
                                        <!-- <div class="card-title text-center">Sebaran</div> -->
                                        <!-- <div id="sebaran-medis"></div> -->
                                        <div id="sebaran-medis-bar">Grafik will load here!</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <!-- <div class="card-title text-center">Kategori Dokter</div>
                                        <div id="dokter-medis"></div> -->
                                        <div id="dokter-medis-bar">Grafik will load here!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title">Paramedis</h5>
                                <div class="d-flex align-items-center">
                                    <span class="font-medium-2 mr-1">Jumlah Paramedis : </span> <span class="font-large-1 font-weight-bolder">{{ $count_paramedis }}</span> 
                                </div>
                            </div>
                            <div class="card-body mt-1 pb-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right">
                                        <!-- <div class="card-title text-center">Sebaran</div>
                                        <div id="sebaran-paramedis"></div> -->
                                        <div id="sebaran-paramedis-bar">Grafik will load here!</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <!-- <div class="card-title text-center">Jenis Paramedis</div>
                                        <div id="jenis-paramedis"></div> -->
                                        <div id="jenis-paramedis-bar">Grafik will load here!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                        <div class="card-header border-bottom">
                                <h5 class="card-title">Pelatihan</h5>
                                <div class="d-flex align-items-center">
                                    <span class="font-medium-2 mr-1">Total Pelatihan : </span> <span class="font-large-1 font-weight-bolder">{{ $count_jenis_pelatihan }}</span> 
                                </div>
                            </div>
                            <div class="card-body mt-1 pb-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right">
                                        <div class="card-title text-center">Total Peserta Per Kategori : <span class="text-secondary font-medium-4 font-weight-bolder">{{ $peserta_bangkes_by_jenis['total'] }}</span></div>
                                        <!-- <div id="peserta1"></div> -->
                                        <div id="peserta1-bar"></div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="card-title text-center">Total Peserta Per Matra : <span class="text-secondary font-medium-4 font-weight-bolder">{{ $peserta_bangkes_by_matra['total'] }}</span></div>
                                        <!-- <div id="peserta2"></div> -->
                                        <div id="peserta2-bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-md-9 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Pendidikan</h4>
                                <div class="d-flex align-items-center">
                                    <select class="select2 form-control" id="semester">
                                        <option disabled selected>Filter Semester &emsp;</option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $s->tahun_ajaran }}">{{ $s->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>     
                                </div>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12 mb-2 mb-md-4">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="calon-patubel">0</h4>
                                                <p class="card-text font-small-3 mb-0">Calon Patubel</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 mb-2 mb-md-4">
                                        <div class="media">
                                            <div class="avatar bg-light-info mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="activity" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="belum-lulus-patubel">0</h4>
                                                <p class="card-text font-small-3 mb-0">Sprin Patubel</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="book-open" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="alih-jurusan-patubel">0</h4>
                                                <p class="card-text font-small-3 mb-0">Alih Jurusan & Tempat</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="award" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="lulus-patubel">0</h4>
                                                <p class="card-text font-small-3 mb-0">Lulusan Patubel</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="card">
                            <div class="card-header pb-50">
                                <h5 class="card-title">Selesai Internship</h5>
                            </div>
                            <div class="card-body">
                                <span class="font-large-1 font-weight-bolder">{{ $count_internship['selesai'] }}</span>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <span>Total Peserta</span>
                                    </div>
                                    <div class="col-md-6 col-12 text-right">
                                        <a href="{{ url('bangkes/selesai-internship') }}" class="underline">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pb-50">
                                <h5 class="card-title">Wahana Internship</h5>
                            </div>
                            <div class="card-body">
                                <span class="font-large-1 font-weight-bolder">{{ $count_internship['wahana'] }}</span>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <span>Total Peserta</span>
                                    </div>
                                    <div class="col-md-6 col-12 text-right">
                                        <a href="{{ url('bangkes/wahana-internship') }}" class="underline">Detail</a>
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
            $('#wilayah').select2({
                ajax: {
                    url: '{{ url('referensi/wilayah') }}',
                    dataType: 'json',
                    type: "GET",
                    data: function(result) {
                        
                    }
                }
            });

            sebaran_medis({!! json_encode($dokter_by_rs) !!})
            dokter_medis({!! json_encode($dokter_by_kategori['label']) !!}, {!! json_encode($dokter_by_kategori['data']) !!})
            sebaran_paramedis({!! json_encode($paramedis_by_rs) !!})
            jenis_paramedis({!! json_encode($paramedis_by_jenis['label']) !!}, {!! json_encode($paramedis_by_jenis['data']) !!})
            peserta_kategori({!! json_encode($peserta_bangkes_by_jenis['data']) !!})
            peserta_matra({!! json_encode($peserta_bangkes_by_matra['data']) !!})

            // donat_chart("#sebaran-medis",{!! json_encode(array_values($dokter_by_rs)) !!}, {!! json_encode(array_keys($dokter_by_rs)) !!})
            // donat_chart("#dokter-medis", {!! json_encode(array_values($dokter_by_kategori)) !!}, {!! json_encode(array_keys($dokter_by_kategori)) !!})          
            // donat_chart("#sebaran-paramedis",{!! json_encode(array_values($paramedis_by_rs)) !!}, {!! json_encode(array_keys($paramedis_by_rs)) !!})
            // donat_chart("#jenis-paramedis", {!! json_encode(array_values($paramedis_by_jenis)) !!}, {!! json_encode(array_keys($paramedis_by_jenis)) !!})
            // donat_chart2("#peserta1", {!! json_encode(array_values($peserta_bangkes_by_jenis)) !!}, {!! json_encode(array_keys($peserta_bangkes_by_jenis)) !!})
            // donat_chart2("#peserta2", {!! json_encode(array_values($peserta_bangkes_by_matra)) !!}, {!! json_encode(array_keys($peserta_bangkes_by_matra)) !!})
        });

        $('#semester').change(function(){
            let semester = $(this).val();
            $.ajax({
                url: "{{ url('bangkes/sdm/dashboard/count-patubel') }}",
                method: "POST",
                data: { _token:"{{ csrf_token() }}", tahun_ajaran : semester },
                success: function(response){
                    $('#calon-patubel').text(response.calon);
                    $('#belum-lulus-patubel').text(response.belum_lulus);
                    $('#alih-jurusan-patubel').text(response.alih_jurusan);
                    $('#lulus-patubel').text(response.lulus);
                }
            });
        })

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            chartColors = {
                donut: {
                    series1: '#ffe700',
                    series2: '#00d4bd',
                    series3: '#826bf8',
                    series4: '#2b9bf4',
                    series5: '#FFA1A1'
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
                    peach: '#FF9F43'
                },
            };

        function donat_chart(selector, series, labels) {
            var bor_covid_element = document.querySelector(selector),
                bor_covid_config = {
                    chart: {
                        height: 230,
                        type: 'pie'
                    },
                    colors: [chartColors.pie.merah, chartColors.pie.ijo, chartColors.pie.kuning, chartColors.pie.biru,
                        chartColors.pie.ungu, chartColors.pie.birmud, chartColors.pie.ijommud, chartColors.pie.pink,
                        chartColors.pie.orange, chartColors.pie.peach
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
                        // position: 'bottom'
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

        let pie_color = Object.keys(chartColors['pie'])
            .map(function(key) {
                return chartColors['pie'][key];
            });

            function donat_chart2(selector, series, labels) {
                var options = {
                    colors: [chartColors.pie.merah, chartColors.pie.ijo, chartColors.pie.kuning, chartColors.pie.biru,
                        chartColors.pie.ungu, chartColors.pie.birmud, chartColors.pie.ijommud, chartColors.pie.pink,
                        chartColors.pie.orange, chartColors.pie.peach
                    ],
                    series: series,
                    labels: labels,
                    legend: {
                        show: true,
                        position: 'bottom'
                    },
                    chart: {
                        height: 300,
                        type: 'donut'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 100
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector(selector), options);
                chart.render();
             }
    </script>

<script src="{{ url('assets/js/fusioncharts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.charts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.theme.fusion.js') }}"></script>
<script type="text/javascript">
    function sebaran_medis(data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: 'sebaran-medis-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "caption": "Sebaran",
                        "numVisiblePlot": "4",
                        "plottooltext": "$label: <b>$dataValue</b>",
                        "paletteColors": "FE2712, A7194B, FABC02, 530505, 3B0041"
                    }, 
                    "data": data
                }
            });
            chartObj.render();
        });
    }
</script>

<script type="text/javascript">
    function dokter_medis(label, data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'scrollmsstackedcolumn2d',
                renderAt: 'dokter-medis-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "numVisiblePlot": "4",
                        "caption": "Kategori Dokter",
                        "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>"
                    },
                    "categories": [{
                        "category": label
                    }],
                    "dataset": [{
                            "dataset": [{
                                    "color": "#0C7B93",
                                    "data": data
                                }
                            ]
                        }
                    ]
                }
            });
            chartObj.render();
        });
    }
</script>

<script type="text/javascript">
    function sebaran_paramedis(data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: 'sebaran-paramedis-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "caption": "Sebaran",
                        "numVisiblePlot": "4",
                        "plottooltext": "$label: <b>$dataValue</b>",
                        "paletteColors": "FE2712, A7194B, FABC02, 530505, 3B0041"
                    },
                    "data": data
                }
            });
            chartObj.render();
        });
    }
</script>

<script type="text/javascript">
    function jenis_paramedis(label, data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'scrollmsstackedcolumn2d',
                renderAt: 'jenis-paramedis-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "numVisiblePlot": "4",
                        "caption": "Jenis Paramedis",
                        "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>"
                    },
                    "categories": [{
                        "category": label
                    }],
                    "dataset": [{
                            "dataset": [{
                                    "color": "#E1701A",
                                    "data": data
                                }
                            ]
                        }
                    ]
                }
            });
            chartObj.render();
        });
    }
</script>

<script type="text/javascript">
    function peserta_kategori(data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: 'peserta1-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "numVisiblePlot": "4",
                        "plottooltext": "$label: <b>$dataValue</b>",
                        "paletteColors": "788300, FFE600, B00000, 530505, 43C7FF"
                    },
                    "data": data
                }
            });
            chartObj.render();
        });
    }
</script>

<script type="text/javascript">
    function peserta_matra(data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: 'peserta2-bar',
                width: '100%',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "numVisiblePlot": "4",
                        "plottooltext": "$label: <b>$dataValue</b>",
                        "paletteColors": "326F3F, 2045B8, 4296A5, FF7E03"
                    },
                    "data": data
                }
            });
            chartObj.render();
        });
    }
</script>
@endsection
