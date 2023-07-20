{{-- Modal LN --}}
<div class="modal fade text-left" id="ln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Penugasan LN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.store_penugasan') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <input type="hidden" name="jenis" value="ln">
                <div class="form-group form-input">
                    <label class="form-label" for="macam">Macam Tugas</label>
                    <input type="text" id="macam" class="form-control" placeholder="Macam Tugas" name="tugas" />
                </div>
                <label for="tahun">Tahun</label>
                <div class="input-group input-group-merge form-input">
                    <input type="text" id="tahun" class="yearpicker-full form-control bg-white cursor-pointer" placeholder="Tahun" name="tahun" readonly/>
                    <div class="input-group-append">
                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                    </div>
                </div>
                <div class="invalid-feedback"></div>
                <div class="form-group form-input mt-1">
                    <label class="form-label" for="lokasi">Negara Tujuan</label>
                    <input type="text" id="lokasi" class="form-control" placeholder="Negara Tujuan" name="lokasi" />
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