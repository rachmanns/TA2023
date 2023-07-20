@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ route('bangkes.calon-patubel.index') }}"><button type="button"
                            class="btn btn-outline-primary"><i class="mr-75"
                                data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3) == 'create' ? 'Tambah' : 'Edit' }}
                        Calon
                        Patubel</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('bangkes.calon-patubel.store') }}" class="default-form"
                                autocomplete="off">
                                @csrf
                                <input type="hidden" name="ket_peserta" id="ket_peserta">
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-md-3 col-12 form-input">
                                            <label class="form-label" for="semester">Semester</label>
                                            <select name="semester" id="semester" class="form-control">
                                                <option value="Ganjil">Ganjil</option>
                                                <option value="Genap">Genap</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3 col-12 form-input">
                                            <label class="form-label" for="tahun">Tahun</label>
                                            <input type="text" name="tahun" id="tahun"
                                                class="form-control yearpicker bg-white cursor-pointer" placeholder="Tahun"
                                                readonly>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-12 form-input">
                                            <label class="form-label">Nama Dokter</label>
                                            <select class="form-control form-control-lg" id="id_nakes" name="id_nakes">
                                                <option disabled selected>Nama Dokter</option>
                                                @foreach ($nakes as $n)
                                                    <option value="{{ $n['id_nakes'] }}">{{ $n['nama'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form">
                                        <div class="row mt-1">
                                            {{-- <div class="col-md-6 col-12">
                                                <label>Kategori Dokter / Jenis Paramedis</label>
                                                <input type="text" id="kategori" class="form-control" placeholder="Kategori Dokter / Jenis Paramedis" readonly>
                                            </div> --}}
                                            <div class="col-md-6 col-12">
                                                <label>Kategori Dokter / Jenis Paramedis</label>
                                                <select class="form-control" name="kategori" id="kategori">
                                                    <option selected disabled>Kategori Dokter / Jenis Paramedis</option>
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k['id'] }}">{{ $k['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="satuan_asal">Asal Kesatuan</label>
                                                    <input type="text" id="satuan_asal" class="form-control"
                                                        placeholder="Asal Kesatuan" name="satuan_asal" disabled>
                                                    <div class="invalid-feedback">Asal Kesatuan harus diisi</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="no_identitas">NRP/NIP</label>
                                                    <input type="text" id="no_identitas" class="form-control"
                                                        placeholder="NRP/NIP" name="no_identitas" disabled>
                                                    <div class="invalid-feedback">NRP/NIP harus diisi</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label class="form-label">Pangkat</label>
                                                <input type="text" id="pangkat" class="form-control"
                                                    placeholder="Pangkat" name="pangkat" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group form-input">
                                                    <label class="form-label" for="jabatan_struktural">Jabatan
                                                        Struktural</label>
                                                    <input type="text" id="jabatan_struktural" class="form-control"
                                                        placeholder="Jabatan Struktural" name="jabatan_struktural" disabled>
                                                    <div class="invalid-feedback">Jabatan Struktural harus diisi</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label class="form-label">Jabatan Fungsional</label>
                                                <input type="text" id="jabatan_fungsional" class="form-control"
                                                    placeholder="Jabatan Fungsional" name="jabatan_fungsional" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="peminatan">Peminatan</label>
                                                <input type="text" id="peminatan" class="form-control"
                                                    placeholder="Peminatan" name="peminatan">
                                                <div class="invalid-feedback">Peminatan harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="kampus">Tempat Pendidikan</label>
                                                <input type="text" id="kampus" class="form-control"
                                                    placeholder="Tempat Pendidikan" name="kampus">
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
                                                            class="custom-control-input" value="d3" />
                                                        <label class="custom-control-label" for="d3">D3</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s1" name="jenjang"
                                                            class="custom-control-input" value="s1" />
                                                        <label class="custom-control-label" for="s1">S1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s2" name="jenjang"
                                                            class="custom-control-input" value="s2" />
                                                        <label class="custom-control-label" for="s2">S2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="s3" name="jenjang"
                                                            class="custom-control-input" value="s3" />
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
                                                            class="custom-control-input" value="AD" />
                                                        <label class="custom-control-label" for="AD">AD</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="AL" name="matra"
                                                            class="custom-control-input" value="AL" />
                                                        <label class="custom-control-label" for="AL">AL</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="AU" name="matra"
                                                            class="custom-control-input" value="AU" />
                                                        <label class="custom-control-label" for="AU">AU</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-6 mr-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="MABES" name="matra"
                                                            class="custom-control-input" value="MABES" />
                                                        <label class="custom-control-label" for="MABES">MABES</label>
                                                    </div>
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
        var kat_select = $("#kategori");
        $(document).ready(function() {
            $("#id_nakes").select2({
                tags: true
            });
            kat_select.select2({
                disabled: true
            });
        })

        function checkIfValidUUID(str) {
            const regexExp = /^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$/gi;
            return regexExp.test(str);
        }


        $('#id_nakes').change(function() {
            let id_nakes = $(this).val();
            if (checkIfValidUUID(id_nakes)) {
                disable_field();
                get_detail_nakes(id_nakes);
            } else {
                $('#ket_peserta').val(id_nakes)
                allow_field();
            }
        })

        function get_detail_nakes(id_nakes) {
            $.ajax({
                method: "POST",
                url: "{{ url('bangkes/calon-patubel/get-nakes') }}",
                data: {
                    id_nakes: id_nakes,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#kategori').val(response.id_kategori).trigger('change.select2');
                    $('#satuan_asal').val(response.satuan_asal)
                    $('#no_identitas').val(response.no_identitas)
                    $('#pangkat').val(response.pangkat)
                    $('#jabatan_struktural').val(response.jabatan_struktural)
                    $('#jabatan_fungsional').val(response.jabatan_fungsional)
                    $('#ket_peserta').val(response.ket_peserta)
                }
            })
        }

        function allow_field() {
            kat_select.select2({
                disabled: false
            });
            $('#satuan_asal').val(null).prop('disabled', false)
            $('#no_identitas').val(null).prop('disabled', false)
            $('#pangkat').val(null).prop('disabled', false)
            $('#jabatan_struktural').val(null).prop('disabled', false)
            $('#jabatan_fungsional').val(null).prop('disabled', false)
        }

        function disable_field() {
            kat_select.select2({
                disabled: true
            });
            $('#satuan_asal').prop('disabled', true)
            $('#no_identitas').prop('disabled', true)
            $('#pangkat').prop('disabled', true)
            $('#jabatan_struktural').prop('disabled', true)
            $('#jabatan_fungsional').prop('disabled', true)
        }
    </script>
@endsection
