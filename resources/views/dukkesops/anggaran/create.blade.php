@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('dukkesops/anggaran') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Anggaran</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('dukkesops.anggaran.store') }}" autocomplete="off" class="default-form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group form-input">
                                        <label class="form-label" for="judul">Judul Kegiatan</label>
                                        <input type="text" id="judul" class="form-control" placeholder="Judul Kegiatan" name="judul">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control form-control-lg" id="kategori_duk_tags" name="kategori">
                                            {{-- <option selected disabled>Kategori</option> --}}
                                            @foreach ($kategori_duk as $item)
                                                <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <label class="form-label">Tahun</label>
                                    <div class="input-group input-group-merge form-input">
                                        <input type="text" id="periode_setiap_bidang"
                                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun"
                                            readonly name="tahun"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group form-input mt-1">
                                        <label for="customFile1">Dokumen Anggaran</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_anggaran" class="custom-file-input" id="customFile1"
                                                required />
                                            <label class="custom-file-label" for="customFile1">Dokumen Anggaran</label>
                                        </div>
                                        <div class="invalid-feedback"></div>
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
@section('page_script')
    <script>
        $(function(){
            $("#kategori_duk_tags").select2({
                tags: true
            });
        })
    </script>
@endsection