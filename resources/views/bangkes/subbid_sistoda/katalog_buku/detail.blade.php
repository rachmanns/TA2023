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
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Detail Buku</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                           <a href="{{ asset('storage/'.$buku->file_buku); }}" target="_blank"><button class="btn btn-primary">Download Buku</button></a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="app-ecommerce-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ $image }}" class="img-fluid product-img" alt="product image" width="50%"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="mb-1">
                                        <h5 class="font-weight-bolder">Judul Buku</h5>
                                        <p class="card-text font-medium-3">{{ $buku->nama_buku }}</p>
                                    </div>
                                    
                                    <div class="mb-1">
                                        <h5 class="font-weight-bolder">Kategori</h5>
                                        <p class="card-text font-medium-3">{{ $buku->kategori_buku->nama_kat_buku }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h5 class="font-weight-bolder">Tahun Terbit</h5>
                                        <p class="card-text font-medium-3">{{ $buku->tahun_terbit }}</p>
                                    </div>

                                    <h5 class="font-weight-bolder">Abstrak</h5>
                                    <p class="card-text">
                                        {{ $buku->abstraksi }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection