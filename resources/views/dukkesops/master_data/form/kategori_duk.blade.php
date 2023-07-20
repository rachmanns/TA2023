<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('dukkesops/kategori-duk') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label class="form-label">Jenis Kegiatan</label>
                        <select class="select2 form-control form-control-lg" id="id_jenis_keg_duk" name="id_jenis_keg_duk">
                            <option selected disabled>Pilih Jenis Kegiatan</option>
                            @foreach ($jenis_keg_duk as $jkd)
                                <option value="{{ $jkd->id_jenis_keg_duk }}">{{ $jkd->nama_jenis }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_kategori">Nama Kategori</label>
                        <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" placeholder="Nama Kategori">
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