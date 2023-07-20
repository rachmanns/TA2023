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
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="d-flex justify-content-between">
                        <h2 class="content-header-title float-left">Daftar Anggaran Dukkesops - 2022</h2>
                        <button class="btn btn-primary" data-toggle='modal' data-target='#add'>Tambah Anggaran</button>

                        <!-- Modal Upload -->
                        <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title">Tambah Anggaran</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group form-input">
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" class="form-control flatpickr-basic" placeholder="Tanggal">
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label">Uraian</label>
                                            <input type="text" class="form-control" placeholder="Uraian">
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label">Jumlah Terbayarkan</label>
                                            <input type="number" class="form-control" placeholder="Jumlah Terbayarkan">
                                        </div>
                                        <div class="form-group form-input">
                                            <label for="customFile1">Bukti Bayar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile1" />
                                                <label class="custom-file-label dbd" for="customFile1">Bukti Bayar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body rounded" style="background-color: #BBD5F3;">
                                <h6 class="font-weight-bolder">Pagu Anggaran</h6>
                                <h1 class="mb-0">Rp125.000.000,-</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body rounded" style="background-color: #BBD5F3;">
                                <h6 class="font-weight-bolder">Anggaran Terbayarkan</h6>
                                <h1 class="mb-0">Rp125.000.000,-</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body rounded" style="background-color: #BBD5F3;">
                                <h6 class="font-weight-bolder">Sisa Anggaran</h6>
                                <h1 class="mb-0">Rp125.000.000,-</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th style="min-width: 300px">Uraian</th>
                                                <th>Jumlah Terbayarkan</th>
                                                <th>Bukti Bayar</th>
                                                <th class="text-center" style="min-width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#table').DataTable({
            // scrollX: true,
            ajax: "{{ url('/app-assets/data/detail_anggaran_dukkesops.json') }}",
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'tgl'
                },
                {
                    data: 'uraian'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'bukti'
                },                             
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection
