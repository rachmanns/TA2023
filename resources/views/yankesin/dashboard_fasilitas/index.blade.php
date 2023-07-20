@extends('partials.template') 

@section('page_style')
<style>
    .graphic-container {
        min-height: 200px;
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .apexcharts-canvas .apexcharts-datalabel {
        fill: #fff;
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
                            <h2 class="content-header-title float-left mb-0">Dashboard Fasilitas</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="modal" data-target="#send-invoice-sidebar" ><i data-feather="filter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                 <!-- Line Chart Card -->
                 <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Ambulance</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 my-auto">
                                            <div id="bor-covid19"></div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 my-auto">
                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="bullet mt-50" style="background-color: #1C55E0;"></span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="font-medium-1">Ambulance Intensif</span>
                                                </div>
                                            </div>
                                            <div class="row mb-50">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <span class="font-medium-1 font-weight-bolder" style="color: #1C55E0">{{$series['Ambulance'][0]}} Unit</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="bullet mt-50 bullet-danger"></span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="font-medium-1">Ambulance Jenazah</span>
                                                </div>
                                            </div>
                                            <div class="row mb-50">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <span class="font-medium-1 font-weight-bolder text-danger">{{$series['Ambulance'][1]}} Unit</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="bullet mt-50 bullet-warning"></span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="font-medium-1">Ambulance Transport</span>
                                                </div>
                                            </div>
                                            <div class="row mb-50">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <span class="font-medium-1 font-weight-bolder text-warning">{{$series['Ambulance'][2]}} Unit</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <span class="font-medium-1">Total Ambulance</span>
                                                </div>
                                            </div>
                                            <div class="row mb-50">
                                                <div class="col-2"></div>
                                                <div class="col-10">
                                                    <span class="font-medium-1 font-weight-bolder" style="color: #1C55E0;">{{$series['Ambulance'][0]+$series['Ambulance'][1]+$series['Ambulance'][2]}} Unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Unggulan</h4>
                                        <span>Jumlah faskes yang memiliki fasilitas unggulan</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="unggulan"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </section>
                <!--/ Line Chart Card -->
                
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Fasilitas Rawat Jalan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="chartjs-chart">
                    <div class="row match-height">
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Poliklinik</h4>
                                        <span>Jumlah spesialis dan sub-spesialis</span>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="graphic-container"> 
                                        <div id="poli-umum"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Poli Gigi</h4>
                                        <span>Jumlah spesialis dan sub-spesialis</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="poli-gigi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas IGD & Kamar Bersalin</h4>
                                        <span>Jumlah tempat tidur</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="f-igd"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Fasilitas Rawat Inap</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="chartjs-chart">
                    <div class="row match-height">
                        <div class="col-xl-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Rawat Inap</h4>
                                        <span>Jumlah tempat tidur</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="f-rawat-inap"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Rawat Inap Khusus</h4>
                                        <span>Jumlah tempat tidur</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="f-rawat-inap-khusus"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Tempat Tidur ICU, Ruang Operasi, dan  Lainnya</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="chartjs-chart">
                    <div class="row match-height">
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Tempat Tidur ICU</h4>
                                        {{-- <span>Jumlah tempat tidur</span> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="f-icu"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Tempat Tidur Ruang Operasi</h4>
                                        {{-- <span>Jumlah tempat tidur</span> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="ruang-operasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Tempat Tidur Lainnya</h4>
                                        {{-- <span>Jumlah tempat tidur</span> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="fas-lain"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Fasilitas Penunjang</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="chartjs-chart">
                    <div class="row match-height">
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Penunjang Diagnostic</h4>
                                        <span>Jumlah fasilitas</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="diagnostic"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Radiologi</h4>
                                        <span>Jumlah fasilitas</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="radiologi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Fasilitas Penunjang Klinis</h4>
                                        <span>Jumlah fasilitas</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="graphic-container"> 
                                        <div id="klinis"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal Chart Kategori Bahan Produksi -->
    <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Detail Daftar Faskes dengan <span class="catfas"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bolder lbl-cat"></h4>
                    <h5 class="font-weight-bolder lbl-total"></h5>
                    
                    <div class="table-responsive border rounded my-1">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nama Faskes</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <span class="align-middle">Filter</span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <form>
                        <div class="form-group">
                            <label for="nasional" class="form-label">Provinsi</label>
                            <select class="select2 form-control" id="nasional">
                                <option value="*">Nasional</option>
                                @foreach($wil as $w)
                                <option value="{{$w->id_provinsi}}" @if(request()->prov == $w->id_provinsi) selected @endif >{{$w->nama_provinsi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matra" class="form-label">Matra</label>
                            <select class="select2 form-control" id="matra">
                                <option value="*">Semua Matra</option>
                                <option value="AD">TNI AD</option>
                                <option value="AL">TNI AL</option>
                                <option value="AU">TNI AU</option>
                                <option value="MABES">MABES</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kotama" class="form-label">Kotama</label>
                            <select class="select2 form-control" id="kotama" disabled>
                                <option value="*">Semua Kotama</option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-wrap mt-2">
                            <button type="button" class="btn btn-primary mr-1 btn-filter" data-dismiss="modal">Filter</button>
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

@section("page_script")
<script>
$( document ).ready(function() {
    $('#matra').change(function() {
        if ($(this).val() == '*') {
            $('#kotama').val('*').trigger('change');
            $('#kotama').prop('disabled', true);
        } else $.ajax({
            url: "{{ url('master/komando/select') }}/" + $(this).val(),
            method: "GET",
            dataType: "json",
            success: function(result) {
                $('#kotama').empty();
                result.data[0] = {id: '*', text: 'Semua Kotama'}
                $('#kotama').select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $('#kotama').parent(),
                    data: result.data,
                });
                $('#kotama').prop('disabled', false);
                @if(request()->kotama)
                $('#kotama').val('{{request()->kotama}}').trigger('change');
                @endif
            }
        });
    });
    @if(request()->matra)
    $('#matra').val('{{request()->matra}}').trigger('change');
    @endif

    $(".btn-filter").click(function() {
        params = 'p';
        if ($('#nasional').val() != '*') params += '&prov=' + $('#nasional').val();
        if ($('#matra').val() != '*') params += '&matra=' + $('#matra').val();
        if ($('#kotama').val() != '*') params += '&kotama=' + $('#kotama').val();
        location.href = '{{request()->url}}?' + params;
    });

    donat_chart("#bor-covid19", [{{implode(', ', $series['Ambulance'])}}], ["{!!implode('", "', $labels['Ambulance'])!!}"])
    bar_chart("#unggulan", [{{implode(', ', $series['Fasilitas Unggulan'])}}], ["{!!implode('", "', $labels['Fasilitas Unggulan'])!!}"], 'Fasilitas Unggulan', true)
    bar_chart("#poli-umum", [{{implode(', ', $series['Poli Umum'])}}], ["{!!implode('", "', $labels['Poli Umum'])!!}"], 'Poli Umum', true)
    bar_chart("#poli-gigi", [{{implode(', ', $series['Poli Gigi'])}}], ["{!!implode('", "', $labels['Poli Gigi'])!!}"], 'Poli Gigi', true)
    bar_chart("#f-igd", [{{implode(', ', $series['IGD'])}}], ["{!!implode('", "', $labels['IGD'])!!}"], 'IGD')
    bar_chart("#f-rawat-inap", [{{implode(', ', array_slice($series['Rawat Inap'], 0, 4))}}], ["{!!implode('", "', array_slice($labels['Rawat Inap'], 0, 4))!!}"], 'Rawat Inap', false, data['Rawat Inap'].slice(0, 4))
    bar_chart("#f-rawat-inap-khusus", [{{implode(', ', $series['Rawat Inap Khusus'])}}], ["{!!implode('", "', $labels['Rawat Inap Khusus'])!!}"], 'Rawat Inap Khusus')
    bar_chart("#f-icu", [{{implode(', ', array_slice($series['Rawat Inap'], 4))}}], ["{!!implode('", "', array_slice($labels['Rawat Inap'], 4))!!}"], 'Rawat Inap', true, data['Rawat Inap'].slice(4))
    bar_chart("#ruang-operasi", [{{implode(', ', $series['Ruang Operasi'])}}], ["{!!implode('", "', $labels['Ruang Operasi'])!!}"], 'Ruang Operasi')
    bar_chart("#fas-lain", [{{implode(', ', $series['Fasilitas Lainnya'])}}], ["{!!implode('", "', $labels['Fasilitas Lainnya'])!!}"], 'Fasilitas Lainnya', true)
    bar_chart("#diagnostic", [{{implode(', ', $series['Penunjang Diagnostik'])}}], ["{!!implode('", "', $labels['Penunjang Diagnostik'])!!}"], 'Penunjang Diagnostik')
    bar_chart("#radiologi", [{{implode(', ', $series['Radiologi'])}}], ["{!!implode('", "', $labels['Radiologi'])!!}"], 'Radiologi')
    bar_chart("#klinis", [{{implode(', ', $series['Penunjang Klinis'])}}], ["{!!implode('", "', $labels['Penunjang Klinis'])!!}"], 'Penunjang Klinis')

});


var data = {!!json_encode($data)!!},
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
        colors: ['#1C55E0', '#EA5455', '#FF9F43'],
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

function bar_chart(selector, series, labels, title, custom_height=false, custom_data = null) {
let height_value = custom_height ? (series.length*50) : 200;
var details = custom_data ?? data[title];
var barChartEl = document.querySelector(selector),
  barChartConfig = {
    chart: {
      height: height_value,
      type: 'bar',
      parentHeightOffset: 0,
      toolbar: {
        show: false
      },
      events: {
        click: function(event, chartContext, config) {
            if (config.dataPointIndex == -1) return;
            $('.catfas').text(title);
            $('.lbl-cat').text('Fasilitas : ' + config.config.xaxis.categories[config.dataPointIndex]);
            $('.lbl-total').text('Total : ' + config.config.series[config.seriesIndex].data[config.dataPointIndex]);
            detail_fas(details[config.dataPointIndex]);
        }
    }
    },
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: '30%',
        endingShape: 'rounded'
      }
    },
    grid: {
      xaxis: {
        lines: {
          show: false
        }
      },
      padding: {
        top: -15,
        bottom: -10
      }
    },
    colors: '#1D55E0',
    dataLabels: {
        enabled: true
    },
    series: [
      {
        name: 'Total',
        data: series
      }
    ],
    tooltip: {
      shared: true,
    },
    xaxis: {
      categories: labels
    },
    yaxis: {
      opposite: isRtl
    }
  };
  if (typeof barChartEl !== undefined && barChartEl !== null) {
    var barChart = new ApexCharts(barChartEl, barChartConfig);
    barChart.render();
  }
}


var table_ = $('#table').DataTable();
function detail_fas(data) {
    table_.destroy();
    $('#table tbody').html('');
    data.forEach(function(d) {
        $('#table tbody').append('<tr><td>' + d.nama + '</td><td>' + (d.jumlah ?? 'Ada') + '</td></tr>');
    });
    table_ = $('#table').DataTable({
        destroy: true,
        "drawCallback": function(settings) {
            $("#modal-detail").modal('show');
        }
    });
}

</script>
@endsection