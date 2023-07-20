@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/pelatihan"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Data Pelatihan</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-1">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Tahun</label>                                
                                        <div class="input-group input-group-merge form-input">
                                            <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                                placeholder="Tahun" readonly />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="tgl">Tanggal Pelaksanaan</label>
                                            <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal Pelaksanaan" name="tanggal" />
                                            <div class="invalid-feedback">Tanggal Pelaksanaan harus diisi</div>
                                        </div>                                           
                                    </div>
                                </div>  
                                <div class="row mb-1">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="nama">Nama Pelatihan</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama Pelatihan">
                                            <div class="invalid-feedback">Nama Pelatihan harus diisi</div>
                                        </div>     
                                    </div>
                                    <div class="col-md-6 col-12">   
                                        <label class="form-label">Tempat Pelatihan</label>          
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Tempat Pelatihan</option>
                                        </select>                                      
                                    </div>
                                </div> 
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection