 {{-- Edit Lapju --}}
 <div class="modal fade text-left" id="lapju" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Lapju</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body"> 
                    <div class="form-group form-input">
                        <label class="form-label">Lapju Min (%)</label>
                        <input type="text" class="form-control" placeholder="Lapju Min (%)" name="lapju_min" id="lapju_min"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label">Lapju Sik (%)</label>
                        <input type="text" class="form-control" placeholder="Lapju Sik (%)" name="lapju_sik" id="lapju_sik"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>