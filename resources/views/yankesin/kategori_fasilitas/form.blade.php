<div class="modal fade text-left" id="kf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Kategori Fasilitas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('yankesin/kategori-fasilitas') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label for="nama_kategori">Kategori Fasilitas</label>
                        <input type="text" id="nama_kategori" class="form-control" placeholder="Kategori Fasilitas" name="nama_kategori" />
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
