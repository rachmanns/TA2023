{{-- Modal Ditolak --}}
<div class="modal fade text-left" id="ditolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Tolak Kenkat</h4>
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
                                <th id="nama-ditolak"></th>
                            </tr>
                            <tr>
                                <th>Pangkat Terakhir</th>
                                <th class="width-50">:</th>
                                <th id="pangkat-ditolak"></th>
                            </tr>
                            <tr>
                                <th>TMT Pangkat Terakhir</th>
                                <th class="width-50">:</th>
                                <th id="tmt_pangkat-ditolak"></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <form action="{{ route('bidum.personil.reject_kenkat') }}" class="kenkat-form">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_personil" id="id_personil_ditolak">
                    <input type="hidden" name="id_list_ukp" id="id_list_ukp_ditolak">
                        <div class="form-group">
                            <label class="form-label" for="alasan">Alasan Penolakan</label>
                            <textarea rows="3" id="alasan" class="form-control" placeholder="Alasan Penolakan" name="keterangan"></textarea>
                        </div>
                        <div class="form-group form-input">
                            <label class="form-label" for="alasan">Periode UKP</label>
                            <input type="text" name="periode" id="" class="form-control flatpickr-basic" placeholder="Periode UKP">
                            <!-- <span> *Format: YYYY-MM-DD</span> -->
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Tolak Kenkat</button>
                    </div>
                </form>
        </div>
    </div>
</div>