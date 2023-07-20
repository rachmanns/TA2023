@extends('partials.template')
@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <h3 class="font-weight-bolder mb-1">Rawat Jalan Kasus Suspek</h3>
            <div class="row match-height">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Prajurit TNI</h4>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-prajurit-tni">Detail</button>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-prajurit-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Prajurit TNI (Rawat Jalan Kasus Suspek)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">Mabes</td>
                                                    <td class="border-top-0">TNI AD</td>
                                                    <td class="border-top-0">TNI AL</td>
                                                    <td class="border-top-0">TNI AU</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AD</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AL</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AU</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0)+($dataseries_1['AD']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0)+($dataseries_1['AL']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0)+($dataseries_1['AU']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="prajurit-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">PNS TNI</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries_1['AD']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries_1['AL']['Suspect (Rawat Jalan)']['PNS'] ?? 0)+($dataseries_1['AU']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="pns-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Suspect (Rawat Jalan)']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Keluarga Besar TNI</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AD']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AL']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AU']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['Prajurit'] ?? 0)+($dataseries_1['AD']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0)+($dataseries_1['AL']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0)+($dataseries_1['AU']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="kel-besar-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Suspect (Rawat Jalan)']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Suspect (Rawat Jalan)']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="font-weight-bolder mb-1">Probable (Pengawasan)</h3>
            <div class="row match-height">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Prajurit TNI</h4>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-pro-prajurit-tni">Detail</button>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-pro-prajurit-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Prajurit TNI (Probable)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">Mabes</td>
                                                    <td class="border-top-0">TNI AD</td>
                                                    <td class="border-top-0">TNI AL</td>
                                                    <td class="border-top-0">TNI AU</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AD</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Probable']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Probable']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Probable']['Prajurit TNI AD'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Probable']['Prajurit TNI AD'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AL</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Probable']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Probable']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Probable']['Prajurit TNI AL'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Probable']['Prajurit TNI AL'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AU</td>
                                                    <td class="border-top-0">{{$dataseries['MABES']['Probable']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AD']['Probable']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AL']['Probable']['Prajurit TNI AU'] ?? 0}}</td>
                                                    <td class="border-top-0">{{$dataseries['AU']['Probable']['Prajurit TNI AU'] ?? 0}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['MABES']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AD']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AL']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AU'] ?? 0)}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{($dataseries['AU']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AU'] ?? 0)}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AU'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AU'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AU'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Probable']['Prajurit'] ?? 0)+($dataseries_1['AD']['Probable']['Prajurit'] ?? 0)+($dataseries_1['AL']['Probable']['Prajurit'] ?? 0)+($dataseries_1['AU']['Probable']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="pro-prajurit-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['MABES']['Probable']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['']['Probable']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AD']['Probable']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Probable']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AL']['Probable']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Probable']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Probable']['Prajurit TNI AD'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AL'] ?? 0)+($dataseries['AU']['Probable']['Prajurit TNI AU'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Probable']['Prajurit'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">PNS TNI</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['PNS'] ?? 0)+($dataseries['AD']['Probable']['PNS'] ?? 0)+($dataseries['AL']['Probable']['PNS'] ?? 0)+($dataseries['AU']['Probable']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Probable']['PNS'] ?? 0)+($dataseries_1['AD']['Probable']['PNS'] ?? 0)+($dataseries_1['AL']['Probable']['PNS'] ?? 0)+($dataseries_1['AU']['Probable']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="pro-pns-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Probable']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Probable']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Probable']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Probable']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Probable']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Probable']['PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Probable']['PNS'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Keluarga Besar TNI</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <span class="font-weight-bolder text-muted">Total</span>
                                    <h1 class="font-large-1 font-weight-bolder mt-0 mb-0">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AD']['Probable']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AL']['Probable']['Keluarga TNI/PNS'] ?? 0)+($dataseries['AU']['Probable']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Probable']['Keluarga'] ?? 0)+($dataseries_1['AD']['Probable']['Keluarga'] ?? 0)+($dataseries_1['AL']['Probable']['Keluarga'] ?? 0)+($dataseries_1['AU']['Probable']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h1>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="pro-kel-besar-tni"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <h5 class="font-weight-normal">Mabes</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['MABES']['Probable']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['MABES']['Probable']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AD</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AD']['Probable']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AD']['Probable']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AL</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AL']['Probable']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AL']['Probable']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="font-weight-normal">TNI AU</h5>
                                    <h4 class="font-weight-bold">
                                    @php
                                    $totalS = ($dataseries['AU']['Probable']['Keluarga TNI/PNS'] ?? 0);

                                    $totalS1 = ($dataseries_1['AU']['Probable']['Keluarga'] ?? 0);

                                    echo $totalS;
                                    @endphp
                                    </h4>
                                    <small class="text-muted"><i data-feather="{{$totalS==$totalS1?'repeat':($totalS>$totalS1?'arrow-up':'arrow-down')}}" class="text-{{$totalS==$totalS1?'warning':($totalS>$totalS1?'danger':'primary')}}"></i> {{$totalS1>$totalS?'-':'+'}} {{abs($totalS-$totalS1)}} Kasus</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="font-weight-bolder mb-1">Kasus Konfirmasi</h3>
            <div class="row match-height">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Prajurit TNI</h4>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-kon-prajurit-tni">Detail</button>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-kon-prajurit-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Kasus Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">Dirawat</td>
                                                    <td class="border-top-0">Isoman</td>
                                                    <td class="border-top-0">Sembuh</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AD</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AD']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AD']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Sembuh)']['Prajurit TNI AD']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AL</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AL']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AL']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Sembuh)']['Prajurit TNI AL']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AU</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0">{{$data['Konfirmasi (Sembuh)']['Prajurit TNI AU']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0 font-weight-bolder">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AD']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AL']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AD']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AL']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{$data['Konfirmasi (Sembuh)']['Prajurit TNI AD']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AL']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AU']}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AD']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AL']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AU']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AD']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AL']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AU']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AD']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AL']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AU']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Dirawat</td>
                                            <td class="border-top-0 p-0">Isolasi Mandiri</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-warning font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Dirawat)']['Prajurit TNI AD']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AL']+$data['Konfirmasi (Dirawat)']['Prajurit TNI AU']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-info font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AD']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AL']+$data['Konfirmasi (Isolasi Mandiri)']['Prajurit TNI AU']}}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2 pt-1">Sembuh</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-success font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Sembuh)']['Prajurit TNI AD']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AL']+$data['Konfirmasi (Sembuh)']['Prajurit TNI AU']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">PNS TNI</h4>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Konfirmasi (Dirawat)']['PNS']+$data['Konfirmasi (Isolasi Mandiri)']['PNS']+$data['Konfirmasi (Sembuh)']['PNS']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Dirawat</td>
                                            <td class="border-top-0 p-0">Isolasi Mandiri</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-warning font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Dirawat)']['PNS']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-info font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Isolasi Mandiri)']['PNS']}}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2 pt-1">Sembuh</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-success font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Sembuh)']['PNS']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">KB TNI</h4>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Konfirmasi (Dirawat)']['Keluarga TNI/PNS']+$data['Konfirmasi (Isolasi Mandiri)']['Keluarga TNI/PNS']+$data['Konfirmasi (Sembuh)']['Keluarga TNI/PNS']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Dirawat</td>
                                            <td class="border-top-0 p-0">Isolasi Mandiri</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-warning font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Dirawat)']['Keluarga TNI/PNS']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-info font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Isolasi Mandiri)']['Keluarga TNI/PNS']}}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2 pt-1">Sembuh</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-success font-medium-2 font-weight-bolder">{{$data['Konfirmasi (Sembuh)']['Keluarga TNI/PNS']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="font-weight-bolder mb-1">Meninggal</h3>
            <div class="row match-height">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">Prajurit TNI</h4>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-men-prajurit-tni">Detail</button>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-men-prajurit-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Meninggal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0 width-100"></td>
                                                    <td class="border-top-0">Suspek</td>
                                                    <td class="border-top-0">Konfirmasi</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AD</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Suspect)']['Prajurit TNI AD']}}</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Konfirmasi)']['Prajurit TNI AD']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AL</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Suspect)']['Prajurit TNI AL']}}</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Konfirmasi)']['Prajurit TNI AL']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0">AU</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Suspect)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0">{{$data['Meninggal (Konfirmasi)']['Prajurit TNI AU']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0 font-weight-bolder">{{$data['Meninggal (Suspect)']['Prajurit TNI AD']+$data['Meninggal (Suspect)']['Prajurit TNI AL']+$data['Meninggal (Suspect)']['Prajurit TNI AU']}}</td>
                                                    <td class="border-top-0 font-weight-bolder">{{$data['Meninggal (Konfirmasi)']['Prajurit TNI AD']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AL']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AU']}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Meninggal (Suspect)']['Prajurit TNI AD']+$data['Meninggal (Suspect)']['Prajurit TNI AL']+$data['Meninggal (Suspect)']['Prajurit TNI AU']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AD']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AL']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AU']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Suspek</td>
                                            <td class="border-top-0 p-0">Konfirmasi</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-danger font-medium-2 font-weight-bolder">{{$data['Meninggal (Suspect)']['Prajurit TNI AD']+$data['Meninggal (Suspect)']['Prajurit TNI AL']+$data['Meninggal (Suspect)']['Prajurit TNI AU']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-konfirmasi font-medium-2 font-weight-bolder">{{$data['Meninggal (Konfirmasi)']['Prajurit TNI AD']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AL']+$data['Meninggal (Konfirmasi)']['Prajurit TNI AU']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">PNS TNI</h4>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Meninggal (Suspect)']['PNS']+$data['Meninggal (Konfirmasi)']['PNS']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Suspek</td>
                                            <td class="border-top-0 p-0">Konfirmasi</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-danger font-medium-2 font-weight-bolder">{{$data['Meninggal (Suspect)']['PNS']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-konfirmasi font-medium-2 font-weight-bolder">{{$data['Meninggal (Konfirmasi)']['PNS']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title mb-2">KB TNI</h4>
                        </div>
                        <div class="card-body mt-1">
                            <div class="row">
                                <div class="col-5 my-auto">
                                    <p class="text-muted font-medium-3 mb-25">Total Kasus</p>
                                    <span class="font-large-1 font-weight-bolder text-primary">{{$data['Meninggal (Suspect)']['Keluarga TNI/PNS']+$data['Meninggal (Konfirmasi)']['Keluarga TNI/PNS']}}</span>
                                </div>
                                <div class="col-7 my-auto">
                                    <table class="table">
                                        <tr>
                                            <td class="border-top-0 p-0 pr-2">Suspek</td>
                                            <td class="border-top-0 p-0">Konfirmasi</td>
                                        </tr>
                                        <tr>
                                            <td class="border-top-0 p-0"><span class="text-danger font-medium-2 font-weight-bolder">{{$data['Meninggal (Suspect)']['Keluarga TNI/PNS']}}</span></td>
                                            <td class="border-top-0 p-0"><span class="text-konfirmasi font-medium-2 font-weight-bolder">{{$data['Meninggal (Konfirmasi)']['Keluarga TNI/PNS']}}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section("page_script")
<script>
    $(document).ready(function() {
        $('#wilayah').select2({
            ajax: {
                url: '{{url("referensi/wilayah")}}',
                dataType: 'json',
                type: "GET",
                data: function(result) {
                    console.log("hasilnya " + result)
                }
            }
        });

        var label = [];
        var tgl = new Date();
        label[13] = tgl.toLocaleString('id-ID', {dateStyle: 'medium'});
        for (i=12;i>=0;i--) {
            tgl.setDate(tgl.getDate() - 1);
            label[i] = tgl.toLocaleString('id-ID', {dateStyle: 'medium'});
        }
        line_chart("#prajurit-tni", [{!!implode(",", $series['Suspect (Rawat Jalan)']['Prajurit'])!!}], label)
        line_chart("#pns-tni", [{!!implode(",", $series['Suspect (Rawat Jalan)']['PNS'])!!}], label)
        line_chart("#kel-besar-tni", [{!!implode(",", $series['Suspect (Rawat Jalan)']['Keluarga'])!!}], label)
        line_chart("#pro-prajurit-tni", [{!!implode(",", $series['Probable']['Prajurit'])!!}], label)
        line_chart("#pro-pns-tni", [{!!implode(",", $series['Probable']['PNS'])!!}], label)
        line_chart("#pro-kel-besar-tni", [{!!implode(",", $series['Probable']['Keluarga'])!!}], label)


    });


    var flatPicker = $('.flat-picker'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        grid_line_color = 'rgba(200, 200, 200, 0.2)',
        labelColor = '#6e6b7b',
        tooltipShadow = 'rgba(0, 0, 0, 0.25)',
        successColorShade = '#28dac6',
        $trackBgColor = '#EBEBEB',
        chartColors = {
            column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
            },
            success: {
                shade_100: '#7eefc7',
                shade_200: '#06774f'
            },
            donut: {
                series1: '#ffe700',
                series2: '#00d4bd',
                series3: '#826bf8',
                series4: '#2b9bf4',
                series5: '#FFA1A1'
            },
            pie: {
                terisi: '#1D55E0',
                tersedia: '#FF9F42'
            },
            area: {
                series3: '#a4f8cd',
                series2: '#60f2ca',
                series1: '#2bdac7'
            },
            line: {
                red: "#ff4961",
                grey: "#4F5D70",
                grey_light: "#EDF1F4",
                sky_blue: "#2b9bf4",
                blue: "#1D55E0",
                pink: "#F8D3FF",
                gray_blue: "#ACBBEA",
                success: "#2bdac7"
            }
        };

    function line_chart(selector, series, labels) {
        var bor_covid_element = document.querySelector(selector),
            bor_covid_config = {
                chart: {
                    height: 150,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                grid: {
                    borderColor: $trackBgColor,
                    strokeDashArray: 5,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                    padding: {
                        top: -30,
                        bottom: -10
                    }
                },
                stroke: {
                    width: 3
                },
                colors: [window.colors.solid.info],
                series: [{
                    data: series
                }],
                labels: labels,
                markers: {
                    size: 2,
                    colors: window.colors.solid.info,
                    strokeColors: window.colors.solid.info,
                    strokeWidth: 2,
                    strokeOpacity: 1,
                    strokeDashArray: 0,
                    fillOpacity: 1,
                    discrete: [{
                        seriesIndex: 0,
                        dataPointIndex: 13,
                        fillColor: '#ffffff',
                        strokeColor: window.colors.solid.info,
                        size: 5
                    }],
                    shape: 'circle',
                    radius: 2,
                    hover: {
                        size: 3
                    }
                },
                xaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontSize: '7px'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + ' Kasus';
                        },
                        title: {
                            formatter: (seriesName) => '',
                        },
                    },
                }
            };
        if (typeof bor_covid_element !== undefined && bor_covid_element !== null) {
            var radialChart = new ApexCharts(bor_covid_element, bor_covid_config);
            radialChart.render();
        }
    }


</script>
@endsection