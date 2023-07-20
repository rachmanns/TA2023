@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12 mb-1">
                            <a href="/regulasi_bangkes"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Input Regulasi Bidang</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="form-control-repeater">
                    <div class="row">
                        <!-- Invoice repeater -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#" class="invoice-repeater">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="nama">Nama Bidang</label>
                                                    <select id="nama" class="form-control select2">
                                                        <option selected disabled>Pilih Nama Bidang</option>
                                                        <option>Bidum</option>
                                                        <option>Bidyankesin</option>
                                                        <option>Bidmatfaskes</option>
                                                        <option>Kermabaktikes</option>
                                                        <option>Taud</option>
                                                        <option>Lafibiovak</option>
                                                        <option>Dukkesops</option>
                                                        <option>Dobekkes</option>
                                                        <option>Bangkes</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <h6 class="font-weight-bold py-50">Daftar Regulasi Bidang</h6>
                                            </div>
                                        </div>
                                        <div data-repeater-list="invoice">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-5 col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Regulasi</label>
                                                            <input type="text" class="form-control" id="nama" placeholder="Isi Nama Regulasi" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-12">
                                                        <div class="form-group">
                                                            <label for="customFile1">Pilih File</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile1" required />
                                                                <label class="custom-file-label" for="customFile1">Pilih File</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12 text-right">
                                                        <div class="form-group">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="mr-25"></i>
                                                                <span>Hapus</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Tambah</span>
                                                </button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice repeater -->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection