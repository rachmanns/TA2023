<div class="modal fade text-left" id="kf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Kategori Fasilitas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('yankesin/fasilitas') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label for="id_kategori">Kategori Fasilitas</label>
                        <select name="id_kategori" id="id_kategori" class="form-control">
                            @foreach ($kategori_fasilitas as $kf)
                                <option value="{{ $kf->id_kategori }}">{{ $kf->nama_kategori }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" id="id_kategori" class="form-control" placeholder="Kategori Fasilitas" name="id_kategori" /> --}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="nama_fasilitas">Nama Fasilitas</label>
                        <input type="text" id="nama_fasilitas" class="form-control" placeholder="Nama Fasilitas" name="nama_fasilitas" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
