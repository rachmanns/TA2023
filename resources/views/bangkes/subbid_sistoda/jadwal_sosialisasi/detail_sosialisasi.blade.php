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
                    <a href="{{ route('bangkes.jadwal-sosialisasi.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Detail Sosialisasi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="col-md-12 col-12 mb-1">
                                        <p class="card-text mb-0">Judul Buku</p>
                                        <h4 class="font-weight-bolder">{{ $event_buku->buku->nama_buku }}</h4>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <p class="card-text mb-0">Tanggal</p>
                                        <h4 class="font-weight-bolder">{{ indonesian_date_format($event_buku->tgl_event) }}</h4>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <p class="card-text mb-0">No. Buku</p>
                                        <h4 class="font-weight-bolder">{{ $event_buku->buku->no_buku }}</h4>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <p class="card-text mb-0">Jumlah Peserta</p>
                                        <h4 class="font-weight-bolder">{{ $event_buku->jml_peserta }}</h4>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <p class="card-text mb-0">Lokasi Sosialisasi</p>
                                        <h4 class="font-weight-bolder">{{ $event_buku->satuan }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-12">
                        <h2 class="content-header-title float-left">Data Panitia</h2>
                    </div>
                </div>
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="panitia">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NRP</th>
                                            <th>Asal Satuan</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event_buku->personil as $personil)
                                            <tr>
                                                <td>{{ $personil->nama }}</td>
                                                <td>{{ $personil->nrp }}</td>
                                                <td>{{ $personil->nama_kesatuan }}</td>
                                                <td>{{ $personil->nama_jabatan_terakhir }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
        $('#panitia').DataTable();
    </script>
@endsection