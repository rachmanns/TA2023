{{-- Modal Umum --}}
<div class="modal fade text-left" id="umum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tambah Pendidikan Umum</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.personil.store_pendidikan_umum') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <div class="form-group form-input">
                        <label class="form-label" for="tingkat">Tingkat Pendidikan</label>
                        <select name="id_pend_umum" id="" class="select2 form-control">
                            @foreach ($pendidikan_umum as $item)
                                <option value="{{ $item->id_pend_umum }}">{{ $item->tingkat_pendidikan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="nama">Nama Sekolah</label>
                        <input type="text" id="nama_sekolah" class="form-control" placeholder="Nama Sekolah" name="nama_sekolah"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <label for="tahun">Tahun Lulus</label>
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="pick-year form-control" placeholder="Tahun Lulus" name="tahun_lulus"/>
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