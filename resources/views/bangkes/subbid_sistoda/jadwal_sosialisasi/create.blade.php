@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ route('bangkes.jadwal-sosialisasi.index') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Jadwal Sosialisasi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($event_buku))
                                <form action="{{ route('bangkes.jadwal-sosialisasi.update',$event_buku->id_event_buku) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ route('bangkes.jadwal-sosialisasi.store') }}" class="default-form" autocomplete="off">
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tgl_event">Tanggal</label>
                                                <input type="text" id="tgl_event" class="form-control flatpickr-basic" placeholder="Tanggal" name="tgl_event" value="{{ $event_buku->tgl_event??null }}"/>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_buku">Judul Buku</label>
                                                <select name="id_buku" id="id_buku" class="form-control select2">
                                                    <option selected disabled>Pilih Buku</option>
                                                    @foreach ($buku as $item)
                                                        <option value="{{ $item->id_buku }}"
                                                            @if (isset($event_buku))
                                                                {{ $event_buku->id_buku == $item->id_buku?'selected':'' }}
                                                            @endif
                                                            >{{ $item->no_buku }} - {{ $item->nama_buku }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <h5>Lokasi Sosialisasi</h5>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="satuan">Satuan</label>
                                        <input type="text" id="satuan" class="form-control" placeholder="Satuan" name="satuan" value="{{ $event_buku->satuan??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="id_provinsi">Provinsi</label>
                                        <select id="id_provinsi" class="form-control select2">
                                            <option selected disabled>Pilih Provinsi</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id_provinsi }}"
                                                    @isset($event_buku)
                                                        {{ $event_buku->kota_kab->id_provinsi == $item->id_provinsi?'selected':'' }}
                                                    @endisset
                                                    >{{ $item->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="kota">Kota</label>
                                        <select name="id_kotakab" id="id_kotakab" class="form-control"></select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="jml_peserta">Jumlah Peserta</label>
                                        <input type="number" id="jml_peserta" class="form-control" placeholder="Jumlah Peserta" name="jml_peserta" value="{{ $event_buku->jml_peserta??null }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label class="form-label" for="id_personil">Nama Petugas Sosialisasi</label>
                                        <select id="id_personil" class="form-control select2" name="id_personil[]" multiple>
                                            @foreach ($personil as $item)
                                                @if(in_array($item->id_personil, $id_personil))
                                                    <option value="{{ $item->id_personil }}" selected="true">{{ $item->nama }}</option>
                                                @else
                                                    <option value="{{ $item->id_personil }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mt-1 form-input">
                                        <label for="customFile1">File Laporan Kegiatan</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_lap_keg" class="custom-file-input" id="customFile1"/>
                                            <label class="custom-file-label" for="customFile1">File Laporan Kegiatan</label>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <label class="form-label" for="status">Status</label>
                                    <div class="row">
                                        @foreach ($status_keg as $item)
                                            <div class="col-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="{{ $item }}" name="status_keg" class="custom-control-input" value="{{ $item }}"
                                                    @isset($event_buku)
                                                        {{ ($event_buku->status_keg == $item)?'checked':'' }}
                                                    @endisset 
                                                    />
                                                    <label class="custom-control-label" for="{{ $item }}">{{ $item }}</label>
                                                </div>   
                                            </div>
                                        @endforeach
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
            select_kotakab({{ $event_buku->kota_kab->id_provinsi??null }})
            setTimeout(function(){$("#id_kotakab").val("{{ $event_buku->kota_kab->id_kotakab??null }}").trigger('change.select2')}, 1000);
        })

        $(document).on('change', '#id_provinsi', function() {
            var id_provinsi = $(this).val();
            select_kotakab(id_provinsi)
        });

        function select_kotakab(id_provinsi){
            $.ajax({
                url: "{{ url('bangkes/kotakab/list') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_provinsi": id_provinsi
                },
                method: "POST",
                dataType: "json",
                success: function (result) {
                    
                    $("#id_kotakab").empty().trigger("change");
                    
                    $("#id_kotakab").select2({ data: result.data,placeholder: "Pilih Kota/Kab",allowClear: true });

                }
            });
        }
    </script>
@endsection