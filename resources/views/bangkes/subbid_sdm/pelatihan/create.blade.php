@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    {{-- <a href="{{ route('bangkes.pelatihan.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a> --}}
                    <a href="{{ route('bangkes.pelatihan.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                {{-- <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Data Pelatihan</h2>
                </div> --}}
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Data Pelatihan</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($pelatihan_bangkes))
                                <form action="{{ route('bangkes.pelatihan.update',$pelatihan_bangkes->id_pelatihan_bangkes) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ route('bangkes.pelatihan.store') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <div class="col-md-12 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tgl_pelaksanaan">Tanggal Pelaksanaan</label>
                                                <input type="text" id="tgl_pelaksanaan" class="form-control flatpickr-basic" placeholder="Tanggal Pelaksanaan" name="tgl_pelaksanaan" value="{{ $pelatihan_bangkes->tgl_pelaksanaan??null }}" />
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_jenis_pelatihan">Nama Pelatihan</label>
                                                <select name="id_jenis_pelatihan" id="id_jenis_pelatihan" class="form-control select2">
                                                    <option selected disabled>Pilih Nama Pelatihan</option>
                                                    @foreach ($jenis_pelatihan as $jp)
                                                        <option value="{{ $jp->id_jenis_pelatihan }}"
                                                            @isset($pelatihan_bangkes)
                                                                {{ ($pelatihan_bangkes->id_jenis_pelatihan == $jp->id_jenis_pelatihan)?'selected':'' }}
                                                            @endisset
                                                            >{{ $jp->nama_pelatihan }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                        <div class="col-md-6 col-12 form-input">   
                                            <label class="form-label">Tempat Pelatihan</label>          
                                            <input type="text" name="tempat" id="tempat" class="form-control" value="{{ $pelatihan_bangkes->tempat??null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
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