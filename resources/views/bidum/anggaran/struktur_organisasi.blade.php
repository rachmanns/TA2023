@extends('partials.template')

@section('page_style')
<style>    
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 1000px;
        margin: 1em auto;
    }

    .highcharts-background {
        fill: transparent;
    }

    .highcharts-credits {
        display: none;
    }

    .highcharts-title {
        font-size: 22px !important;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    #container h4 {
        text-transform: none;
        font-size: 14px;
        font-weight: normal;
        color: white;
    }

    #container p {
        font-size: 13px;
        line-height: 16px;
    }

    @media screen and (max-width: 600px) {
        #container h4 {
            font-size: 2.3vw;
            line-height: 3vw;
        }

        #container p {
            font-size: 2.3vw;
            line-height: 3vw;
        }
    }
</style>
<script src="{{ url('assets/js/highcharts.js') }}"></script>
<script src="{{ url('assets/js/sankey.js') }}"></script>
<script src="{{ url('assets/js/organization.js') }}"></script>
<script src="{{ url('assets/js/exporting.js') }}"></script>
<script src="{{ url('assets/js/accessibility.js') }}"></script>
@endsection

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body" style="margin-top: -15px;">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('page_js')
<script>
    Highcharts.chart('container', {
        chart: {
            height: 500,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI SUBBIDRENPROGAR BIDUM'
        },

        accessibility: {
            point: {
                descriptionFormatter: function(point) {
                    var nodeName = point.toNode.name,
                        nodeId = point.toNode.id,
                        nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                        parentDesc = point.fromNode.id;
                    return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
                }
            }
        },

        series: [{
            type: 'organization',
            name: 'Puskes TNI',
            keys: ['from', 'to'],
            data: [
                ['KASUBBIDRENPROGAR', 'KASIRENPROGRAR'],
                ['KASUBBIDRENPROGAR', 'KASIEVDOKPROGRAR'],
                ['KASIRENPROGRAR', 'KAURRENPROGRAR'],
                ['KASIEVDOKPROGRAR', 'KAUREVDOK'],
                ['KASUBBIDRENPROGAR', 'BATUROPSKOMP1'],
                ['KASUBBIDRENPROGAR', 'BATUROPSKOMP2'],
                ['KASUBBIDRENPROGAR', 'BATUROPSKOMP3']
            ],
            levels: [{
                level: 0,
                color: '#2045B8'
            }, {
                level: 1,
                color: '#2045B8'
            }, {
                level: 2,
                color: '#2045B8'
            }, {
                level: 3,
                color: '#2045B8'
            }],
            nodes: [{
                id: 'KASUBBIDRENPROGAR',
                title: 'KASUBBID RENPROGAR',
                name: 'Letkol Riyadi Novianto, AKS',
                image: `{{ asset('personil/' . $kasubbid) }}`
            }, {
                id: 'KASIRENPROGRAR',
                title: 'KASI RENPROGRAR',
                name: 'Kapten Arifin',
                image: `{{ asset('personil/' . $kasiren) }}`
            }, {
                id: 'KASIEVDOKPROGRAR',
                title: 'KASI EVDOK PROGRAR',
                name: 'Tujiyo, SE',
                image: `{{ asset('personil/' . $kasiedvok) }}`
            }, {
                id: 'KAURRENPROGRAR',
                title: 'KAUR RENPROGRAR',
                name: '-',
                column: 2
            }, {
                id: 'KAUREVDOK',
                title: 'KAUR EVDOK',
                name: 'Nur Puji Harsi, SE',
                column: 2,
                image: `{{ asset('personil/' . $kauredvok) }}`
            }, {
                id: 'BATUROPSKOMP1',
                title: 'BATUR OPS KOMP 1',
                name: 'Pelda Tri Iswandari',
                column: 3,
                image: `{{ asset('personil/' . $opskomp1) }}`
            }, {
                id: 'BATUROPSKOMP2',
                title: 'BATUR OPS KOMP 2',
                name: '-',
                column: 3
            }, {
                id: 'BATUROPSKOMP3',
                title: 'BATUR OPS KOMP 3',
                name: '-',
                column: 3
            }],
            colorByPoint: false,
            color: '#007ad0',
            dataLabels: {
                color: 'white'
            },
            borderColor: 'white',
            nodeWidth: 80
        }],
        tooltip: {
            outside: true
        },
        exporting: {
            allowHTML: true,
            sourceWidth: 800,
            sourceHeight: 600
        }

    });
</script>
@endsection