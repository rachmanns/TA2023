{{-- Modal Bahasa --}}
<div class="modal fade text-left" id="bahasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Kecakapan Bahasa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.store_bahasa') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                <div class="row mb-1 form-input">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="jenis" id="asing" class="custom-control-input" value="asing"/>
                            <label class="custom-control-label" for="asing">Asing</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="jenis" id="daerah" class="custom-control-input" value="daerah"/>
                            <label class="custom-control-label" for="daerah">Daerah</label>
                        </div>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group form-input">
                    <label class="form-label" for="bhs">Bahasa</label>
                    <input type="text" id="bhs" class="form-control" placeholder="Bahasa" name="bahasa"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="row form-input">
                    <div class="col-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="kompetensi" id="aktif" class="custom-control-input" value="aktif"/>
                            <label class="custom-control-label" for="aktif">Aktif</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="kompetensi" id="pasif" class="custom-control-input" value="pasif"/>
                            <label class="custom-control-label" for="pasif">Pasif</label>
                        </div>
                    </div>
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