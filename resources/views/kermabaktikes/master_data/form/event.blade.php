<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kerma.event.store') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label class="form-label">Jenis Kerma</label>
                        <select class="select2 form-control form-control-lg" name="id_jenis_kerma" id="id_jenis_kerma">
                            <option selected disabled>Pilih Jenis Kerma</option>
                            @foreach ($jenis_kerma as $item)
                                <option value="{{ $item->id_jenis_kerma }}">{{ $item->jenis_kerma }} | {{ $item->cakupan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_event">Nama Event</label>
                        <input type="text" id="nama_event" class="form-control" name="nama_event">
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