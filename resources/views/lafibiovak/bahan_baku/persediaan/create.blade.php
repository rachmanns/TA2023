@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12 mb-1">
                    <a href="/lafibiovak/bahan-produksi"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                </div>
                <div class="col-12">
                    <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Bahan Produksi</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                                <div class="form-group form-input">
                                    <label class="form-label">Pilih Kategori*</label>
                                    <select name="kategori" class="form-control select2">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach($kategori as $k)
                                        <option value="{{$k->id_kategori}}" {{isset($data->id_kategori)&&$data->id_kategori==$k->id_kategori ? 'selected' : ''}} >{{$k->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-k">Kategori harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Nama Bahan Produksi*</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Bahan Produksi" value="{{$data->nama_bahan_produksi ?? ''}}" required />
                                    <div class="invalid-feedback">Nama harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Satuan*</label>
                                    <input type="text" name="satuan" class="form-control" placeholder="Satuan" value="{{$data->satuan ?? ''}}" required />
                                    <div class="invalid-feedback">Satuan harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Spesifikasi Teknis</label>
                                    <input type="text" name="spesifikasi" class="form-control" placeholder="Spesifikasi Teknis" value="{{$data->spesifikasi ?? ''}}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Kemasan Minimal</label>
                                    <input type="number" name="kemasan" class="form-control" placeholder="Kemasan Minimal" value="{{$data->kemasan_min ?? ''}}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Sumber Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control" placeholder="Sumber Perusahaan" value="{{$data->perusahaan ?? ''}}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Sumber Asal Negara</label>
                                    <input type="text" name="asal" class="form-control" placeholder="Sumber Asal Negara" value="{{$data->negara ?? ''}}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Renada</label>
                                    <input type="number" name="renada" class="form-control" placeholder="Renada" value="{{$data->renada ?? ''}}">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Jumlah Awal (Sisa Tahun Lalu)*</label>
                                    <input type="number" name="awal" class="form-control" placeholder="Jumlah Awal" value="{{$data->jumlah_awal ?? '0'}}" required />
                                    <div class="invalid-feedback">Jumlah harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" name="ket" class="form-control" placeholder="Keterangan" value="{{$data->keterangan ?? ''}}">
                                </div>
                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-primary btn-save">Simpan Data</button>
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
        $(function(){
            $(".btn-save").click(function() {
                if ($('form')[0].checkValidity() && $('select[name=kategori]').val() != null) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/bahan-produksi') }}/" + id,
                        method: "{{ request()->segment(3)=='create'?'POST':'PUT' }}",
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/bahan-produksi';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('select[name=kategori]').val() == null) $('.select-k').css('display', 'block');
                }
            });
            $('select[name=kategori]').change(function() {
                $('.select-k').css('display', 'none');
            });
        })
    </script>
@endsection