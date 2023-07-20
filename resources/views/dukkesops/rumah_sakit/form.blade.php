<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Rumah Sakit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('dukkesops/rs') }}" class="default-form" autocomplete="off">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-body">
                    <div class="form-group form-input">
                        <label for="nama_rs">Nama RS</label>
                        <input type="text" id="nama_rs" class="form-control" placeholder="Nama RS" name="nama_rs" />
                        <div class="invalid-feedback"></div>
                    </div>
                    {{-- <div class="form-group form-input">
                        <label for="nama_rs">Kategori</label>
                        <select class="select2 form-control">
                            <option disabled selected>Pilih Kategori</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div> --}}
                    <div class="form-group form-input">
                        <label for="lat">Latitude</label>
                        <input type="text" id="latitude" class="form-control" placeholder="Latitude" name="latitude" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="long">Longitude</label>
                        <input type="text" id="longitude" class="form-control" placeholder="Longitude" name="longitude" />
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
