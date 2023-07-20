@extends('partials.template') 

@section('page_style')
<style>    
    .bg-personil {
        background-color: rgba(40, 199, 111, 0.3) !important; 
    }
    .bg-bidlog {
        background-color: rgba(255, 159, 67, 0.3) !important; 
    }
    .bg-anggaran {
        background-color: rgba(234, 84, 85, 0.3) !important; 
    }
</style>
@endsection

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Bidang Umum</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    @if(
                        auth()->user()->can('subbidminpers.list') ||
                        auth()->user()->can('subbidminpers.dashboard') ||
                        auth()->user()->can('subbidminpers.manage') 
                    )
                        <div class="col-lg-4 col-sm-6 col-12">
                            <a href="/bidum/personil/dashboard">
                                <div class="card ecommerce-card cursor-pointer bg-personil">
                                    <div class="card-header justify-content-center height-200">
                                        <div>
                                            <h1 class="font-weight-bolder text-center">Personil</h1>
                                            <h3 class="font-weight-bolder text-center">Kekuatan Personil TNI</h3>
                                        </div>
                                    </div>
                                    <div class="text-center pb-4">
                                        <img src="{{ url('app-assets/images/pages/eCommerce/personil.png')}}" height="250" class="pb-2"/>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if(
                        auth()->user()->can('logistik.list') ||
                        auth()->user()->can('logistik.dashboard') ||
                        auth()->user()->can('logistik.manage') 
                    )
                        <div class="col-lg-4 col-sm-6 col-12">
                            <a href="/bidum/logistik">
                                <div class="card ecommerce-card cursor-pointer bg-bidlog">
                                    <div class="card-header justify-content-center height-200">
                                        <div>
                                            <h1 class="font-weight-bolder text-center">BidLog</h1>
                                            <h3 class="font-weight-bolder text-center">Stok & Mutasi <br> Barang Keluar Masuk</h3>
                                        </div>
                                    </div>
                                    <div class="text-center pb-4">
                                        <img src="{{ url('app-assets/images/pages/eCommerce/bidlog.png')}}" height="250" class="pb-2"/>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                    
                    @if(
                        auth()->user()->can('anggaran.list') ||
                        auth()->user()->can('anggaran.dashboard') ||
                        auth()->user()->can('anggaran.manage') 
                    )
                        <div class="col-lg-4 col-sm-6 col-12">
                            <a href="/bidum/anggaran/dashboard">
                                <div class="card ecommerce-card cursor-pointer bg-anggaran">
                                    <div class="card-header justify-content-center height-200">
                                        <div>
                                            <h1 class="font-weight-bolder text-center">Anggaran</h1>
                                            <h3 class="font-weight-bolder text-center">Laporan Keuangan</h3>
                                        </div>
                                    </div>
                                    <div class="text-center pb-4">
                                        <img src="{{ url('app-assets/images/pages/eCommerce/anggaran.png')}}" height="250" class="pb-2"/>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection    