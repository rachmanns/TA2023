@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('dukkesops/werving') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Rikkes Werving</h2>
                </div>
            </div>  
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('dukkesops.werving.preview') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group form-input">
                                        <label class="form-label">Nama Kategori</label>
                                        <select class="select2 form-control form-control-lg" name="id_kat_duk">
                                            <option selected disabled>Nama Kategori</option>
                                            @foreach ($kategori_duk as $item)
                                                <option value="{{ $item->id_kat_duk }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="judul">Judul Kegiatan</label>
                                        <input type="text" id="judul" class="form-control" placeholder="Judul Kegiatan" name="judul_kegiatan">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="tempat">Tempat Pelaksana</label>
                                        <input type="text" id="tempat" class="form-control" placeholder="Tempat Pelaksana" name="tempat">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="tgl">Tanggal Pelaksana</label>
                                        <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal Pelaksana" name="tanggal" />
                                    </div>
                                    <label class="form-label">Tahun Anggaran</label>
                                    <div class="input-group input-group-merge form-input">
                                        <input type="text" id="periode_setiap_bidang"
                                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran" name="tahun_anggaran"
                                            readonly />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <label for="customFile1">Dokumen Werving</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_kegiatan" class="custom-file-input" id="customFile1"
                                                required />
                                            <label class="custom-file-label" for="customFile1">Dokumen Werving</label>
                                        </div>
                                        <div class="text-right"><a href="{{ url('template/werving-dukkesops') }}"><u>Download Template</u></a></div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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