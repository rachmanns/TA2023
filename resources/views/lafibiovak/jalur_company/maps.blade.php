@extends('partials.template')

@section('page_style')
<style>
    .modal-backdrop.show {
        opacity: .0;
        width: 0;
        height: 0;
    }

    .modal .modal-header {
        background-color: transparent;
    }

    body.modal-open {
        padding-right: 30rem !important;
    }

    @media (min-width: 576px) {
        .modal-slide-in .modal-dialog.sidebar-lg {
            width: 30rem;
        }
    }

    #modal-sidebar {
        z-index: 500;
    }
</style>
@endsection

@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="d-flex justify-content-between mb-1">
            <h2 class="content-header-title float-left">Peta Lokasi Jalur Company</h2>
        </div>
        <div class="content-body">
            <section id="apexchart">
                <div class="row match-height">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-body" id="map" style="height:400px"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal modal-slide-in fade" id="modal-sidebar" aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <button type="button" class="text-white close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header p-0">
                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="50000">
                            <img src="" width="420" style="min-height: 180px; max-height: 180px;" id="foto" />
                        </div>
                        <div class="carousel-item" data-interval="50000">
                            <video width="420" height="180" id="video"></video>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="modal-body flex-grow-1">
                <p class="font-weight-bolder mt-1 mb-50" style="font-size: 20px;" id="nama"></p>

                <div class="d-flex justify-content-between">
                    <i class="font-medium-2 mr-50" style="min-width: 5%;" data-feather="map-pin"></i>
                    <span style="font-size: 12px;" id="alamat"></span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-25">
                    <span>Kemampuan Personil</span>
                    <span id="jmlp"></span>
                </div>

                <div class="d-flex justify-content-between mb-25">
                    <span>Jumlah Mesin</span>
                    <span id="jmlm">45</span>
                </div>

                <div class="d-flex justify-content-between mb-25">
                    <span>Izin Operasional</span>
                    <span class="badge" id="izin"></span>
                </div>

                <div class="d-flex justify-content-between mb-25">
                    <span>Sertifikat CPOB</span>
                    <span class="badge" id="cpob"></span>
                </div>

                <hr>

                <p class="font-weight-bolder mb-50" style="font-size: 16px;">Detail Obat</p>

                <div class="mb-50">
                    <span class="font-weight-bold" style="font-size: 14px;">Sumber Dana Puskes</span>
                    <p class="mb-0" style="font-size: 13px;" id="sumberp"></p>
                </div>

                <div class="mb-50">
                    <span class="font-weight-bold" style="font-size: 14px;">Sumber Dana Angkatan</spa>
                    <p class="mb-0" style="font-size: 13px;" id="sumbera"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section("page_script")
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>

<script>
    var data = {!!json_encode($data)!!};
    function initMap() {
        const uluru = {
            lat: -1.770340,
            lng: 118.409108
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: uluru,
        });

      for (var i=0;i<data.length;i++) {
        var obj = data[i];
        var infowindow = new google.maps.InfoWindow({
            content: '<b>' + obj.nama_jalur + '</b>'
        });
        var drawmarker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
            map: map,
            window: infowindow,
            data: obj,
        });
        google.maps.event.addListener(drawmarker,'mouseover',function() {
            this.window.open(map,this);
        });
        google.maps.event.addListener(drawmarker,'click',function() {
            $('#nama').html(this.data.nama_jalur);
            $('#alamat').html(this.data.alamat ?? '-');
            $('#jmlp').html(this.data.jml_personil ?? '-');
            $('#jmlm').html(this.data.jml_mesin ?? '-');
            $('#sumberp').html(this.data.sumber_puskes ?? '-');
            $('#sumbera').html(this.data.sumber_angkatan ?? '-');
            $('#izin').html(this.data.izin_opr ? 'Ada' : 'Tidak Ada').removeClass('badge-light-danger badge-light-success').addClass(this.data.izin_opr ? 'badge-light-success' : 'badge-light-danger');
            $('#cpob').html(this.data.cpob ? 'Ada' : 'Tidak Ada').removeClass('badge-light-danger badge-light-success').addClass(this.data.cpob ? 'badge-light-success' : 'badge-light-danger');
            $('#foto').attr('src', this.data.foto ? '{{url("uploads/jalur_company")}}/' + this.data.foto : '');
            $('#video').attr('src', this.data.video ?? '');
            $('#modal-sidebar').modal('show');
        });
        google.maps.event.addListener(drawmarker,'mouseout',function() {
            this.window.close();
        });
      }
    }
    window.initMap = initMap;
</script>
@endsection