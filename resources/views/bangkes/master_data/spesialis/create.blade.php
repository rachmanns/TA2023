<div class="modal fade text-left" id="spesialis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Spesialis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('bangkes/jenis-spesialis') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label for="id_kategori_dokter">Kategori Dokter</label>
                        <select id="id_kategori_dokter" class="form-control" name="id_kategori_dokter">
                            <option selected disabled>Pilih Kategori Dokter</option>
                            @foreach ($kategori_dokter as $kd)
                                <option value="{{ $kd->id_kategori_dokter }}">{{ $kd->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="nama_spesialis">Spesialis</label>
                        <input type="text" id="nama_spesialis" class="form-control" placeholder="Spesialis" name="nama_spesialis" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
