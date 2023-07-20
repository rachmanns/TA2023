@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/buku') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Data Buku</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($buku))
                                <form action="{{ route('bangkes.buku.update',$buku->id_buku) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ route('bangkes.buku.store') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="no">No. Buku</label>
                                                <input type="text" id="no" class="form-control" placeholder="No. Buku" name="no_buku" value="{{ $buku->no_buku??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="judul">Judul</label>
                                                <input type="text" id="judul" class="form-control" placeholder="Judul" name="nama_buku" value="{{ $buku->nama_buku??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_kat_buku">Kategori</label>
                                                <select name="id_kat_buku" id="id_kat_buku" class="form-control select2">
                                                    <option selected disabled>Pilih Kategori</option>
                                                    @foreach ($kat_buku as $item)
                                                        <option value="{{ $item->id_kat_buku }}"
                                                            @isset($buku)
                                                                {{ ($buku->id_kat_buku == $item->id_kat_buku)?'selected':'' }}
                                                            @endisset
                                                            >{{ $item->nama_kat_buku }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label" for="tahun_terbit">Tahun Terbit</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="tahun_terbit" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Terbit" name="tahun_terbit"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="abstrak">Abstrak</label>
                                        <textarea name="abstraksi" id="abstrak" class="form-control" cols="30" rows="10">{{ $buku->abstraksi??null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="customFile1">Upload File</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_buku" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Upload File</label>
                                        </div>
                                        <div class="invalid-feedback">File harus ada</div>
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
            $("#tahun_terbit").val({{ $buku->tahun_terbit??null }})
        })
    </script>
@endsection