@extends('partials.template')

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row pb-1">
            <div class="col-6">
                <a href="/matfaskes/pengadaan"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Kembali</span>
                    </button></a>
            </div>
        </div>
        <div class="row pb-1">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Kegiatan Pengadaan</h2>
            </div>
        </div>
        <div class="content-body">
            <!-- Multilingual -->
            <section id="multilingual-datatable">
                @if (isset($kontrak))
                <form action="{{ route('matfaskes.pengadaan.update',$kontrak->id_kontrak) }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @else
                    <form action="{{ route('matfaskes.pengadaan.store') }}" class="default-form" autocomplete="off">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="nama_kegiatan">Nama Kegiatan*</label>
                                                    <input type="text" id="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan" value="{{ $kontrak->nama_kegiatan??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="tgl_kegiatan_pengadaan">Tanggal Kegiatan Pengadaan*</label>
                                                    <input type="text" id="tgl_kegiatan_pengadaan" class="form-control flatpickr-basic" placeholder="Tanggal Kegiatan Pengadaan" name="tgl_kegiatan_pengadaan" value="{{ $kontrak->tgl_kegiatan_pengadaan??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-sm-1">
                                                <label>Pilih Sumber Dipa*</label>
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="kode_dipa1" name="kode_dipa" class="custom-control-input" value="DIPPUS" @isset($kontrak) {{ ($kontrak->kode_dipa == 'DIPPUS')?'checked':'' }} @endisset />
                                                        <label class="custom-control-label" for="kode_dipa1">Kewenangan Pusat</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="kode_dipa2" name="kode_dipa" class="custom-control-input" value="DIPDAR" @isset($kontrak) {{ ($kontrak->kode_dipa == 'DIPDAR')?'checked':'' }} @endisset />
                                                        <label class="custom-control-label" for="kode_dipa2">Kewenangan Daerah</label>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-md-6 col-12 mb-sm-1">
                                                <label>Pilih Jenis Pengadaan*</label>
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="alkes" name="kode_kontrak" class="custom-control-input" value="A" @isset($kontrak) {{ ($kontrak->kode_kontrak == 'A')?'checked':'' }} @endisset />
                                                        <label class="custom-control-label" for="alkes">Pengadaan Alkes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="bekkes" name="kode_kontrak" class="custom-control-input" value="P" @isset($kontrak) {{ ($kontrak->kode_kontrak == 'P')?'checked':'' }} @endisset />
                                                        <label class="custom-control-label" for="bekkes">Pengadaan Bekkes</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="no_dipa">Nomor Dipa/Kep*</label>
                                                    <input type="text" id="no_dipa" class="form-control" placeholder="Nomor Dipa/Kep" name="no_dipa" value="{{ $kontrak->no_dipa??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group bg-white form-input">
                                                    <label class="form-label" for="tgl_dipa">Tanggal Dipa/Kep*</label>
                                                    <input type="text" id="tgl_dipa" class="form-control flatpickr-basic" placeholder="Tanggal Dipa/Kep" name="tgl_dipa" value="{{ $kontrak->tgl_dipa??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="jumlah">Jumlah Anggaran*</label>
                                                    <input type="text" id="jumlah" class="form-control rupiah" placeholder="Jumlah Anggaran" name="jumlah" value="{{ isset($kontrak)?"Rp" . number_format($kontrak->jumlah,0,',','.'):null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 col-12 mb-1">
                                                <label>Apakah sudah ada Dokumen Kontrak ?</label>
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="sudah-ada" name="dokumen" class="custom-control-input" />
                                                        <label class="custom-control-label" for="sudah-ada">Sudah Ada</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mt-50">
                                                        <input type="radio" id="belum-ada" name="dokumen" class="custom-control-input" />
                                                        <label class="custom-control-label" for="belum-ada">Belum Ada</label>
                                                    </div> 
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div> --}}
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="nomor_kontrak">Nomor Kontrak/SPK</label>
                                                    <input type="text" id="nomor_kontrak" class="form-control" placeholder="Nomor Kontrak/SPK" name="nomor_kontrak" value="{{ $kontrak->nomor_kontrak??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label for="tgl">Tanggal Kontrak</label>
                                                    <input type="text" id="tgl_kontrak" class="form-control flatpickr-basic" placeholder="Tanggal Kontrak" name="tgl_kontrak" value="{{ $kontrak->tgl_kontrak??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="masa_berlaku">Masa Berlaku (Hari)</label>
                                                    <input type="text" id="masa_berlaku" class="form-control" placeholder="Masa Berlaku" name="masa_berlaku" value="{{ $kontrak->masa_berlaku??null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="nominal_kontrak">Nominal Kontrak*</label>
                                                    <input type="text" id="nominal_kontrak" class="form-control rupiah" placeholder="Nominal Kontrak" name="nominal_kontrak" value="{{ isset($kontrak)?"Rp" . number_format($kontrak->jumlah,0,',','.'):null }}" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="sisa">Sisa Anggaran</label>
                                                    <input type="text" id="sisa" class="form-control rupiah" placeholder="Sisa Anggaran" />
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group form-input">
                                                    <label for="id_vendor">Pilih Pelaksana*</label>
                                                    <select id="id_vendor" class="select2 form-control form-control-lg" name="id_vendor">
                                                        <option selected disabled>Pilih Pelaksana</option>
                                                        @foreach ($vendor as $item)
                                                        <option value="{{ $item->id_vendor }}" @isset($kontrak) {{ ($kontrak->id_vendor == $item->id_vendor)?'selected':'' }} @endisset>{{ $item->nama_vendor }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label for="dok">Dokumen Kontrak</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_kontrak" class="custom-file-input" id="file_kontrak" />
                                                <label class="custom-file-label" for="file_kontrak">Dokumen Kontrak</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label for="dok">Dokumen Pendukung (Jika belum ada kontrak)</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pendukung" name="file_pendukung" />
                                                <label class="custom-file-label" for="pendukung">Dokumen Pendukung (Jika belum ada kontrak)</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label for="dok">Dokumen Dasar Pengadaan</label>
                                            <div class="custom-file">
                                                <input type="file" name="dasar_pengadaan" class="custom-file-input" id="dasar_pengadaan" />
                                                <label class="custom-file-label" for="dasar_pengadaan">Dokumen Dasar Pengadaan</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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