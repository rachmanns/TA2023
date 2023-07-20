<!-- Modal Import-->
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Realisasi Anggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bidum.anggaran.realisasi_store') }}" class="default-form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="post">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="">Pilih Kewenangan</label>
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="DIPPUS"  name="kode_dipa" class="custom-control-input matra" value="DIPPUS"/>
                                        <label class="custom-control-label" for="DIPPUS">Pusat</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="DIPDAR"  name="kode_dipa" class="custom-control-input matra" value="DIPDAR"/>
                                        <label class="custom-control-label" for="DIPDAR">Daerah</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="bidang">Pilih Bidang</label>
                                <select id="bidang" name="bidang" class="select2 form-control form-control-lg">
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="uraian">Pilih Uraian</label>
                                <select id="uraian" name="id_uraian" class=" form-control form-control-lg">
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="tgl_realisasi">Tanggal Realisasi</label>
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control flatpickr-basic" placeholder="Tanggal Realisasi" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-input">
                                <label for="jumlah">Nilai Realisasi</label>
                                <input type="text" id="jumlah" class="form-control"
                                    placeholder="Nilai Realisasi" name="jumlah" />
                                    <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Realisasi</button>
                </div>
            </form>
        </div>
    </div>
</div>