@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/data_buku"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Data Buku</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="no">No. Buku</label>
                                            <input type="number" id="no" class="form-control" placeholder="No. Buku">
                                            <div class="invalid-feedback">No. Buku harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="judul">Judul</label>
                                            <input type="text" id="judul" class="form-control" placeholder="Judul">
                                            <div class="invalid-feedback">Judul harus diisi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="kategori">Kategori</label>
                                            <input type="text" id="kategori" class="form-control" placeholder="Kategori">
                                            <div class="invalid-feedback">Kategori harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="form-label" for="tahun">Tahun Terbit</label>
                                        <div class="input-group input-group-merge form-input">
                                            <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Terbit"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="abs">Abstrak</label>
                                    <input type="text" id="abs" class="form-control" placeholder="Abstrak">
                                    <div class="invalid-feedback">Abstrak harus diisi</div>
                                </div>
                                <div class="form-group">
                                    <label for="customFile1">Upload File</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile1"
                                            required />
                                        <label class="custom-file-label" for="customFile1">Upload File</label>
                                    </div>
                                    <div class="invalid-feedback">File harus ada</div>
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