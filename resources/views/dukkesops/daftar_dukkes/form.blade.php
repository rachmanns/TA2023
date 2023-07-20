{{-- Modal Add --}}
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Input Dukkes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dukkesops.dukkes.store') }}" class="default-form" autocomplete="off">
                <input type="hidden" name="_method" value="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group form-input">
                        <label class="form-label">Dukkes</label>
                        <input type="text" class="form-control" placeholder="Dukkes" name="nama_dukkes" id="nama_dukkes">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label">Tempat</label>
                        <input type="text" class="form-control" placeholder="Tempat" name="tempat" id="tempat">
                        <div class="invalid-feedback"></div>
                    </div>
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <div class="form-group form-input">
                        <input type="text" id="tanggal" class="form-control" placeholder="Tanggal" name="tanggal"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="customFile1">Lampiran Surat</label>
                        <div class="custom-file">
                            <input type="file" name="lampiran_surat" class="custom-file-input" id="customFile1" />
                            <label class="custom-file-label" for="customFile1">Lampiran Surat</label>
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