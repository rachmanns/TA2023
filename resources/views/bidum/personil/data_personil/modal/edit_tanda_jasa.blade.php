{{-- Modal Jasa --}}
<div class="modal fade text-left" id="edit_tanda_jasa_pers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">Edit Tanda Jasa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bidum.personil.update_tanda_jasa_pers') }}" class="default-form" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id_jasa_pers" id="id_jasa_pers">
                    <div class="form-group form-input">
                        <label for="edit_id_jasa">Tanda Jasa</label>
                        <select id="edit_id_jasa" name="id_jasa" class="select2 form-control form-control-lg">
                            <option disabled selected>Pilih Jenis Tanda Jasa</option>
                            @foreach ($tanda_jasa as $item)
                                <option value="{{ $item->id_jasa }}">{{ $item->nama_jasa }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="tahun">Tahun Perolehan</label>
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="edit_tahun_jasa" class="pick-year form-control" placeholder="Tahun Perolehan" name="tahun"/>
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>