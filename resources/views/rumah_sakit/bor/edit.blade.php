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
            <div class="row pb-1">
                <div class="col-6">
                    <a href="/bor"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Kembali</span>
                    </button></a>
                </div>
            </div>   
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Data BOR</h2>
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
                                    <div class="form-input mb-1">
                                        <label for="tgl">Tanggal</label>
                                        <input type="text" id="tgl_kontrak" class="form-control flatpickr-basic" placeholder="Tanggal"/>
                                    </div>
                                    <h5 class="card-title mb-50">IGD</h5>
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Rawat Inap</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">VIP</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 1</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 2</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 3</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">NICU/PICU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICCU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Unit Luka Bakar</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Isolasi</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Rawat Khusus</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Perina/Bayi</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Anak</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Trauma Militer</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Unit Luka Bakar</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Operasi</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Operasi IGD</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Operasi Sentral</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : 5</label>
                                                <input type="text" class="form-control" id="igd" placeholder="Terisi" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#defaultSize">Simpan Data</button>
                                </div>

                                <!-- Modal-->
                                <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ url('app-assets/images/pages/eCommerce/ok.png')}}" class="pb-2"/>
                                                <h1>Data Berhasil Di Simpan</h1>
                                            </div>
                                            <div class="row pb-2 pt-2">
                                                <div class="col-12 text-center">
                                                    <a href="/kelola_bor"><button type="submit" class="btn btn-success">Ok</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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