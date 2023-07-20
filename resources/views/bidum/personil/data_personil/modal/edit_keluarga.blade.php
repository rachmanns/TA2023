{{-- Modal Anggota Keluarga --}}
<div class="modal fade text-left" id="edit_keluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Anggota Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_keluarga') }}" class="default-form" id="form-keluarga" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_keluarga" id="id_keluarga">
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_nama">Nama Lengkap</label>
                        <input type="text" id="edit_nama" class="form-control" placeholder="Nama Lengkap" name="nama"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="edit_tempat_lahir" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_tgl_lahir">Tanggal Lahir</label>
                        <input type="text" id="edit_tgl_lahir" class="form-control flatpickr-false" placeholder="Tanggal Lahir" name="tgl_lahir"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_hubungan">Hubungan Keluarga</label>
                        <select name="hubungan" id="edit_hubungan" class="select2 form-control">
                            <option value="ayah">Ayah</option>
                            <option value="ibu">Ibu</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>