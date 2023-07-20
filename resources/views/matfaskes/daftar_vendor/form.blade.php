{{-- Tambah --}}
<div class="modal fade text-left" id="modal_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('matfaskes.vendor.store') }}" class="default-form" autocomplete="off">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-body"> 
                    <div class="form-group form-input">
                        <label class="form-label" for="nama_vendor">Nama Vendor</label>
                        <input type="text" id="nama_vendor" class="form-control" placeholder="Nama Vendor" name="nama_vendor" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="alamat">Alamat Vendor</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="direktur">Direktur</label>
                        <input type="text" id="direktur" class="form-control" placeholder="Direktur" name="direktur" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label class="form-label" for="npwp">NPWP Badan</label>
                        <input type="text" id="npwp" class="form-control" placeholder="NPWP Badan" name="npwp" />
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