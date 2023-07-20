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
                    <a href="{{ route('bangkes.jadwal-supervisi.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Detail Supervisi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <p class="card-text mb-0">Tanggal</p> <br>
                                        <h3 class="font-weight-bolder">{{ indonesian_date_format($supervisi->tgl) }}</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="card-text mb-0">Topik</p> <br>
                                        <h3 class="font-weight-bolder">{{ $supervisi->topik }}</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="card-text mb-0">Lokasi Sosialisasi</p> <br>
                                        <h3 class="font-weight-bolder">{{ $supervisi->satuan }}</h3>
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
                                            <th>Kategori</th>
                                            <th>NRP</th>
                                            <th>Asal Satuan</th>
                                            <th>Jabatan</th>
                                            {{-- <th class="text-center">Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supervisi->panitia_supervisi as $ps)
                                            <tr>
                                                <td>{{ $ps->nama }}</td>
                                                <td>{{ ($ps->status=="EXT")?'Panitia Eksternal':'Panitia Internal' }}</td>
                                                <td>{{ $ps->nrp }}</td>
                                                <td>{{ $ps->satuan }}</td>
                                                <td>{{ $ps->jabatan }}</td>
                                                {{-- <td><div class='text-center'><a href='#'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div></td> --}}
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