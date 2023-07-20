@extends('partials.template') 

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-12 mb-1">
                            <a href="{{ url('bidum/personil') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Tambah Personil</h2>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="alert alert-danger">
            </div>
            <div class="content-body">                
                <section class="vertical-wizard">
                    <div class="bs-stepper vertical vertical-wizard-example">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#diri">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">1</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Data Diri</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#tni">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">2</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Data TNI</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#pangkat">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">3</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Pangkat & Jabatan</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form id="form-personil" onsubmit="return false" autocomplete="off">
                                @csrf
                                <div id="diri" class="content">
                                    <h5 class="mb-1 font-weight-bolder">Identitas Personil</h5>
                                    <div class="row">
                                        <div class="form-group col-md-12 form-input">
                                            <label class="form-label" for="nama">Nama Lengkap*</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" name="nama" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <label class="form-label mb-1">Jenis Kelamin</label>
                                    <div class="row mb-1 form-input">
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input" value="laki-laki"/>
                                                <label class="custom-control-label" for="customRadio1">LAKI-LAKI</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="jenis_kelamin" class="custom-control-input" value="perempuan"/>
                                                <label class="custom-control-label" for="customRadio2">PEREMPUAN</label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>                                       
                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tempat">Tempat Lahir*</label>
                                            <input type="text" id="tempat" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tgl_lahir">Tanggal Lahir*</label>
                                            <input type="text" id="tgl_lahir" class="form-control flatpickr-basic" placeholder="Tanggal Lahir" name="tgl_lahir" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label for="agama">Agama*</label>
                                            <select id="agama" name="agama" class="select2 form-control form-control-lg" >
                                                <option disabled selected>Pilih Agama</option>
                                                <option value="islam">ISLAM</option>
                                                <option value="protestan">PROTESTAN</option>
                                                <option value="katolik">KATOLIK</option>
                                                <option value="hindu">HINDU</option>
                                                <option value="buddha">BUDDHA</option>
                                                <option value="khonghucu">KHONGHUCU</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="suku">Suku</label>
                                            <input type="text" id="suku" class="form-control" placeholder="Suku" name="suku"/>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label for="status_pernikahan">Status Pernikahan*</label>
                                            <select id="status_pernikahan" name="status_pernikahan" class="select2 form-control form-control-lg">
                                                <option disabled selected>Pilih Status Pernikahan</option>
                                                <option value="kawin">KAWIN</option>
                                                <option value="tidak kawin">TIDAK KAWIN</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tgl-pernikahan">Tanggal Pernikahan</label>
                                            <input type="text" id="tgl_pernikahan" class="form-control flatpickr-basic" placeholder="Tanggal Pernikahan" name="tgl_pernikahan"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-12 form-input">
                                            <label for="no-nikah">No. Surat Nikah</label>
                                            <input type="text" id="no_surat_nikah" class="form-control" placeholder="No. Surat Nikah" name="no_surat_nikah" disabled/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-12 form-input">
                                            <label class="form-label" for="alamat">Alamat*</label>
                                            <textarea rows="3" id="alamat" class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="nik">NIK*</label>
                                            <input type="text" id="nik" class="form-control" placeholder="NIK" name="nik"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="kk">No. KK</label>
                                            <input type="text" id="kk" class="form-control" placeholder="NO. KK" name="no_kk" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="npwp">NPWP</label>
                                            <input type="text" id="npwp" class="form-control" placeholder="NPWP" name="npwp" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="bpjs">No. BPJS</label>
                                            <input type="text" id="bpjs" class="form-control" placeholder="No. BPJS" name="no_bpjs" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="asabri">No. Asabri</label>
                                            <input type="text" id="asabri" class="form-control" placeholder="No. Asabri" name="no_asabri" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="kpis">KPIS</label>
                                            <input type="text" id="kpis" class="form-control" placeholder="KPIS" name="no_kpis" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="telp">No. Telp*</label>
                                            <input type="number" id="telp" class="form-control" placeholder="No. Telp" name="no_telp" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" id="email" class="form-control" placeholder="Email" name="email" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group form-input">
                                        <label for="customFile1">Foto Personil*</label>
                                        <div class="custom-file">
                                            <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                                            <label class="custom-file-label" for="customFile1">Pilih Foto Personil</label>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <h5 class="mb-1 mt-1 font-weight-bolder">Ciri Fisik</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="rambut">Jenis Rambut</label>
                                            <input type="text" id="rambut" class="form-control" placeholder="Jenis Rambut" name="jenis_rambut" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="kulit">Warna Kulit</label>
                                            <input type="text" id="kulit" class="form-control" placeholder="Warna Kulit" name="warna_kulit"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tb">Tinggi Badan (cm)</label>
                                            <input type="number" id="tb" class="form-control" placeholder="Tinggi Badan" name="tinggi_badan"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="bb">Berat Badan (kg)</label>
                                            <input type="number" id="bb" class="form-control" placeholder="Berat Badan" name="berat_badan"/>
                                        </div>
                                    </div>
                                    <label class="form-label mb-1">Golongan Darah</label>
                                    <div class="row mb-1">
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="a" name="gol_darah" class="custom-control-input" value="a"/>
                                                <label class="custom-control-label" for="a">A</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="b" name="gol_darah" class="custom-control-input" value="b"/>
                                                <label class="custom-control-label" for="b">B</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="ab" name="gol_darah" class="custom-control-input" value="ab"/>
                                                <label class="custom-control-label" for="ab">AB</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="o" name="gol_darah" class="custom-control-input" value="o"/>
                                                <label class="custom-control-label" for="o">O</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-2">
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                        </button>
                                    </div>                                 
                                </div>

                                <div id="tni" class="content">
                                    <h5 class="mb-1 font-weight-bolder">Data TNI</h5>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tmt-tni">TMT TNI*</label>
                                            <input type="text" id="tmt-tni" class="form-control flatpickr-basic" placeholder="TMT TNI" name="tmt_tni"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tmt-perwira">TMT Perwira</label>
                                            <input type="text" id="tmt-perwira" class="form-control flatpickr-basic" placeholder="TMT Perwira" name="tmt_perwira"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tmt-bintara">TMT Bintara</label>
                                            <input type="text" id="tmt-bintara" class="form-control flatpickr-basic" placeholder="TMT Bintara" name="tmt_bintara"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tmt-tamtama">TMT Tamtama</label>
                                            <input type="text" id="tmt-tamtama" class="form-control flatpickr-basic" placeholder="TMT Tamtama" name="tmt_tamtama"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="sumber_masuk">Sumber Masuk</label>
                                            <input type="text" id="sumber_masuk" class="form-control" placeholder="Sumber Masuk" name="sumber_masuk"/>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-1 font-weight-bolder">Penilaian</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="psikologi">Psikologi</label>
                                            <input type="text" id="psikologi" class="form-control" placeholder="Psikologi" name="psikologi"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="kesehatan">Kesehatan</label>
                                            <input type="text" id="kesehatan" class="form-control" placeholder="Kesehatan" name="kesehatan"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="jasmani">Jasmani</label>
                                            <input type="text" id="jasmani" class="form-control" placeholder="Jasmani" name="jasmani"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="dapen">Dapen</label>
                                            <input type="text" id="dapen" class="form-control" placeholder="Dapen" name="dapen"/>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <button class="btn btn-outline-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                        </button>
                                    </div>
                                </div>

                                <div id="pangkat" class="content">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="matra">Matra*</label>
                                            <select id="matra" class="select2 form-control form-control-lg">
                                                <option disabled selected>Pilih Matra</option>
                                                @foreach ($matra as $item)
                                                    <option value="{{ $item->kode_matra }}">{{ $item->nama_matra }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="list_korps">Korps*</label>
                                            <select id="list_korps" class="select2 form-control form-control-lg" name="kode_korps">
                                                <option disabled selected>Pilih Korps</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="nrp">NRP/NIP*</label>
                                            <input type="number" id="nrp" class="form-control" placeholder="NRP/NIP" name="nrp" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="list_kesatuan">Kesatuan*</label>
                                            <select id="list_kesatuan" class="select2 form-control form-control-lg" name="nama_kesatuan" >
                                                <option disabled selected>Pilih Kesatuan</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-1 font-weight-bolder">Pangkat/Golongan Terakhir</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="list_pangkat">Pangkat*</label>
                                            <select id="list_pangkat" class="select2 form-control form-control-lg" name="id_pangkat">
                                                <option disabled selected>Pilih Pangkat</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tmt-pangkat">TMT Pangkat*</label>
                                            <input type="text" id="tmt-pangkat" class="form-control flatpickr-basic" placeholder="TMT Pangkat" name="tmt_pangkat" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="skep-pangkat">No. SKEP Pangkat</label>
                                            <input type="text" id="skep-pangkat" class="form-control" placeholder="No. SKEP Pangkat" name="no_skep_pangkat" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tgl-skep-pangkat">Tanggal SKEP Pangkat</label>
                                            <input type="text" id="tgl-skep-pangkat" class="form-control flatpickr-basic" placeholder="Tanggal SKEP Pangkat" name="tgl_skep_pangkat" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="no-sprin-pangkat">No. SPRIN Pangkat</label>
                                            <input type="text" id="no-sprin-pangkat" class="form-control" placeholder="No. SPRIN Pangkat" name="no_sprin_pangkat"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tgl-sprin-pangkat">Tanggal SPRIN Pangkat</label>
                                            <input type="text" id="tgl-sprin-pangkat" class="form-control flatpickr-basic" placeholder="Tanggal SPRIN Pangkat" name="tgl_sprin_pangkat"/>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-1 font-weight-bolder">Jabatan Terakhir</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="eselon">Eselon</label>
                                            <input type="number" name="eselon" id="eselon" class="form-control" placeholder="Eselon">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="grade">Grade</label>
                                            <input type="number" name="grade" id="grade" class="form-control" placeholder="Grade">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="jabatan">Jabatan*</label>
                                            <select id="jabatan" class="select2 form-control form-control-lg" name="id_jabatan">
                                                <option disabled selected>Pilih Jabatan</option>
                                                @foreach ($jabatan as $item)
                                                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 form-input">
                                            <label class="form-label" for="tmt-jangkat">TMT Jabatan*</label>
                                            <input type="text" id="tmt-jangkat" class="form-control flatpickr-basic" placeholder="TMT Jabatan" name="tmt_jabatan" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="skep-jabatan">No. SKEP Jabatan</label>
                                            <input type="text" id="skep-jabatan" class="form-control" placeholder="No. SKEP Jabatan" name="no_skep_jabatan" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tgl-skep-jabatan">Tanggal SKEP Jabatan</label>
                                            <input type="text" id="tgl-skep-jabatan" class="form-control flatpickr-basic" placeholder="Tanggal SKEP Jabatan" name="tgl_skep_jabatan" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="no-sprin-jabatan">No. SPRIN Jabatan</label>
                                            <input type="text" id="no-sprin-jabatan" class="form-control" placeholder="No. SPRIN Jabatan" name="no_sprin_jabatan" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="tgl-sprin-jabatan">Tanggal SPRIN Jabatan</label>
                                            <input type="text" id="tgl-sprin-jabatan" class="form-control flatpickr-basic" placeholder="Tanggal SPRIN Jabatan" name="tgl_sprin_jabatan" />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <button class="btn btn-outline-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                                        </button>
                                        <button id="submit" class="btn btn-primary btn-page-block-custom">Simpan Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>

        $(function(){
            $("#list_korps").prop("disabled", true);
            $("#list_kesatuan").prop("disabled", true);
            $("#list_pangkat").prop("disabled", true);

            var fp = $('#tgl_pernikahan').flatpickr({
                    altInput:true,
                    altFormat: "j F Y",
                });
                fp._input.disabled = true

            $('#tgl_lahir').flatpickr({
                altInput:true,
                altFormat: "j F Y",
                maxDate: moment().subtract(17, "years").format("YYYY-MM-DD")
            });
        })

        $('#submit').click(function(){
            let form_data = new FormData($('#form-personil')[0]);
            
            $.ajax({
                url : `{{ route('bidum.personil.store_data_personil') }}`,
                type : 'POST',
                data : form_data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                cache: false,
                success : function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }else{
                        Swal.fire(
                            'Success!',
                            'Personil Created!',
                            'success'
                        ),
                        setTimeout(function() {
                            window.location.replace("{{ route('bidum.personil.index_data_personil') }}");
                        }, 1000);
                    }
                },
                error: (xhr, status, error) => {
                    const {
                        responseJSON: response
                    } = xhr;
                    if (response.errors) {
                        $(".alert-danger").empty();
                        $('.alert-danger').append('<ul></ul>');
                        for (let form_data in response.errors) {
                            let form_name = form_data.replace(/\.(\d+)\.(\w+)/g, "[$1][$2]");

                            $(`[name^="${form_name}"]`, '#form-personil').addClass('is-invalid');
                            $(`[name^="${form_name}"]`, '#form-personil').parents('.form-input').find(
                                '.invalid-feedback').addClass('d-block');
                            $(`[name^="${form_name}"]`, '#form-personil').parents('.form-input').find(
                                '.invalid-feedback').html(response.errors[form_data][0]);
                            $(`[name^="${form_name}"]`, '#form-personil').parents('.form-input').find(
                                '.invalid-tooltip').html(response.errors[form_data][0]);

                            $('.alert-danger ul').append(`<li>${response.errors[form_data][0]}</li>`);
                        }
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error",
                            heightAuto: false
                        })
                    }
                }
            });
        });

        $('#matra').change(function(){
            let kode_matra = $(this).val();
            select_ajax("{{ url('bidum/personil/list-korps') }}",'korps',"Korps",kode_matra)
            select_ajax("{{ url('bidum/personil/list-kesatuan') }}",'kesatuan',"Kesatuan",kode_matra)
            select_ajax("{{ url('bidum/personil/list-pangkat') }}",'pangkat',"Pangkat",kode_matra)
        });

        $('#status_pernikahan').change(function(){
            let status_pernikahan = $(this).val();

            var fp = $('#tgl_pernikahan').flatpickr({
                altInput:true,
                altFormat: "j F Y",
            });
            
            if (status_pernikahan === 'kawin') {
                $("#no_surat_nikah").prop('disabled', false);
                fp._input.disabled = false
            } else {
                $("#no_surat_nikah").prop('disabled', true); 
                fp._input.disabled = true
            }
        })

        $('form input').on('keyup change paste', function () {
            // $(".alert-danger").empty();
            $(this).removeClass('is-invalid');
            $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
        });

        $('form textarea').on('keyup change paste', function () {
            // $(".alert-danger").empty();
            $(this).removeClass('is-invalid');
            $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
        });

        $('select').on('change', function () {
            // $(".alert-danger").empty();
            $(this).removeClass('is-invalid');
            $(this).parents('.form-input').find('.invalid-feedback').removeClass('d-block');
        });

        function select_ajax(url,field,placeholder,kode_matra){
            $('#list_'+field).empty().trigger("change");
            $.ajax({
                    url: url+'/'+kode_matra, 
                    method: "GET",
                    dataType: "json",
                    success: function (result) {

                        if ($('#list_'+field).data('select2')) {

                            $("#list_"+field).val("");
                            $("#list_"+field).trigger("change");
                            $("#list_"+field).empty().trigger("change");

                        }
                        
                        $("#list_"+field).select2({ data: result.data,placeholder: "Pilih "+placeholder,allowClear: true });
                        $('#list_'+field).prop('disabled',false)
                    }
                });
        }


    </script>
@endsection