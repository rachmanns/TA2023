{{-- Modal Edit --}}
<div class="modal fade text-left" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Import Data Satgas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('dukkesops/seleksi-satgas-ln/preview-update-data/'.$seleksi_satgas_ln->id_kegiatan_duk) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Dokumen</label>
                            <input type="file" name="file_kegiatan" class="custom-file-input" id="customFile1" required />
                            <label class="custom-file-label" for="customFile1">Dokumen Satgas</label>
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