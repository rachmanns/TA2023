{{-- Modal Pusat--}}
<div class="modal fade text-left" id="pemakaian_modal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Upload Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td class="border-top-0 pl-0 pb-0">No Kontrak</td>
                            <td class="border-top-0 pr-0 pb-0">:</td>
                            <td class="border-top-0 pl-0 pr-0 pb-0" id="no_nota_dinas"></td>
                        </tr>
                        <tr>
                            <td class="border-top-0 pl-0 pb-0">Nominal</td>
                            <td class="border-top-0 pr-0 pb-0">:</td>
                            <td class="border-top-0 pl-0 pr-0 pb-0" id="nominal"></td>
                        </tr>
                    </table>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_ppm">Kode Dokumen PPM</label>
                        <input type="text" id="no_ppm" class="form-control" placeholder="Kode Dokumen PPM" name="no_ppm"/>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label for="file_ppm">Dokumen PPM</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_ppm" name="file_ppm" />
                            <label class="custom-file-label" for="file_ppm">Pilih Dokumen PPM</label>
                        </div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_rth">Kode Dokumen RTH</label>
                        <input type="text" id="no_rth" class="form-control" placeholder="Nomor Dokumen RTH TK" name="no_rth"/>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label for="file_rth">Dokumen RTH</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_rth" name="file_rth"/>
                            <label class="custom-file-label" for="file_rth">Pilih Dokumen RTH</label>
                        </div>
                    </div>
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