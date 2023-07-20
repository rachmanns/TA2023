{{-- Modal Disetujui --}}
<div class="modal fade text-left" id="disetujui" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Setujui Kenkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                            
                <div class="card bg-light border mb-1">
                    <div class="card-body">
                        <table>
                            <tr>
                                <th class="width-250">Nama Lengkap</th>
                                <th class="width-50">:</th>
                                <th id="nama"></th>
                            </tr>
                            <tr>
                                <th>Pangkat Terakhir</th>
                                <th class="width-50">:</th>
                                <th id="nama_pangkat_terakhir"></th>
                            </tr>
                            <tr>
                                <th>TMT Pangkat Terakhir</th>
                                <th class="width-50">:</th>
                                <th id="tmt_pangkat_terakhir"></th>
                            </tr>
                        </table>
                    </div>
                </div>
                {{-- <form action="{{ route('bidum.personil.approve_kenkat') }}" class="default-form"> --}}
                <form action="{{ route('bidum.personil.approve_kenkat') }}" class="kenkat-form">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_list_ukp" id="id_list_ukp">
                    <input type="hidden" name="id_personil" id="id_personil">
                    <input type="hidden" name="id_pangkat" id="id_pangkat">
                    <div class="form-group">
                        <label class="form-label" for="pangkat_baru">Pangkat Baru</label>
                        <input type="text" id="pangkat_baru" class="form-control" placeholder="Pangkat Baru" readonly/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tmt-pangkat">TMT Pangkat</label>
                        <input type="text" id="tmt_pangkat" class="form-control" placeholder="TMT Pangkat" readonly name="tmt_pangkat"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="skep-pangkat">No. SKEP</label>
                        <input type="text" id="skep-pangkat" class="form-control" placeholder="No. SKEP" name="no_skep_pangkat" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tgl-skep-pangkat">Tanggal SKEP</label>
                        <input type="text" id="tgl-skep-pangkat" class="form-control flatpickr-basic" placeholder="Tanggal SKEP" name="tgl_skep_pangkat" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="no-sprin-pangkat">No. SPRIN</label>
                        <input type="text" id="no-sprin-pangkat" class="form-control" placeholder="No. SPRIN" name="no_sprin_pangkat" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tgl-sprin-pangkat">Tanggal SPRIN</label>
                        <input type="text" id="tgl-sprin-pangkat" class="form-control flatpickr-basic" placeholder="Tanggal SPRIN" name="tgl_skep_pangkat" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Setujui Kenkat</button>
                </div>
                </form>
        </div>
    </div>
</div>