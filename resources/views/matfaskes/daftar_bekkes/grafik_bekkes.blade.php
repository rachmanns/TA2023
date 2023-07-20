@extends('partials.template')

@section('page_style')
<style>
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

    [pointer-events="bounding-box"] {
            display: none
        }
</style>
@endsection
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-1">
                <h2 class="content-header-title float-left">Grafik Bekkes</h2>
            </div>
            <div class="col-md-3 col-12 mb-1">
                <div class="input-group input-group-merge form-input">
                    <input type="text" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Berjalan" readonly />
                    <div class="input-group-append">
                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div id="berjalan">Grafik will load here!</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div id="lampau">Grafik will load here!</div>
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
<script src="{{ url('assets/js/fusioncharts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.charts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.theme.fusion.js') }}"></script>
<script type="text/javascript">

$( document ).ready(function(){
    berjalan({{ $tahun }});
    lampau({{ $tahun }});
}) 

$('.yearpicker').change(function () {
    let tahun = $(this).val();
    berjalan(tahun);
    lampau(tahun);
})

function berjalan(tahun) {
    $.ajax({
        type: 'POST',
        data:{_token:"{{ csrf_token() }}",tahun:tahun},
        url: "{{ url('matfaskes/dashboard-barang/berjalan') }}",
        success: function(response) {
            chart_berjalan(response.categories, response.dataset1, response.dataset2, tahun);
        }
    });
}

function lampau(tahun) {
    $.ajax({
        type: 'POST',
        data:{_token:"{{ csrf_token() }}",tahun:tahun},
        url: "{{ url('matfaskes/dashboard-barang/lampau') }}",
        success: function(response) {
            chart_lampau(response.categories, response.dataset1, response.dataset2, tahun);
        }
    });
}

function chart_berjalan(categories, dataset1, dataset2, tahun) {
    FusionCharts.ready(function() {
        var chartObj = new FusionCharts({
            type: 'scrollmsstackedcolumn2d',
            renderAt: 'berjalan',
            width: '100%',
            height: '450',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "numVisiblePlot": "24",
                    "caption": `Bekkes ${tahun} ( Berjalan )`,
                    "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>",
                    "showSum": "1"
                },
                "categories": categories,
                "dataset": [{
                        "dataset": dataset1
                    },
                    {
                        "dataset": dataset2
                    }
                ]
            }
        });
        chartObj.render();
    });
}

function chart_lampau(categories, dataset1, dataset2, tahun) {
    FusionCharts.ready(function() {
        var chartObj = new FusionCharts({
            type: 'scrollmsstackedcolumn2d',
            renderAt: 'lampau',
            width: '100%',
            height: '450',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "numVisiblePlot": "24",
                    "caption": `Bekkes ${tahun-1} ( Lampau )`,
                    "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>",
                    "showSum": "1"
                },
                "categories": categories,
                "dataset": [{
                        "dataset": dataset1
                    },
                    {
                        "dataset": dataset2
                    }
                ]
            }
        });
        chartObj.render();
    });
}
</script>
@endsection