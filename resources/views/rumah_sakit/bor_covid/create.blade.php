@extends('partials.template') 

@section('page_style')
    <style>
        .underline { text-decoration: underline; }
    </style>
@endsection

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Input Data Covid RS</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">RSPAD Gatot Subroto - <b> 6 Maret 2022 </b></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">BOR Covid</h5>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICU Covid</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Isolasi Covid</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Pasien Covid</h5>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">

                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Prajurit TNI AD
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Prajurit TNI AL
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Prajurit TNI AU
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            PNS
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Keluarga TNI/PNS
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Suspect (Rawat Jalan)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Probable
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Konfirmasi (Sembuh)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Konfirmasi (Dirawat)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Konfirmasi (Konfirmasi)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Konfirmasi (Isolasi Mandiri)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus Meninggal (Suspect/Probable)
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan Data</button>
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