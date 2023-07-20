@extends('partials.template')
@section('page_style')
    <style>
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
            <div class="content-header-left col-md-12 col-1">
                <h2 class="content-header-title float-left">Grafik Alkes</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-body pb-0 mt-2">
                            <div id="alkes">Loading...</div>
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
    FusionCharts.ready(function() {
        var chartObj = new FusionCharts({
            type: 'scrollcolumn2d',
            renderAt: 'alkes',
            width: '100%',
            height: '400',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "numVisiblePlot": "8",
                    "plottooltext": "<b>$seriesName</b><hr>$label: <b>$dataValue</b>",
                    "xaxisname": "Nama Alat",
                    "showValues": "1",
                    "formatNumberScale": "0",
                    "thousandSeparator": ".",
                    "drawCrossLine": "1",
                    "yaxisname": "Jumlah"
                },
                "categories": [{
                    "category": {!! json_encode($category) !!}
                }],
                "dataset": [{
                    "data": {!! json_encode($data) !!}
                    }
                ]
            }
        });
        chartObj.render();
    });
</script>
@endsection