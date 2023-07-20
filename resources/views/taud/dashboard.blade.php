@extends('partials.template')

@section('page_style')
    <style>
    .picker__header select {
        display: inline-block !important;
    }
    .datepicker.dropdown-menu {
        visibility: visible;
        opacity: 1;
        width: auto;
        z-index:9999 !important;
        transform: unset !important;
    }
    .radius-left {
        border-top-left-radius: 8px;
    }
    .dataTables_info {
        padding-left: 20px;
        padding-bottom: 20px;
    }
    .scroll {
        display: inline-block;
        overflow-y: scroll;
        overflow-x: hidden;
        max-height:365px;
    }
    .freeze {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 2;
    }   
    table.dataTable {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Bidang Taud</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-9 col-12 my-auto">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Surat Diterima <span class="tahun"></span></h3>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun_anggaran" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div>
                                    <h2 class="font-weight-bolder card-text">Surat Biasa</h2>
                                </div>
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="cpu" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <span class="font-weight-bolder font-large-3 text-primary mr-1" id="Biasa"></span><span class="font-medium-2">Surat </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div>
                                    <h2 class="font-weight-bolder card-text">Surat Rahasia</h2>
                                </div>
                                <div class="avatar bg-light-danger p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="activity" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <span class="font-weight-bolder font-large-3 text-primary mr-1" id="Rahasia"></span><span class="font-medium-2">Surat </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div>
                                    <h2 class="font-weight-bolder card-text">Surat Telegram</h2>
                                </div>
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="server" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <span class="font-weight-bolder font-large-3 text-primary mr-1" id="Telegram"></span><span class="font-medium-2">Surat </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header row mb-1">
                    <div class="content-header-left col-md-9 col-12 my-auto">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h3 class="content-header-title float-left mb-0">Surat Keluar <span class="tahun"></span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                        <div class="input-group input-group-merge form-input">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Surat Keluar</div>
                            </div>
                            <div class="card-body">
                                <div id="chart"></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header row mb-1">
                    <div class="content-header-left col-md-12 col-12 my-auto">
                        <div class="row breadcrumbs-top">
                            <div class="col-md-4 col-8">
                                <h3 class="content-header-title float-left mb-0">Daftar Ranmor</h3>
                            </div>
                            <div class="col-md-5 col-8 my-auto">
                                <h3 class="content-header-title float-left mb-0">Distribusi BBM - <span class="periode"></span></h3>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <input type="text" id="tgl" class="form-control bg-white cursor-pointer" placeholder="Filter Bulan" readonly />
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row match-height">
                    <div class="col-md-4 col-12">
                        <div class="mb-2">
                            <h3 class="content-header-title float-left mb-0">Daftar Ranmor</h3>
                        </div>
                        <div class="card">
                            <div class="scroll">
                            <table class="table m-0" id="ranmor">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white radius-left" style="position: sticky; top: 0; z-index: 2;">Merk</th>
                                        <th class="bg-secondary text-white freeze">No. Reg</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-2">
                            <h3 class="content-header-title float-left mb-0">Distribusi BBM - <span class="periode"></span></h3>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title mb-2">Terima BBM</div>
                            </div>
                            <div class="card-body">
                                <div id="terima"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div style="margin-bottom: 8px;">
                            <input type="text" id="tgl" class="form-control bg-white cursor-pointer" placeholder="Filter Bulan" readonly />
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title mb-2">Keluar BBM</div>
                            </div>
                            <div class="card-body">
                                <div id="keluar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($jenis_bbm as $j)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                                <h4 class="card-title">Grafik Distribusi {{$j}}</h4>
                            </div>
                            <div class="card-body">
                                <div id="{{$j}}"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var chartColors = {
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
                bar: {
                    'Pertalite': '#FFAB00',
                    'Pertamax': '#28C76F',
                    'HSD': '#2045B8',
                },
            };
        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        function reload_donat() {
            $('.periode').html(bulan[parseInt($('#tgl').val().substr(5))-1] + ' ' + $('#tgl').val().substr(0,4));
            $.ajax({
                url: "{{ url('taud/dashboard/bbm') }}?periode=" + $('#tgl').val(),
                success: function(res) {
                    if (!res.error) {
                        donat_chart("#terima", res.terima, ["Pertalite", "Pertamax", "HSD"])
                        donat_chart("#keluar", res.keluar, ["Pertalite", "Pertamax", "HSD"])
                    }
                }
            });
        }

        function donat_chart(selector, series, labels) {
            var element = document.querySelector(selector),
                config = {
                    chart: {
                        height: 285,
                        type: 'pie'
                    },
                    colors: [chartColors.pie.kuning, chartColors.pie.ijo, chartColors.pie.biru, chartColors.pie.biru,
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
                        position: 'bottom'
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    series: series,
                    labels: labels
                };
            if (typeof element !== undefined && element !== null) {
                element.innerHTML = '';
                var radialChart = new ApexCharts(element, config);
                radialChart.render();
            }

        }

        $(document).ready(function() {
            $('#tahun_anggaran').change(function() {
                reload_chart();
            });
            $('#tahun_anggaran').val({{date('Y')}}).trigger('change');
            $('#ranmor').DataTable({
                ajax: "{{ url('/taud/ranmor/list') }}",
                searching: false,
                paging: false,
                columns: [
                    {
                        data: 'merk',
                        orderable: false,
                    },
                    {
                        data: 'no_reg',
                        className: 'text-center',
                        orderable: false,
                    },
                    { data: 'jenis_ranmor', visible: false },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr><th colspan="2" height="25">' + group + '</th></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });
            $('#tgl').flatpickr({
                altInput: true,
                altFormat: 'F Y',
                defaultDate: '{{date("Y-m")}}',
                plugins: [
                    new monthSelectPlugin({
                        dateFormat: "Y-m",
                    })
                ]
            });
            $('#tgl').change(function() {
                reload_donat();
            });
            //document.querySelector("#tgl")._flatpickr.setDate('{{date('Y-m')}}');
            reload_donat();
        });

        function reload_chart() {
            var options = {
                series: [{
                    name: 'Dalam Pemeriksaan',
                    data: []
                }, {
                    name: 'Sudah diperiksa',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '13px',
                        colors: ["#304758"]
                    }
                },
                colors: ['#7367F0', '#d2b0ff'],
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['{!!implode("','", $katsk)!!}'],
                },
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

            $('.tahun').html($('#tahun_anggaran').val());
            $.ajax({
                url: "{{ url('taud/dashboard/data') }}?tahun=" + $('#tahun_anggaran').val(),
                success: function(res) {
                    if (!res.error) {
                        $('#Biasa').html(res.sm['Biasa'] ?? 0);
                        $('#Rahasia').html(res.sm['Rahasia'] ?? 0);
                        $('#Telegram').html(res.sm['Telegram'] ?? 0);
                        options.series[0].data = res.skb;
                        options.series[1].data = res.sks;
                        document.querySelector("#chart").innerHTML = '';
                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                        @foreach($jenis_bbm as $j)
                        barChart('#{{$j}}', res.bbm['{{$j}}']['Sisa'], res.bbm['{{$j}}']['Terpakai'], chartColors.bar['{{$j}}']);
                        @endforeach
                    }
                }
            });
        }

        function barChart(id, data1, data2, color) {
            var columnChartEl = document.querySelector(id),
            columnChartConfig = {
            chart: {
                height: 330,
                type: 'bar',
                stacked: true,
                parentHeightOffset: 0,
                toolbar: {
                show: false
                }
            },
            tooltip: {
                shared: true
            },
            plotOptions: {
                bar: {
                columnWidth: '30%',
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'start'
            },
            colors: [color, '#d2b0ff'],
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
            series: [
            {
                name: 'Sisa',
                data: data1
            },
            {
                name: 'Terpakai',
                data: data2
            }],
            xaxis: {
                categories: bulan.map(function(b) {return b.substr(0, 3);})
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                opposite: false
            }
            }
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                columnChartEl.innerHTML = '';
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }
        }

    </script>
@endsection
