@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row pb-1">
                <div class="col-6">
                    <a href="{{ route('matfaskes.hibah.index') }}"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Back</span>
                    </button></a>
                </div>
            </div>   
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Kegiatan Hibah</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @if (isset($ba_hibah))
                                    <form action="{{ route('matfaskes.hibah.update',$ba_hibah->id_ba_hibah) }}" class="default-form" autocomplete="off">
                                        @method('PUT')
                                @else
                                    <form action="{{ route('matfaskes.hibah.store') }}" class="default-form" autocomplete="off">
                                @endif
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group form-input mt-1">
                                            <label class="form-label" for="nomor">Nomor Berita Acara</label>
                                            <input type="text" id="nomor" class="form-control" placeholder="Nomor Berita Acara" name="no_ba_hibah" value="{{ $ba_hibah->no_ba_hibah??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input mt-1">
                                            <label class="form-label" for="nomor">Nominal Hibah</label>
                                            <input type="text" id="nomor" class="form-control rupiah" placeholder="Nominal Hibah" name="nominal" value="{{ isset($ba_hibah)?"Rp" . number_format($ba_hibah->nominal,0,',','.'):null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="pelaksana_tktm">Pemberi Hibah</label>
                                            <select name="id_vendor" id="" class="form-control select2">
                                                    <option selected disabled>Pilih Pelaksana</option>
                                                @foreach ($vendor as $item)
                                                    <option value="{{ $item->id_vendor }}"
                                                        @isset($ba_hibah)
                                                            {{ ($ba_hibah->id_vendor == $item->id_vendor)?'selected':'' }}
                                                        @endisset
                                                        >{{ $item->nama_vendor }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group bg-white form-input">
                                            <label class="form-label" for="nomor">Tanggal Hibah</label>
                                            <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="Tanggal Hibah" name="tgl_ba_hibah" value="{{ $ba_hibah->tgl_ba_hibah??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>        
                                        <label>Jenis Barang Hibah</label>
                                        <div class="row form-input">
                                            <div class="col-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="bekkes" name="kode_ba_hibah" value="P" class="custom-control-input" 
                                                    @isset($ba_hibah)
                                                       {{ ($ba_hibah->kode_ba_hibah == 'P')?'checked':'' }} 
                                                    @endisset
                                                    />
                                                    <label class="custom-control-label" for="bekkes">Bekkes</label>
                                                </div>   
                                            </div>
                                            <div class="col-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="alkes" name="kode_ba_hibah" value="A" class="custom-control-input"
                                                    @isset($ba_hibah)
                                                       {{ ($ba_hibah->kode_ba_hibah == 'A')?'checked':'' }} 
                                                    @endisset
                                                    />
                                                    <label class="custom-control-label" for="alkes">Alkes</label>
                                                </div>   
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>                     
                                        <div class="form-group form-input mt-1">
                                            <label for="">File Berita Acara</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_ba_hibah" class="custom-file-input" id="customFile1" />
                                                <label class="custom-file-label" for="customFile1">Unggah Berita Acara</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var rupiah = document.getElementsByClassName('rupiah')
        for (const rp of rupiah) {
            rp.addEventListener('keyup', function(e) {
                rp.value = formatRupiah(this.value, 'Rp. ');
            });
        }
    </script>
@endsection
