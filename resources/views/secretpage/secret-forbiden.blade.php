@extends('partials.template')
@section('page_style')
<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/page-auth.css')}}">
@endsection
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Reset Password v1 -->
                    <div class="card mb-0">
                        <div class="card-body">

                            <a href="javascript:void(0);" class="brand-logo">
                                <img src="{{ url('img/caution-sign.png')}}" height="62" />
                            </a>

                            <h4 class="card-title mb-1 d-flex justify-content-center">Forbidden 🔒</h4>
                            <p class=" mb-2 d-flex justify-content-center">Maaf, Anda tidak berhak untuk mengakses halaman ini</p>
                     
                        </div>
                    </div>
                    <!-- /Reset Password v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
