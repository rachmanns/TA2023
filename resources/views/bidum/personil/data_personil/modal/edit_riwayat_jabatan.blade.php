{{-- Modal Jabatan --}}
<div class="modal fade text-left" id="edit_riwayat_jabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Riwayat Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_riwayat_jabatan') }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_riwayat_jabatan" id="id_riwayat_jabatan">
                <div class="row">
                    <div class="form-group col-md-6 form-input">
                        <label class="form-label" for="jabatan">Jabatan</label>
                        <select name="id_jabatan" id="edit_id_jabatan" class="select2 form-control">
                            @foreach ($jabatan as $item)
                                <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tmt_jabatan">TMT Jabatan</label>
                        <input type="text" id="edit_tmt_jabatan" class="form-control flatpickr-false" placeholder="TMT Jabatan" name="tmt_jabatan" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="no_skep_jabatan">No. SKEP</label>
                        <input type="text" id="edit_no_skep_jabatan" class="form-control" placeholder="No. SKEP" name="no_skep_jabatan" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tgl_skep_jabatan">Tanggal SKEP</label>
                        <input type="text" id="edit_tgl_skep_jabatan" class="form-control flatpickr-false" placeholder="Tanggal SKEP" name="tgl_skep_jabatan" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="no_sprin_jabatan">No. SPRIN</label>
                        <input type="text" id="edit_no_sprin_jabatan" class="form-control" placeholder="No. SPRIN" name="no_sprin_jabatan" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input col-md-6">
                        <label class="form-label" for="tgl-sprin">Tanggal SPRIN</label>
                        <input type="text" id="edit_tgl_sprin_jabatan" class="form-control flatpickr-false" placeholder="Tanggal SPRIN" name="tgl_sprin_jabatan" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>