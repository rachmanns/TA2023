{{-- Modal Militer --}}
<div class="modal fade text-left" id="edit-pend-militer-pers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Pendidikan Militer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.update_pend_militer_pers') }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_pend_militer_pers" id="id-pend-militer-pers">
                    <label class="form-label mb-1">Kategori Pendidikan</label>
                    <div class="row mb-1 form-input">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="edit-kategori-pendidikan1" name="kategori_pendidikan" class="custom-control-input" value="Diktuk/Dikbangum"/>
                                <label class="custom-control-label" for="edit-kategori-pendidikan1">Diktuk/Dikbangum</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="edit-kategori-pendidikan2" name="kategori_pendidikan" class="custom-control-input" value="Dikbangspes"/>
                                <label class="custom-control-label" for="edit-kategori-pendidikan2">Dikbangspes</label>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div> 
                    <div class="form-group form-input">
                        <label for="edit-kriteria-tingkat">Kriteria Pendidikan</label>
                        <select id="edit-kriteria-tingkat" name="kriteria_tingkat" class="select2 form-control form-control-lg">
                            <option disabled selected>Pilih Kriteria Pendidikan</option>
                            <option value="bintara">Bintara</option>
                            <option value="tamtama">Tamtama</option>
                            <option value="perwira">Perwira</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit-nama-sekolah-militer">Nama Sekolah</label>
                        <input type="text" id="edit-nama-sekolah-militer" class="form-control" placeholder="Nama Sekolah" name="nama_sekolah" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="tahun-lulus-militer">Tahun Lulus</label>
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="edit-tahun-lulus-militer" class="pick-year form-control" placeholder="Tahun Lulus" name="tahun_lulus"/>
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