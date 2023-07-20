<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Jenis Kegiatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kerma.jenis_kegiatan.store') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label class="form-label" for="jenis_keg">Jenis Kegiatan</label>
                        <input type="text" id="jenis_keg" class="form-control" name="jenis_keg">
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="">Kategori Kegiatan</label>
                    <div class="row form-input">
                        <div class="col-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="kerma" name="kategori_keg" class="custom-control-input" value="kerma"/>
                                <label class="custom-control-label" for="kerma">Kerma</label>
                            </div>   
                        </div>
                        <div class="col-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="bakti" name="kategori_keg" class="custom-control-input" value="bakti"/>
                                <label class="custom-control-label" for="bakti">Bakti</label>
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