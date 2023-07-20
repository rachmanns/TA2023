@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('yankesin/posyandu') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Posyandu</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (request()->segment(3)=='create')
                                <form action="{{ url('yankesin/posyandu') }}" class="default-form" autocomplete="off">
                            @else
                                <form action="{{ url('yankesin/posyandu/'.$posyandu->id_posyandu) }}" class="default-form" autocomplete="off">
                                    @method('PUT')
                            @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Nama Posyandu</label>
                                                <input type="text" class="form-control" placeholder="Nama Faskes" name="nama_posy" value="{{ $posyandu->nama_posy??null }}">
                                                <div class="invalid-feedback">Nama harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label class="form-label">Matra</label>
                                            <select class="select2 form-control form-control-lg" name="id_matra">
                                                <option disabled selected>Matra</option>
                                                @foreach ($matra as $m)
                                                    <option value="{{ $m->kode_matra }}"
                                                        @isset($posyandu)
                                                            {{ $posyandu->id_matra === $m->kode_matra ? 'selected' : '' }}
                                                        @endisset
                                                        >{{ $m->nama_matra }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label class="form-label">Provinsi</label>
                                            <select class="select2 form-control form-control-lg" id="id_provinsi">
                                                <option disabled selected>Provinsi</option>
                                                @foreach ($provinsi as $p)
                                                    <option value="{{ $p->id_provinsi }}"
                                                        @isset($posyandu)
                                                            {{ isset($posyandu->kota_kab) && $posyandu->kota_kab->id_provinsi === $p->id_provinsi ? 'selected' : '' }}
                                                        @endisset
                                                        >{{ $p->nama_provinsi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label class="form-label">Kota/Kabupaten</label>
                                            <select class="select2 form-control form-control-lg" name="id_kotakab" id="id_kotakab">
                                                <option disabled selected>Kota/Kabupaten</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-12 mt-1">
                                            <div class="form-group">
                                                <label>Alamat Posyandu</label>
                                                <textarea class="form-control" rows="2" placeholder="Alamat Posyandu" name="alamat_posy">{{ $posyandu->alamat_posy??null }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Program Germas</label>
                                                <textarea class="form-control" rows="2" placeholder="Program Germas" name="prog_germas">{{ $posyandu->prog_germas??null }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Program Posyandu</label>
                                                <textarea class="form-control" rows="2" placeholder="Program Posyandu" name="prog_posy">{{ $posyandu->prog_posy??null }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Hubungan Lintas Sektoral</label>
                                                <input type="text" class="form-control" placeholder="Hubungan Lintas Sektoral" name="hub_sektoral" value="{{ $posyandu->hub_sektoral??null }}">
                                                <div class="invalid-feedback">Hubungan Lintas Sektoral harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Jumlah Kader Germas</label>
                                                <input type="text" class="form-control" placeholder="Jumlah Kader Germas" name="jml_kader_germas" value="{{ $posyandu->jml_kader_germas??null }}">
                                                <div class="invalid-feedback">Jumlah Kader Germas harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Jumlah Posyandu</label>
                                                <input type="text" class="form-control" placeholder="Jumlah Posyandu" name="jml_kader_posy" value="{{ $posyandu->jml_kader_posy??null }}">
                                                <div class="invalid-feedback">Jumlah Posyandu harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-3 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Garis Lintang</label>
                                                <input type="text" class="form-control" placeholder="Garis Lintang" name="latitude" value="{{ $posyandu->latitude??null }}">
                                                <div class="invalid-feedback">Garis Lintang harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-3 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label">Garis Bujur</label>
                                                <input type="text" class="form-control" placeholder="Garis Bujur" name="longitude" value="{{ $posyandu->longitude??null }}">
                                                <div class="invalid-feedback">Garis Bujur harus diisi</div>
                                            </div>                                       
                                        </div>
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
            select_kotakab({{ $posyandu->kota_kab->id_provinsi??null }})
            setTimeout(function(){$("#id_kotakab").val("{{ $posyandu->kota_kab->id_kotakab??null }}").trigger('change.select2')}, 1000);
        })

        $('#id_provinsi').change(function(){
            select_kotakab($(this).val());
        });

        function select_kotakab(id_provinsi){
            $.ajax({
                url: `{{ url('refrensi/kota-kab/${id_provinsi}') }}`,
                method: "GET",
                dataType: "json",
                success: function (result) {
                    
                    $("#id_kotakab").empty().trigger("change");
                    
                    $("#id_kotakab").select2({ data: result.data,placeholder: "Pilih Kota/Kab",allowClear: true });

                }
            });
        }
    </script>
@endsection