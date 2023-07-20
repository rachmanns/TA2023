@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Rikujikkes - Seleksi Satgas Luar Negeri</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        {{-- <a href="{{ url('dukkesops/seleksi-satgas-ln/pratugas') }}"> --}}
                        <a href="{{ url('dukkesops/seleksi-satgas/ln/pratugas') }}">
                            <div class="card mb-3">
                                <img class="card-img-top" src="{{ url('img/dashboard/pratugas.png')}}">
                                <div class="card-body text-center">
                                    <h4 class="card-title mb-0">Pratugas</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-12">
                        {{-- <a href="{{ url('dukkesops/seleksi-satgas-ln/purnatugas') }}"> --}}
                        <a href="{{ url('dukkesops/seleksi-satgas/ln/purnatugas') }}">
                            <div class="card mb-3">
                                <img class="card-img-top" src="{{ url('img/dashboard/purnatugas.png')}}">
                                <div class="card-body text-center">
                                    <h4 class="card-title mb-0">Purnatugas</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection