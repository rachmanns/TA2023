@extends('partials.template')

@section('page_style')
    <style>
        .hide {
            display:  none;
        }
    </style>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('bangkes/peserta-patubel') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Peserta Patubel</h2>
                </div>
            </div>
            <form action="{{ url('bangkes/peserta-patubel/'.$patubel->id_patubel) }}" class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <input type="hidden" name="tmt_awal" value="{{ $patubel->tmt_awal }}">
                <input type="hidden" name="tmt_akhir" value="{{ $patubel->tmt_akhir }}">
                <div class="content-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bolder">Data Diri</h5>
                                    <div class="row">
                                        <div class="col-md-6">             
                                            <label class="form-label">Tahun Ajaran</label>
                                            <div class="input-group input-group-merge form-input">
                                                <input type="text" id="tahun" class="form-control bg-white "
                                                    placeholder="Tahun" value="{{ $patubel->tahun_ajaran }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nama">Nama Dokter</label>
                                                <input type="text" id="nama" class="form-control" placeholder="Nama Dokter" value="{{ $nakes['nama'] ?? '' }}" disabled>
                                                <div class="invalid-feedback">Nama Dokter harus diisi</div>
                                            </div>     
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="korp">Pangkat/Korp</label>
                                                <input type="text" id="korp" class="form-control" placeholder="Pangkat/Korp" value="{{ $nakes['pangkat'] ?? ''}}" disabled>
                                                <div class="invalid-feedback">Pangkat/Korp harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">   
                                            <div class="form-group form-input">
                                                <label class="form-label" for="nrp">NRP/NIP</label>
                                                <input type="text" id="nrp" class="form-control" placeholder="NRP/NIP" value="{{ $nakes['no_identitas'] ?? ''}}" disabled>
                                                <div class="invalid-feedback">NRP/NIP harus diisi</div>
                                            </div>                                      
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="kesatuan">Asal Kesatuan</label>
                                                <input type="text" id="kesatuan" class="form-control" placeholder="Asal Kesatuan" value="{{ $nakes['satuan_asal'] ?? ''}}" disabled>
                                                <div class="invalid-feedback">Asal Kesatuan harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12 form-input">             
                                            <label for="tmt_date">TMT</label>
                                            <input type="text" id="tmt_date" class="form-control" placeholder="TMT" name="tmt" /> 
                                            <div class="invalid-feedback"></div>                           
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6 col-12">             
                                            <div class="form-group form-input">
                                                <label class="form-label" for="minat">Peminatan</label>
                                                <input type="text" id="minat" class="form-control" placeholder="Peminatan" disabled value="{{ $patubel->peminatan }}">
                                                <div class="invalid-feedback">Peminatan harus diisi</div>
                                            </div>                                       
                                        </div>
                                        <div class="col-md-6 col-12">   
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tempat">Tempat Pendidikan</label>
                                                <input type="text" id="tempat" class="form-control" placeholder="Tempat Pendidikan" disabled  value="{{ $patubel->kampus }}">
                                                <div class="invalid-feedback">Tempat Pendidikan harus diisi</div>
                                            </div>                                      
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="customFile1">Dokumen Sprin</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_sprin" class="custom-file-input"
                                                        id="customFile1" />
                                                    <label class="custom-file-label" for="customFile1">Dokumen Sprin</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-right">
                                            <a href="{{ asset('storage/'.$patubel->file_sprin) }}" target="_blank"><u> Lihat Sprin </u></a>
                                        </div>
                                    </div>
    
                                    <hr>
    
                                    <div class="custom-control custom-switch custom-switch-primary custom-control-inline mt-1">
                                        <p class="mr-1">Alih Jurusan</p>
                                        <input type="checkbox" class="custom-control-input" id="customSwitch10" checked onclick="toggleText()"/>
                                        <label class="custom-control-label" for="customSwitch10">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
    
                                    <div id="show">
                                        <h5 class="font-weight-bolder">Jurusan Baru</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-12">             
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="minat">Peminatan</label>
                                                    <input type="text" id="minat" class="form-control" placeholder="Peminatan" name="peminatan2" value="{{ $patubel->peminatan2 }}">
                                                    <div class="invalid-feedback">Peminatan harus diisi</div>
                                                </div>                                       
                                            </div>
                                            <div class="col-md-6 col-12">             
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="tempat">Tempat Pendidikan</label>
                                                    <input type="text" id="tempat" class="form-control" placeholder="Tempat Pendidikan" name="kampus2" value="{{ $patubel->kampus2 }}">
                                                    <div class="invalid-feedback">Tempat Pendidikan harus diisi</div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="customFile2">Dokumen Sprin</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="file_sprin2" class="custom-file-input"
                                                            id="customFile2" />
                                                        <label class="custom-file-label" for="customFile2">Dokumen Sprin</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
    
                                    <h5 class="font-weight-bolder pb-25">Kelulusan</h5>
    
                                    <div id="myRadioGroup">
                                        <div class="row form-input">
                                            <div class="col-md-2 col-12">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="status" id="belum" class="custom-control-input" value="belum lulus" checked/>
                                                    <label class="custom-control-label" for="belum">Belum Lulus</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="status" id="lulus" class="custom-control-input" value="lulus" data-div="divlulus"/>
                                                    <label class="custom-control-label" for="lulus">Lulus</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="status" id="tidak" class="custom-control-input" value="tidak lulus" data-div="divtidaklulus"/>
                                                    <label class="custom-control-label" for="tidak">Tidak Lulus</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="divlulus" class="desc">
                                            <div class="row mt-1">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group form-input">
                                                        <label class="form-label" for="tgl">Tanggal</label>
                                                        <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal" value="{{ $patubel->tgl_lulus }}" name="tgl_lulus"/>
                                                        <div class="invalid-feedback">Tanggal harus diisi</div>
                                                    </div>    
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group form-input">
                                                        <label class="form-label" for="ipk">IPK</label>
                                                        <input type="number" min="0" max="4" type="text" id="ipk" class="form-control" placeholder="IPK" name="ipk" value="{{ $patubel->ipk }}">
                                                        <div class="invalid-feedback">IPK harus diisi</div>
                                                    </div>   
                                                </div>
                                            </div>     
                                        </div>
                                        <div id="divtidaklulus" class="desc">
                                            <div class="row mt-1">
                                                <div class="col-12">
                                                    <div class="form-group form-input">
                                                        <label class="form-label" for="ket">Keterangan</label>
                                                        <textarea rows="3" id="ket" class="form-control" placeholder="Keterangan" name="keterangan">{{ $patubel->keterangan }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
        function toggleText(){
            var x = document.getElementById("show");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $(document).ready(function() {
            $("div.desc").hide();
            $("input[name$='status']").click(function() {
                // var test = $(this).val();
                var test = $(this).attr('data-div');
                $("div.desc").hide();
                $("#" + test).show();
            });

            tmt_date.setDate(['{{ $patubel->tmt_date_awal }}','{{ $patubel->tmt_date_akhir }}'],false);
        });

        var tmt_date = $("#tmt_date").flatpickr({
            mode: 'range',
            dateFormat: "d F Y",
            onChange:function(selectedDates){
                var _this=this;
                var dateArr=selectedDates.map(function(date){return _this.formatDate(date,'Y-m-d');});
                let start = dateArr[0];
                let end = dateArr[1];

                $('#tmt_awal').val(start);
                $('#tmt_akhir').val(end);
            }
        })
    </script>
@endsection