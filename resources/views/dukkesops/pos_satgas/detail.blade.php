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
                    <h2 class="content-header-title float-left">Detail Pos</h2>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Edit Data
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/dukkesops/pos-satgas/{{ $pos_satgas->id_pos }}/edit">Edit Detail Pos </a>
                            <a class="dropdown-item" href="/dukkesops/pos-satgas/faskes-rujukan/{{ $pos_satgas->id_pos }}">Edit Faskes Rujukan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="card-title"> Detail Pos <b> {{ $pos_satgas->nama_pos }} </b> </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Nama Pos</h5>
                                    <span class="text-secondary">{{ $pos_satgas->nama_pos }}</span>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Satgas Pos</h5>
                                    <span class="text-secondary">{{ $pos_satgas->satgas_ops->nama_kat_satgas }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Garis Lintang</h5>
                                    <span class="text-secondary">{{ $pos_satgas->latitude }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Garis Bujur</h5>
                                    <span class="text-secondary">{{ $pos_satgas->latitude }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Endemik</h5>                                    
                                    @if ($pos_satgas->status_endemik === 1)
                                        <span class="badge badge-light-danger">
                                            Ya
                                        </span>
                                    @else
                                        <span class="badge badge-light-success">
                                            Tidak
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="card-title"> Detail Geomedik </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row mb-2">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Geografis</h5>
                                    <span class="text-secondary" id="jenis_geografis">{{ $pos_satgas->geografis->jenis_geografis??null }}</span>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Pendapatan Per Kapita</h5>
                                    <span class="text-secondary" id="pendapatan">{{ $pos_satgas->pendapatan }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Kepadatan Penduduk</h5>
                                    <span class="text-secondary" id="kepadatan">{{ $pos_satgas->kepadatan }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Ekonomi</h5>
                                    <span class="text-secondary" id="ekonomi">{{ $pos_satgas->ekonomi }}</span>
                                </div>
                                <div class="col-xl-2 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Sosial</h5>
                                    <span class="text-secondary" id="sosial">{{ $pos_satgas->budaya }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Budaya</h5>
                                    <span class="text-secondary" id="budaya">{{ $pos_satgas->budaya }}</span>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <h5 class="font-weight-bolder">Ideologi</h5>
                                    <span class="text-secondary" id="ideologi">{{ $pos_satgas->ideologi }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <div class="card-title"> Faskes Rujukan </div>
                            </div>
                            <table class="table table-striped table-responsive-xl" id="faskes-terdekat">
                                <thead>
                                    <tr>
                                        <th>Nama RS</th>
                                        <th>Kategori</th>
                                        <th>Jarak</th>
                                        <th>Evakuasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rs_pos as $rs)
                                    <tr>
                                        <td>{{ $rs->rs_militer->nama_rs ?? $rs->rs_pemda_swasta->nama_rs }}</td>
                                        <td>{{ $rs->tipe == 'M' ? 'Militer' : 'Pemda / Swasta' }}</td>
                                        <td>{{ $rs->jarak }} km</td>
                                        <td>{{ $rs->evakuasi }}</td>
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
    var table = $('#faskes-terdekat').DataTable({
        
    });
</script>
@endsection