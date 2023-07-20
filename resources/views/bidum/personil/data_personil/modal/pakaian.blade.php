{{-- Modal Ubah Pakaian --}}
<div class="modal fade text-left" id="ubah-pakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Data Pakaian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="mb-1 mt-1 font-weight-bolder">Edit Data Pakaian</h5>
                <form action="{{ route('bidum.personil.store_pakaian_personil') }}" class="default-form" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_personil" value="{{ $id_personil }}">
                    <div class="row">
                        @foreach ($pakaian as $item)
                        <div class="form-group col-md-4">
                            <label class="form-label" for="{{ $item->id_pakaian }}">{{ $item->item_pakaian }}</label>
                            <input type="text" id="{{ $item->id_pakaian }}" class="form-control" placeholder="Terisi" name="{{ $item->id_pakaian }}"
                            value="{{ $item->ukuran??null }}" 
                            />
                        </div>
                        @endforeach
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>