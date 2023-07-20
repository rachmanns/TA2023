@extends('partials.template')

@section('page_style')
<style>    
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 700px;
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
            text: 'STRUKTUR ORGANISASI SUBBIDMINPERS'
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
                ['KASUBBIDMINPERS', 'KASIJABFUNGKES'],
                ['KASUBBIDMINPERS', 'KASIMIN'],
                ['KASUBBIDMINPERS', 'KAURDATA'],
                ['KASIMIN', 'KAURDATA'],
                ['KASUBBIDMINPERS', 'BATUROPRKOMP1'],
                ['KASUBBIDMINPERS', 'BATUROPRKOMP2'],
                ['KAURDATA', 'BATUROPRKOMP1'],
                ['KAURDATA', 'BATUROPRKOMP2']
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
                id: 'KASUBBIDMINPERS',
                title: 'KASUBBIDMINPERS',
                name: '-'
            }, {
                id: 'KASIJABFUNGKES',
                title: 'KA SIJABFUNGKES',
                name: '-'
            }, {
                id: 'KASIMIN',
                title: 'KASIMIN',
                name: 'Mayor Liring Indrijani, S.I.Kom.,M.Si',
                column: 1,
                image: `{{ asset('personil/' . $kasimin) }}`
            }, {
                id: 'KAURDATA',
                title: 'KAUR DATA',
                name: 'Yulianti, S.A.P',
                image: `{{ asset('personil/' . $kaurdata) }}`
            }, {
                id: 'BATUROPRKOMP1',
                title: 'BA/TUR OPR KOMP 1',
                name: 'Purwanti, A.Md., Kep	',
                column: 3,
                image: `{{ asset('personil/' . $komp1) }}`
            }, {
                id: 'BATUROPRKOMP2',
                title: 'BA/TUR OPR KOMP 2',
                name: 'Totok Argianto',
                column: 3,
                image: `{{ asset('personil/' . $komp2) }}`
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