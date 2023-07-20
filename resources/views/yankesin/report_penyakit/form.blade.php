@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('yankesin/report-penyakit') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Report Penyakit</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ url('yankesin/report-penyakit/' . (isset($report) ? 'update/' . $report->id : 'store')) }}" class="default-form" autocomplete="off" method="post">
                                @csrf
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Periode</label>
                                            <select class="select2 form-control" id="periode" name="id_periode">
                                                @foreach ($periode as $p)
                                                    <option value="{{ $p->id_periode }}"
                                                        @isset($report)
                                                            {{ ($report->id_periode == $p->id_periode)?'selected':''}}
                                                        @endisset
                                                    >{{ $p->nama_periode }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12">            
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Tahun</label>
                                                <input type="number" class="form-control" placeholder="Tahun" name="tahun" value="{{ $report->tahun??null }}" required />
                                                <div class="invalid-feedback">Tahun harus diisi</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Matra</label>
                                            <select class="select2 form-control" id="matra">
                                                <option disabled selected>Matra</option>
                                                @foreach ($matra as $m)
                                                    <option value="{{ $m }}" 
                                                        @isset($report)
                                                            {{ ($report->angkatan->kode_matra == $m)?'selected':''}}
                                                        @endisset
                                                    >{{ $m }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Satker</label>
                                            <select class="select2 form-control" id="satker" name="id_angkatan" disabled>
                                                <option disabled selected>Pilih Satker</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div> 
                                    <div class="row mb-1">
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Jenis Kasus</label>
                                            <select class="select2 form-control" id="jenis" name="id_penyakit">
                                                @foreach ($penyakit as $p)
                                                    <option value="{{ $p->id_penyakit }}"
                                                        @isset($report)
                                                            {{ ($report->id_penyakit == $p->id_penyakit)?'selected':''}}
                                                        @endisset
                                                    >{{ $p->nama_penyakit }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Status</label>
                                            <select class="select2 form-control" id="status" name="status">
                                                @foreach ($status as $s)
                                                    <option value="{{ $s }}" 
                                                        @isset($report)
                                                            {{ ($report->status == $s)?'selected':''}}
                                                        @endisset
                                                    >{{ $s }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-12">            
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Jumlah Kasus Sebelumnya</label>
                                                <input type="number" class="form-control" placeholder="Jumlah Kasus Sebelumnya" name="sebelumnya" value="{{ $report->sebelumnya??null }}" required />
                                                <div class="invalid-feedback">Data harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">            
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Jumlah Kasus Baru</label>
                                                <input type="number" class="form-control" placeholder="Jumlah Kasus Baru" name="baru" value="{{ $report->baru??null }}" required />
                                                <div class="invalid-feedback">Data harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">            
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Jumlah Sembuh</label>
                                                <input type="number" class="form-control" placeholder="Jumlah Sembuh" name="sembuh" value="{{ $report->sembuh??null }}" required />
                                                <div class="invalid-feedback">Data harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">            
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jenis">Jumlah Meninggal</label>
                                                <input type="number" class="form-control" placeholder="Jumlah Meninggal" name="meninggal" value="{{ $report->meninggal??null }}" required />
                                                <div class="invalid-feedback">Data harus diisi</div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group form-input">
                                        <label class="form-label" for="ket">Keterangan</label>
                                        <textarea rows="3" id="ket" class="form-control" placeholder="Keterangan" name="keterangan">{{ $report->keterangan??null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-primary btn-submit">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            $('#matra').change(function() {
                $.ajax({
                    url: "{{ url('master/komando/select') }}/" + $(this).val() + '?all=1',
                    method: "GET",
                    dataType: "json",
                    success: function(result) {
                        $('#satker').empty();
                        $('#satker').select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            dropdownParent: $('#satker').parent(),
                            data: result.data,
                        });
                        $('#satker').prop('disabled', false);
                        @if(isset($report))
                            $('#satker').val('{{$report->id_angkatan}}').trigger('change');
                        @endif
                    }
                });
            });
            $('.btn-submit').click(function() {
                if ($('form')[0].checkValidity() && $('#satker').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: $('form').attr('action'),
                        method: "post",
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/yankesin/report-penyakit';
                            });
                        }
                    }).always(function() {
                        $(".btn-primary").prop('disabled', false);
                        $(".btn-primary").text('Simpan Data');
                    });
                } else if ($('#satker').val() == null) {
                    Swal.fire({
                        title: 'Info',
                        text: 'Satker harus dipilih',
                        icon: 'info',
                    });
                } else $('form').addClass('was-validated');
            });
            @if(isset($report))
                $('#matra').trigger('change');
            @endif
        });
    </script>
@endsection