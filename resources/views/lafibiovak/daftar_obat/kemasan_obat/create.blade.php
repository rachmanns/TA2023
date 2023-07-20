@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="{{ url('/lafibiovak/kemasan') }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Kemasan Produk</h2>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                                <div class="form-group form-input">
                                    <label class="form-label">Nama Produk*</label>
                                    <select class="select2 form-control form-control-lg" name="produk" required>
                                        <option selected disabled>Nama Produk</option>
                                        @foreach($prods as $p)
                                        <option value="{{$p->id_produk}}" {{isset($data->id_produk)&&$data->id_produk==$p->id_produk ? 'selected' : ''}} >{{$p->nama_produk}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-pr">Produk harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Satuan Produk*</label>
                                    <select class="select2 form-control form-control-lg" name="satuan" required>
                                        <option selected disabled>Satuan Produk</option>
                                        @foreach($satprods as $sp)
                                        <option value="{{$sp->id_satuan_produk}}" {{isset($data->id_satuan_produk)&&$data->id_satuan_produk==$sp->id_satuan_produk ? 'selected' : ''}} >{{$sp->nama_satuan}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-sp">Satuan harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="kemasan">Kemasan*</label>
                                    <input type="text" name="kemasan" class="form-control" placeholder="Kemasan" value="{{$data->nama_kemasan ?? ''}}" required />
                                    <div class="invalid-feedback">Nama harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="bets">Bets*</label>
                                    <input type="number" name="bets" class="form-control" placeholder="Bets" min="1" value="{{$data->bets ?? ''}}" required />
                                    <div class="invalid-feedback">Bets harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="nie">NIE*</label>
                                    <input type="text" name="nie" class="form-control" placeholder="NIE" value="{{$data->NIE ?? ''}}" required />
                                    <div class="invalid-feedback">NIE harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile1">Upload Gambar Kemasan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="gambar" />
                                        <label class="custom-file-label" for="customFile1">Upload Gambar</label>
                                    </div>
                                </div>
                                @csrf
                              </form>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
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
                if ($('form')[0].checkValidity() && $('select[name=produk]').val() != null && $('select[name=satuan]').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/kemasan') }}/" + id,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/kemasan';
                            });
                        }
                    }).always(function() {
                        $(".btn-primary").prop('disabled', false);
                        $(".btn-primary").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('select[name=produk]').val() == null) $('.select-pr').css('display', 'block');
                    else $('.select-pr').css('display', 'none');
                    if ($('select[name=satuan]').val() == null) $('.select-sp').css('display', 'block');
                    else $('.select-sp').css('display', 'none');
                }
            });
        });
    </script>
@endsection