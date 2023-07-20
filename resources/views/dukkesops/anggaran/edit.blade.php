{{-- Modal Edit --}}
<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Dokumen Anggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="customFile1">Dokumen Anggaran</label>
                            <div class="custom-file">
                                <input type="file" name="file_anggaran" class="custom-file-input" id="customFile1"
                                    required />
                                <label class="custom-file-label" for="customFile1">Dokumen Anggaran</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>