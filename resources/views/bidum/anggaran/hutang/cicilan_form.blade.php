<!-- Modal Tambah Cicilan -->
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Cicilan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('bidum/anggaran/cicilan') }}" autocomplete="off" class="default-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id_hutang" id="id_hutang">
                    <div class="row d-flex align-items-end">
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="jml_bayar">Nominal</label>
                                <input type="text" class="form-control" id="jml_bayar" placeholder="Nominal" name="jml_bayar" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="tgl_bayar">Tanggal Pembayaran</label>
                                <input type="text" class="form-control flatpickr-false" id="tgl_bayar" placeholder="Tanggal Pembayaran" name="tgl_bayar"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="customFile1">Upload Bukti Bayar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile1" name="bukti_bayar" />
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