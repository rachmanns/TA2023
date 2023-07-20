{{-- Modal Edit--}}
<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Daftar Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('matfaskes/pengadaan/edit-excel-brg') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_barang_masuk" value="{{ $kontrak->id_kontrak }}">
                <div class="modal-body">
                    <div class="form-group form-input mb-50">
                        <label for="file">Pilih File Excel</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" />
                            <label class="custom-file-label" for="file_rth">Pilih File Excel</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <a href="{{ url('matfaskes/pengadaan/download-edit/'.$kontrak->id_kontrak) }}" style="font-size: 12px;">
                        << Download Excel Daftar Barang>>
                    </a>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>