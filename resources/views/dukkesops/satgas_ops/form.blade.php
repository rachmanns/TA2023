<div class="modal fade text-left" id="so" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Satgas Ops</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('dukkesops/satgas-ops') }}" class="default-form" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group form-input">
                        <label for="nama_kat_satgas">Nama Satgas Ops</label>
                        <input type="text" id="nama_kat_satgas" class="form-control" placeholder="Nama Satgas Ops" name="nama_kat_satgas" />
                        <div class="invalid-feedback"></div>
                    </div>

                    <label for="">Jenis Satgas</label>
                    <div class="col-12 mb-1">
                        <div class="row">
                            <div class="demo-inline-spacing">
                                <div class="custom-control custom-radio mt-0">
                                    <input type="radio" id="ln" name="jenis_satgas" class="custom-control-input matra" value="LN"/>
                                    <label class="custom-control-label" for="ln">Luar Negeri</label>
                                </div>
                                <div class="custom-control custom-radio mt-0">
                                    <input type="radio" id="dn" name="jenis_satgas" class="custom-control-input matra" value="DN"/>
                                    <label class="custom-control-label" for="dn">Dalam Negeri</label>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group form-input">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" class="form-control" id="keterangan">
                            <option value="darat">Darat</option>
                            <option value="puter">Puter</option>
                            <option value="bandara">Bandara</option>
                        </select>
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
