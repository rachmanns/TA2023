@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/selesai_internship"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Data Selesai Internship</h2>
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
                                            <label class="form-label" for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama">
                                            <div class="invalid-feedback">Nama harus diisi</div>
                                        </div>                         
                                    </div>
                                </div>  
                                <div class="row mb-1">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Korp</label>          
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Korp</option>
                                        </select>    
                                    </div>
                                    <div class="col-md-6 col-12">   
                                        <label class="form-label">Pangkat</label>          
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Pangkat</option>
                                        </select>                                      
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="nrp">NRP</label>
                                            <input type="text" id="nrp" class="form-control" placeholder="NRP">
                                            <div class="invalid-feedback">NRP harus diisi</div>
                                        </div>     
                                    </div>
                                    <div class="col-md-6 col-12">   
                                        <label class="form-label">Kesatuan</label>          
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Kesatuan</option>
                                        </select>                                      
                                    </div>
                                </div> 
                                <div class="form-group form-input">
                                    <label class="form-label" for="jabatam">Jabatan</label>
                                    <input type="text" id="jabatan" class="form-control" placeholder="Jabatan">
                                    <div class="invalid-feedback">Jabatan harus diisi</div>
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