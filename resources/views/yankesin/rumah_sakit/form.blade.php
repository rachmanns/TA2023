{{-- Modal Pangkat --}}
<div class="modal fade text-left" id="rumah_sakit_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="max-width:87%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Faskes TNI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('yankesin.rumah_sakit.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id_angkatan" id="id_angkatan">
                    <div class="form-group form-input">
                        <label for="nama_rs">Nama Faskes</label>
                        <input type="text" class="form-control" id="nama_rs" placeholder="Nama Faskes" name="nama_rs" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <label class="form-label form-input">Matra Faskes</label>
                    <div class="demo-inline-spacing mb-1">
                        @foreach ($matra as $item)
                                <div class="custom-control custom-radio mt-0">
                                    <input type="radio" id="{{ $item->kode_matra }}"  name="kode_matra" class="custom-control-input matra" value="{{ $item->kode_matra }}"/>
                                    <label class="custom-control-label" for="{{ $item->kode_matra }}">{{(($item->kode_matra != 'MABES')?'TNI':''). " ".$item->kode_matra }}</label>
                                </div>
                        @endforeach
                        <div class="invalid-feedback"></div>
                    </div>
                    <label class="form-label form-input">Tipe Faskes</label>
                    <div class="demo-inline-spacing mb-1">
                            <div class="custom-control custom-radio mt-0">
                                <input type="radio" id="FKTP"  name="jenis_rs" class="custom-control-input" value="FKTP" checked />
                                <label class="custom-control-label" for="FKTP">FKTP</label>
                            </div>
                            <div class="custom-control custom-radio mt-0">
                                <input type="radio" id="FKTL"  name="jenis_rs" class="custom-control-input" value="FKTL"/>
                                <label class="custom-control-label" for="FKTL">FKTL</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-0">
                                <input type="checkbox" id="RSS" name="rss" class="custom-control-input" value="RSS"/>
                                <label class="custom-control-label" for="RSS">RS Sandaran Operasi TNI</label>
                            </div>
                        <div class="invalid-feedback"></div>
                    </div>                    
                    <div class="form-group form-input">
                        <label for="kotama">Kotama*</label>
                        <select id="parent_komando" class="select2 form-control form-control-lg" required></select>
                    </div>
                    <div class="form-group form-input">
                        <label for="satker">Satker</label>
                        <select id="parent_sub_komando" class="select2 form-control form-control-lg"></select>
                    </div>
                    <div class="form-group form-input">
                        <label for="subsatker">Subsatker</label>
                        <select id="parent_subsatker" class="select2 form-control form-control-lg"></select>
                    </div>
                    <div class="form-group form-input">
                        <label for="tingkat_rs">Tingkat*</label>
                        <select id="id_tingkat_rs" name="id_tingkat_rs" class="select2 form-control form-control-lg">
                            <option selected disabled>Tingkat RS</option>
                            @foreach ($tingkat_rs as $tr)
                                <option value="{{ $tr->id_tingkat_rs }}">{{ $tr->nama_tingkat_rs }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="alamat">Alamat*</label>
                        <textarea rows="3" id="alamat" class="form-control" placeholder="Alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group form-input">
                        <label for="parent_provinsi">Provinsi*</label>
                        <select id="parent_provinsi" class="select2 form-control form-control-lg" required></select>
                    </div>
                    <div class="form-group form-input">
                        <label for="parent_kota_kab">Kota/Kabupaten*</label>
                        <select id="parent_kota_kab" name="id_kotakab" class="select2 form-control form-control-lg" required></select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="phone-number">No. Telp</label>
                    <div class="input-group input-group-merge mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ID (+62)</span>
                        </div>
                        <input type="text" class="form-control phone-number-mask" id="phone-number" name="telp" />
                    </div>
                    <div class="form-group form-input">
                        <label for="no">Nomor Surat Izin Operasional*</label>
                        <input type="text" class="form-control" id="no" placeholder="Nomor Izin Operasional" name="no_ijin_opr" required />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="imb">IMB</label>
                        <select id="imb" name="imb" class="select2 form-control form-control-lg">
                            <option selected disabled>Status IMB</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="ipal">IPAL</label>
                        <select id="ipal" name="ipal" class="select2 form-control form-control-lg">
                            <option selected disabled>Status IPAL</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="akreditasi">Akreditasi</label>
                        <select id="akreditasi" name="akreditasi" class="select2 form-control form-control-lg">
                            <option selected disabled>Status Akreditasi</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="keuangan">Keuangan</label>
                        <select id="keuangan" name="keuangan" class="select2 form-control form-control-lg">
                            <option selected disabled>Pengelolaan Keuangan</option>
                            <option value="BLU">BLU</option>
                            <option value="Proses BLU">Proses BLU</option>
                            <option value="PNPB">PNPB</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="wilayah">Wilayah Kerja</label>
                        <input type="text" class="form-control" id="wilayah" placeholder="Wilayah Kerja" name="wilayah_kerja" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                      <div class="form-group form-input col-6">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" placeholder="latitude" name="latitude" />
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="form-group form-input col-6">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" placeholder="longitude" name="longitude" />
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label>Pilih dari peta</label>
                        <div id="map" style="height:400px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>