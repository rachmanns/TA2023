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
            <div style="display: none" id="empty" class="align-items-center justify-content-center ">
                <div class="align-middle">
                    {{-- <a href="javascript:void(0);" class="brand-logo"> --}}
                        <img src="{{ url('img/org-structure.png')}}" class="mx-auto mb-2 d-block" height="102" />
                    {{-- </a> --}}
                    <h4 class="card-title mb-1 d-flex justify-content-center">WARNING!</h4>
                    <p class=" mb-2 d-flex justify-content-center">Maaf, Struktur Organisasi Belum Tersedia</p>
                    </div>
            </div>
            <figure style="display: none" class="highcharts-figure" id="preview">
                <div id="container"></div>
            </figure>
            
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('page_js')
<script>
    $(document).ready(function(){
        $.ajax({
            type: "get",
            url: "{{ url('/org_personil/chart/'.$kode) }}" ,
            dataType: "json",
            success: function(res) {
                
                if (!res.error){
                    $("#preview").show();
                    org_highchart(res.data.datas, res.data.nodes,res.data.struktur_name);
                } else{
                    $("#empty").show();
                }
            }
        });
    });

</script>
<script src="{{ url('assets/js/org_preview.js') }}"></script>
@endsection