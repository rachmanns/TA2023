<div class="modal fade text-left" id="create_tanda_jasa_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Tanda Jasa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tanda_jasa.store') }}" class="default-form">
                    @csrf
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_jasa">Nama Jasa</label>
                        <input type="text" name="nama_jasa" id="nama_jasa" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>