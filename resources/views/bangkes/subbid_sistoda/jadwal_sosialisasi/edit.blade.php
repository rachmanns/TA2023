@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/jadwal_sosialisasi"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Jadwal Sosialisasi</h2>
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
                                            <label class="form-label" for="tgl">Tanggal</label>
                                            <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal" name="tanggal" />
                                            <div class="invalid-feedback">Tanggal harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="no">No. Buku</label>
                                            <input type="number" id="no" class="form-control" placeholder="No. Buku">
                                            <div class="invalid-feedback">No. Buku harus diisi</div>
                                        </div>                                        
                                    </div>
                                </div>           
                                <div class="form-group form-input">
                                    <label class="form-label" for="judul">Judul Buku</label>
                                    <input type="text" id="judul" class="form-control" placeholder="Judul Buku">
                                    <div class="invalid-feedback">Judul Buku harus diisi</div>
                                </div>        
                                <h5>Lokasi Sosialisasi</h5>
                                <div class="form-group form-input">
                                    <label class="form-label" for="satuan">Satuan</label>
                                    <input type="text" id="satuan" class="form-control" placeholder="Satuan">
                                    <div class="invalid-feedback">Satuan harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="kota">Kota</label>
                                    <input type="text" id="kota" class="form-control" placeholder="Kota">
                                    <div class="invalid-feedback">Kota harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="jml">Jumlah Peserta</label>
                                    <input type="number" id="jml" class="form-control" placeholder="Jumlah Peserta">
                                    <div class="invalid-feedback">Jumlah Peserta harus diisi</div>
                                </div>
                                <label>Nama Petugas Sosialisasi</label>
                                <select class="select2 form-control" multiple>
                                    <option>Fitria</option>  
                                    <option>Hidayah</option>  
                                    <option>Nauval</option>  
                                </select>
                                <div class="form-group mt-1">
                                    <label for="customFile1">File Laporan Kegiatan</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile1"
                                            required />
                                        <label class="custom-file-label" for="customFile1">File Laporan Kegiatan</label>
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