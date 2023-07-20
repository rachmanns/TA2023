{{-- Modal Edit --}}
<div class="modal fade text-left" id="edit_werving" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Data Rikkes Werving</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off" id="form_edit_werving" method="POST"
                enctype="multipart/form-data" action="{{ route('dukkesops.werving.update_werving') }}">
                @csrf
                <input type="hidden" name="id_kegiatan_duk" id="id_kegiatan_duk">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Nama Kategori</label>
                            <select class="select2 form-control form-control-lg" name="id_kat_duk" id="id_kat_duk_m">
                                <option selected disabled>Nama Kategori</option>
                                @foreach ($kegiatan_duk as $item)
                                    <option value="{{ $item->id_kat_duk }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Tahun Anggaran</label>
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun_anggaran"
                                    class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                                    name="tahun_anggaran" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="tempat">Tempat Pelaksana</label>
                            <input type="text" id="tempat" class="form-control" placeholder="Tempat Pelaksana"
                                name="tempat">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="tanggal">Tanggal Pelaksana</label>
                            <input type="text" id="tanggal" class="form-control flatpickr-basic"
                                placeholder="Tanggal Pelaksana" name="tanggal" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
