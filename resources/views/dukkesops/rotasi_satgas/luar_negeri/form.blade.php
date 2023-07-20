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
                <a href="/rotasi_satgas_ln"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Rotasi Pos Satgas</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group form-input">
                                <label class="form-label">Satgas Ops</label>
                                <select class="select2 form-control">
                                    <option selected disabled>Pilih Satgas Ops</option>
                                </select>
                            </div>
                            <div class="form-group form-input">
                                <label class="form-label">Batalyon</label>
                                <input type="text" class="form-control" placeholder="Batalyon" />
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Berangkat</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Berangkat" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Pulang</label>
                                        <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal Pulang" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan Data</button>
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