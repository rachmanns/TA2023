@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('/lafibiovak/rko') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">Form RKO Faskes</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form method="post" enctype="multipart/form-data"
                                action="{{ url('/lafibiovak/rko/upload') }}" novalidate>
                                <div class="form-group form-input">
                                    <label class="form-label">Faskes*</label>
                                    <select class="select2 form-control form-control-lg" name="faskes" required>
                                        <option selected disabled>Faskes</option>
                                        @foreach($faskes as $f)
                                        <option value="{{$f->id_rs}}" @if(isset($data) && $f->id_rs == $data->id_rs) selected @endif >{{$f->nama_rs}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-fb">Faskes harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Nama CP*</label>
                                    <input type="text" name="cp" class="form-control" placeholder="Nama CP" value="{{$data->nama_cp_faskes ?? ''}}" required />
                                    <div class="invalid-feedback">Nama harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$data->email ?? ''}}" required />
                                    <div class="invalid-feedback">Email harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Nomor Telepon*</label>
                                    <input type="text" name="phone" class="form-control" placeholder="No. Telepon" value="{{$data->no_telp ?? ''}}" required />
                                    <div class="invalid-feedback">No. Telepon harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Tahun Anggaran*</label>
                                    <div class="input-group input-group-merge form-input">
                                        <input type="number" name="tahun"
                                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                                            onkeypress="return event.key === 'Enter'"
                                            required />
                                        <div class="invalid-feedback">Tahun harus diisi</div>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="customFile1">Dokumen RKO*</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile1"
                                            accept=".xlsx" required />
                                        <label class="custom-file-label" for="customFile1">Unggah Dokumen RKO</label>
                                    </div>
                                    <div class="invalid-feedback">File harus ada</div>
                                </div>
                                <div class="text-right">
                                    <a href="/lafibiovak/rko/download_template" target="_blank"><u>Download Template RKO</u></a>
                                </div>
                                @csrf
                              </form>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary btn-save">Simpan Data</button>
                            </div>
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
            $(".btn-save").click(function() {
                if ($('form')[0].checkValidity() && $('select').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    form_data = new FormData($('form')[0]);
                    $.ajax({
                        url: $('form').attr('action'),
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: form_data,
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/rko';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('select').val() == null) $('.select-fb').css('display', 'block');
                    if ($('input[name=tahun]').val() == '') $('.input-group-append').css('display', 'none');
                }
            });
            $('select').change(function() {
                $('.select-fb').css('display', 'none');
            });
            $('input[name=tahun]').change(function() {
                if ($(this).val() != '') $('.input-group-append').css('display', '');
            });
        });
    </script>
@endsection