{{-- Modal Nonaktif --}}
<div class="modal fade text-left" id="nonaktif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Alasan Penonaktifan Personil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('bidum.personil.nonaktif_personil',$personil->id_personil) }}" class="default-form">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="alasan">Alasan Penonaktifan</label>
                        <select id="alasan" name="alasan" class="select2 form-control form-control-lg" onchange="showDiv('hidden_div', this)">
                            <option disabled selected>Pilih Alasan</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                            {{-- <option value="1">Resign</option>
                            <option value="2">Pensiun</option>
                            <option value="3">Lainnya</option> --}}
                        </select>
                        <div class="form-group mt-1" id="hidden_div">
                            <label class="form-label" for="alasan">Alasan</label>
                            <textarea rows="2" id="alasan" class="form-control" placeholder="Alasan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>