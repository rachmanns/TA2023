@extends('partials.template')

@section('page_style')
<style>
    div.dataTables_wrapper div.dataTables_filter label,
    div.dataTables_wrapper div.dataTables_length label {
        margin-left: 1.5rem;
        margin-right: 1.5rem;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin-right: 1.5rem;
    }

    div.dataTables_wrapper .dataTables_info {
        margin-left: 1.5rem;
    }
</style>
@endsection

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/detail_rotasi_satgas_ln"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">Edit Data Rotasi Pos</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> <b> Satgas AD </b> - Pos Simpang PNG</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-input">
                                <label class="form-label">Nama Personil Kesehatan</label>
                                <select class="select2 form-control">
                                    <option selected disabled>Pilih Nama Personil Kesehatan</option>
                                </select>
                            </div>
                            <div class="form-group form-input">
                                <label class="form-label">Jumlah Personil</label>
                                <input type="number" class="form-control" placeholder="Jumlah Personil" />
                            </div>
                            <div class="form-group form-input">
                                <label class="form-label">No. Telepon</label>
                                <input type="number" class="form-control" placeholder="No. Telepon" />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="font-weight-bolder mt-1">Perangkat</h5>
                                </div>
                                <div class="col-12">
                                    <form action="#" class="invoice-repeater">
                                        <div data-repeater-list="invoice">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group form-input">
                                                            <label class="form-label">Nama Kat</label>
                                                            <select class="select2 form-control">
                                                                <option selected disabled>Pilih Nama Kat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-12">
                                                        <div class="form-group form-input">
                                                            <label class="form-label">Jumlah Kat</label>
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
                                            <div class="col-md-6">
                                                <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>Tambah Data</button>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button class="btn btn-primary">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
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