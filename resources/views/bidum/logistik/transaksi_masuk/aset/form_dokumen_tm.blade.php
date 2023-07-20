{{-- Modal Transfer--}}
<div class="modal fade text-left" id="transfer_modal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Dokumen Transfer Masuk - Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('bidum.logistik.transfer_masuk.store_transfer','aset') }}" class="default-form" autocomplete="off">
                <input type="hidden" name="_method" value="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_kontrak_tktm">Nomor Kontrak*</label>
                        <input type="text" id="no_kontrak_tktm" class="form-control" placeholder="Nomor Kontrak" name="no_kontrak_tktm"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="nominal">Nominal Kontrak*</label>
                        <input type="text" id="nominal" class="form-control jumlah" placeholder="Nominal Kontrak" name="nominal"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input bg-white">
                        <label class="form-label" for="tgl_kontrak_tktm">Tanggal Kontrak*</label>
                        <input type="text" id="tgl_kontrak_tktm" class="form-control flatpickr-basic" placeholder="Tanggal Kontrak" name="tgl_kontrak_tktm"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="pelaksana_tktm">Pelaksana*</label>
                        {{-- <input type="text" id="pelaksana_tktm" class="form-control" placeholder="Pelaksana" name="pelaksana_tktm"/> --}}
                        <select name="pelaksana_tktm" id="pelaksana_tktm" class="form-control select2">
                            <option selected disabled>Pilih Pelaksana</option>
                            @foreach ($vendor as $item)
                                <option value="{{ $item->id_vendor }}">{{ $item->nama_vendor }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label for="customFile1">Dokumen Kontrak*</label>
                        <div class="custom-file">
                            <input type="file" name="file_kontrak_tktm" class="custom-file-input" id="file_kontrak_tktm" />
                            <label class="custom-file-label" for="file_kontrak_tktm">Pilih Dokumen Kontrak</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    {{-- <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_rth_tk">Nomor Dokumen RTH TK</label>
                        <input type="text" id="no_rth_tk" class="form-control" placeholder="Nomor Dokumen RTH TK" name="no_rth_tk"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label for="customFile1">Dokumen RTH TK</label>
                        <div class="custom-file">
                            <input type="file" name="file_rth_tk" class="custom-file-input" id="file_rth_tk" />
                            <label class="custom-file-label" for="file_rth_tk">Pilih Dokumen RTH TK</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div> --}}
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_rth_tm">Nomor Dokumen RTH TM</label>
                        <input type="text" id="no_rth_tm" class="form-control" placeholder="Nomor Dokumen RTH TM" name="no_rth_tm"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label for="customFile1">Dokumen RTH TM</label>
                        <div class="custom-file">
                            <input type="file" name="file_rth_tm" class="custom-file-input" id="file_rth_tm" />
                            <label class="custom-file-label" for="file_rth_tm">Pilih Dokumen RTH TM</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>