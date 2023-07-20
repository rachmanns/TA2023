{{-- Modal Edit --}}
<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Data Rikkes Seleksi Satgas {{ strtoupper($jenis) }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="default-form" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Pangkat</label>
                            <input type="text" class="form-control" placeholder="Pangkat" name="pangkat" id="pangkat"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">NRP</label>
                            <input type="text" class="form-control" placeholder="NRP" name="nrp" id="nrp"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" id="jabatan"/>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Umum</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">TB/BB</label>
                                <input type="text" class="form-control" placeholder="TB/BB" name="tb_bb" id="tb_bb"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">IMT</label>
                                <input type="text" class="form-control" placeholder="IMT" name="imt" id="imt"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">TENSI/NADI</label>
                                <input type="text" class="form-control" placeholder="TENSI/NADI" name="tensi_nadi" id="tensi_nadi"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">RO</label>
                                <input type="text" class="form-control" placeholder="RO" name="ro" id="ro"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">PENY. DALAM</label>
                                <input type="text" class="form-control" placeholder="PENY. DALAM" name="peny_dalam" id="peny_dalam"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">LAB</label>
                                <input type="text" class="form-control" placeholder="LAB" name="lab" id="lab"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">EKG</label>
                                <input type="text" class="form-control" placeholder="EKG" name="ekg" id="ekg"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">THT</label>
                                <input type="text" class="form-control" placeholder="THT" name="tht" id="tht"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">KULIT</label>
                                <input type="text" class="form-control" placeholder="KULIT" name="kulit" id="kulit"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">BEDAH</label>
                                <input type="text" class="form-control" placeholder="BEDAH" name="bedah" id="bedah"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Atas (A)</label>
                            <input type="text" class="form-control" placeholder="Atas (A)" name="atas" id="atas"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Bawah (B)</label>
                            <input type="text" class="form-control" placeholder="Bawah (B)" name="bawah" id="bawah"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Mata (L)</label>
                            <input type="text" class="form-control" placeholder="Mata (L)" name="mata" id="mata"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Gigi (G)</label>
                            <input type="text" class="form-control" placeholder="Gigi (G)" name="gigi" id="gigi"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Jiwa (J)</label>
                            <input type="text" class="form-control" placeholder="Jiwa (J)" name="jiwa" id="jiwa"/>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Hasil Rikkes</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Rikkesum</label>
                                <input type="text" class="form-control" placeholder="Rikkesum" name="hasil_um" id="hasil_um"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Rikkeswa</label>
                                <input type="text" class="form-control" placeholder="Rikkeswa" name="hasil_wa" id="hasil_wa"/>
                            </div>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Keterangan</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Nilai</label>
                                <input type="text" class="form-control" placeholder="Nilai" name="ket_nilai" id="ket_nilai"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Hasil</label>
                                <input type="text" class="form-control" placeholder="Hasil" name="ket_hasil" id="ket_hasil"/>
                            </div>
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