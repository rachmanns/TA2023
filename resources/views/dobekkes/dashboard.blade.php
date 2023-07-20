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
                            <h2 class="content-header-title float-left mb-0">Bidang Dobekkes - <?php echo date('F'); ?> 2022</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="modal" data-target="#send-invoice-sidebar"><i
                                    data-feather="filter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="card-title text-center mb-1 mt-2">Gudang 1</h4>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{$total[0]->jumlah ?? 0}} Barang</span>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1 mb-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Nilai Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{number_format($total[0]->nilai ?? 0, 0, '', '.')}}</span>
                                </div>
                            </div>
                            <div class="card-footer p-0"></div>
                            <h4 class="card-title text-center mb-0 mt-2">Stok Gudang 1</h4>
                            <div class="card-body">
                                <div class="row" id="kat_1">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
                                        <div id="gudang-dua" class="mb-50"></div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-right">
									    {{--
                                        <a href="#" class="underline">Detail</a>
									    --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="card-title text-center mb-1 mt-2">Gudang 2</h4>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{$total[1]->jumlah ?? 0}} Barang</span>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1 mb-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Nilai Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{number_format($total[1]->nilai ?? 0, 0, '', '.')}}</span>
                                </div>
                            </div>
                            <div class="card-footer p-0"></div>
                            <h4 class="card-title text-center mb-0 mt-2">Stok Gudang 2</h4>
                            <div class="card-body">
                                <div class="row" id="kat_2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
                                        <div id="gudang-satu" class="mb-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="card-title text-center mb-1 mt-2">Gudang 3</h4>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{$total[2]->jumlah ?? 0}} Barang</span>
                                </div>
                            </div>
                            <div class="row ml-1 mr-1 mb-1">
                                <div class="col-6">
                                    <h5 class="font-weight-bolder">Total Nilai Barang</h5>
                                </div>
                                <div class="col-6">
                                    <span class="text-primary font-weight-bolder">{{number_format($total[2]->nilai ?? 0, 0, '', '.')}}</span>
                                </div>
                            </div>
                            <div class="card-footer p-0"></div>
                            <h4 class="card-title text-center mb-0 mt-2">Stok Gudang 3</h4>
                            <div class="card-body">
                                <div class="row" id="kat_3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
                                        <div id="gudang-tiga" class="mb-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <h4 class="card-title text-center mb-0 mt-2">Total Persediaan</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 pr-0">
                                        <div id="persediaan" class="mb-50"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 my-auto" id="daftar_persediaan" style="max-height: 250px; overflow-x:auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <h4 class="card-title text-center mb-0 mt-2">Total Asset Matkes</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 pr-0">
                                        <div id="asset" class="mb-50"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 my-auto" id="daftar_aset" style="max-height: 250px; overflow-x:auto">
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
            for (i=1;i<=3;i++) {
                eval('tmp = kat'+i);
                if (tmp[0] == '') tmp = [];
                k = '';
                for (j=0;j<tmp.length;j++) {
                    if (j%2==0) k += '<div class="col-lg-4 col-md-12 col-sm-12 col-12">';
                    k += 
                                        '<div class="row">' +
                                            '<div class="col-2 pr-0">' +
                                                '<span class="bullet mt-25" style="background-color: ' + pie_color[j] + '"></span>' +
                                            '</div>' +
                                            '<div class="col-10 pr-0">' +
                                                '<span class="font-small-4">' + tmp[j] + '</span>' +
                                            '</div>' +
                                        '</div>';
                    if (j%2==1) k += '</div>';
                }
                $('#kat_'+i).append(k);
            }
            for (i=0;i<options1.labels.length;i++) {
                $('#daftar_persediaan').append('<div class="row">' +
                                            '<div class="col-2">' +
                                                '<span class="bullet mt-50" style="background-color: ' + pie_color[i] + '"></span>' +
                                            '</div>' +
                                            '<div class="col-10">' +
                                                '<span class="font-small-4">' + options1.labels[i] + '</span>' +
                                            '</div>' +
                                        '</div>');
            }
            if (options2.labels[0] == '') options2.labels = [];
            for (i=0;i<options2.labels.length;i++) {
                $('#daftar_aset').append('<div class="row">' +
                                            '<div class="col-2">' +
                                                '<span class="bullet mt-50" style="background-color: ' + pie_color[i] + '"></span>' +
                                            '</div>' +
                                            '<div class="col-10">' +
                                                '<span class="font-medium-2">' + options2.labels[i] + '</span>' +
                                            '</div>' +
                                        '</div>');
            }

            donat_chart("#gudang-dua", [{!!implode(",", $data["Gudang 1"]["series"])!!}], kat1)
            donat_chart("#gudang-satu", [{!!implode(",", $data["Gudang 2"]["series"])!!}], kat2)
            donat_chart("#gudang-tiga", [{!!implode(",", $data["Gudang 3"]["series"])!!}], kat3)
        });


        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            kat1 = ['{!!implode("','", $data["Gudang 1"]["labels"])!!}'],
            kat2 = ['{!!implode("','", $data["Gudang 2"]["labels"])!!}'],
            kat3 = ['{!!implode("','", $data["Gudang 3"]["labels"])!!}'],
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
                area: {
                    series3: '#a4f8cd',
                    series2: '#60f2ca',
                    series1: '#2bdac7'
                },
                line: {
                    red: "#ff4961",
                    grey: "#4F5D70",
                    grey_light: "#EDF1F4",
                    sky_blue: "#2b9bf4",
                    blue: "#1D55E0",
                    pink: "#F8D3FF",
                    gray_blue: "#ACBBEA",
                    success: "#2bdac7"
                }
            };

        function donat_chart(selector, series, labels) {
            var bor_covid_element = document.querySelector(selector),
                bor_covid_config = {
                    chart: {
                        height: 220,
                        type: 'pie'
                    },
                    colors: pie_color,
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

        let pie_color = Object.keys(chartColors['pie'])
            .map(function(key) {
                return chartColors['pie'][key];
            });

        var options1 = {
            colors: pie_color,
            series: [{!!implode(",", $data_p)!!}],
            labels: ['{!!implode("','", $kat)!!}'
            ],
            legend: {
                show: false
            },
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#persediaan"), options1);
        chart.render();

        var options2 = {
            colors: pie_color,
            series: [{{implode(',', $aset_jml)}}],
            labels: ['{!!implode("','", $aset_nama)!!}'],
            legend: {
                show: false
            },
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#asset"), options2);
        chart.render();
    </script>
@endsection
