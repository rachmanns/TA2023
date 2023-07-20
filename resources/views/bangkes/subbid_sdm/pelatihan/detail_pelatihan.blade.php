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
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/pelatihan') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Detail Pelatihan</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header p-1">
                                <div>
                                    <p class="card-text mb-0">Nama Pelatihan</p>
                                    <h4 class="font-weight-bolder">{{ $pelatihan_bangkes->jenis_pelatihan->nama_pelatihan }}</h4>
                                </div>
                                <div class="avatar bg-light-success p-25 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="server" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header p-1">
                                <div>
                                    <p class="card-text mb-0">Tanggal Pelaksanaan</p>
                                    <h4 class="font-weight-bolder">{{ indonesian_date_format($pelatihan_bangkes->tgl_pelaksanaan) }}</h4>
                                </div>
                                <div class="avatar bg-light-danger p-25 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="activity" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header p-1">
                                <div>
                                    <p class="card-text mb-0">Tempat Pelatihan</p>
                                    <h4 class="font-weight-bolder">{{ $pelatihan_bangkes->tempat }}</h4>
                                </div>
                                <div class="avatar bg-light-warning p-25 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="alert-octagon" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    {{-- <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                        <div class="input-group input-group-merge form-input">
                            <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                placeholder="Tahun" readonly />
                            <div class="input-group-append">
                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-12 text-right">
                        <a href="{{ url('bangkes/peserta/create/'.$pelatihan_bangkes->id_pelatihan_bangkes) }}"><button class="btn btn-primary">Tambah Data Peserta</button></a>
                    </div>
                </div>
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="peserta">
                                    <thead>
                                        <tr>
                                            <th>Matra</th>
                                            <th style="min-width: 250px;">Nama</th>
                                            <th>Pangkat/Korp</th>
                                            <th style="min-width: 100px;">NRP</th>
                                            <th style="min-width: 200px;">Satuan</th>
                                            <th>Keterangan</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
        $(function(){
            peserta_list();
        })

        function peserta_list() {
            let id_pelatihan_bangkes = "{{ $pelatihan_bangkes->id_pelatihan_bangkes }}";
            let data = { id_pelatihan_bangkes: id_pelatihan_bangkes }

            $('#peserta').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('bangkes/peserta/get') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pangkat_korps',
                        name: 'pangkat_korps'
                    },
                    {
                        data: 'nrp',
                        name: 'nrp'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }, 
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
@endsection