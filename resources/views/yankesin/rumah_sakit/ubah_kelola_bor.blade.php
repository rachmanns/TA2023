@extends('partials.template') 

@section('page_style')
    <style>
        .underline { text-decoration: underline; }
    </style>
@endsection

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Data BOR</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $rs->nama_rs }} (Update terakhir: <b> {{ $last }} </b>) </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                  <form>
                                    <h5 class="card-title mb-50">IGD</h5>
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang IGD</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['IGD']['jumlah']-$data['IGD_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['IGD']['idf']}}" placeholder="Terisi" value="{{$data['IGD_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kamar Bersalin</h6>
                                            <div class="form-group">
                                                <label for="salin">Tersedia : {{$data['Kamar Bersalin']['jumlah']-$data['Kamar Bersalin_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Kamar Bersalin']['idf']}}" placeholder="Terisi" value="{{$data['Kamar Bersalin_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Rawat Inap</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">VIP</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['VIP']['jumlah']-$data['VIP_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['VIP']['idf']}}" placeholder="Terisi" value="{{$data['VIP_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 1</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Kelas 1']['jumlah']-$data['Kelas 1_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Kelas 1']['idf']}}" placeholder="Terisi" value="{{$data['Kelas 1_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 2</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Kelas 2']['jumlah']-$data['Kelas 2_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Kelas 2']['idf']}}" placeholder="Terisi" value="{{$data['Kelas 2_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Kelas 3</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Kelas 3']['jumlah']-$data['Kelas 3_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Kelas 3']['idf']}}" placeholder="Terisi" value="{{$data['Kelas 3_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['ICU']['jumlah']-$data['ICU_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['ICU']['idf']}}" placeholder="Terisi" value="{{$data['ICU_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">NICU/PICU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['NICU']['jumlah']-$data['NICU_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['NICU']['idf']}}" placeholder="Terisi" value="{{$data['NICU_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICCU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['ICCU']['jumlah']-$data['ICCU_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['ICCU']['idf']}}" placeholder="Terisi" value="{{$data['ICCU_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">HCU</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['HCU']['jumlah']-$data['HCU_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['HCU']['idf']}}" placeholder="Terisi" value="{{$data['HCU_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICU Isolasi</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['ICU Isolasi']['jumlah']-$data['ICU Isolasi_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['ICU Isolasi']['idf']}}" placeholder="Terisi" value="{{$data['ICU Isolasi_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Unit Luka Bakar</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Unit Luka Bakar']['jumlah']-$data['Unit Luka Bakar_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Unit Luka Bakar']['idf']}}" placeholder="Terisi" value="{{$data['Unit Luka Bakar_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Isolasi Non-Covid</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Ruang Isolasi Non-Covid']['jumlah']-$data['Ruang Isolasi Non-Covid_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Ruang Isolasi Non-Covid']['idf']}}" placeholder="Terisi" value="{{$data['Ruang Isolasi Non-Covid_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Rawat Khusus</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Perina/Bayi</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Perina']['jumlah']-$data['Perina_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Perina']['idf']}}" placeholder="Terisi" value="{{$data['Perina_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Anak</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Anak']['jumlah']-$data['Anak_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Anak']['idf']}}" placeholder="Terisi" value="{{$data['Anak_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Trauma Militer</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Trauma Militer']['jumlah']-$data['Trauma Militer_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Trauma Militer']['idf']}}" placeholder="Terisi" value="{{$data['Trauma Militer_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Ruang Operasi</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Operasi IGD</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Ruang Operasi IGD']['jumlah']-$data['Ruang Operasi IGD_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Ruang Operasi IGD']['idf']}}" placeholder="Terisi" value="{{$data['Ruang Operasi IGD_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Operasi Sentral</h6>
                                            <div class="form-group">
                                                <label for="igd">Tersedia : {{$data['Ruang Operasi Sentral']['jumlah']-$data['Ruang Operasi Sentral_isi']}}</label>
                                                <input type="number" class="form-control" name="d{{$data['Ruang Operasi Sentral']['idf']}}" placeholder="Terisi" value="{{$data['Ruang Operasi Sentral_isi']}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                    </div>
                                    @csrf
                                  </form>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $( document ).ready(function() {  
            $('.card-footer button').click(function() {
                if (!$('form')[0].checkValidity()) {
                    $('form').addClass('was-validated');
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
				$.ajax({
                    url: '/yankesin/input/bor-update/{{ $rs->id_rs }}',
                    method: "POST",
                    dataType: "json",
                    data: $('form').serialize(),
                    success: function (res) {
                        if (!res.error) {
                            $('h2.content-header-title b').text(res.tgl);
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                showCancelButton: true,
                                confirmButtonText: 'Lihat Data BOR',
                                cancelButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) window.open("{{ url('yankesin/bor-covid') }}", '_blank').focus();
                            });
                            $('form').removeClass('was-validated');
                        }
                    }
                }).always(function() {
                    $('.card-footer button').prop('disabled', false);
                    $('.card-footer button').text('Simpan Data');
                });
            });
        });
    </script>
@endsection