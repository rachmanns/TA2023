@extends('partials.template') 

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
                            <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">

                    <div class="col-md-6 col-xl-4">
                        <a href="/struktur_organisasi_dukkesops">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Dukkesops</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/dukkesops.jpeg')}}"  >
                        </div>
                        </a>
                    </div>


                    <div class="col-md-6 col-xl-4">
                        <a href="/dashboard_yankesin">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Yankesin</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/yankesin.png')}}"  >
                        </div>
                        </a>
                    </div>
                            
                    <div class="col-md-6 col-xl-4">
                        <a href="/bangkes/sistoda/dashboard">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Bangkes</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/bankes.jpeg')}}"  >
                        </div>
                        </a>
                    </div>
                          
                    <div class="col-md-6 col-xl-4">
                        <a href="/dashboard_bidum">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Umum</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/umum.jpeg')}}"  >
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <a href="/struktur_organisasi_matfaskes">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Matfaskes</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/matfaskes.jpeg')}}"  >
                        </div>
                        </a>
                    </div>
                                     
                    <div class="col-md-6 col-xl-4">
                        <a href="/dobekkes/dashboard">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Dobekkes</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/dobekkes.jpeg')}}"  >
                        </div>
                        </a>
                    </div>
                            
                    <div class="col-md-6 col-xl-4">
                        <a href="/dashboard_lafi">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Lafibiovak</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/lafibiovak.jpeg')}}"  >
                        </div>
                        </a>
                    </div>
                      
                    <div class="col-md-6 col-xl-4">
                        <a href="/struktur_organisasi_kerma">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Kerma</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/kerma.png')}}"  >
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <a href="/taud/dashboard">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h1 class="font-weight-bolder text-center">Bidang Taud</h1>
                            </div>
                            <img class="card-img-bottom" src="{{ url('img/dashboard/taud.jpeg')}}"  >
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection    
 