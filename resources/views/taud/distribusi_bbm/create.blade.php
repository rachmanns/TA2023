@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/taud"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Distribusi BBM</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group form-input">
                                    <label class="form-label" for="tgl">Periode</label>
                                    <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Periode" name="tanggal" />
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="jenis">Jenis yang Diterima</label>
                                    <input type="text" id="jenis" class="form-control" placeholder="Jenis yang Diterima">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="jml">Jumlah Distribusi</label>
                                    <input type="text" id="jml" class="form-control" placeholder="Jumlah Distribusi">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="operasional">Operasional</label>
                                    <input type="text" id="operasional" class="form-control" placeholder="Operasional">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="ket">Keterangan</label>
                                    <input type="text" id="ket" class="form-control" placeholder="Keterangan">
                                    <div class="invalid-feedback"></div>
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