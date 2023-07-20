<div class="modal fade text-left" id="mb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Master Bekkes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('dukkesops/master-bekkes') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label for="nama_bekkes">Nama Bekkes</label>
                        <input type="text" id="nama_bekkes" class="form-control" placeholder="Nama Bekkes" name="nama_bekkes" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
