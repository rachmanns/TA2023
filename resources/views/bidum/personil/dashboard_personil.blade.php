@extends('partials.template') 

@section('page_style')
    <style>
        .underline { text-decoration: underline; }
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
                            <h2 class="content-header-title float-left mb-0">Personil (Per 1 Januari {{ date('Y') }} - 31 Desember {{ date('Y') }})</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                 <!-- Line Chart Card -->
                 <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">DATA PERSONIL PUSKES TNI</h3><br>
                                    {{-- <div id="pie-dsp"></div> --}}
                                    <div id="bar_dsp"></div>
                                    {{-- <div class="row mt-2">
                                        <div class="col-lg-6 text-right">
                                            <h4 class="font-weight-bolder">{{ $pie_dsp['DSP'] }}</h4>
                                            <p class="text-secondary m-0">DSP</p>
                                        </div>   
                                        <div class="col-lg-6">
                                            <h4 class="font-weight-bolder">{{ $pie_dsp['RIIL'] }}</h4>
                                            <p class="text-secondary m-0">RIIL</p>
                                        </div>    
                                    </div>                                      --}}
                                </div>                                      
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">JUMLAH PERSONIL RIIL</h3><br>
                                    <div id="personil_riil"></div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">PERSONIL TNI</h3><br>
                                    <div id="personil_tni"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart Card -->                               
                <div class="row match-height">
                    <div class="col-lg-8 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">JUMLAH PERWIRA PER MATRA</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="jumlah_perwira"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="row match-height">
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-header align-items-start pb-0">
                                        <div class="header-left">
                                            <h5>UKP <br> {{ $date_ukp_kenkat }}</h5>
                                        </div>
                                        <!-- <div class="avatar bg-light-primary p-25 rounded">
                                            <div class="avatar-content">
                                                <i data-feather="users" class="font-medium-3"></i>
                                            </div>
                                        </div> -->
                                    </div>    
                                    <div class="row pl-2 pr-2 pt-1">
                                        <div class="col-8">                                        
                                            <h1 class="d-inline font-large-4">{{ $jumlah_ukp }}</h1>
                                            <i data-feather="arrow-up" class="font-medium-4 text-primary" style="margin-top:-2em;"></i>
                                        </div>
                                    </div>
                                    <div class="row pr-2 pb-2">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('bidum.personil.index_ukp') }}" class="underline">Detail</a>                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-header align-items-start pb-0">
                                        <div class="header-left">
                                            <h5>KENKAT <br> {{ $date_ukp_kenkat }}</h5>
                                        </div>
                                        <!-- <div class="avatar bg-light-warning p-25 rounded">
                                            <div class="avatar-content">
                                                <i data-feather="award" class="font-medium-3"></i>
                                            </div>
                                        </div> -->
                                    </div>    
                                    <div class="row pl-2 pr-2 pt-1">
                                        <div class="col-8">                                        
                                            <h1 class="d-inline font-large-4">{{ $jumlah_kenkat }}</h1>
                                            <i data-feather="arrow-up" class="font-medium-4 text-warning" style="margin-top:-2em;"></i>
                                        </div>
                                    </div>
                                    <div class="row pr-2 pb-2">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('bidum.personil.index_kenkat') }}" class="underline">Detail</a>                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-header align-items-start pb-0">
                                        <div class="header-left">
                                            <h5>ULANG <br> TAHUN <br> ({{ date('F Y') }})</h5>
                                        </div>
                                        <!-- <div class="avatar bg-light-danger p-25 rounded">
                                            <div class="avatar-content">
                                                <i data-feather="gift" class="font-medium-3"></i>
                                            </div>
                                        </div> -->
                                    </div>    
                                    <div class="row pl-2 pr-2 pt-1">
                                        <div class="col-8">                                        
                                            <h1 class="d-inline font-large-4">{{ $birthday }}</h1>
                                        </div>
                                    </div>
                                    <div class="row pr-2 pb-2">
                                        <div class="col-12 text-right">
                                            <a href="{{ url('bidum/personil/ulang-tahun/hbd') }}" class="underline">Detail</a>                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-header align-items-start pb-0">
                                        <div class="header-left">
                                            <h5>PENSIUN <br> (Periode {{ date('F Y') }})</h5>
                                        </div>
                                        <!-- <div class="avatar bg-light-success p-25 rounded">
                                            <div class="avatar-content">
                                                <i data-feather="star" class="font-medium-3"></i>
                                            </div>
                                        </div> -->
                                    </div>    
                                    <div class="row pl-2 pr-2 pt-1">
                                        <div class="col-8">                                        
                                            <h1 class="d-inline font-large-4">{{ $pensiun }}</h1>
                                            <i data-feather="arrow-up" class="font-medium-4 text-success" style="margin-top:-2em;"></i>
                                        </div>
                                    </div>
                                    <div class="row pr-2 pb-2">
                                        <div class="col-12 text-right">
                                            <a href="{{ url('bidum/personil/pensiun') }}" class="underline">Detail</a>                             
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

    <!-- Send Invoice Sidebar -->
    <!-- /Send Invoice Sidebar -->
    <!-- END: Content-->
@endsection    

@section("page_script")
<script>
$( document ).ready(function() {
    $('#wilayah').select2({
    ajax: {
        url: '{{url("referensi/wilayah")}}',
        dataType: 'json',
        type: "GET",
        data:function(result){
        }
    }
    });

    // donat_chart("#pie-dsp",{!! json_encode(array_values($pie_dsp),JSON_NUMERIC_CHECK) !!},{!! json_encode(array_keys($pie_dsp)) !!})
    personil_riil("#personil_riil",{!! json_encode(array_values($personil_riil),JSON_NUMERIC_CHECK) !!},{!! json_encode(array_keys($personil_riil)) !!})
    personil_riil("#bar_dsp",{!! json_encode(array_values($bar_dsp),JSON_NUMERIC_CHECK) !!},{!! json_encode(array_keys($bar_dsp)) !!})
    personil_tni("#personil_tni",{!! json_encode(array_values($personil_tni),JSON_NUMERIC_CHECK) !!},{!! json_encode(array_keys($personil_tni)) !!})
    

    var options = {
        series: [{
        name: 'TNI AD',
        data: {!! json_encode($jumlah_perwira['AD'],JSON_NUMERIC_CHECK) !!}
    }, {
        name: 'TNI AL',
        data: {!! json_encode($jumlah_perwira['AL'],JSON_NUMERIC_CHECK) !!}
    }, {
        name: 'TNI AU',
        data: {!! json_encode($jumlah_perwira['AU'],JSON_NUMERIC_CHECK) !!}
    }],
        chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
        horizontal: false,
        columnWidth: '60%',
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
        categories: {!! json_encode($pangkat_perwira) !!},
    },
    yaxis: {
        title: {
        // text: '$ (thousands)'
        }
    },
    colors: [chartColors.column.ad, chartColors.column.al, chartColors.column.au],
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

  var chart = new ApexCharts(document.querySelector("#jumlah_perwira"), options);
  chart.render();


    bar_chart(".bor-covid-rs")

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
        series5: '#1C55E0',
        series6: '#FF9F43',
        series7: '#24B263',
        ad: '#24B263',
        al: '#87817E',
        au: '#1C55E0',
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
        riil:'#1D55E0',
        dsp:'#FF9F42'
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
            height: 250,
            type: 'pie'
        },
        colors: [chartColors.pie.riil, chartColors.pie.dsp],
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
        grid: {
            padding: {
            top: 10,
            right:-20
            }
        },
        legend: {
            show: true,
            position: 'right'
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

function personil_riil(data_selector,data_series,data_labels) {
    data_labels = data_labels.map(i => i);
    // Personil Chart
  var options = {
    series: [{
    data: data_series
  }],
    chart: {
    type: 'bar',
    height: 308
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
    width: 1,
    colors: ['transparent']
  },
  xaxis: {
    categories: data_labels,
  },
  yaxis: {
    title: {
      // text: '$ (thousands)'
    }
  },
  colors: [chartColors.column.series5, chartColors.column.series6, chartColors.column.series7],
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return val
      }
    }
  },
  };

  var chart = new ApexCharts(document.querySelector(data_selector), options);
  chart.render();
}

function personil_tni(data_selector,data_series,data_labels) {
    data_labels = data_labels.map(i => 'TNI ' + i);
    // Personil Chart

    var options = {
          series: [{
          data: data_series
        }],
          chart: {
          height: 308,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: [chartColors.column.ad, chartColors.column.al, chartColors.column.au],
        plotOptions: {
          bar: {
            columnWidth: '60%',
            distributed: true,
            endingShape: 'rounded'
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: data_labels,
        }
        };

        var chart = new ApexCharts(document.querySelector(data_selector), options);
        chart.render();
    }

</script>
@endsection