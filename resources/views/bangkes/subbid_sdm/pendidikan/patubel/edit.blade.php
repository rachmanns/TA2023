@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/bangkes/calon-patubel"><button type="button" class="btn btn-outline-primary"><i class="mr-75"
                                data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Calon Patubel</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ url('bangkes/calon-patubel' . '/' . $patubel->id_patubel) }}"
                                class="default-form" autocomplete="off">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 200px">Nama</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->nama_dokter ?? ($nakes->nama_paramedis ?? '-') }}

                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 250px">Kategori</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->jenis_spesialis[0]->kategori_dokter->nama_kategori ?? ($nakes->jenis_paramedis->nama_jenis_paramedis ?? '-') }}
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 200px">Asal Kesatuan</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->satuan_asal ?? '-' }}
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 250px">NRP/NIP</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->no_identitas ?? '-' }}
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 200px">Pangkat</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->pangkat ?? ($nakes->pangkat_korps ?? '-') }}
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 250px">Jabatan Struktural</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->jabatan_struktural ?? '-' }}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <table class="tg">
                                                <thead>
                                                    <tr>
                                                        <td class="tg-v0nz" style="width: 200px">Jabatan Fungsional</td>
                                                        <td class="tg-v0nz">:</td>
                                                        <td class="tg-gvcd font-weight-bolder">
                                                            {{ $nakes->jabatan_fungsional ?? '-' }}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="semester">Semester</label>
                                                <select name="semester" id="semester" class="form-control">
                                                    <option value="Ganjil"
                                                        @if (explode(' - ', $patubel->tahun_ajaran)[0] == 'Ganjil') selected @endif>Ganjil</option>
                                                    <option value="Genap"
                                                        @if (explode(' - ', $patubel->tahun_ajaran)[0] == 'Genap') selected @endif>Genap</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tahun">Tahun</label>
                                                <input type="text" name="tahun" id="tahun"
                                                    class="form-control yearpicker bg-white cursor-pointer"
                                                    placeholder="Tahun" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="minat">Peminatan</label>
                                                <input type="text" id="peminatan" class="form-control"
                                                    placeholder="Peminatan" value="{{ $patubel->peminatan }}"
                                                    name="peminatan">
                                                <div class="invalid-feedback">Peminatan harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tempat">Tempat Pendidikan</label>
                                                <input type="text" id="kampus" class="form-control"
                                                    placeholder="Tempat Pendidikan" value="{{ $patubel->kampus }}"
                                                    name="kampus">
                                                <div class="invalid-feedback">Tempat Pendidikan harus diisi</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label class="form-label">Jenjang</label>
                                            <div class="row mb-1 form-input">
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="d3" name="jenjang"
                                                            class="custom-control-input" value="d3"
                                                            @if ($patubel->jenjang == 'd3') checked @endif />
                                                        <label class="custom-control-label" for="d3">D3</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s1" name="jenjang"
                                                            class="custom-control-input" value="s1"
                                                            @if ($patubel->jenjang == 's1') checked @endif />
                                                        <label class="custom-control-label" for="s1">S1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s2" name="jenjang"
                                                            class="custom-control-input" value="s2"
                                                            @if ($patubel->jenjang == 's2') checked @endif />
                                                        <label class="custom-control-label" for="s2">S2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s3" name="jenjang"
                                                            class="custom-control-input" value="s3"
                                                            @if ($patubel->jenjang == 's3') checked @endif />
                                                        <label class="custom-control-label" for="s3">S3</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label class="form-label">Matra</label>
                                            <div class="row mb-1 form-input">
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="AD" name="matra"
                                                            class="custom-control-input" value="AD"
                                                            @if ($nakes->matra == 'AD') checked @endif />
                                                        <label class="custom-control-label" for="AD">AD</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="AL" name="matra"
                                                            class="custom-control-input" value="AL"
                                                            @if ($nakes->matra == 'AL') checked @endif />
                                                        <label class="custom-control-label" for="AL">AL</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="AU" name="matra"
                                                            class="custom-control-input" value="AU"
                                                            @if ($nakes->matra == 'AU') checked @endif />
                                                        <label class="custom-control-label" for="AU">AU</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="MABES" name="matra"
                                                            class="custom-control-input" value="MABES"
                                                            @if ($nakes->matra == 'MABES') checked @endif />
                                                        <label class="custom-control-label" for="MABES">MABES</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label for="tmt">Tanggal Sprin</label>
                                                <input type="text" id="tmt_date" class="form-control"
                                                    placeholder="TMT" name="tmt" />
                                                <input type="hidden" name="tmt_awal" id="tmt_awal">
                                                {{-- <input type="hidden" name="tmt_akhir" id="tmt_akhir"> --}}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label for="">Dokumen Sprint</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_sprin" class="custom-file-input"
                                                        id="#" />
                                                    <label class="custom-file-label" for="#">Dokumen Sprint</label>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
        var tmt_date = $("#tmt_date").flatpickr({
            // mode: 'range',
            dateFormat: "d F Y",
            onChange: function(selectedDates) {
                var _this = this;
                var dateArr = selectedDates.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });
                let start = dateArr[0];
                let end = dateArr[1];

                $('#tmt_awal').val(start);
                // $('#tmt_akhir').val(end);
            }
        })

        $(document).ready(function() {
            let year = "{{ explode(' - ', $patubel->tahun_ajaran)[1] }}";
            $('#tahun').val(year);

            // tmt_date.setDate(['{{ $patubel->tmt_date_awal }}', '{{ $patubel->tmt_date_akhir }}'], true);
            tmt_date.setDate('{{ $patubel->tmt_date_awal }}', true);
        });
    </script>
@endsection
