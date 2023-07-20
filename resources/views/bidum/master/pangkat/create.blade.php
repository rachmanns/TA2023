<div class="modal fade text-left" id="create_pangkat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Pangkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pangkat.store') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label class="form-label" for="kode_matra">Matra</label>
                        <select name="kode_matra" class="form-control" id="kode_matra">
                            <option disabled selected>Pilih Matra</option>
                            @foreach ($matra as $item)
                                <option value="{{ $item->kode_matra }}">{{ $item->nama_matra }}</option>                            
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_pangkat">Nama Pangkat</label>
                        <input type="text" name="nama_pangkat" id="nama_pangkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="masa_kenkat">Masa Kenkat (dalam satuan tahun)</label>
                        <input type="number" name="masa_kenkat" id="masa_kenkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="jenis_pangkat">Jenis Pangkat</label>
                        <input type="text" name="jenis_pangkat" id="jenis_pangkat" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="next_pangkat">Next Pangkat</label>
                        <select name="next_pangkat" class="form-control" id="next_pangkat">
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="usia_pensiun">Usia Pensiun (dalam satuan tahun)</label>
                        <input type="number" name="usia_pensiun" id="usia_pensiun" class="form-control">
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