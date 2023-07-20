@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row pb-1">
                <div class="col-6">
                    <a href="/persediaan_masuk"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Back</span>
                    </button></a>
                </div>
            </div>   
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Dokumen Transfer Masuk - Persediaan</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group form-input mt-1">
                                        <label class="form-label" for="nomor">Nomor Kontrak</label>
                                        <input type="text" id="nomor" class="form-control" placeholder="Nomor Kontrak"/>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label class="form-label" for="nomor">Nominal Kontrak</label>
                                        <input type="text" id="nomor" class="form-control" placeholder="Nominal Kontrak"/>
                                    </div>
                                    <label class="form-label" for="nomor">Tanggal Kontrak</label>
                                    <div class="form-group bg-white">
                                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="Tanggal Kontrak" />
                                    </div>
                                    <label class="form-label" for="pelaksana">Piilih Pelaksana*</label>
                                    <select class="select2 form-control form-control-lg" required>
                                        <option selected disabled>Pilih Pelaksana</option>
                                    </select>
                                    <div class="form-group form-input mt-1">
                                        <label for="customFile1">Dokumen Kontrak</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Pilih Dokumen Kontrak</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label class="form-label" for="nomor">Nomor Dokumen RTH TK</label>
                                        <input type="text" id="nomor" class="form-control" placeholder="Nomor Dokumen RTH TK"/>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label for="customFile1">Dokumen RTH TK</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Pilih Dokumen RTH TK</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label class="form-label" for="nomor">Nomor Dokumen RTH TM</label>
                                        <input type="text" id="nomor" class="form-control" placeholder="Nomor Dokumen RTH TM"/>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label for="customFile1">Dokumen RTH TM</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Pilih Dokumen RTH TM</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="#"><button type="submit" class="btn btn-primary">Simpan Data</button></a>
                                    </div>
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
