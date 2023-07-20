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
            <div class="row">
                {{-- <div class="col-6 text-right">
                    <div class="btn-group">  
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultSize">Ekspor Data</button>
                    </div>
                </div> --}}
                <div class="col-12">
                    <a data-toggle="modal" data-target="#defaultSize"><i data-feather="file-text" class="font-medium-5 text-primary"></i></a>
                </div>
                <!-- Modal-->
                <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Revisi Pagu</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="pagu">Pagu Awal</label>
                                        <input type="number" id="pagu" class="form-control" placeholder="Pagu Awal" />
                                    </div>
                                </div>
                                <label class="form-label mb-1">Revisi Pagu</label>
                                <div class="row mb-1">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio1">Tambah</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="customRadio2">Kurang</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="nilai">Nilai Revisi Pagu</label>
                                        <input type="number" id="nilai" class="form-control" placeholder="Nilai Revisi Pagu" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="revisi">Pagu Setelah Revisi</label>
                                        <input type="number" id="revisi" class="form-control" placeholder="Pagu Setelah Revisi" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#"><button type="submit" class="btn btn-primary">Simpan Revisi</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection