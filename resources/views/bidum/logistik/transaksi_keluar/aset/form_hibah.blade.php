{{-- Modal Daerah--}}
<div class="modal fade text-left" id="hibah_modal" tabindex="-1" role="dialog"
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
                    {{-- <div class="form-group form-input mt-1">
                        <label class="form-label" for="nomor">Kode Dokumen Berita Acara</label>
                        <input type="text" id="nomor" class="form-control" placeholder="Kode Dokumen Berita Acara"/>
                    </div>
                    <div class="form-group form-input">
                        <label for="customFile1">Dokumen Berita Acara</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="customFile1" />
                            <label class="custom-file-label" for="customFile1">Pilih Berita Acara</label>
                        </div>
                    </div> --}}
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_rth_hibah">Kode Dokumen RTH Hibah</label>
                        <input type="text" id="no_rth_hibah" class="form-control" placeholder="Kode Dokumen RTH Hibah" name="no_rth_hibah"/>
                    </div>
                    <div class="form-group form-input">
                        <label for="file_rth_hibah">Dokumen RTH Hibah</label>
                        <div class="custom-file">
                            <input type="file" name="file_rth_hibah" class="custom-file-input" id="file_rth_hibah" />
                            <label class="custom-file-label" for="file_rth_hibah">Pilih RTH Hibah</label>
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