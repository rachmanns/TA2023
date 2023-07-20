<div class="modal fade text-left" id="edit_pangkat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Pangkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="default-form">
                    @method('PUT')
                    @csrf
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_kode_matra">Matra</label>
                        <select name="kode_matra" class="form-control" id="edit_kode_matra">
                            @foreach ($matra as $item)
                                <option value="{{ $item->kode_matra }}">{{ $item->nama_matra }}</option>                            
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_nama_pangkat">Nama Pangkat</label>
                        <input type="text" name="nama_pangkat" id="edit_nama_pangkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_masa_kenkat">Masa Kenkat (dalam satuan tahun)</label>
                        <input type="number" name=" masa_kenkat" id="edit_masa_kenkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_jenis_pangkat">Jenis Pangkat</label>
                        <input type="text" name="jenis_pangkat" id="edit_jenis_pangkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="edit_next_pangkat">Next Pangkat</label>
                        <select name="next_pangkat" class="form-control" id="edit_next_pangkat">
                            <option value="">Pilih Pangkat</option>
                            @foreach ($pangkat as $item)
                                <option value="{{ $item->id_pangkat }}">{{ $item->nama_pangkat }}</option>                            
                            @endforeach
                        </select>
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