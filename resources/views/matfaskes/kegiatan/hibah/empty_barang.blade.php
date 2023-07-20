@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Daftar Barang</h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6 mt-50">
                    <h4 class="text-secondary">No Hibah: {{ $ba_hibah->no_ba_hibah }}</h4>
                </div>    
                <div class="col-6 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#impor">Impor Barang</button>
                    @include('matfaskes.kegiatan.hibah.import_daftar_barang')
                </div>
            </div>
            @error('file')
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ $message }}
                        </div>
                    </div>
                </div>
            @enderror
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center pt-4 pb-4">
                                <img src="{{ url('app-assets/images/pages/eCommerce/folder.png')}}" height="130" class="pb-2"/>
                                <h3 class="text-muted">
                                    Daftar barang belum tersedia. Klik tombol <br> Impor Barang untuk mulai menambahkan barang.
                                </h3>
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
    $(function () {
        $("#ada").click(function () {
            $("#check-ada").show();
        });

        $("#tidak-ada").click(function () {
            $("#check-ada").hide();
            $("#penerima").val(null);
            $("#tujuan_penggunaan").val(null);
        });
    });
</script>
@endsection