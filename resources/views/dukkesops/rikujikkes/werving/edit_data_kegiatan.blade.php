{{-- Modal Edit --}}
<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Edit Data Rikkes Werving</h4>
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
                            <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" name="nama" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Kelas</label>
                            <input type="text" class="form-control" placeholder="Kelas" id="kelas" name="kelas"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Prodi</label>
                            <input type="text" class="form-control" placeholder="Prodi" id="prodi" name="prodi"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" placeholder="Jenis Kelamin" id="jenis_kelamin" name="jenis_kelamin"/>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Umum</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">TB/BB</label>
                                <input type="text" class="form-control" placeholder="TB/BB" id="tb_bb" name="tb_bb"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">ERGOMETRI</label>
                                <input type="text" class="form-control" placeholder="ERGOMETRI" id="ergometri" name="ergometri"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">IMT</label>
                                <input type="text" class="form-control" placeholder="IMT" id="imt" name="imt"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">PARU (SPIROMETRI)</label>
                                <input type="text" class="form-control" placeholder="PARU (SPIROMETRI)" id="paru" name="paru"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">TENSI/NADI</label>
                                <input type="text" class="form-control" placeholder="TENSI/NADI" id="tensi_nadi" name="tensi_nadi"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">RO</label>
                                <input type="text" class="form-control" placeholder="RO" id="ro" name="ro"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">PENY. DALAM</label>
                                <input type="text" class="form-control" placeholder="PENY. DALAM" id="peny_dalam" name="peny_dalam"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">LAB</label>
                                <input type="text" class="form-control" placeholder="LAB" id="lab" name="lab"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">USG</label>
                                <input type="text" class="form-control" placeholder="USG" id="usg" name="usg"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">THT</label>
                                <input type="text" class="form-control" placeholder="THT" id="tht" name="tht"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">OBGYN</label>
                                <input type="text" class="form-control" placeholder="OBGYN" id="obgyn" name="obgyn"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">KULIT</label>
                                <input type="text" class="form-control" placeholder="KULIT" id="kulit" name="kulit"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">JANTUNG</label>
                                <input type="text" class="form-control" placeholder="JANTUNG" id="jantung" name="jantung"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">BEDAH</label>
                                <input type="text" class="form-control" placeholder="BEDAH" id="bedah" name="bedah"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Atas (A)</label>
                            <input type="text" class="form-control" placeholder="Atas (A)" id="atas" name="atas"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Bawah (B)</label>
                            <input type="text" class="form-control" placeholder="Bawah (B)" id="bawah" name="bawah"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Pendengaran & Keseimbangan</label>
                            <input type="text" class="form-control" placeholder="Pendengaran & Keseimbangan" id="pendengaran_keseimbangan" name="pendengaran_keseimbangan"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Mata (L)</label>
                            <input type="text" class="form-control" placeholder="Mata (L)" id="mata" name="mata"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Gigi (G)</label>
                            <input type="text" class="form-control" placeholder="Gigi (G)" id="gigi" name="gigi"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Jiwa (J)</label>
                            <input type="text" class="form-control" placeholder="Jiwa (J)" id="jiwa" name="jiwa"/>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Hasil Rikkes</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Rikkesum</label>
                                <input type="text" class="form-control" placeholder="Rikkesum" id="hasil_um" name="hasil_um"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Rikkeswa</label>
                                <input type="text" class="form-control" placeholder="Rikkeswa" id="hasil_wa" name="hasil_wa"/>
                            </div>
                        </div>
                    </div>
                    <label class="form-label font-weight-bolder font-small-4">Keterangan</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Nilai</label>
                                <input type="text" class="form-control" placeholder="Nilai" id="ket_nilai" name="ket_nilai"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Hasil</label>
                                <input type="text" class="form-control" placeholder="Hasil" id="ket_hasil" name="ket_hasil"/>
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