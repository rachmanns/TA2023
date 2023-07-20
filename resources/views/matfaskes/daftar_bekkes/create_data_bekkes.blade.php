<!-- Add Bekkes -->
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Tambah Bekkes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('matfaskes/data-bekkes/preview') }}" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="modal-body">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="POST"> --}}
                    <div class="form-group form-input">
                        <label for="bekkes">Bekkes</label>
                        {{-- <input type="text" class="form-control" id="bekkes" placeholder="Bekkes" name="id_mas_bek" /> --}}
                        <select name="id_mas_bek" id="" class="select2 form-control">
                            <option selected disabled>Bekkes</option>
                            @foreach ($master_bekkes as $mb)
                                <option value="{{ $mb->id_mas_bek }}">{{ $mb->nama_bekkes }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <label>LN/DN</label>
                    <select class="select2 form-control" name="jenis_tujuan">
                        <option selected disabled>Pilih LN/DN</option>
                        <option value="ln">LN</option>
                        <option value="dn">DN</option>
                    </select>
                    <div class="invalid-feedback"></div>
                    <div class="form-group form-input mt-1">
                        <label class="form-label" for="direktur">Tahun</label>
                        <div class="input-group input-group-merge form-input">
                            <input type="text" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" readonly name="tahun_anggaran"/>
                            <div class="input-group-append">
                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="file">Import Detail Barang</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="detail_bekkes"/>
                            <label class="custom-file-label">Import Detail Barang</label>
                        </div>
                        <div class="text-right">
                            <a href="{{ url('template/detail-bekkes') }}" class="text-right" style="font-size: 12px;">
                                <u> Download Template </u>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>