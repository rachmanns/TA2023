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
            height: 600,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI DOBEKKES'
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
                ['KADOBEKKES', 'PAURMIN'],
                ['KADOBEKKES', 'KABAGTRANDISI'],
                ['KADOBEKKES', 'KASIBATKATKES'],
                ['KADOBEKKES', 'KASIALKESDANMATUM'],
                ['KABAGTRANDISI', 'KAURTRANDISI'],
                ['KASIBATKATKES', 'KAURBATKATKES'],
                ['KASIALKESDANMATUM', 'KAURALKES'],
                ['KASIALKESDANMATUM', 'KAURMATUM']
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
            }],
            nodes: [{
                id: 'KADOBEKKES',
                title: 'KADOBEKKES',
                name: 'Kolonel M.Washiluddin AR, SKM.,MKKK',
                image: `{{ asset('personil/' . $kadobek) }}`
            }, {
                id: 'PAURMIN',
                title: 'PAURMIN',
                name: 'Lettu Ckm Risidah Rahmawati',
                column: 1,
                image: `{{ asset('personil/' . $paurmin) }}`
            }, {
                id: 'KABAGTRANDISI',
                title: 'KABAG TRANDISI',
                name: 'Letkkol Laut (k) Muzammil Basuni, SKM',
                column: 2,
                image: `{{ asset('personil/' . $kabag) }}`
            },{
                id: 'KASIBATKATKES',
                title: 'KASIBATKATKES',
                name: 'Mayor Barnabas Purba',
                column: 2,
                image: `{{ asset('personil/' . $kasibat) }}`
            }, {
                id: 'KASIALKESDANMATUM',
                title: 'KASIALKES DAN MATUM',
                name: 'Suratinah, SE',
                column: 2,
                image: `{{ asset('personil/' . $kasialkes) }}`
            }, {
                id: 'KAURTRANDISI',
                title: 'KAUR TRANSDISI',
                name: 'Budi Santoso, S.PD',
                column: 3,
                image: `{{ asset('personil/' . $kaurtran) }}`
            }, {
                id: 'KAURBATKATKES',
                title: 'KAUR BATKATKES',
                name: 'Dwi Astuty, SE',
                column: 3,
                image: `{{ asset('personil/' . $kaurbat) }}`
            }, {
                id: 'KAURALKES',
                title: 'KAUR ALKES',
                name: '-',
                column: 3
            }, {
                id: 'KAURMATUM',
                title: 'KAURMATUM',
                name: 'Yacub Soleh, SE',
                column: 3,
                image: `{{ asset('personil/' . $kaurmatum) }}`
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