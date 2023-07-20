@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('/lafibiovak/satuan-produk') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Satuan Produk</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                                <div class="form-group form-input">
                                    <label class="form-label" for="satuan_produk">Satuan Produk*</label>
                                    <input type="text" name="satuan_produk" class="form-control" placeholder="Satuan Produk" value="{{$data->nama_satuan ?? ''}}" required />
                                    <div class="invalid-feedback">Satuan harus diisi</div>
                                </div>
                                <div action="#" class="invoice-repeater">
                                    <div data-repeater-list="tahap_produksi">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-10 col-12">
                                                    <div class="form-group">
                                                        <label for="tahap">Tahap Produksi*</label>
                                                        <input type="text" class="form-control" name="tahap"  placeholder="Tahap Produksi" required />
                                                        <div class="invalid-feedback">Tahap harus diisi</div>
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
                        url: "{{ url('lafibiovak/satuan-produk') }}/" + id,
                        method: "{{ request()->segment(3)=='create'?'POST':'PUT' }}",
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/satuan-produk';
                            });
                        }
                    }).always(function() {
                        $(".btn-primary").prop('disabled', false);
                        $(".btn-primary").text('Simpan Data');
                    });
                } else if ($('[data-repeater-item]').length == 0) {
                    Swal.fire({
                        title: 'Info',
                        text: 'Tahap harus diisi',
                        icon: 'info',
                    });
                } else $('form').addClass('was-validated');
            });
            @if(request()->segment(3)!='create')
            var tp = JSON.parse('{!!json_encode($data->tahap_produksi)!!}');
            if (tp.length >0) $("[data-repeater-list]").html('');
            for (i=0;i<tp.length;i++) {
                $('button[data-repeater-create]').click();
                $("[data-repeater-item]").eq(i).find('input[type="text"]').val(tp[i].nama_tahap);
            }
            @endif
        });
    </script>
@endsection