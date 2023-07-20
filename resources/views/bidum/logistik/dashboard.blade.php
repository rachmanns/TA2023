@extends('partials.template') 
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="toast toast-basic hide position-fixed" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="top: 1rem; right: 1rem">
            <div class="toast-header pt-75" style="background-color: #f5bcb8!important">
                <button type="button" class="close" data-dismiss="toast" aria-label="Close" style="margin-left:18rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body font-weight-bolder font-medium-3 text-white rounded-bottom pt-0" style="background-color: #f5bcb8!important">Dokumen Tidak Ditemukan</div>
        </div>

        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Dashboard Bidang Logistik <span id="periode-text"></span></h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group bg-white">
                        {{-- <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="Filter Tanggal" /> --}}
                        {{-- <input type="month" id="month" class="form-control" placeholder="Filter Tanggal" value="{{ $month_now }}" /> --}}
                        <input type="text" id="fp-range" class="form-control bg-white" placeholder="Periode" />
                        <input type="hidden" id="from_date">
                        <input type="hidden" id="to_date">
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <h2 class="content-header-title float-left mb-0">Transaksi Masuk</h2>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <h3 class="font-weight-bolder mb-2">Aset Masuk</h3>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12 my-auto" id="aset-masuk-nominal"></div>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <div id="aset-masuk"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <h3 class="font-weight-bolder mb-2">Persediaan Masuk</h3>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12 my-auto" id="persediaan-masuk-nominal"></div>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <div id="persediaan-masuk"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <h2 class="content-header-title float-left mb-0">Transaksi Keluar</h2>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <h3 class="font-weight-bolder">Aset Keluar</h3>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12 my-auto" id="aset-keluar-nominal"></div>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <div id="aset-keluar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <h3 class="font-weight-bolder">Persediaan Keluar</h3>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12 my-auto" id="persediaan-keluar-nominal"></div>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <div id="persediaan-keluar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <h2 class="content-header-title float-left mb-0">Pelaporan</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-1">Neraca BMN</h5>
                                {{-- <button class="btn btn-primary btn-sm" onclick="export_laporan(1,'Neraca BMN')">Lihat Neraca BNM</button> --}}
                                <a href="{{ url('bidum/logistik/export-laporan/1') }}" class="btn btn-primary btn-sm" target="_blank" >Lihat Neraca BNM</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-1">Laporan BMN</h5>
                                {{-- <button class="btn btn-primary btn-sm" onclick="export_laporan(3,'Laporan BMN')">Lihat Laporan BMN</button> --}}
                                <a href="{{ url('bidum/logistik/export-laporan/3') }}" target="_blank" class="btn btn-primary btn-sm">Lihat Laporan BMN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-1">Penghapusan Khusus</h5>
                                {{-- <button class="btn btn-primary btn-sm" onclick="export_laporan(4,'Penghapusan Khusus')">Lihat Penghapusan</button> --}}
                                <a href="{{ url('bidum/logistik/export-laporan/4') }}" target="_blank" class="btn btn-primary btn-sm">Lihat Penghapusan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-1">Master Aset</h5>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#master">Lihat Master Aset</button>
                            </div>
                        </div>
                        {{-- Modal Master--}}
                        <div class="modal fade text-left" id="master" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Master Aset</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form-master-aset">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkall" name="all"  {{ ($empty_master_aset == 1)?'disabled':'' }}/>
                                                        <label class="custom-control-label" for="checkall">All</label>
                                                    </div>
                                                </div>
                                                @foreach ($master_aset as $item)
                                                <div class="col-6 mb-1">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="cb-element custom-control-input" id="{{ $item->id_kat_lap }}" name="master_aset[]" value="{{ $item->id_kat_lap }}" {{ (blank($item->file))?'disabled':'' }} />
                                                        <label class="custom-control-label" for="{{ $item->id_kat_lap }}">{{ $item->nama_kat_lap }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <div class="text-right">
                                            <button class="btn btn-primary" id="submit-master-aset">Export Master Aset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-1">Laporan Rincian Persediaan</h5>
                                {{-- <button class="btn btn-primary btn-sm" onclick="export_laporan(2,'Rincian Persediaan')">Lihat Rincian Persediaan</button> --}}
                                <a href="{{ url('bidum/logistik/export-laporan/2') }}" target="_blank" class="btn btn-primary btn-sm">Lihat Rincian Persediaan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection    

@section("page_style")
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
@endsection

@section("page_script")
<script src="{{ url('assets/js/monthpicker.js')}}"></script>
<script>
    $('#checkall').change(function () {
        $('.cb-element:not([disabled])').prop('checked',this.checked);
    });

    $('.cb-element').change(function () {
        if ($('.cb-element:checked').length == $('.cb-element').length){
            $('#checkall').prop('checked',true);
        }else {
            $('#checkall').prop('checked',false);
        }
    });
</script>

<script>
$( document ).ready(function() {
    $('#periode-text').html("- " + "{{ date("F Y") }}");
    $('#wilayah').select2({
    ajax: {
        url: '{{url("referensi/wilayah")}}',
        dataType: 'json',
        type: "GET",
        data:function(result){
        }
    }
    });

    let radialChart = null;

    chart_aset_masuk("{{ $from }}","{{ $to }}");
    chart_persediaan_masuk("{{ $from }}","{{ $to }}");
    chart_aset_keluar("{{ $from }}","{{ $to }}");
    chart_persediaan_keluar("{{ $from }}","{{ $to }}");


    // $('#month').change(function (){
    //     let date_val = $(this).val();
    //     chart_aset_masuk($(this).val());
    //     chart_persediaan_masuk($(this).val());
    //     chart_aset_keluar($(this).val());
    //     chart_persediaan_keluar($(this).val());
    //     $('#periode-text').text(moment($(this).val()).format('MMMM YYYY'));
    // });

    $("#fp-range").flatpickr({
        mode: 'range',
        onChange: function(selectedDate) {
            let _this = this;
            let dateArr = selectedDate.map(function(date) {
                return _this.formatDate(date, 'Y-m-d');
            });

            let start = dateArr[0];
            let end = dateArr[1];

            const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                  'July', 'August', 'September', 'October', 'November', 'December'];

            if (start != null && end != null) {
                if (start.split('-')[0] == end.split('-')[0]) {
                    if (start.split('-')[1] == end.split('-')[1]) {
                        $('#periode-text').html("- " + months[parseInt(start.split('-')[1],10)-1] + " " + start.split('-')[0]);
                    } else {
                        $('#periode-text').html("(" + months[parseInt(start.split('-')[1],10)-1] + ' - ' + months[parseInt(end.split('-')[1],10)-1] + " " + end.split('-')[0] + ")");
                    }
                } else {
                    $('#periode-text').html("(" + months[parseInt(start.split('-')[1],10)-1] + " " + start.split('-')[0] + ' - ' + months[parseInt(end.split('-')[1],10)-1] + " " + end.split('-')[0] + ")");
                }
            }
            

            chart_aset_masuk(start,end);
            chart_persediaan_masuk(start,end);
            chart_aset_keluar(start,end);
            chart_persediaan_keluar(start,end);
        }
    })

function chart_aset_masuk(from,to) {
    let url = `{{ url('bidum/logistik/chart-aset-masuk/${from}/${to}') }}`;

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            donat_chart("#aset-masuk",Object.values(response.chart),Object.keys(response.chart))
            nominal_map("#aset-masuk",response.nominal)
        }
    });
}

function chart_persediaan_masuk(from,to) {
    let url = `{{ url('bidum/logistik/chart-persediaan-masuk/${from}/${to}') }}`;

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            donat_chart("#persediaan-masuk",Object.values(response.chart),Object.keys(response.chart))
            nominal_map("#persediaan-masuk",response.nominal)
        }
    });
}

function chart_aset_keluar(from,to) {
    let url = `{{ url('bidum/logistik/chart-aset-keluar/${from}/${to}') }}`;

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            donat_chart("#aset-keluar",Object.values(response.chart),Object.keys(response.chart))
            nominal_map("#aset-keluar",response.nominal)
        }
    });
}


function chart_persediaan_keluar(from,to) {
    let url = `{{ url('bidum/logistik/chart-persediaan-keluar/${from}/${to}') }}`;

    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            donat_chart("#persediaan-keluar",Object.values(response.chart),Object.keys(response.chart))
            nominal_map("#persediaan-keluar",response.nominal)
        }
    });
}

function nominal_map(selector,response) {
    var color = [
        '#7367F0',
        '#28C76F',
        '#FF9F42',
        '#EA5455'
    ];
    $(`${selector}-nominal`).empty(); 
    let index = 0;
    $.each( response, function( key, value ) {
        $(`${selector}-nominal`).append(`
            <div class="font-small-4">${key}</div>
            <h4 style="color:${(index == (Object.keys(response).length - 1))?'black':color[index]}" class="mb-1">Rp${formatRupiah(value)}</h4>`)
        index++;
    });
}


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
        pusat: '#7367F0',
        daerah:'#28C76F',
        transfer:'#FF9F42',
        hibah: '#EA5455'
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

var chart_init = {}
    function donat_chart(selector,series,labels){
        var bor_covid_element = document.querySelector(selector),
        bor_covid_config = {
        chart: {
            height: 320,
            type: 'pie'
        },
        colors: [chartColors.pie.pusat, chartColors.pie.daerah, chartColors.pie.transfer, chartColors.pie.hibah],
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
            position: 'bottom'
        },
        stroke: {
            lineCap: 'round'
        },
        series: series,
        labels: labels
        };
    if (typeof bor_covid_element !== undefined && bor_covid_element !== null) {
        radialChart = new ApexCharts(bor_covid_element, bor_covid_config);
        if($(`${selector} svg`).length){

            chart_init[selector].destroy();
        }
            chart_init[selector]= radialChart
            chart_init[selector].render();
        
    }
}


    $('#submit-master-aset').click(function(){
        let form_data = new FormData($('#form-master-aset')[0]);
        $.ajax({
            url : "{{ route('bidum.logistik.export_master_aset') }}",
            type : 'POST',
            data : form_data,
            xhrFields: {
                responseType: 'blob'
            },
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            cache: false,
            success : function(response) {
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Master Aset.zip";
                link.click();
            },
            error: function(response){
                Swal.fire(
                    'Failed!',
                    `Dokumen aset belum ditambahkan`,
                    'error'
                )
            }
        });
    });
});

function export_laporan(id,nama_file) {

    let url = "{{ url('bidum/logistik/export-laporan') }}"

    $.ajax({
            url : url,
            type : 'POST',
            data : {id_kategori:id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'
            },
            cache: false,
            success : function(response) {
                let type = response.type
                var blob = new Blob([response],{'type' :type});
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = nama_file;
                link.click();
            },
            error: function(blob){
                $('.toast-basic').toast('show');
            }
        });
    
}

        // $('#month').flatpickr({
        //     altInput: true,
        //     altFormat: 'F Y',
        //     plugins: [
        //         new monthSelectPlugin({
        //             dateFormat: "Y-m",
        //         })
        //     ]
        // });

        

</script>
@endsection