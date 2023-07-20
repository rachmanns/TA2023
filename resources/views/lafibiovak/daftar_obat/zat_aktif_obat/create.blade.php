@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('/lafibiovak/produk') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Produk</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                                <label for="">Kategori</label>
                                <div class="row mb-1">
                                    <div class="col-md-1 col-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="obat" value="Obat" name="kategori" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="obat">Obat</label>
                                        </div>   
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="PKRT" value="PKRT" name="kategori" class="custom-control-input" {{isset($data->kategori_produk)&&$data->kategori_produk=='PKRT' ? 'checked' : ''}} />
                                            <label class="custom-control-label" for="PKRT">PKRT</label>
                                        </div>   
                                    </div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="nama_produk">Nama Produk*</label>
                                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="{{$data->nama_produk ?? ''}}" required />
                                    <div class="invalid-feedback">Nama harus diisi</div>
                                </div>
                                <div action="#" class="invoice-repeater">
                                    <div data-repeater-list="zat_aktif">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="zat">Zat Aktif*</label>
                                                        <input type="text" class="form-control zat" name="zat"  placeholder="Zat Aktif" required />
                                                        <div class="invalid-feedback">Zat harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="takaran">Takaran* <span class="text-muted">(Contoh: 70 Mg)</span></label>
                                                        <input type="text" class="form-control takaran" name="takaran"  placeholder="Takaran" required />
                                                        <div class="invalid-feedback">Takaran harus diisi</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 text-right">
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-danger text-nowrap" data-repeater-delete type="button">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                <i data-feather="plus" class="mr-25"></i>
                                                <span>Tambah Baru</span>
                                            </button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-icon btn-primary" type="button">
                                                <span>Simpan Data</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @csrf
                              </form>
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
        var id = "{{ request()->segment(3)=='create'?'':request()->segment(3) }}";
        $(document).ready(function() {
            $(".btn-primary").click(function() {
                if ($('form')[0].checkValidity() && $('[data-repeater-item]').length != 0) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/produk') }}/" + id,
                        method: "{{ request()->segment(3)=='create'?'POST':'PUT' }}",
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/produk';
                            });
                        }
                    }).always(function() {
                        $(".btn-primary").prop('disabled', false);
                        $(".btn-primary").text('Simpan Data');
                    });
                } else if ($('[data-repeater-item]').length == 0) {
                    Swal.fire({
                        title: 'Info',
                        text: 'Zat Aktif harus diisi',
                        icon: 'info',
                    });
                } else $('form').addClass('was-validated');
            });
            @if(request()->segment(3)!='create')
            var tp = JSON.parse('{!!json_encode($data->zat_aktif)!!}');
            if (tp.length >0) $("[data-repeater-list]").html('');
            for (i=0;i<tp.length;i++) {
                $('button[data-repeater-create]').click();
                $("[data-repeater-item]").eq(i).find('.zat').val(tp[i].nama_zat);
                $("[data-repeater-item]").eq(i).find('.takaran').val(tp[i].takaran);
            }
            @endif
        });
    </script>
@endsection