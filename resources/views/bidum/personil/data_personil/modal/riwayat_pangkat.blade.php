{{-- Modal Pangkat --}}
<div class="modal fade text-left" id="pangkat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Riwayat Pangkat/Gol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.store_riwayat_pangkat') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group form-input">
                                <label class="form-label" for="pangkat">Pangkat</label>
                                <select name="id_pangkat" id="id_pangkat" class="form-control select2">
                                    @foreach ($pangkat as $item)
                                        <option value="{{ $item->id_pangkat }}">{{ $item->nama_pangkat }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label" for="tmt">TMT Pangkat</label>
                            <div class="form-group form-input">
                                <input type="text" id="tmt_pangkat" class="form-control flatpickr-false" placeholder="TMT Pangkat" name="tmt_pangkat"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group form-input">
                                <label class="form-label" for="no_skep_pangkat">No. SKEP</label>
                                <input type="text" id="no_skep_pangkat" class="form-control" placeholder="No. SKEP" name="no_skep_pangkat" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label" for="tgl_skep_pangkat">Tanggal SKEP</label>
                            <div class="form-group form-input">
                                <input type="text" id="tgl_skep_pangkat" class="form-control flatpickr-false" placeholder="Tanggal SKEP" name="tgl_skep_pangkat" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group form-input">
                                <label class="form-label" for="no_sprin_pangkat">No. SPRIN</label>
                                <input type="text" id="no_sprin_pangkat" class="form-control" placeholder="No. SPRIN" name="no_sprin_pangkat" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label" for="tgl_sprin_pangkat">Tanggal SPRIN</label>
                            <div class="form-group form-input">
                                <input type="text" id="tgl_sprin_pangkat" class="form-control flatpickr-false" placeholder="Tanggal SPRIN" name="tgl_sprin_pangkat" />
                                <div class="invalid-feedback"></div>
                            </div>
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