<div class="modal fade text-left" id="rf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Regulasi & SOP Bidang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('regulasi') }}" class="default-form" autocomplete="off">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id_bidang" value="{{ $id_bidang }}">
                <div class="modal-body">
                    <div class="row d-flex align-items-end">
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="nama_regulasi">Nama Regulasi & SOP</label>
                                <input type="text" class="form-control" id="nama_regulasi" placeholder="Isi Nama Regulasi & SOP" name="nama_regulasi"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="kategori">Kategori</label>
                                <select class="select2 form-control" name="id_kat_buku" id="id_kat_buku">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id_kat_buku }}">{{ $kat->nama_kat_buku }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="customFile1">Pilih File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile1" name="file" />
                                    <label class="custom-file-label" for="customFile1">Pilih File</label>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>