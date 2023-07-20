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
            height: 700,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI YANKESIN'
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
                ['KABIDYANKESIN', 'KASUBBIDKESKUREHAB'],
                ['KABIDYANKESIN', 'KASUBBIDKESPREV'],
                ['KABIDYANKESIN', 'KASIKESNUBIKA'],
                ['KASUBBIDKESKUREHAB', 'KAURKESKUREHAB'],
                ['KASUBBIDKESPREV', 'KAURPROMKES'],
                ['KABIDYANKESIN', 'BATURKOMP2'],
                ['KABIDYANKESIN', 'BATURKOMP1'],
                ['KABIDYANKESIN', 'TAMUDI']
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
                id: 'KABIDYANKESIN',
                title: 'KABIDYANKESIN',
                name: 'dr. R.M Tjahja Nurrobi, M.Kes.,Sp.OT (K) Hand',
                image: `{{ asset('personil/' . $kabidyankesin) }}`
            }, {
                id: 'KASUBBIDKESKUREHAB',
                title: 'KASUBBIDKESKUREHAB',
                name: 'Ayu Chandra, SKM., M.Si (Han)',
                column: 1,
                image: `{{ asset('personil/' . $kasubbidkeskurehab) }}`
            }, {
                id: 'KASUBBIDKESPREV',
                title: 'KASUBBIDKESPREV',
                name: 'Letkol Hariyanto, AmK.,S.Psi',
                column: 1,
                image: `{{ asset('personil/' . $kasubbidkesprev) }}`
            }, {
                id: 'KASIKESNUBIKA',
                title: 'KASIKESNUBIKA',
                name: 'Yatuni',
                column: 2,
                image: `{{ asset('personil/' . $kasikesnubika) }}`
            }, {
                id: 'KAURKESKUREHAB',
                title: 'KAURKESKUREHAB',
                name: 'Misanami, M.M.',
                column: 3,
                image: `{{ asset('personil/' . $kaurkeskurehab) }}`
            }, {
                id: 'KAURPROMKES',
                title: 'KAURPROMKES',
                name: '-',
                column: 3,
                image: ''
            }, {
                id: 'BATURKOMP2',
                title: 'BA/TUR KOMP 2',
                name: '-',
                column: 4,
                image: ''
            }, {
                id: 'BATURKOMP1',
                title: 'BA/TUR KOMP 1',
                name: 'M. Toha Mansur S.Kep',
                column: 4,
                image: `{{ asset('personil/' . $baturkomp1) }}`
            }, {
                id: 'TAMUDI',
                title: 'TAMUDI',
                name: 'Riau Mendung Agustian',
                column: 4,
                image: `{{ asset('personil/' . $tamudi) }}`
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