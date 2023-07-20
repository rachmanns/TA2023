{{-- Modal Pangkat --}}
<div class="modal fade text-left" id="edit_riwayat_pangkat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Riwayat Pangkat/Gol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_riwayat_pangkat') }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_riwayat_pangkat" id="id_riwayat_pangkat">
                    <div class="form-group form-input">
                        <label class="form-label" for="pangkat">Pangkat</label>
                        <select name="id_pangkat" id="edit_id_pangkat" class="select2 form-control">
                            @foreach ($pangkat as $item)
                                <option value="{{ $item->id_pangkat }}">{{ $item->nama_pangkat }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_tmt_pangkat">TMT Pangkat</label>
                        <input type="text" id="edit_tmt_pangkat" class="form-control flatpickr-false" placeholder="TMT Pangkat" name="tmt_pangkat"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_no_skep_pangkat">No. SKEP</label>
                        <input type="text" id="edit_no_skep_pangkat" class="form-control" placeholder="No. SKEP" name="no_skep_pangkat" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_tgl_skep_pangkat">Tanggal SKEP</label>
                        <input type="text" id="edit_tgl_skep_pangkat" class="form-control flatpickr-false" placeholder="Tanggal SKEP" name="tgl_skep_pangkat" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_no_sprin_pangkat">No. SPRIN</label>
                        <input type="text" id="edit_no_sprin_pangkat" class="form-control" placeholder="No. SPRIN" name="no_sprin_pangkat" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_tgl_sprin_pangkat">Tanggal SPRIN</label>
                        <input type="text" id="edit_tgl_sprin_pangkat" class="form-control flatpickr-false" placeholder="Tanggal SPRIN" name="tgl_sprin_pangkat" />
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