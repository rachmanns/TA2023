@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    @php
                        $id_data_b = $id_data_bekkes??$detail_bekkes->id_data_bekkes;
                    @endphp
                    <a href="{{ url('matfaskes/data-bekkes/'.$id_data_b) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Tambah Isi Kat Prapas</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($detail_bekkes))
                                <form action="{{ url('matfaskes/detail-bekkes/'.$detail_bekkes->id_detail_bekkes) }}" autocomplete="off" class="default-form">
                                    @method('PUT')
                            @else
                                <form action="{{ url('matfaskes/detail-bekkes/store') }}" autocomplete="off" class="default-form" method="post">
                            @endif
                                @csrf
                                <input type="hidden" name="id_data_bekkes" value="{{ isset($detail_bekkes)?$detail_bekkes->id_data_bekkes:$id_data_bekkes }}">
                                <div class="card-body">
                                    <div class="form-group form-input">
                                        <label class="form-label">Kategori Barang</label>
                                        <select class="select2 form-control" name="id_kategori_brg">
                                            <option selected disabled>Pilih Kategori Barang</option>
                                            @foreach ($kategori_brg as $kb)
                                                <option value="{{ $kb->id_kategori }}"
                                                    @isset($detail_bekkes)
                                                        {{ ($detail_bekkes->id_kategori_brg == $kb->id_kategori)?'selected':'' }}
                                                    @endisset
                                                    >{{ $kb->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Jenis Barang</label>
                                        <input type="text" class="form-control" name="jenis_brg" placeholder="Jenis Barang" value="{{ $detail_bekkes->jenis_brg??null }}">
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Nama Barang</label>
                                        <input type="text"class="form-control" placeholder="Nama Barang" name="nama_brg" value="{{ $detail_bekkes->nama_brg??null }}">
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Satuan</label>
                                        <input type="text"class="form-control" placeholder="Satuan" name="satuan" value="{{ $detail_bekkes->satuan??null }}">
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number"class="form-control" placeholder="Jumlah" name="jml" value="{{ $detail_bekkes->jml??null }}">
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control" rows="3" placeholder="Keterangan" name="keterangan">{{ $detail_bekkes->keterangan??null }}</textarea>
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