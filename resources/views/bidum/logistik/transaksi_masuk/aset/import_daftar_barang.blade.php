{{-- Modal Master--}}
<div class="modal fade text-left" id="impor" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Impor Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('bidum.logistik.daftar_barang.excel_import') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_barang_masuk" value="{{ $in_tktm->id_in_tktm }}">
                <div class="modal-body">
                    <h4>Tambah Barang</h4>
                    <p>Rencana Pengeluaran*</p>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rencana_pengeluaran" id="ada" value="ada">
                                <label class="form-check-label" for="ada">Ada</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rencana_pengeluaran" id="tidak-ada" value="tidak_ada" checked>
                                <label class="form-check-label" for="tidak-ada">Tidak Ada</label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="check-ada" style="display: none">
                        <div class="form-group form-input mt-1">
                            <label class="form-label" for="penerima">Penerima Barang</label>
                            <input type="text" id="penerima" class="form-control" placeholder="Penerima Barang" name="penerima" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input mt-1">
                            <label class="form-label" for="tujuan_penggunaan">Tujuan Penggunaan</label>
                            <input type="text" id="tujuan_penggunaan" class="form-control" placeholder="Tujuan Penggunaan" name="tujuan_penggunaan"/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group form-input">
                        <label for="file">Pilih File Excel</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" />
                            <label class="custom-file-label" for="file_rth">Pilih File Excel</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <a href="{{ url('template/detail_barang') }}"><< download template excel detail barang >></a>
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