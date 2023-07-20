@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/pelatihan/'.Request::segment(4)) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Data Peserta</h2>
                </div>
            </div> 
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($peserta_bangkes))
                                <form action="{{ url('bangkes/peserta').'/'.$peserta_bangkes->id_peserta_bangkes }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ url('bangkes/peserta') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <input type="hidden" name="id_pelatihan_bangkes" value="{{ $id_pelatihan_bangkes }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="matra">Matra</label>
                                                <select name="matra" id="matra" class="select2 form-control">
                                                    @foreach ($matra as $m)
                                                        <option value="{{ $m }}" 
                                                        @isset($peserta_bangkes)
                                                            {{ ($peserta_bangkes->matra==$m)?'selected':'' }}
                                                        @endisset
                                                        >{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Nama</label>
                                                <input type="text" id="nama" class="form-control" placeholder="Nama" name="nama" value="{{ $peserta_bangkes->nama??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                        <div class="col-md-6 col-12 form-input">   
                                            <label class="form-label">NRP</label>          
                                            <input type="text" name="nrp" id="nrp" class="form-control" value="{{ $peserta_bangkes->nrp??null }}">
                                            <div class="invalid-feedback"></div>                                      
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="pangkat_korps">Pangkat/Korps</label>
                                                <input type="text" id="pangkat_korps" class="form-control" placeholder="Pangkat/Korps" name="pangkat_korps" value="{{ $peserta_bangkes->pangkat_korps??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="satuan">Satuan</label>
                                                <input type="text" id="satuan" class="form-control" placeholder="Satuan" name="satuan" value="{{ $peserta_bangkes->satuan??null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>                                       
                                        </div>
                                    </div>  
                                    <div class="form-group form-input mt-1">
                                        <label class="form-label" for="ket">Keterangan</label>
                                        <textarea rows="3" id="ket" class="form-control" placeholder="Keterangan" name="keterangan">{{ $peserta_bangkes->keterangan??null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection