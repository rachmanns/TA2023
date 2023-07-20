@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/wahana-internship') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Data Internship</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($internship))
                                <form action="{{ url('bangkes/wahana-internship/'.$internship->id_internship) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ route('bangkes.wahana-internship.store') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
                                                <input type="text" id="tgl_mulai" class="form-control flatpickr-basic" placeholder="Tanggal Mulai" name="tgl_mulai" value="{{ $internship->tgl_mulai ?? null }}" />
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Nama</label>
                                                <input type="text" id="nama" class="form-control" placeholder="Nama" name="nama" value="{{ $internship->nama ?? null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Korps</label>
                                            <input type="text" name="korps" id="korps" class="form-control" placeholder="Korps" value="{{ $internship->korps ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">   
                                            <label class="form-label">Pangkat</label>
                                            <input type="text" name="pangkat" id="pangkat" class="form-control" placeholder="Pangkat" value="{{ $internship->pangkat ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nrp">NRP</label>
                                                <input type="text" id="nrp" class="form-control" placeholder="NRP" name="nrp" value="{{ $internship->nrp ?? null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                        <div class="col-md-6 col-12 form-input">   
                                            <label class="form-label">Kesatuan</label>
                                            <input type="text" name="kesatuan" id="kesatuan" class="form-control" placeholder="Kesatuan" value="{{ $internship->kesatuan ?? null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jabatan">Jabatan</label>
                                                <input type="text" id="jabatan" class="form-control" placeholder="Jabatan" name="jabatan" value="{{ $internship->jabatan ?? null }}">
                                                <div class="invalid-feedback"></div>
                                            </div>     
                                        </div>
                                        <div class="col-md-6 col-12">   
                                            <label class="form-label">Matra</label>
                                            <div class="demo-inline-spacing">
                                                <div class="custom-control custom-radio mt-50">
                                                    <input type="radio" id="tni_ad" name="matra" class="custom-control-input" value="TNI AD"
                                                    @isset($internship)
                                                        {{ $internship->matra == 'TNI AD'?'checked':'' }}
                                                    @endisset
                                                    />
                                                    <label class="custom-control-label" for="tni_ad">TNI AD</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-50">
                                                    <input type="radio" id="tni_al" name="matra" class="custom-control-input" value="TNI AL"
                                                    @isset($internship)
                                                        {{ $internship->matra == 'TNI AL'?'checked':'' }}
                                                    @endisset/>
                                                    <label class="custom-control-label" for="tni_al">TNI AL</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-50">
                                                    <input type="radio" id="tni_au" name="matra" class="custom-control-input" value="TNI AU"
                                                    @isset($internship)
                                                        {{ $internship->matra == 'TNI AU'?'checked':'' }}
                                                    @endisset/>
                                                    <label class="custom-control-label" for="tni_au">TNI AU</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group form-input">
                                        <label class="form-label" for="wahana">Wahana Program</label>
                                        <input type="text" id="wahana" class="form-control" placeholder="Wahana Program" name="wahana" value="{{ $internship->wahana ?? null }}">
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

        $('#tgl_mulai').change(function(){
            let tgl_mulai = $(this).val();
            let tgl_selesai = moment(tgl_mulai).add(1, 'years').format("YYYY-MM-DD")
        })
    </script>
@endsection