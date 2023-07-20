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
            height: 1000,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI TAUD'
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
                ['KATAUD', 'KASITU'],
                ['KASITU', 'KAURMIN'],
                ['KASITU', 'KAURDAL'],
                ['KAURMIN', 'BATURREPRODUKSI'],
                ['KAURMIN', 'BATURAGENDA1'],
                ['KAURMIN', 'BATUROPRKOMP'],
                ['KAURMIN', 'TAKURIR1'],
                ['BATURAGENDA1', 'BATURAGENDA2'],
                ['TAKURIR1', 'TAKURIR2'],
                ['KAURDAL', 'BAURDAL'],
                ['KAURDAL', 'BAHARWAT'],
                ['KAURDAL', 'BATURJUYAR1'],
                ['KAURDAL', 'TAMUDI1'],
                ['KAURDAL', 'TABAN1'],
                ['BATURJUYAR1', 'BATURJUYAR2'],
                ['TAMUDI1', 'TAMUDI2'],
                ['TABAN1', 'TABAN2']
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
            }, {
                level: 4,
                color: '#2045B8'
            }, {
                level: 5,
                color: '#2045B8'
            }, {
                level: 6,
                color: '#2045B8'
            }],
            nodes: [{
                id: 'KATAUD',
                title: 'KATAUD',
                name: '-'
            }, {
                id: 'KASITU',
                title: 'KASI TU',
                name: 'Mayor Sulistiyono',
                column: 1,
                image: `{{ asset('personil/' . $kasitu) }}`
            }, {
                id: 'KAURMIN',
                title: 'KAURMIN',
                name: '-',
                column: 2
            },{
                id: 'KAURDAL',
                title: 'KAURDAL',
                name: '-',
                column: 2
            }, {
                id: 'BATURREPRODUKSI',
                title: 'BA/TUR REPRODUKSI',
                name: '-',
                column: 3
            }, {
                id: 'BATURAGENDA1',
                title: 'BA/TUR AGENDA 1',
                name: '-',
                column: 3
            }, {
                id: 'BATUROPRKOMP',
                title: 'BA/TUR OPR KOMP',
                name: 'Dewi Rahmawati Ningsih, S.A.P',
                column: 3,
                image: `{{ asset('personil/' . $oprkomp) }}`
            }, {
                id: 'TAKURIR1',
                title: 'TAKURIR 1',
                name: '-',
                column: 3
            }, {
                id: 'BATURAGENDA2',
                title: 'BA/TUR AGENDA 2',
                name: '-',
                column: 4
            }, {
                id: 'TAKURIR2',
                title: 'TAKURIR 2',
                name: 'Koptu Bambang Prihanto',
                column: 4,
                image: `{{ asset('personil/' . $takurir) }}`
            }, {
                id: 'BAURDAL',
                title: 'BAURDAL',
                name: '-',
                column: 5
            }, {
                id: 'BAHARWAT',
                title: 'BA HARWAT',
                name: 'Serma I Wayan KarianA',
                column: 6,
                image: `{{ asset('personil/' . $baharwat) }}`
            }, {
                id: 'BATURJUYAR1',
                title: 'BA/TUR JUYAR 1',
                name: '-',
                column: 5
            }, {
                id: 'TAMUDI1',
                title: 'TAMUDI 1',
                name: 'Kopka Sunaryo',
                column: 5,
                image: `{{ asset('personil/' . $tamudi1) }}`
            }, {
                id: 'TABAN1',
                title: 'TABAN 1',
                name: '-',
                column: 5
            }, {
                id: 'BATURJUYAR2',
                title: 'BA/TUR JUYAR 2',
                name: '-',
                column: 6
            }, {
                id: 'TAMUDI2',
                title: 'TAMUDI 2',
                name: 'Riau Mendung Agustian',
                column: 6,
                image: `{{ asset('personil/' . $tamudi2) }}`
            }, {
                id: 'TABAN2',
                title: 'TABAN 2',
                name: '-',
                column: 6
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