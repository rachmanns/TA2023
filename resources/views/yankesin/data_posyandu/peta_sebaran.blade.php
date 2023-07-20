@extends('partials.template') 

@section('page_style')
<style>
    .bg-bor-yankesin {
        background-color: #EA54554D !important; 
    }
    .bg-pasien {
        background-color: rgba(255, 159, 67, 0.3) !important;
    }
    .bg-nakes {
        background-color: rgba(40, 199, 111, 0.3) !important; 
    }
    .bg-fasilitas {
        background-color: rgba(32, 69, 184, 0.3) !important; 
    }
    .bg-rs {
        background-color: rgba(242, 78, 30, 0.3) !important; 
    }
    .bg-bor {
        background-color: rgba(213, 0, 232, 0.3) !important; 
    }

    .modal-backdrop.show {
        opacity: .0;
        width: 0;
        height: 0;
    }

    .modal {
        width: 0;
        height: 0;
    }

    .modal .modal-header {
        background-color: transparent;
    }

    body.modal-open{
        padding-right: 30rem !important;
    }

    @media (min-width: 576px) {
        .modal-slide-in .modal-dialog.sidebar-lg {
            width: 30rem;
        }
    }

    p {
        margin-bottom: 0px;
    }

    .visiblediv {
        display: block;
    }

    .hiddendiv {
        display: none;
    }

    .demo-inline-spacing>* {
        margin-top: 0rem;
    }
</style>
@endsection

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-1">Sebaran Posyandu</h2>
                        </div>
                        <div class="col-sm-9 col-12">
                            <div class="demo-inline-spacing mt-0">
                                <label>MATRA&emsp;: </label>
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AD" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AD">AD</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/PosyanduAD.png') }}" width="3%">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AL" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AL">AL</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/PosyanduAL.png') }}" width="3%">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AU" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AU">AU</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/PosyanduAU.png') }}" width="3%">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="MABES" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="MABES">MABES</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/PosyanduMABES.png') }}" width="3%">
                            </div>
                        </div>
                        <div class="col-sm-3 col-12">
                            <input type="text" class="form-control" placeholder="Cari Posyandu" id="inp-faskes" disabled />
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                 <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-body" id="map" style="height:400px">
                                </div>
                                <div class="m-2">
                                    <span class="font-weight-bolder"> Keterangan Icon : </span>
                                    <div class="demo-inline-spacing mt-1">
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/PosyanduAD.png') }}" width="22px" class="mr-50">Posyandu AD
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/PosyanduAL.png') }}" width="22px" class="mr-50">Posyandu AL
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/PosyanduAU.png') }}" width="22px" class="mr-50">Posyandu AU
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/PosyanduMABES.png') }}" width="22px" class="mr-50">Posyandu MABES
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </section>
                 @include('yankesin.card_yankesin')
            </div>
        </div>
    </div>

    <!-- Faskes Detail Sidebar -->
    <div class="modal modal-slide-in fade" id="faskes-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">
                        <span class="align-middle"></span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <p class="font-weight-bolder mb-25" id="namafaskes"></p>

                    <span class="badge badge-success badge-pill pr-1 pl-1" id="matra"> AD </span>

                    <hr>

                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center">
                            <i data-feather="map-pin" class="mr-1"></i><span id="alamat"></span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i data-feather="phone" class="mr-1"></i><span id="telp">-</span>
                        </li>
                    </ul>

                    <hr>

                    <h6 class="font-weight-bolder">Informasi Posyandu</h6>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label>Prog. Germas</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="float-right"><b class="text-break" id="prog_germas">TK 1</b></label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label>Prog. Posyandu</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="float-right"><b class="text-break" id="prog_posy">081234234234</b></label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label>Hub. Sektoral</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="float-right"><b class="text-break" id="hub_sektoral">PNPB</b></label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label>Jumlah Kader Germas</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="float-right"><b class="text-break" id="jml_kader_germas">Dasar</b></label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label>Jumlah Kader Posyandu</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="float-right"><b class="text-break" id="jml_kader_posy">Dasar</b></label>
                        </div>
                    </div>

                    <hr>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /Faskes Detail Sidebar -->
    <!-- END: Content-->
@endsection    

@section("page_script")
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&callback=initMap"></script>

<script>

$( document ).ready(function() {
    $('#inp-faskes').keypress(function(event) {
        if (event.key === "Enter") {
            for(i=0;i<markers.length;i++) {
                if (($(this).val() == '' || markers[i].data.nama_posy.toLowerCase().indexOf($(this).val().toLowerCase()) != -1) && $('#' + markers[i].data.id_matra).prop('checked')) markers[i].setVisible(true);
                else markers[i].setVisible(false);
            }
        }
    });

});

var data = {!!json_encode($rs)!!};
var map;
var markers = [];
var badge = {'AD': 'badge-success', 'AL': 'badge-info', 'AU': 'badge-primary', 'MABES': 'badge-warning'};
function initMap() {
    map = new google.maps.Map(
        document.getElementById('map'), {
            center: {lat: -1.770340, lng: 118.409108},
            zoom: 5
        }
    );
    for (var i=0;i<data.length;i++) {
        var obj = data[i];
        var infowindow = new google.maps.InfoWindow({
            content: '<b>' + obj.nama_posy + '</b>'
        });
        var img = obj.id_matra;
        var drawmarker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
            map: map,
            window: infowindow,
            data: obj,
            icon: {
                url: '/app-assets/images/ico/Posyandu' + img + '.png',
                scaledSize: new google.maps.Size(25, 25),
            }
        });
        google.maps.event.addListener(drawmarker,'mouseover',function() {
            this.window.open(map,this);
        });
        google.maps.event.addListener(drawmarker,'click',function() {
            $('#namafaskes').html(this.data.nama_posy);
            $('#matra').removeClass('badge-success badge-primary badge-info badge-warning');
            $('#matra').addClass(badge[this.data.id_matra]);
            $('#matra').html(this.data.id_matra);
            $('#alamat').html(this.data.alamat_posy ?? '-');
            $('#prog_germas').html(this.data.prog_germas ?? '-');
            $('#prog_posy').html(this.data.prog_posy ?? '-');
            $('#hub_sektoral').html(this.data.hub_sektoral ?? '-');
            $('#jml_kader_germas').html(this.data.jml_kader_germas ?? '-');
            $('#jml_kader_posy').html(this.data.jml_kader_posy ?? '-');
            $('#faskes-sidebar').modal('show');
        });
        google.maps.event.addListener(drawmarker,'mouseout',function() {
            this.window.close();
        });
        markers.push(drawmarker);
    }
    $('#inp-faskes').prop('disabled', false);
}
function filter(kat, val, checked) {
    for(i=0;i<markers.length;i++) {
        if (kat == 'm') {
            if (markers[i].data.id_matra == val) markers[i].setVisible(checked);
        }
    }
}
</script>
@endsection
