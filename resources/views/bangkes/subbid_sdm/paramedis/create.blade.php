@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/paramedis') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Daftar Paramedis</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($paramedis))
                                <form action="{{ route('bangkes.paramedis.update',$paramedis->id_paramedis) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ url('bangkes/paramedis') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-1 form-input">
                                        <div class="col-md-2 col-6">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="militer" name="klasifikasi" class="custom-control-input" value="militer"/>
                                                <label class="custom-control-label" for="militer">Militer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="pns" name="klasifikasi" class="custom-control-input" value="pns"/>
                                                <label class="custom-control-label" for="pns">PNS</label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Matra</label>
                                            <select class="select2 form-control form-control-lg" id="matra" name="matra">
                                                <option disabled selected>Matra</option>
                                                @foreach ($matra as $m)
                                                    <option value="{{ $m }}" 
                                                        @isset($paramedis)
                                                            {{ ($paramedis->matra == $m)?'selected':''}}
                                                        @endisset
                                                    >{{ $m }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Jenjang</label>
                                            <select class="select2 form-control form-control-lg" id="jenjang" name="jenjang">
                                                <option disabled selected>Jenjang</option>
                                                @foreach ($jenjang as $j)
                                                    <option value="{{ $j }}"
                                                        @isset($paramedis)
                                                            {{ ($paramedis->jenjang == $j)?'selected':''}}
                                                        @endisset
                                                    >{{ $j }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12 col-12 form-input mt-1">   
                                            <label class="form-label">Sebaran</label>          
                                            <select class="select2 form-control form-control-lg" id="id_rs" name="id_rs">
                                                <option disabled selected>Sebaran</option>
                                                @foreach ($rumah_sakit as $rs)
                                                    <option value="{{ $rs->id_rs }}"
                                                        @isset($paramedis)
                                                            {{ ($paramedis->rumah_sakit->first()->id_rs == $rs->id_rs)?'selected':''}}
                                                        @endisset    
                                                    >{{ $rs->nama_rs }}</option>
                                                @endforeach
                                            </select>                          
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Jenis Paramedis</label>
                                            <select class="select2 form-control form-control-lg" id="id_jenis_paramedis" name="id_jenis_paramedis">
                                                <option disabled selected>Jenis Paramedis</option>
                                                @foreach ($jenis_paramedis as $jp)
                                                    <option value="{{ $jp->id_jenis_paramedis }}"
                                                        @isset($paramedis)
                                                            {{ ($paramedis->id_jenis_paramedis == $jp->id_jenis_paramedis)?'selected':''}}
                                                        @endisset    
                                                    >{{ $jp->nama_jenis_paramedis }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Tahun Ijazah</label>
                                                <input type="text" id="jenis" class="form-control" placeholder="Tahun Ijazah" name="jenis_ijazah" value="{{ $paramedis->jenis_ijazah??null }}">
                                                <div class="invalid-feedback">Tahun Ijazah harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Nama</label>
                                                <input type="text" id="nama" class="form-control" placeholder="Nama" name="nama_paramedis" value="{{ $paramedis->nama_paramedis??null }}">
                                                <div class="invalid-feedback">Nama harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="pangkat">Pangkat</label>
                                                <input type="text" id="pangkat" class="form-control" placeholder="Pangkat" name="pangkat" value="{{ $paramedis->pangkat??null }}">
                                                <div class="invalid-feedback">Pangkat harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nrp">NRP/NIP</label>
                                                <input type="text" id="nrp" class="form-control" placeholder="NRP/NIP" name="no_identitas" value="{{ $paramedis->no_identitas??null }}">
                                                <div class="invalid-feedback">NRP/NIP harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12 form-input">           
                                            <label class="form-label">Satuan Asal</label>  
                                            <input type="text" name="satuan_asal" id="satuan_asal" class="form-control" value="{{ $paramedis->satuan_asal??null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="struktural">Jabatan Struktural</label>
                                                <input type="text" id="struktural" class="form-control" placeholder="Jabatan Struktural" name="jabatan_struktural" value="{{ $paramedis->jabatan_struktural??null }}">
                                                <div class="invalid-feedback">Jabatan Struktural harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="fungsional">Jabatan Fungsional</label>
                                                <input type="text" id="fungsional" class="form-control" placeholder="Jabatan Fungsional" name="jabatan_fungsional" value="{{ $paramedis->jabatan_fungsional??null }}">
                                                <div class="invalid-feedback">Jabatan Fungsional harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>  
                                    <div class="form-group form-input">
                                        <label class="form-label" for="ket">Keterangan</label>
                                        <textarea rows="3" id="ket" class="form-control" placeholder="Keterangan" name="keterangan">{{ $paramedis->keterangan??null }}</textarea>
                                        <div class="invalid-feedback">Keterangan harus diisi</div>
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

        @if(isset($paramedis))
            $("input[name='klasifikasi'][value='{{ $paramedis->klasifikasi }}']").prop("checked",true);
        @endif
    </script>
@endsection