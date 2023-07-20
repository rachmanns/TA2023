@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/tenaga-medis') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Daftar Tenaga Medis</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (isset($dokter))
                                <form action="{{ route('bangkes.tenaga-medis.update',$dokter->id_dokter) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @else
                                <form action="{{ url('bangkes/tenaga-medis') }}" class="default-form" autocomplete="off">
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
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-group form-input">
                                            <label class="form-label">Matra</label>
                                            <select class="form-control form-control-lg" name="matra" id="matra">
                                                <option disabled selected>Matra</option>
                                                @foreach ($matra as $m)
                                                    <option value="{{ $m }}"
                                                        @isset($dokter)
                                                            {{ ($dokter->matra == $m)?'selected':''}}
                                                        @endisset
                                                    >{{ $m }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-group form-input">   
                                            <label class="form-label">Sebaran</label>          
                                            <select class="select2 form-control form-control-lg" name="id_rs">
                                                <option disabled selected>Sebaran</option>
                                                @foreach ($rumah_sakit as $rs)
                                                    <option value="{{ $rs->id_rs }}"
                                                        @isset($id_rs)
                                                            {{ ($id_rs == $rs->id_rs)?'selected':''}}
                                                        @endisset
                                                        >{{ $rs->nama_rs }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12 col-12 form-group form-input">   
                                            <label class="form-label">Jenjang</label>          
                                            <select class="select2 form-control form-control-lg" name="jenjang">
                                                <option disabled selected>Pilih Jenjang</option>
                                                @foreach ($jenjang as $j)
                                                    <option value="{{ $j }}"
                                                        @isset($dokter)
                                                            {{ ($dokter->jenjang == $j)?'selected':''}}
                                                        @endisset
                                                        >{{ $j }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Kategori Dokter</label>
                                            <select class="select2 form-control form-control-lg" name="id_kategori_dokter" id="id_kategori_dokter">
                                                <option disabled selected>Kategori Dokter</option>
                                                @foreach ($kategori_dokter as $kd)
                                                    <option value="{{ $kd->id_kategori_dokter }}"
                                                        @isset($dokter)
                                                            {{ ($id_kategori_dokter == $kd->id_kategori_dokter)?'selected':''}}
                                                        @endisset
                                                        >{{ $kd->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="id_spesialis">Jenis Spesialis</label>
                                                <select name="id_spesialis[]" id="id_spesialis" class="select2 form-control" multiple="multiple"></select>
                                                <div class="invalid-feedback">Jenis Spesialis harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama_dokter">Nama</label>
                                                <input type="text" id="nama_dokter" class="form-control" placeholder="Nama" name="nama_dokter" value="{{ $dokter->nama_dokter??null }}">
                                                <div class="invalid-feedback">Nama harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="pangkat_korps">Pangkat</label>
                                                <input type="text" id="pangkat_korps" class="form-control" placeholder="Pangkat" name="pangkat_korps" value="{{ $dokter->pangkat_korps??null }}">
                                                <div class="invalid-feedback">Pangkat harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="no_identitas">NRP/NIP</label>
                                                <input type="text" id="no_identitas" class="form-control" placeholder="NRP/NIP" name="no_identitas" value="{{ $dokter->no_identitas??null }}">
                                                <div class="invalid-feedback">NRP/NIP harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12 form-input">           
                                            <label class="form-label">Satuan Asal</label>  
                                            <input type="text" name="satuan_asal" id="satuan_asal" class="form-control" placeholder="Satuan Asal" value="{{ $dokter->satuan_asal??null }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jabatan_struktural">Jabatan Struktural</label>
                                                <input type="text" id="jabatan_struktural" class="form-control" placeholder="Jabatan Struktural" name="jabatan_struktural" value="{{ $dokter->jabatan_struktural??null }}">
                                                <div class="invalid-feedback">Jabatan Struktural harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jabatan_fungsional">Jabatan Fungsional</label>
                                                <input type="text" id="jabatan_fungsional" class="form-control" placeholder="Jabatan Fungsional" name="jabatan_fungsional" value="{{ $dokter->jabatan_fungsional??null }}">
                                                <div class="invalid-feedback">Jabatan Fungsional harus diisi</div>
                                            </div>                                       
                                        </div>
                                    </div>  
                                    <div class="form-group form-input">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea rows="3" id="keterangan" class="form-control" placeholder="Keterangan" name="keterangan">{{ $dokter->keterangan??null }}</textarea>
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

        @if(isset($dokter))
            $("input[name='klasifikasi'][value='{{ $dokter->klasifikasi }}']").prop("checked",true);
            select_jenis_spesialis({{ $id_kategori_dokter }})
            setTimeout(function(){
                $("#id_spesialis").val({!! $selected_spesialis !!}).trigger('change.select2')
            }, 1000);
        @endif

        $(document).on('change', '#id_kategori_dokter', function() {
            var id_kategori_dokter = $(this).val();
            select_jenis_spesialis(id_kategori_dokter)
        });

        function select_jenis_spesialis(id_kategori_dokter){
            $.ajax({
                url: "{{ url('bangkes/get-spesialis') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_kategori_dokter": id_kategori_dokter
                },
                method: "POST",
                dataType: "json",
                success: function (result) {
                    
                    $("#id_spesialis").empty().trigger("change");
                    $("#id_spesialis").select2({ data: result.data,placeholder: "Pilih Jenis Spesialis",allowClear: true });

                }
            });
        }

    </script>
@endsection