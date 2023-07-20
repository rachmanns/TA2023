@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bidum/anggaran/hutang') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ $button }}</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($hutang))
                                <form action="{{ url('bidum/anggaran/hutang/'.$hutang->id_hutang) }}" autocomplete="off" class="default-form" >
                                    @method('PUT')
                            @else
                                <form action="{{ url('bidum/anggaran/hutang') }}" autocomplete="off" class="default-form" method="post">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="form-group form-input">
                                        <label class="form-label">Nama Batalyon</label>
                                        <input type="text"class="form-control" placeholder="Nama Batalyon" name="batalyon" value="{{ $hutang->batalyon??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Operasi</label>
                                        <input type="text"class="form-control" placeholder="Operasi" name="operasi" value="{{ $hutang->operasi??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Jumlah Pers</label>
                                        <input type="number"class="form-control" placeholder="Jumlah Pers" name="jml_pers" value="{{ $hutang->jml_pers??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Indeks</label>
                                        <input type="number"class="form-control" placeholder="Indeks" name="indeks" value="{{ $hutang->indeks??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Jumlah Tagihan</label>
                                        <input type="number"class="form-control" placeholder="Jumlah Tagihan" name="jml_tagihan" value="{{ $hutang->jml_tagihan??null }}" id="jml_tagihan">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Pembayaran</label>
                                        <input type="number"class="form-control" placeholder="Pembayaran" name="jml_bayar" value="{{ $hutang->jml_bayar??null }}" id="jml_bayar">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Sisa Tagihan</label>
                                        <input type="number"class="form-control" placeholder="Sisa Tagihan" id="sisa_tagihan" disabled>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Tagihan</label>
                                        <input type="text"class="form-control flatpickr-basic" placeholder="Tanggal Tagihan" name="tgl_hutang" value="{{ $hutang->tgl_hutang ?? null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Tanggal Pelunasan</label>
                                        <input type="text"class="form-control flatpickr-basic" placeholder="Tanggal Pelunasan" name="tgl_lunas" value="{{ $hutang->tgl_lunas ?? null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control" rows="3" placeholder="Keterangan" name="keterangan">{{ $hutang->keterangan??null }}</textarea>
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

        @if (isset($hutang))
            sisa_tagihan('{{ $hutang->jml_tagihan }}', '{{ $hutang->jml_bayar }}');
        @endif

        $('#jml_tagihan').keyup(function(){
            sisa_tagihan($(this).val(),$('#jml_bayar').val())
        });

        $('#jml_bayar').keyup(function(){
            sisa_tagihan($('#jml_tagihan').val(),$(this).val())
        });

        function sisa_tagihan(jml_tagihan, jml_bayar) {
            let selisih = jml_tagihan - jml_bayar;
            $('#sisa_tagihan').val(selisih);
        }
    </script>
@endsection