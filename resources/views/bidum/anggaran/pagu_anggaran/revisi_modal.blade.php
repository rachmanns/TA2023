<!-- Modal-->
<div class="modal fade text-left" id="revisi-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Revisi Pagu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('bidum.anggaran.revisi_store') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_uraian" id="id_uraian">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="pagu">Pagu Awal</label>
                            <input type="text" id="pagu" class="form-control rupiah" placeholder="Pagu Awal" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="pagu_terakhir">Pagu Terakhir</label>
                            <input type="text" id="pagu_terakhir" class="form-control rupiah" placeholder="Pagu Terakhir" readonly/>
                        </div>
                    </div>
                    <label class="form-label mb-1">Revisi Pagu</label>
                    <div class="row mb-1">
                        <div class="col-md-3">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="operator1" name="operator" class="custom-control-input" value="tambah" />
                                <label class="custom-control-label" for="operator1">Tambah</label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="operator2" name="operator" class="custom-control-input" value="kurang" />
                                <label class="custom-control-label" for="operator2">Kurang</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="nilai">Nilai Revisi Pagu</label>
                            <input type="text" id="nilai" name="nilai" class="form-control rupiah" placeholder="Nilai Revisi Pagu"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="revisi">Pagu Setelah Revisi</label>
                            <input type="text" id="revisi" class="form-control" placeholder="Pagu Setelah Revisi" readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Simpan Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>