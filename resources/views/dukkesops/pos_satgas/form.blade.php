@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="{{ url('dukkesops/pos-satgas') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Pos</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($pos_satgas))
                                <form action="{{ url('dukkesops/pos-satgas/'.$pos_satgas->id_pos) }}" autocomplete="off" class="default-form">
                                    @method('PUT')
                            @else
                                <form action="{{ url('dukkesops/pos-satgas') }}" method="POST" autocomplete="off" class="default-form">
                            @endif
                                    @csrf
                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="nama_pos">Nama Pos</label>
                                            <input type="text" id="nama_pos" class="form-control" placeholder="Nama Pos" name="nama_pos" value="{{ $pos_satgas->nama_pos ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-6">
                                            <label class="form-label">Satgas Ops</label>
                                            <select class="select2 form-control form-control-lg" name="id_satgas_ops">
                                                <option selected disabled>Satgas Ops</option>
                                                @foreach ($satgas_ops as $item)
                                                <option value="{{ $item->id_satgas_ops }}" @isset($pos_satgas) @if ($pos_satgas->id_satgas_ops === $item->id_satgas_ops) selected @endif
                                                    @endisset
                                                    >{{ $item->nama_kat_satgas }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="latitude">Koordinat Garis Lintang</label>
                                            <input type="text" id="latitude" class="form-control" placeholder="Koordinat Garis Lintang" name="latitude" value="{{ $pos_satgas->latitude ?? null }}">
                                            <div class="valid-feedback d-block">(Diisi menggunakan format desimal)</div>
                                        </div>
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="longitude">Koordinat Garis Bujur</label>
                                            <input type="text" id="longitude" class="form-control" placeholder="Koordinat Garis Bujur" name="longitude" value="{{ $pos_satgas->longitude ?? null }}">
                                            <div class="valid-feedback d-block">(Diisi menggunakan format desimal)</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="keterangan">Keterangan</label>
                                            <input type="text" id="keterangan" class="form-control" placeholder="Keterangan" name="keterangan" value="{{ $pos_satgas->keterangan ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="tipe">Tipe</label>
                                            <select class="select2 form-control form-control-lg" name="tipe">
                                                <option selected disabled>Tipe</option>
                                                @foreach ($tipe as $t)
                                                <option value="{{ $t }}" @isset($pos_satgas) @if ($pos_satgas->tipe === $t) selected @endif
                                                    @endisset
                                                    >{{ $t }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <label class="form-label mb-1">Apakah Daerah ini Endemik?</label>
                                        <div class="demo-inline-spacing">
                                            <div class="custom-control custom-radio mt-0">
                                                <input type="radio" id="ya" name="status_endemik" class="custom-control-input" value="1" @isset($pos_satgas) @if ($pos_satgas->status_endemik === 1) checked @endif
                                                @endisset
                                                />
                                                <label class="custom-control-label" for="ya">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-0">
                                                <input type="radio" id="tidak" name="status_endemik" class="custom-control-input" value="0" @isset($pos_satgas) @if ($pos_satgas->status_endemik === 0) checked @endif
                                                @endisset
                                                />
                                                <label class="custom-control-label" for="tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback"></div>

                                    <h5 class="mt-2"><b>Geomedik</b></h5>

                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label">Geografis</label>
                                            <select class="select2 form-control form-control-lg" name="id_geografis">
                                                <option selected disabled>Geografis</option>
                                                @foreach ($geografis as $g)
                                                <option value="{{ $g->id_geografis }}" @isset($pos_satgas) @if ($pos_satgas->id_geografis === $g->id_geografis) selected @endif
                                                    @endisset
                                                    >{{ $g->jenis_geografis }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-3">
                                            <label class="form-label" for="pendapatan">Pendapatan Per Kapita</label>
                                            <input type="text" id="pendapatan" class="form-control" placeholder="Pendapatan Per Kapita" name="pendapatan" value="{{ $pos_satgas->pendapatan ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-3">
                                            <label class="form-label" for="kepadatan">Kepadatan Penduduk</label>
                                            <input type="text" id="kepadatan" class="form-control" placeholder="Kepadatan Penduduk" name="kepadatan" value="{{ $pos_satgas->kepadatan ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="ekonomi">Ekonomi</label>
                                            <input type="text" id="ekonomi" class="form-control" placeholder="Ekonomi" name="ekonomi" value="{{ $pos_satgas->ekonomi ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="sosial">Sosial</label>
                                            <input type="text" id="sosial" class="form-control" placeholder="Sosial" name="sosial" value="{{ $pos_satgas->sosial ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="budaya">Budaya</label>
                                            <input type="text" id="budaya" class="form-control" placeholder="Budaya" name="budaya" value="{{ $pos_satgas->budaya ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input col-6">
                                            <label class="form-label" for="ideologi">Ideologi</label>
                                            <input type="text" id="ideologi" class="form-control" placeholder="Ideologi" name="ideologi" value="{{ $pos_satgas->ideologi ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12 text-right">
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
<!-- END: Content-->
@endsection