{{-- Modal Add --}}
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Bekkes Satgas Dalam Negeri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dukkesops.satgas-dn.store') }}" class="default-form" autocomplete="off">
                <input type="hidden" name="_method" value="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-12 form-input">
                            <label class="form-label">Tahun</label>
                            <div class="input-group input-group-merge form-input">
                                <input type="text" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" readonly name="tahun" id="tahun" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12 mt-1">
                            <label class="form-label">Satgas</label>
                            <input type="text" class="form-control" placeholder="Satgas" name="satgas" id="satgas">
                            <div class="invalid-feedback"></div>    
                        </div>
                        <div class="col-md-12 col-12 mt-1">
                            <label class="form-label">Jumlah Personil</label>
                            <input type="text" class="form-control" placeholder="Jumlah Personil" name="jumlah" id="jumlah">
                            <div class="invalid-feedback"></div>    
                        </div>
                        <div class="col-md-12 col-12 mt-1">
                            <label class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" placeholder="Nomor Surat" name="no_surat" id="no_surat">
                            <div class="invalid-feedback"></div>    
                        </div>
                    </div>
                    <div class="form-group form-input">
                        <label for="customFile1">Dokumen Bekkes Disetujui</label>
                        <div class="custom-file">
                            <input type="file" name="file_disetujui" class="custom-file-input" id="customFile1" />
                            <label class="custom-file-label dbd" for="customFile1">Dokumen Bekkes Disetujui</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>