{{-- Modal Ubah Pakaian --}}
<div class="modal fade text-left" id="rh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Riwayat Hidup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_data_personil',$personil->id_personil) }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                <div class="row">
                    <div class="form-group form-input col-md-12">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" name="nama" value="{{ $personil->nama }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="matra">Matra*</label>
                        <select id="matra" class="select2 form-control form-control-lg">
                            <option disabled selected>Pilih Matra</option>
                            @foreach ($matra as $item)
                                <option value="{{ $item->kode_matra }}"{{ ($personil->korps->matra->kode_matra==$item->kode_matra)?'selected':'' }}>{{ $item->nama_matra }}</option>
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
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="grade">Grade</label>
                        <input type="text" id="grade" class="form-control" placeholder="Grade" name="grade" value="{{ $personil->grade }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="eselon">Eselon</label>
                        <input type="text" id="eselon" class="form-control" placeholder="eselon Lengkap" name="eselon" value="{{ $personil->eselon }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <label class="form-label mb-1">Jenis Kelamin</label>
                <div class="row mb-1 form-input">
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input" value="laki-laki" {{ ($personil->jenis_kelamin == 'laki-laki')?'checked':'' }}/>
                            <label class="custom-control-label" for="customRadio1">LAKI-LAKI</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="jenis_kelamin" class="custom-control-input" value="perempuan" {{ ($personil->jenis_kelamin == 'perempuan')?'checked':'' }}/>
                            <label class="custom-control-label" for="customRadio2">PEREMPUAN</label>
                        </div>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tempat">Tempat Lahir</label>
                        <input type="text" id="tempat" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $personil->tempat_lahir }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tanggal">Tanggal Lahir</label>
                        <input type="text" id="tanggal" class="form-control flatpickr-basic" placeholder="Tanggal Lahir" name="tgl_lahir" value="{{ $personil->tgl_lahir }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label for="agama">Agama</label>
                        <select id="agama" name="agama" class="select2 form-control form-control-lg" required>
                            <option disabled selected>Pilih Agama</option>
                            <option {{ ($personil->agama == 'islam')?'selected':'' }} value="islam">ISLAM</option>
                            <option {{ ($personil->agama == 'protestan')?'selected':'' }} value="protestan">PROTESTAN</option>
                            <option {{ ($personil->agama == 'katolik')?'selected':'' }} value="katolik">KATOLIK</option>
                            <option {{ ($personil->agama == 'hindu')?'selected':'' }} value="hindu">HINDU</option>
                            <option {{ ($personil->agama == 'buddha')?'selected':'' }} value="buddha">BUDDHA</option>
                            <option {{ ($personil->agama == 'khonghucu')?'selected':'' }} value="khonghucu">KHONGHUCU</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label for="suku">Suku</label>
                        <input type="text" id="suku" class="form-control" placeholder="Suku" name="suku" value="{{ $personil->suku }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label for="status_pernikahan">Status Pernikahan</label>
                        <select id="status_pernikahan" name="status_pernikahan" class="select2 form-control form-control-lg" required>
                            <option disabled selected>Pilih Status Pernikahan</option>
                            <option {{ ($personil->status_pernikahan == 'kawin')?'selected':'' }} value="kawin">KAWIN</option>
                            <option {{ ($personil->status_pernikahan == 'tidak kawin')?'selected':'' }} value="tidak kawin">TIDAK KAWIN</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tgl-pernikahan">Tanggal Pernikahan</label>
                        <input type="text" id="tgl-pernikahan" class="form-control flatpickr-basic" placeholder="Tanggal Pernikahan" name="tgl_pernikahan" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-12">
                        <label for="no-nikah">No. Surat Nikah</label>
                        <input type="text" id="no-nikah" class="form-control" placeholder="No. Surat Nikah" name="no_surat_nikah" value="{{ $personil->no_surat_nikah }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-12">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea rows="3" id="alamat" class="form-control" placeholder="Alamat" name="alamat" >{{ $personil->alamat }}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="nik">NIK/NIP</label>
                        <input type="text" id="nik" class="form-control" placeholder="NIK/NIP" name="nik" value="{{ $personil->nik }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="kk">No. KK</label>
                        <input type="text" id="kk" class="form-control" placeholder="NO. KK" name="no_kk" value="{{ $personil->no_kk }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="npwp">NPWP</label>
                        <input type="text" id="npwp" class="form-control" placeholder="NPWP" name="npwp" value="{{ $personil->npwp }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="bpjs">No. BPJS</label>
                        <input type="text" id="bpjs" class="form-control" placeholder="No. BPJS" name="no_bpjs" value="{{ $personil->no_bpjs }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="asabri">No. Asabri</label>
                        <input type="text" id="asabri" class="form-control" placeholder="No. Asabri" name="no_asabri" value="{{ $personil->no_asabri }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="kpis">KPIS</label>
                        <input type="text" id="kpis" class="form-control" placeholder="KPIS" name="no_kpis" value="{{ $personil->no_kpis }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="telp">No. Telp</label>
                        <input type="text" id="telp" class="form-control" placeholder="No. Telp" name="no_telp" value="{{ $personil->no_telp }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{ $personil->email }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group form-input">
                    <label for="customFile1">Foto Personil</label>
                    <div class="custom-file">
                        <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                        <label class="custom-file-label" for="customFile1">Pilih Foto Personil</label>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="sumber_masuk">Sumber Masuk</label>
                        <input type="text" id="sumber_masuk" class="form-control" placeholder="Sumber Masuk" name="no_sumber_masuk" value="{{ $personil->sumber_masuk }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <h5 class="mb-1 mt-1 font-weight-bolder">Ciri Fisik</h5>

                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="rambut">Jenis Rambut</label>
                        <input type="text" id="rambut" class="form-control" placeholder="Jenis Rambut" name="jenis_rambut" value="{{ $personil->jenis_rambut }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="kulit">Warna Kulit</label>
                        <input type="text" id="kulit" class="form-control" placeholder="Warna Kulit" name="warna_kulit" value="{{ $personil->warna_kulit }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tb">Tinggi Badan</label>
                        <input type="text" id="tb" class="form-control" placeholder="Tinggi Badan" name="tinggi_badan" value="{{ $personil->tinggi_badan }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="bb">Berat Badan</label>
                        <input type="text" id="bb" class="form-control" placeholder="Berat Badan" name="berat_badan" value="{{ $personil->berat_badan }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <label class="form-label mb-1">Golongan Darah</label>
                <div class="row mb-1">
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="a" name="gol_darah" class="custom-control-input" value="a" {{ ($personil->gol_darah == 'a')?'checked':'' }}/>
                            <label class="custom-control-label" for="a">A</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="b" name="gol_darah" class="custom-control-input" value="b" {{ ($personil->gol_darah == 'b')?'checked':'' }}/>
                            <label class="custom-control-label" for="b">B</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="ab" name="gol_darah" class="custom-control-input" value="ab" {{ ($personil->gol_darah == 'ab')?'checked':'' }}/>
                            <label class="custom-control-label" for="ab">AB</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="o" name="gol_darah" class="custom-control-input" value="o" {{ ($personil->gol_darah == '0')?'checked':'' }}/>
                            <label class="custom-control-label" for="o">O</label>
                        </div>
                    </div>
                </div> 
                <h5 class="mb-1 mt-1 font-weight-bolder">Penilaian</h5>
    
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="rambut">Psikologi</label>
                        <input type="text" id="rambut" class="form-control" placeholder="Psikologi" name="psikologi" value="{{ $personil->psikologi }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="kulit">Kesehatan</label>
                        <input type="text" id="kulit" class="form-control" placeholder="Kesehatan" name="kesehatan" value="{{ $personil->kesehatan }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tb">Jasmani</label>
                        <input type="text" id="tb" class="form-control" placeholder="Jasmani" name="jasmani" value="{{ $personil->jasmani }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="bb">Dapen</label>
                        <input type="text" id="bb" class="form-control" placeholder="Dapen" name="dapen" value="{{ $personil->dapen }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-page-block-custom">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
