@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/tenaga_medis"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Daftar Tenaga Medis</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col-md-2 col-6">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input"/>
                                            <label class="custom-control-label" for="customRadio1">Militer</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input"/>
                                            <label class="custom-control-label" for="customRadio2">PNS</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Matra</label>
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Matra</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12">   
                                        <label class="form-label">Sebaran</label>          
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Sebaran</option>
                                        </select>                                      
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Kategori Dokter</label>
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Kategori Dokter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="jenis">Jenis Spesialis</label>
                                            <input type="text" id="jenis" class="form-control" placeholder="Jenis Spesialis">
                                            <div class="invalid-feedback">Jenis Spesialis harus diisi</div>
                                        </div>                                       
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama">
                                            <div class="invalid-feedback">Nama harus diisi</div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="pangkat">Pangkat</label>
                                            <input type="text" id="pangkat" class="form-control" placeholder="Pangkat">
                                            <div class="invalid-feedback">Pangkat harus diisi</div>
                                        </div>                                       
                                    </div>
                                </div>     
                                <div class="row">
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="nrp">NRP/NIP</label>
                                            <input type="text" id="nrp" class="form-control" placeholder="NRP/NIP">
                                            <div class="invalid-feedback">NRP/NIP harus diisi</div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-6 col-12">           
                                        <label class="form-label">Satuan Asal</label>  
                                        <select class="select2 form-control form-control-lg">
                                            <option disabled selected>Satuan Asal</option>
                                        </select>                                     
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="struktural">Jabatan Struktural</label>
                                            <input type="text" id="struktural" class="form-control" placeholder="Jabatan Struktural">
                                            <div class="invalid-feedback">Jabatan Struktural harus diisi</div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="fungsional">Jabatan Fungsional</label>
                                            <input type="text" id="fungsional" class="form-control" placeholder="Jabatan Fungsional">
                                            <div class="invalid-feedback">Jabatan Fungsional harus diisi</div>
                                        </div>                                       
                                    </div>
                                </div>  
                                <div class="form-group form-input">
                                    <label class="form-label" for="ket">Keterangan</label>
                                    <textarea rows="3" id="ket" class="form-control" placeholder="Keterangan"></textarea>
                                    <div class="invalid-feedback">Keterangan harus diisi</div>
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