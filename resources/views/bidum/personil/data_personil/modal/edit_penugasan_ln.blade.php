{{-- Modal LN --}}
<div class="modal fade text-left" id="edit_penugasan_ln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Penugasan LN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_penugasan') }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_penugasan" id="id_penugasan_ln">
                <div class="form-group form-input">
                    <label class="form-label" for="edit_tugas_ln">Macam Tugas</label>
                    <input type="text" id="edit_tugas_ln" class="form-control" placeholder="Macam Tugas" name="tugas" />
                </div>
                <label for="edit_tahun_ln">Tahun</label>
                <div class="input-group input-group-merge form-input">
                    <input type="text" id="edit_tahun_ln" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" name="tahun" readonly/>
                    <div class="input-group-append">
                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                    </div>
                </div>
                <div class="invalid-feedback"></div>
                <div class="form-group form-input mt-1">
                    <label class="form-label" for="edit_lokasi_ln">Negara Tujuan</label>
                    <input type="text" id="edit_lokasi_ln" class="form-control" placeholder="Negara Tujuan" name="lokasi" />
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