@extends('partials.template')

@section('page_style')
    <style>
        .right-line {
            border-right: 5px #ccc solid;
            height: 2em
        }

        .top-line {
            border-top: 5px #ccc solid;
        }

        .bottom-line {
            border-bottom: 5px #ccc solid;
        }

        .halved {
            width: 50%;
            float: left;
        }

        .blue {
            border-top: 5px solid #2045B8 !important;
        }
        
        .vl {
            border-left: 5px solid #ccc;
            height: 80rem;
            position: absolute;
            left: 50%;
            margin-left: -5px;
            margin-top: -50px;
        }
    </style>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row match-height mb-4">
                    <div class="container text-center">
                        <h2 class="font-weight-bolder mb-3">Jalur Company Lafibiovak Puskes TNI</h2>
                        <div class="row justify-content-center">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                    <div class="card-header justify-content-center p-0">
                                        <h4 class="font-weight-bolder text-center pt-1 pb-1">LAFIBIOVAK</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 right-line"></div>
                        </div>
                        <div class="row">
                            <div class="col-6 right-line"></div>
                        </div>
                        <div class="row">
                            <div class="col-1 right-line"></div>
                            <div class="col-2 right-line top-line"></div>
                            <div class="col-2 right-line top-line"></div>
                            <div class="col-3 right-line top-line"></div>
                            <div class="col-3 right-line top-line"></div>
                        </div>
                        <div class="row">
                            <div class="col-1 right-line"></div>
                            <div class="col-2 right-line"></div>
                            <div class="col-2 right-line"></div>
                            <div class="col-3 right-line"></div>
                            <div class="col-3 right-line"></div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-12">
                                        <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                            <div class="card-header justify-content-center p-0">
                                                <h4 class="font-weight-bolder text-center pt-1 pb-1">LAFI PUSKESAD</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-12">
                                        <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                            <div class="card-header justify-content-center p-0">
                                                <h4 class="font-weight-bolder text-center pt-1 pb-1">LAFIAL</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-12">
                                        <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                            <div class="card-header justify-content-center p-0">
                                                <h4 class="font-weight-bolder text-center pt-1 pb-1">LAFIAU</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-12">
                                        <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                            <div class="card-header justify-content-center p-0">
                                                <h4 class="font-weight-bolder text-center pt-1 pb-1">LABIOMED PUSKESAD</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-12">
                                        <div class="card ecommerce-card cursor-pointer mb-0 blue">
                                            <div class="card-header justify-content-center p-0">
                                                <h4 class="font-weight-bolder text-center pt-1 pb-1">LABIOVAK PUSKESAD</h4>
                                            </div>
                                        </div>
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
