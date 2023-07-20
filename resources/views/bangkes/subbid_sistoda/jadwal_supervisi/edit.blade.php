@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/jadwal_supervisi"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Jadwal Supervisi</h2>
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
                                            <label class="form-label" for="topik">Topik</label>
                                            <input type="text" id="topik" class="form-control" placeholder="Topik">
                                            <div class="invalid-feedback">Topik harus diisi</div>
                                        </div>                                        
                                    </div>
                                </div>
                                <h5>Lokasi Supervisi</h5>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group form-input">
                                            <label class="form-label" for="satuan">Satuan</label>
                                            <input type="text" id="satuan" class="form-control" placeholder="Satuan">
                                            <div class="invalid-feedback">Satuan harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">             
                                        <div class="form-group form-input">
                                            <label class="form-label" for="kota">Kota</label>
                                            <input type="text" id="kota" class="form-control" placeholder="Kota">
                                            <div class="invalid-feedback">Kota harus diisi</div>
                                        </div>                                     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customFile1">File Laporan Kegiatan</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile1"
                                            required />
                                        <label class="custom-file-label" for="customFile1">File Laporan Kegiatan</label>
                                    </div>
                                    <div class="invalid-feedback">File harus ada</div>
                                </div>

                                <h5>Panitia Internal</h5>
                                <label class="form-label">Panitia Internal</label>
                                <select class="select2 form-control" multiple>
                                    <option>Fitria</option>  
                                    <option>Hidayah</option>  
                                    <option>Nauval</option>  
                                </select>

                                <h5 class="mt-2">Panitia Eksternal</h5>
                                <div action="#" class="invoice-repeater">
                                    <div data-repeater-list="lafi">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-3 col-6">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" placeholder="Nama" required />
                                                        <div class="invalid-feedback">Nama harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-6">
                                                    <div class="form-group">
                                                        <label for="nrp">NRP</label>
                                                        <input type="text" class="form-control" placeholder="NRP" required />
                                                        <div class="invalid-feedback">NRP harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <div class="form-group">
                                                        <label for="asal">Asal Satuan</label>
                                                        <input type="text" class="form-control" placeholder="Asal Satuan" required />
                                                        <div class="invalid-feedback">Asal Satuan harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-6">
                                                    <div class="form-group">
                                                        <label for="jabatan">Jabatan</label>
                                                        <input type="text" class="form-control" placeholder="Jabatan" required />
                                                        <div class="invalid-feedback">Jabatan harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-6 text-right">
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-danger text-nowrap" data-repeater-delete type="button">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                <i data-feather="plus" class="mr-25"></i>
                                                <span>Tambah Baru</span>
                                            </button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-icon btn-primary" type="button">
                                                <span>Simpan Data</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection