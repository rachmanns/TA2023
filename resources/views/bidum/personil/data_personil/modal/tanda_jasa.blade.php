{{-- Modal Jasa --}}
<div class="modal fade text-left" id="jasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">Tambah Tanda Jasa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bidum.personil.store_tanda_jasa') }}" class="default-form" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <div class="form-group form-input">
                        <label for="id_jasa">Tanda Jasa</label>
                        <select id="id_jasa" name="id_jasa" class="select2 form-control form-control-lg">
                            <option disabled selected>Pilih Jenis Tanda Jasa</option>
                            @foreach ($tanda_jasa as $item)
                                <option value="{{ $item->id_jasa }}">{{ $item->nama_jasa }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="tahun">Tahun Perolehan</label>
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="pick-year form-control" placeholder="Tahun Perolehan" name="tahun"/>
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