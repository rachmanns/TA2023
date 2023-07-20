<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Tambah Dokumen SDM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form action="{{ url('bangkes/dokumen-tenaga-medis') }}" autocomplete="off" class="default-form">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-body">
                    <div class="form-group form-input">
                        <label>Judul</label>
                        <input type="text" class="form-control" placeholder="Judul" name="judul" id="judul"/>
                        <div class="invalid-feedback"></div>
                    </div>

                    <label>Tahun</label>
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Tahun" readonly name="tahun"/>
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mt-1 form-input">
                        <label for="customFile1">Upload File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file"/>
                            <label class="custom-file-label">Upload File</label>
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