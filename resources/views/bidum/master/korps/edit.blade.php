<div class="modal fade text-left" id="edit_korps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Korps</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="default-form">
                    @method('PUT')
                    @csrf
                    <div class="form-group form-input">
                        <label class="form-label" for="kode_matra">Matra</label>
                        <select name="kode_matra" class="form-control" id="edit_kode_matra">
                            @foreach ($matra as $item)
                                <option value="{{ $item->kode_matra }}">{{ $item->nama_matra }}</option>                            
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="kode_korps">Kode Korps</label>
                        <input type="text" name="kode_korps" id="edit_kode_korps" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_korps">Nama Korps</label>
                        <input type="text" name="nama_korps" id="edit_nama_korps" class="form-control">
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