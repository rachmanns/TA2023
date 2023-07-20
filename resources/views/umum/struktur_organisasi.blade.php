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
            height: 800,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI'
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
                ['Kapuskes', 'Wakapuskes'],
                ['Wakapuskes', 'BIDUM'],
                ['Wakapuskes', 'DUKKESOPS'],
                ['Wakapuskes', 'YANKESIN'],
                ['Wakapuskes', 'BANGKES'],
                ['Wakapuskes', 'MATFASKES'],
                ['Wakapuskes', 'LAVIBIOVAK'],
                ['Wakapuskes', 'KERMABAKTIKES'],
                ['Wakapuskes', 'DOBEKKES'],
                ['Wakapuskes', 'TAUD'],
                ['Wakapuskes', 'PAKU'],
                ['Wakapuskes', 'SATLAKKES'],
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
            }],
            nodes: [{
                id: 'Kapuskes',
                title: 'KAPUSKES',
                name: 'dr. Budiman, Sp.BE, RE(K).,MARS',
                image: `{{ asset('personil/' . $kapuskes) }}`
            }, {
                id: 'Wakapuskes',
                title: 'WAKAPUSKES',
                name: 'dr. Guntoro, Sp.BP-RE(K)',
                image: `{{ asset('personil/' . $wakapuskes) }}`
            }, {
                id: 'BIDUM',
                title: 'KABID UM',
                name: 'dr. Asnominanda, Sp.THT.KL',
                column: 2,
                image: `{{ asset('personil/' . $bidum) }}`
            }, {
                id: 'DUKKESOPS',
                title: 'KABID DUKKESOPS',
                name: 'dr. Moh. Birza Rizaldi, Sp.OG., M.A.R.S.',
                column: 2,
                image: `{{ asset('personil/' . $dukkesops) }}`
            }, {
                id: 'YANKESIN',
                title: 'KABID YANKESIN',
                name: 'dr. R.M Tjahja Nurrobi, M.Kes.,Sp.OT (K) Hand',
                column: 2,
                image: `{{ asset('personil/' . $yankesin) }}`
            }, {
                id: 'BANGKES',
                title: 'KABID BANGKES',
                name: 'dr. Nunung Joko Nugroho',
                column: 3,
                image: `{{ asset('personil/' . $bangkes) }}`
            }, {
                id: 'MATFASKES',
                title: 'KABID MATFASKES',
                name: 'Asngari, S.Si.,Apti',
                column: 3,
                image: `{{ asset('personil/' . $matfaskes) }}`
            }, {
                id: 'LAVIBIOVAK',
                title: 'KA LAVIBIOVAK',
                name: 'Drs. Nur Abdul Goni, M.Si',
                column: 3,
                image: `{{ asset('personil/' . $lavibiovak) }}`
            }, {
                id: 'KERMABAKTIKES',
                title: 'KA UNIT KERMABAKTIKES',
                name: 'drg. Zelvya Purnama Rika, Sp.Kga., F.I.C.D., CIQnR',
                column: 4,
                image: `{{ asset('personil/' . $kerma) }}`
            }, {
                id: 'DOBEKKES',
                title: 'KA DOBEKKES',
                name: 'M.Washiluddin AR, SKM.,MKKK',
                column: 4,
                image: `{{ asset('personil/' . $dobekkes) }}`
            }, {
                id: 'TAUD',
                title: 'KA TAUD',
                name: '-',
                column: 4
            }, {
                id: 'PAKU',
                title: 'PAKU',
                name: '-',
                column: 5
            }, {
                id: 'SATLAKKES',
                title: 'KA SATLAKKES',
                name: '-',
                column: 5
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