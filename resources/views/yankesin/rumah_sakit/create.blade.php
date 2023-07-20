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
                            <h2 class="content-header-title float-left mb-0">Tambah Data Faskes</h2>
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
                                    <h5 class="card-title mb-1">Data Faskes</h5>
                                    <div class="form-group form-input">
                                        <label for="tingkat">Tingkatan Faskes</label>
                                        <select id="tingkat" name="tingkat" class="select2 form-control form-control-lg" >
                                            <option disabled selected>Pilih Tingkatan Faskes</option>
                                            <option>Diskes</option>
                                            <option>Satkes</option>
                                            <option>Rumkit TK 1</option>
                                            <option>Rumkit TK 2</option>
                                            <option>Rumkit TK 3</option>
                                            <option>FTKP</option>
                                            <option>Denkes</option>
                                            <option>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Faskes</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Faskes" />
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="mabes" name="faskes" class="custom-control-input" value="mabes"/>
                                                <label class="custom-control-label" for="mabes">Faskes Mabes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="ad" name="faskes" class="custom-control-input" value="ad"/>
                                                <label class="custom-control-label" for="ad">Faskes AD</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="al" name="faskes" class="custom-control-input" value="al"/>
                                                <label class="custom-control-label" for="al">Faskes AL</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="au" name="faskes" class="custom-control-input" value="au"/>
                                                <label class="custom-control-label" for="au">Faskes AU</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="komando">Komando</label>
                                        <select id="komando" name="komando" class="select2 form-control form-control-lg" >
                                            <option disabled selected>Pilih Komando</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea rows="3" id="alamat" class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="provinsi">Provinsi</label>
                                        <select id="provinsi" name="provinsi" class="select2 form-control form-control-lg" >
                                            <option disabled selected>Pilih Provinsi</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="kabupaten">Kabupaten</label>
                                        <select id="kabupaten" name="kabupaten" class="select2 form-control form-control-lg" >
                                            <option disabled selected>Pilih Kabupaten</option>
                                        </select>
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