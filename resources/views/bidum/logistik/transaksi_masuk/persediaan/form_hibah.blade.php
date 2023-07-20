{{-- Modal Hibah--}}
<div class="modal fade text-left" id="hibah_modal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Upload Dokumen</h4>
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
                            <td class="border-top-0 pl-0 pr-0 pb-0" id="no_ba_hibah">KJB/11/DN/PUSKES TNI/XI/2019/OPS</td>
                        </tr>
                        <tr>
                            <td class="border-top-0 pl-0 pb-0">Nominal</td>
                            <td class="border-top-0 pr-0 pb-0">:</td>
                            <td class="border-top-0 pl-0 pr-0 pb-0" id="nominal_hibah">1.389.110.000,-</td>
                        </tr>
                    </table>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="no_app_hibah">Nomor Dokumen Persetujuan</label>
                        <input type="text" id="no_app_hibah" class="form-control" placeholder="Nomor Dokumen Persetujuan" name="no_app_hibah"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="tgl_app_hibah">Tanggal Dokumen Persetujuan</label><br>
                        <input type="text" id="tgl_app_hibah" class="form-control flatpickr-basic" placeholder="Tanggal Dokumen Persetujuan" name="tgl_app_hibah"/>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="file_app_hibah">Dokumen Persetujuan</label>
                        <div class="custom-file mb-1">
                            <input type="file" name="file_app_hibah" class="custom-file-input" id="file_app_hibah" />
                            <label class="custom-file-label" for="file_app_hibah">Pilih Dokumen Persetujuan</label>
                            <div class="invalid-feedback"></div>
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