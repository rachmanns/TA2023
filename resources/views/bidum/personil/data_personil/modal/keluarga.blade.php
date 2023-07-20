{{-- Modal Anggota Keluarga --}}
<div class="modal fade text-left" id="anggota-keluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Anggota Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.store_keluarga') }}" class="default-form" id="form-keluarga" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <div class="form-group form-input">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" name="nama"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="tempat">Tempat Lahir</label>
                        <input type="text" id="tempat" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="tgl">Tanggal Lahir</label>
                        <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal Lahir" name="tgl_lahir"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="hubungan">Hubungan Keluarga</label>
                        <select name="hubungan" id="hubungan" class="select2 form-control">
                            <option value="ayah">Ayah</option>
                            <option value="ibu">Ibu</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                        </select>
                        <div class="invalid-feedback"></div>
                        {{-- <input type="text" id="hubungan" class="form-control" placeholder="Hubungan Keluarga" name="hubungan"/> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>