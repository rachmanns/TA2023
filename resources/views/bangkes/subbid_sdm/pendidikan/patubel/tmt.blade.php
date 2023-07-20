<div class="modal fade text-left" id="tmt_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Dokumen Sprint</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group form-input">
                        <label for="tmt">TMT</label>
                        <input type="text" id="tmt_date" class="form-control" placeholder="TMT" name="tmt" />
                        <input type="hidden" name="tmt_awal" id="tmt_awal">
                        <input type="hidden" name="tmt_akhir" id="tmt_akhir">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="">Dokumen Sprint</label>
                        <div class="custom-file">
                            <input type="file" name="file_sprin" class="custom-file-input" id="#" />
                            <label class="custom-file-label" for="#">Dokumen Sprint</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    {{-- <input type="text" id="fp-range" class="form-control flatpickr-range" placeholder="TMT" /> --}}
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Simpan Data" />
                </div>
            </form>
        </div>
    </div>
</div>

