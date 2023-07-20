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
                            <h2 class="content-header-title float-left mb-0">Input Data Covid RS</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $rs->nama_rs }} (Update terakhir: <b> {{ $last }} </b>)</h2>
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
                                    @csrf
                                    <h5 class="card-title mb-1">BOR Covid</h5>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">ICU Covid</h6>
                                            <div class="form-group">
                                            @if(isset($data['icu']))
                                                <label for="igd">Tersedia : {{$data['icu']->jumlah-($data['bor_icu'] ?? 0)}}</label>
                                                <input type="number" class="form-control" name="bor_{{$data['icu']->id_fasilitas_rs}}" placeholder="Terisi" value="{{$data['bor_icu'] ?? 0}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            @else
                                                <label for="igd">Fasilitas belum ditambahkan / tidak tersedia</label>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <h6 class="font-weight-bolder">Ruang Isolasi Covid</h6>
                                            <div class="form-group">
                                            @if(isset($data['iso']))
                                                <label for="igd">Tersedia : {{$data['iso']->jumlah-($data['bor_iso'] ?? 0)}}</label>
                                                <input type="number" class="form-control" name="bor_{{$data['iso']->id_fasilitas_rs}}" placeholder="Terisi" value="{{$data['bor_iso'] ?? 0}}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            @else
                                                <label for="igd">Fasilitas belum ditambahkan / tidak tersedia</label>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-1">Jumlah Pasien Covid</h5>
                                    <div class="row">
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">

                                        </div>
                                        @foreach($jenis_pasien as $jp)
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
										    {{$jp->nama_jenis}}
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach($status_pasien as $sp)
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            Kasus {{$sp->nama_status}}
                                        </div>
                                        @foreach($jenis_pasien as $jp)
                                        <div class="col-xl-2 col-md-3 col-6 mb-1">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="p_{{$sp->id_status_pasien}}_{{$jp->id_jenis_pasien}}" placeholder="Jumlah Pasien" value="{{ $data['d_' . $sp->id_status_pasien . '_' . $jp->id_jenis_pasien] ?? 0 }}" min="0" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endforeach
                                    </div>
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
            $('.card-footer button').click(function(){
                if (!$('form')[0].checkValidity()) {
                    $('form').addClass('was-validated');
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: '/yankesin/input/covid-update/{{ $rs->id_rs }}',
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
                                confirmButtonText: 'Lihat Data Pasien Covid',
                                cancelButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) window.open("{{ url('yankesin/data-covid') }}", '_blank').focus();
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