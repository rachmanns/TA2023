@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper"> 
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Jenis Kegiatan</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group form-input">
                                        <label class="form-label" for="jenis">Jenis Kegiatan</label>
                                        <input type="text" id="jenis" class="form-control" placeholder="Jenis Kegiatan"/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="tgl">Tanggal Kegiatan</label>
                                        <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal Kegiatan" />
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="tempat">Tempat</label>
                                        <input type="text" id="tempat" class="form-control" placeholder="Tempat"/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <label class="form-label" for="tahun">Tahun</label>
                                    <div class="input-group input-group-merge form-input">
                                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" readonly/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        </div>
                                    </div> 
                                    <label class="form-label mt-1" for="ket">Ketarangan</label>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="terencana" name="ket" class="custom-control-input"/>
                                                <label class="custom-control-label" for="terencana">Terencana</label>
                                            </div>   
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="terlaksana" name="ket" class="custom-control-input"/>
                                                <label class="custom-control-label" for="terlaksana">Terlaksana</label>
                                            </div>   
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="batal" name="ket" class="custom-control-input"/>
                                                <label class="custom-control-label" for="batal">Batal</label>
                                            </div>   
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="tunda" name="ket" class="custom-control-input"/>
                                                <label class="custom-control-label" for="tunda">Tunda</label>
                                            </div>   
                                        </div>
                                    </div>
                                    <label class="form-label mt-1" for="status">Status</label>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="undangan" name="status" class="custom-control-input"/>
                                                <label class="custom-control-label" for="undangan">Undangan</label>
                                            </div>   
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="tuan" name="status" class="custom-control-input"/>
                                                <label class="custom-control-label" for="tuan">Tuang Rumah</label>
                                            </div>   
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="mandiri" name="status" class="custom-control-input"/>
                                                <label class="custom-control-label" for="mandiri">Mandiri</label>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection