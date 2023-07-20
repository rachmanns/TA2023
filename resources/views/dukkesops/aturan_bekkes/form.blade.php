@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/aturan_bekkes"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Aturan Bekkes</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Nama Pos</label>
                                    <select class="select2 form-control">
                                        <option selected disabled>Pilih Nama Pos</option>
                                        <option>Assike</option>
                                    </select>
                                </div>
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Satgas Ops</label>
                                    <input type="text" class="form-control" placeholder="Satgas Ops">
                                </div>
                                <div class="col-12">
                                    <h6 class="font-weight-bolder">Perangkat</h6>
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
                                                                <option>Nama Test</option>
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