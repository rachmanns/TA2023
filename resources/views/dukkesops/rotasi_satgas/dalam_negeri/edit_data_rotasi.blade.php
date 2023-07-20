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
                <a href="{{ url('dukkesops/rotasi-satgas/show/'.$penugasan_pos->id_tugas) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">Edit Data Rotasi Pos - {{ $penugasan_pos->pos_satgas->nama_pos }}</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> <b> {{ $penugasan_pos->penugasan_satgas->nama_satgas }} </b> - {{ $penugasan_pos->penugasan_satgas->nama_batalyon}}</h4>
                        </div>
                        <form action="{{ url('dukkesops/penugasan-pos/'.$penugasan_pos->id_penugasan_pos) }}" class="default-form" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group form-input">
                                    <label class="form-label">Nama Personil Kesehatan</label>
                                    <input type="text" name="nama_ketua" class="form-control" placeholder="Nama Personil Kesehatan" value="{{ $penugasan_pos->nama_ketua }}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Jumlah Personil</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Personil" name="jml_personil" value="{{ $penugasan_pos->jml_personil }}" />
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control" placeholder="No. Telepon" name="no_telp" value="{{ $penugasan_pos->no_telp }}"/>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="font-weight-bolder mt-1">Perangkat</h5>
                                    </div>
                                    @foreach ($master_bekkes as $mb)
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group form-input">
                                                        <div class="col-12">
                                                            <label class="form-label">{{ $mb->nama_bekkes }}</label>
                                                            <input type="number" class="form-control" placeholder="Jumlah Kat" name="id_mas_bek[{{ $mb->id_mas_bek }}]" value="{{ $bpp[$mb->id_mas_bek] ?? 0 }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <div class="col-12">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-primary">Simpan Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection