@extends('partials.template') 

@section('page_style')
    <style>
        .icon-size{
            width: 5rem;
            height: 5rem;
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
                            <h2 class="content-header-title float-left">Daftar Alkes & Bekkes Puskes TNI</h2>
                        </div>
                    </div>
                    <form action="{{ url('matfaskes/dashboard-kegiatan') }}" method="get" autocomplete="off">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="tahun form-control" name="q">
                            </div>
                            <div class="col-3 pl-0">
                                <button type="submit" class="btn btn-primary">filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 my-auto">
                                        <div class="card-header flex-column align-items-center p-0">
                                            <div class="avatar bg-light-success p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="users" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <span class="card-text mt-1">Total Alkes</span>
                                            <h2 class="font-weight-bolder mb-0">{{ $daftar_alkes_bekkes['jumlah']['alkes']; }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-12 col-sm-12 col-12 my-auto">
                                        <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column p-0">
                                            <div class="header-left">
                                                <h3 class="card-title font-weight-bolder mb-1">Alkes Puskes TNI</h3>
                                            </div>
                                        </div>
                                        <span class="pr-2 font-medium-1">Jumlah Nominal Alkes</span> <span class="font-weight-bolder font-medium-3">{{ "Rp" . number_format($daftar_alkes_bekkes['nominal']['alkes'],0,',','.'); }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 my-auto">
                                        <div class="card-header flex-column align-items-center p-0">
                                            <div class="avatar bg-light-danger p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="users" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <span class="card-text mt-1">Total Bekkes</span>
                                            <h2 class="font-weight-bolder mb-0">{{ $daftar_alkes_bekkes['jumlah']['bekkes']; }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-12 col-sm-12 col-12 my-auto">
                                        <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column p-0">
                                            <div class="header-left">
                                                <h3 class="card-title font-weight-bolder mb-1">Bekkes Puskes TNI</h3>
                                            </div>
                                        </div>
                                        <span class="pr-2 font-medium-1">Jumlah Nominal Bekkes</span> <span class="font-weight-bolder font-medium-3">{{ "Rp" . number_format($daftar_alkes_bekkes['nominal']['bekkes'],0,',','.'); }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-1">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Kegiatan Pengadaan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center">Jumlah Kontrak Pengadaan Berdasarkan Jenis Barang</h4>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 px-0 pb-0">
                                            <div id="perbandingan-pengadaan"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center">Jumlah Kontrak Pengadaan Berdasarkan Kewenangan</h4>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 px-0 pb-0">
                                            <div id="jumlah-kontrak" class="mb-50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="row mt-1">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header flex-column align-items-center p-0">
                                                <div class="avatar bg-light-success height-150 width-150  align-items-center pl-3">
                                                    <i data-feather="briefcase" class="icon-size text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column p-0">
                                                <div class="header-left">
                                                    <h3 class="font-weight-bolder mb-2">Kegiatan Pengadaan</h3>
                                                </div>
                                            </div>
                                            <div class="font-medium-1">Jumlah Nominal Pengadaan</div> <span class="font-weight-bolder font-large-1">{{ "Rp" . number_format($count_kontrak['nominal']['total'],0,',','.'); }}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 ml-1">
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Alkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_kontrak['jumlah_kontrak']['alkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Alkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_kontrak['nominal']['alkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_kontrak['jumlah_kontrak']['bekkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_kontrak['nominal']['bekkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-1">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Kegiatan TKTM</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-4 col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center">Jumlah TKTM Berdasarkan Jenis Barang</h4>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 px-0 pb-0">
                                            <div id="jumlah-tktm"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header flex-column align-items-center p-0">
                                                <div class="avatar bg-light-warning height-150 width-150  align-items-center pl-3">
                                                    <i data-feather="briefcase" class="icon-size text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column p-0">
                                                <div class="header-left">
                                                    <h3 class="font-weight-bolder mb-2">Kegiatan TKTM</h3>
                                                </div>
                                            </div>
                                            <div class="font-medium-1">Jumlah Nominal TKTM</div> <span class="font-weight-bolder font-large-1">{{ "Rp" . number_format($count_tktm['nominal']['total'],0,',','.'); }}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 ml-1">
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Alkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_tktm['jumlah_tktm']['alkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Alkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_tktm['nominal']['alkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_tktm['jumlah_tktm']['bekkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_tktm['nominal']['bekkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-1">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Kegiatan Hibah</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-4 col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center">Jumlah Hibah Berdasarkan Jenis Barang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 px-0 pb-0">
                                            <div id="jumlah-hibah"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header flex-column align-items-center p-0">
                                                <div class="avatar bg-light-danger height-150 width-150  align-items-center pl-3">
                                                    <i data-feather="briefcase" class="icon-size text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column p-0">
                                                <div class="header-left">
                                                    <h3 class="font-weight-bolder mb-2">Kegiatan Hibah</h3>
                                                </div>
                                            </div>
                                            <div class="font-medium-1">Jumlah Nominal Hibah</div> <span class="font-weight-bolder font-large-1">{{ "Rp" . number_format($count_hibah['nominal']['total'],0,',','.'); }}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 ml-1">
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Alkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_hibah['jumlah_hibah']['alkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Alkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_hibah['nominal']['alkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pr-2 font-medium-2 text-muted">Total Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ $count_hibah['jumlah_hibah']['bekkes'] }}</span>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <div class="pr-2 font-medium-2 text-muted">Jumlah Nominal Bekkes</div> <span class="font-weight-bolder font-medium-5">{{ "Rp" . number_format($count_hibah['nominal']['bekkes'],0,',','.'); }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection    

@section("page_script")
<script>

$(".tahun").yearpicker({year: {{ $tahun }}})

$( document ).ready(function() {
    $('#wilayah').select2({
    ajax: {
        url: '{{url("referensi/wilayah")}}',
        dataType: 'json',
        type: "GET",
        data:function(result){
            console.log("hasilnya "+result)
        }
    }
    });

    bar_chart("perbandingan-pengadaan", @json($count_kontrak['bar_chart_jenis_barang']))
    bar_chart("jumlah-kontrak", @json($count_kontrak['bar_chart_kewenangan']))
    bar_chart("jumlah-tktm", @json($count_tktm['bar_chart']))
    bar_chart("jumlah-hibah", @json($count_hibah['bar_chart']))

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
    pie:{
        terisi:'#1D55E0',
        tersedia:'#FF9F42'
    },
    area: {
        series3: '#a4f8cd',
        series2: '#60f2ca',
        series1: '#2bdac7'
    },
    line:{
        red:"#ff4961",
        grey:"#4F5D70",
        grey_light:"#EDF1F4",
        sky_blue:"#2b9bf4",
        blue:"#1D55E0",
        pink:"#F8D3FF",
        gray_blue:"#ACBBEA",
        success:"#2bdac7"
    }
};

function donat_chart(selector,series,labels){
    var bor_covid_element = document.querySelector(selector),
        bor_covid_config = {
        chart: {
            height: 220,
            type: 'pie'
        },
        colors: [chartColors.pie.tersedia, chartColors.pie.terisi],
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
                    formatter: function (w) {
                        return '80%';
                    }
                }
            }
            }
        },
        legend: {
            show: false
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

</script>

<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<script type="text/javascript">

    function bar_chart(selector, data) {
        FusionCharts.ready(function() {
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: selector,
                width: '100%',
                height: '300',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "theme": "fusion",
                        "numVisiblePlot": "2",
                        "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>",
                        "paletteColors": "1d55e0, ff9f42"
                    },
                    "data": data
                }
            });
            chartObj.render();
        });
    }
</script>
@endsection