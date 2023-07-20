@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/bekkes_dn_new"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">Edit Data Satgas Operasi</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Nama Batalyon</label>
                                    <input type="text" class="form-control" placeholder="Nama Batalyon">
                                </div>
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Nama Satgas</label>
                                    <input type="text" class="form-control" placeholder="Nama Satgas">
                                </div>
                                <div class="form-group form-input col-md-3 col-12">
                                    <label class="form-label">Tanggal Berangkat Ops</label>
                                    <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Berangkat Ops">
                                </div>
                                <div class="form-group form-input col-md-3 col-12">
                                    <label class="form-label">Tanggal Kembali Ops</label>
                                    <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Kembali Ops">
                                </div>
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Jumlah Personil</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Personil">
                                </div>
                                <div class="col-md-12 col-12 mb-1">
                                    <label class="form-label">Apakah Daerah ini Endemik ?</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio1" name="endemik" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio1">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio2" name="endemik" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 mb-1">
                                    <label class="form-label">Status Pemberangkatan</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio3" name="pemberangkatan" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio3">Berangkat</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio4" name="pemberangkatan" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio4">Batal Berangkat</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 mb-1">
                                    <label class="form-label">Status Distribusi Bekkes</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio5" name="distribusi" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio5">Sudah Terdistribusi </label>
                                        </div>
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio6" name="distribusi" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio6">Belum Terdistribusi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-input col-md-12 col-12">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <h5 class="font-weight-bolder">Perangkat</h5>
                                </div>
                                <div class="col-12">
                                <section class="form-control-repeater">
                                    <form action="#" class="invoice-repeater">
                                        <div data-repeater-list="invoice">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group form-input">
                                                            <label class="form-label">Nama Perangkat</label>
                                                            <select class="select2 form-control">
                                                                <option selected disabled>Pilih Nama Perangkat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-12">
                                                        <div class="form-group">
                                                            <label>Jumlah Kat</label>
                                                            <input type="number" class="form-control" placeholder="Jumlah Kat" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-12 text-right">
                                                        <div class="form-group">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Tambah Data</span>
                                                </button>
                                            </div>
                                            <div class="col-md-6 col-12 text-right">
                                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </section>
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