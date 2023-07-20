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
            text: 'STRUKTUR ORGANISASI LAVIBIOVAK'
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
                ['KALAFIBIOVAK', 'SPRI'],
                ['KALAFIBIOVAK', 'TAMUDI'],
                ['KALAFIBIOVAK', 'KAURMIN'],
                ['KAURMIN', 'BATUROPRKOMP1'],
                ['KALAFIBIOVAK', 'KABIDRENDALPROD'],
                ['KABIDRENDALPROD', 'KASUBBIDALPROD'],
                ['KASUBBIDRENPROD', 'KAURMINPROD'],
                ['KAURMINPROD', 'BATUROPRKOMP2'],
                ['KALAFIBIOVAK', 'KABIDRENDALDIA'],
                ['KABIDRENDALDIA', 'KASUBBIDDALDIA'],
                ['KASUBBIDDALADA', 'KAURMINADALDIA'],
                ['KAURMINADALDIA', 'BATUROPRKOMP3'],
                ['KALAFIBIOVAK', 'KABIDRENDALDISI'],
                ['KABIDRENDALDISI', 'KASUBDISANEVDIS'],
                ['KASUBBIDDISPROD', 'KAURMINDIS'],
                ['KAURMINDIS', 'BATUROPRKOMP4'],
                ['KALAFIBIOVAK', 'KALITBANG'],
                ['KALITBANG', 'KABAGLITBANGSDMDANALPROD'],
                ['KABAGLITBANGFAR', 'BATUROPRKOMP5'],
                ['KALAFIBIOVAK', 'KAJANGUM'],
                ['KAJANGUM', 'KASUBBAGMINLOG'],
                ['KABAGRENGAR', 'BATUROPRKOMP6'],
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
                id: 'KALAFIBIOVAK',
                title: 'KALAVIBIOVAK',
                name: 'Kolonel Drs. Nur Abdul Goni, M.Si',
                image: `{{ asset('personil/' . $kalavi) }}`
            }, {
                id: 'SPRI',
                title: 'SPRI',
                name: '-',
                column: 1
            }, {
                id: 'TAMUDI',
                title: 'TAMUDI',
                name: '-',
                column: 1
            },{
                id: 'KAURMIN',
                title: 'KAURMIN',
                name: '-',
                column: 1
            }, {
                id: 'BATUROPRKOMP1',
                title: 'BA/TUR OPR KOMP',
                name: 'Serma Sigit Daryono',
                column: 2,
                image: `{{ asset('personil/' . $oprkomp) }}`
            }, {
                id: 'KABIDRENDALPROD',
                title: 'KABIDRENDALPROD',
                name: '-',
                column: 3
            }, {
                id: 'KASUBBIDRENPROD',
                title: 'KASUBBIDRENPROD',
                name: '-',
                column: 3
            }, {
                id: 'KASUBBIDALPROD',
                title: 'KASUBBIDDALPROD',
                name: 'Wahyu Kristianto, S.Kep',
                column: 3,
                image: `{{ asset('personil/' . $kasubbiddalprod) }}`
            }, {
                id: 'KAURMINPROD',
                title: 'KAURMIN PROD',
                name: '-',
                column: 3
            }, {
                id: 'BATUROPRKOMP2',
                title: 'BA/TUR OPR KOMP',
                name: '-',
                column: 3
            }, {
                id: 'KABIDRENDALDIA',
                title: 'KABID RENDALDIA',
                name: 'Letkol Nuramso Sucipto, S.Si., Apt',
                column: 4,
                image: `{{ asset('personil/' . $kabidrendal) }}`
            }, {
                id: 'KASUBBIDDALADA',
                title: 'KASUBBIDDALADA',
                name: '-',
                column: 4
            }, {
                id: 'KASUBBIDDALDIA',
                title: 'KASUBBIDDALDIA',
                name: 'Letkol Totok Mukti Chahyanto',
                column: 4,
                image: `{{ asset('personil/' . $kasubbiddaldia) }}`
            }, {
                id: 'KAURMINADALDIA',
                title: 'KAURMINADALDIA',
                name: '-',
                column: 4
            }, {
                id: 'BATUROPRKOMP3',
                title: 'BA/TUR OPR KOMP',
                name: '-',
                column: 4
            }, {
                id: 'KABIDRENDALDISI',
                title: 'KABIDRENDALDISI',
                name: '-',
                column: 5
            }, {
                id: 'KASUBBIDDISPROD',
                title: 'KASUBBIDDISPROD',
                name: '-',
                column: 5
            }, {
                id: 'KASUBDISANEVDIS',
                title: 'KASUBDISANEVDIS',
                name: '-',
                column: 5
            }, {
                id: 'KAURMINDIS',
                title: 'KAURMINDIS',
                name: '-',
                column: 5
            }, {
                id: 'BATUROPRKOMP4',
                title: 'BA/TUR OPR KOMP',
                name: '-',
                column: 5
            }, {
                id: 'KALITBANG',
                title: 'KALITBANG',
                name: '-',
                column: 6
            }, {
                id: 'KABAGLITBANGFAR',
                title: 'KABAGLITBANGFAR',
                name: '-',
                column: 6
            }, {
                id: 'KABAGLITBANGSDMDANALPROD',
                title: 'KABAGLITBANG SDM DAN ALPROD',
                name: '-',
                column: 6
            }, {
                id: 'BATUROPRKOMP5',
                title: 'BA/TUR OPR KOMP',
                name: '-',
                column: 6
            }, {
                id: 'KAJANGUM',
                title: 'KAJANGUM',
                name: '-',
                column: 7
            }, {
                id: 'KABAGRENGAR',
                title: 'KABAGRENGAR',
                name: 'Letkol Elizabeth I.R, S.Kep',
                column: 7,
                image: `{{ asset('personil/' . $kabagrengar) }}`
            }, {
                id: 'KASUBBAGMINLOG',
                title: 'KASUBBAGMINLOG',
                name: '-',
                column: 7
            }, {
                id: 'BATUROPRKOMP6',
                title: 'BA/TUR OPR KOMP',
                name: '-',
                column: 7
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