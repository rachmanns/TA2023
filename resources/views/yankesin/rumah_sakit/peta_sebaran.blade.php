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
                            <h2 class="content-header-title float-left mb-1">Fasilitas </h2>
                        </div>
                        <div class="col-sm-8 col-12">
                            <div class="demo-inline-spacing mt-0">
                                <label>MATRA&emsp;: </label>
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AD" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AD">AD</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/ad-polos.png') }}" width="22px">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AL" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AL">AL</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/al-polos.png') }}" width="22px">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="AU" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="AU">AU</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/au-polos.png') }}" width="22px">
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="MABES" class="custom-control-input" onchange="filter('m', this.id, this.checked)" />
                                    <label class="custom-control-label" for="MABES">MABES</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/mabes-polos.png') }}" width="22px">
                            </div>
                            <div class="demo-inline-spacing mt-75">
                                <label>JENIS &emsp; : </label>
                                <div class="custom-control custom-checkbox mr-100">
                                    <input type="checkbox" checked id="FKTP" class="custom-control-input" onchange="filter('j', this.id, this.checked)" />
                                    <label class="custom-control-label" for="FKTP">FKTP</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-100">
                                    <input type="checkbox" checked id="FKTL" class="custom-control-input" onchange="filter('j', this.id, this.checked)" />
                                    <label class="custom-control-label" for="FKTL">FKTL</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-50">
                                    <input type="checkbox" checked id="RSS" class="custom-control-input" onchange="filter('j', 'FKTL RSS', this.checked)" />
                                    <label class="custom-control-label" for="RSS">FKTL-Ops</label>
                                </div>
                                <img src="{{ url('app-assets/images/ico/AmbS.png') }}" width="22px">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <select class="select2 form-control" onchange="location.href='{{ request()->url }}?id='+this.value">
                            @foreach($fas as $f)
                                <option value="{{ $f->id_fasilitas }}" @if($f->id_fasilitas == request()->id) selected @endif>{{ $f->nama_fasilitas }}</option>
                            @endforeach
                            </select>
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
                                            <img src="{{ url('app-assets/images/ico/AmbAD.png') }}" width="22px" class="mr-50">FKTP/FKTL AD
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/AmbAL.png') }}" width="22px" class="mr-50">FKTP/FKTL AL
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/AmbAU.png') }}" width="22px" class="mr-50">FKTP/FKTL AU
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/AmbMABES.png') }}" width="22px" class="mr-50">FKTP/FKTL MABES
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/AmbS.png') }}" width="22px" class="mr-50">FKTL Ops
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </section>
                 @if(auth()->user()->can('yankesin.list') || auth()->user()->can('yankesin.dashboard'))
                 @include('yankesin.card_yankesin')
                 @endif
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
                    <p class="font-weight-bolder mb-25" id="namafaskes" style="font-size: 20px;"></p>

                    <span class="badge badge-secondary badge-pill mr-50 pr-1 pl-1" id="jenisfaskes"> FKTL </span>
                    <span class="badge badge-success badge-pill pr-1 pl-1" id="matra"> AD </span>

                    <hr>

                    <div class="d-flex justify-content-left mb-50">
                        <i data-feather="map-pin" class="font-weight-bolder mr-1" style="font-size: 14px; min-width:14px;"></i>
                        <span class="text-break" id="alamat" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-left mb-50">
                        <i data-feather="phone" class="font-weight-bolder mr-1" style="font-size: 14px; min-width:14px;"></i>
                        <span class="text-break" id="telp" style="font-size: 14px;"></span>
                    </div>

                    <hr>

                    <h6 class="font-weight-bolder" style="font-size: 16px;">Informasi Faskes</h6>

                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Tingkat</span>
                        <span class="font-weight-bolder text-break" id="tingkat" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">No Izin Operasional</span>
                        <span class="font-weight-bolder text-break" id="noopr" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Pengelolaan Keuangan</span>
                        <span class="font-weight-bolder text-break" id="keuangan" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Akreditasi</span>
                        <span class="font-weight-bolder text-break" id="akre" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">IMB</span>
                        <span class="font-weight-bolder text-break" id="imb" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">IPAL</span>
                        <span class="font-weight-bolder text-break" id="ipal" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Kerjasama dengan BPJS</span>
                        <span class="badge badge-success badge-pill pr-1 pl-1 float-right" id="bpjs"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Faskes Detail Sidebar -->
    <!-- END: Content-->
@endsection    

@section("page_script")
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&callback=initMap"></script>

<script>

$( document ).ready(function() {
    $('.content-header-title').html('Fasilitas ' + $('option[value={{ request()->id }}]').html());

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
            content: '<b>' + obj.nama_rs + '</b>' @if(request()->id == 1) + ' <br />Jumlah: <b>' + obj.jumlah + ' unit</b>' @endif
        });
        var img = obj.jenis_rs != null && obj.jenis_rs.indexOf('RSS') != -1 ? 'S' : obj.kode_matra;
        var drawmarker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
            map: map,
            window: infowindow,
            data: obj,
            icon: {
                url: '/app-assets/images/ico/Amb' + img + '.png',
                scaledSize: new google.maps.Size(25, 25),
            }
        });
        google.maps.event.addListener(drawmarker,'mouseover',function() {
            this.window.open(map,this);
        });
        google.maps.event.addListener(drawmarker,'click',function() {
            $('#namafaskes').html(this.data.nama_rs);
            $('#jenisfaskes').html(this.data.jenis_rs.indexOf('RSS') == -1 ? this.data.jenis_rs : this.data.jenis_rs.substr(0, 4) + '-Ops');
            $('#matra').removeClass('badge-success badge-primary badge-info badge-warning');
            $('#matra').addClass(badge[this.data.kode_matra]);
            $('#matra').html(this.data.kode_matra);
            $('#telp').html(this.data.telp ?? '-');
            $('#noopr').html(this.data.no_ijin_opr ?? '-');
            $('#alamat').html(this.data.alamat ?? '-');
            $('#tingkat').html(this.data.nama_tingkat_rs ?? (this.data.id_tingkat_rs != null && this.data.id_tingkat_rs != '' ? this.data.id_tingkat_rs : '-'));
            $('#keuangan').html(this.data.keuangan ?? '-');
            $('#akre').html(this.data.akreditasi ?? '-');
            $('#ipal').html(this.data.ipal ?? '-');
            $('#bpjs').html(this.data.bpjs ?? '-');
            $('#imb').html(this.data.imb ?? '-');
            $('#faskes-sidebar').modal('show');
        });
        google.maps.event.addListener(drawmarker,'mouseout',function() {
            this.window.close();
        });
        markers.push(drawmarker);
    }
}
function filter(kat, val, checked) {
    for(i=0;i<markers.length;i++) {
        if (kat == 'm') {
            if (markers[i].data.kode_matra == val && ($('#' + markers[i].data.jenis_rs.substr(0, 4)).prop('checked') || ($('#RSS').prop('checked') && markers[i].data.jenis_rs.indexOf('RSS') != -1))) markers[i].setVisible(checked);
        } else if (kat == 'j') {
            if (markers[i].data.jenis_rs == val && $('#' + markers[i].data.kode_matra).prop('checked')) markers[i].setVisible(checked);
        }
    }
}
</script>
@endsection
