@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row pb-1">
                <div class="col-6">
                    <a href="{{ url('kerma/mou') }}"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Back</span>
                    </button></a>
                </div>
            </div>   
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Data MoU</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @if (isset($mou))
                                    <form action="{{ route('kerma.mou.update',$mou->id_doc_kerma) }}" class="default-form" autocomplete="off">
                                        @method('PUT')
                                @else
                                    <form action="{{ route('kerma.mou.store') }}" class="default-form" autocomplete="off">
                                @endif
                                    @csrf
                                    <div class="card-body">
                                        <label class="form-label mb-1 form-input">Jenis</label>
                                        <div class="row mb-1">
                                            @foreach ($jenis_doc_kerma as $item)
                                                <div class="col">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="{{ $item }}" name="jenis_doc_kerma" class="custom-control-input" value="{{ $item }}" 
                                                        @isset($mou)
                                                            {{ ($mou->jenis_doc_kerma == $item)?'checked':'' }}
                                                        @endisset
                                                        />
                                                        <label class="custom-control-label" for="{{ $item }}">{{$item}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="pihak">Pihak</label>
                                            <input type="text" id="pihak" class="form-control" placeholder="Pihak" name="pihak" value="{{ $mou->pihak??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="lembaga">Nama Kementrian/Lembaga</label>
                                            <input type="text" id="lembaga" class="form-control" placeholder="Nama Kementrian/ Lembaga" name="lembaga" value="{{ $mou->lembaga??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="no_doc">Nomor</label>
                                            <input type="text" id="no_doc" class="form-control" placeholder="Nomor" name="no_doc" value="{{ $mou->no_doc??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="tgl_terbit">Tanggal Terbit</label>
                                            <input type="text" id="tgl_terbit" class="form-control flatpickr-basic" placeholder="Tanggal Terbit" name="tgl_terbit" value="{{ $mou->tgl_terbit??null }}" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="tgl_berakhir">Tanggal Berakhir</label>
                                            <input type="text" id="tgl_berakhir" class="form-control flatpickr-basic" placeholder="Tanggal Berakhir" name="tgl_berakhir" value="{{ $mou->tgl_berakhir??null }}" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="select2 form-control form-control-lg">
                                                <option selected disabled>Status</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="nonaktif">Nonaktif</option>
                                                <option value="nonaktif">Perpanjang</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group form-input">
                                            <label class="form-label" for="desc">Deskripsi</label>
                                            <input type="text" id="desc" class="form-control" placeholder="Deskripsi" name="desc" value="{{ $mou->desc??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="keterangan">Keterangan</label>
                                            <input type="text" id="keterangan" class="form-control" placeholder="Keterangan" name="keterangan" value="{{ $mou->keterangan??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="id_parent_doc">Kontrak Sebelumnya</label>
                                            <select class="select2 form-control form-control-lg" name="id_parent_doc">
                                                <option selected disabled>Pilih kontrak sebelumnya</option>
                                                @foreach ($doc_kerma as $item)
                                                    <option value="{{ $item->id_doc_kerma }}"
                                                        @isset($mou)
                                                            {{ ($mou->id_parent_doc == $item->id_doc_kerma)?'selected':'' }}
                                                        @endisset
                                                        >{{ $item->no_doc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group form-input mt-1">
                                            <label for="">File MoU</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_doc" class="custom-file-input" id="customFile1" />
                                                <label class="custom-file-label" for="customFile1">Unggah MoU</label>
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
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection