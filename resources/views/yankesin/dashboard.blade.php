@extends('partials.template') 

@section('page_style')
<style>    
    .modal-backdrop.show {
        opacity: .0;
        width: 0;
        height: 0;
    }

    #faskes-sidebar {
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

    .dokwrap {
        padding: 5px;
        border-radius: 5px;
    }

    .dokwrap:hover {
        background-color: lightgray;
    }

    #detail-dokter {
        z-index: 1060;
    }
</style>
@endsection

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-1">Bidang Yankesin</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">                
                <div class="col-sm-9 col-12">
                    <div class="demo-inline-spacing mt-0">
                        <label>MATRA &ensp;: </label>
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
                        <img src="{{ url('app-assets/images/ico/mabes-polos.png') }}" width="23px">
                    </div>
                    <div class="demo-inline-spacing mt-75">
                        <label>JENIS &emsp; : </label>
                        <div class="custom-control custom-checkbox mr-50">
                            <input type="checkbox" checked id="FKTP" class="custom-control-input"onchange="filter('j', this.id, this.checked)" />
                            <label class="custom-control-label" for="FKTP">FKTP</label>
                        </div>
                        <img src="{{ url('app-assets/images/ico/fktp-polos.png') }}" width="22px">
                        <div class="custom-control custom-checkbox mr-50">
                            <input type="checkbox" checked id="FKTL" class="custom-control-input"onchange="filter('j', this.id, this.checked)" />
                            <label class="custom-control-label" for="FKTL">FKTL</label>
                        </div>
                        <img src="{{ url('app-assets/images/ico/fktl-polos.png') }}" width="22px">
                        <div class="custom-control custom-checkbox mr-50">
                            <input type="checkbox" checked id="RSS" class="custom-control-input"onchange="filter('j', 'FKTL RSS', this.checked)" />
                            <label class="custom-control-label" for="RSS">FKTL-Ops</label>
                        </div>
                        <img src="{{ url('app-assets/images/ico/FKTL.png') }}" width="22px">
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <input type="text" class="form-control" placeholder="Cari Faskes" id="inp-faskes" disabled />
                </div>
            </div>
            <div class="content-body">
                <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-body" id="map" style="height:500px">                                    
                                </div>
                                <div class="m-2">
                                    <span class="font-weight-bolder"> Keterangan Icon : </span>
                                    <div class="demo-inline-spacing mt-1">
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTP-AD.png') }}" width="22px" class="mr-50">FKTP AD
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTP-AL.png') }}" width="22px" class="mr-50">FKTP AL
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTP-AU.png') }}" width="22px" class="mr-50">FKTP AU
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/mabes.png') }}" width="22px" class="mr-50">FKTP MABES
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTL-AD.png') }}" width="22px" class="mr-50">FKTL AD
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTL-AL.png') }}" width="22px" class="mr-50">FKTL AL
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTL-AU.png') }}" width="22px" class="mr-50">FKTL AU
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/FKTL.png') }}" width="22px" class="mr-50">FKTL Ops
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

    <!-- Modal Detail-->
            <div class="modal fade" id="detail-dokter" tabindex="-1" role="dialog" aria-labelledby="abc" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="abc">Detail Dokter </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border p-1 mb-0 table-responsive">
                                        <table class="table" id="table_detail">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Dokter</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center">
                            <i data-feather="map-pin" class="mr-1"></i><span id="alamat" style="font-size: 14px;"></span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i data-feather="phone" class="mr-1"></i><span id="telp" style="font-size: 14px;">-</span>
                        </li>
                    </ul>

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
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Jumlah Tempat Tidur</span>
                        <span class="font-weight-bolder text-break" id="tempat_tidur" style="font-size: 14px;"></span>
                    </div>

                    <hr>

                    <h6 class="font-weight-bolder" style="font-size: 16px;">Fasilitas</h6>

                    <div id="fasunggul"></div>

                    <hr>

                    <h6 class="font-weight-bolder" style="font-size: 16px;">Rekapitulasi Nakes</h6>

                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Dokter</span>
                        <span class="font-weight-bolder text-break" id="dokter" style="font-size: 14px;"></span>
                    </div>
                    {{--
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Paramedis</span>
                        <span class="font-weight-bolder text-break" id="paramedis" style="font-size: 14px;"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-50">
                        <span style="font-size: 14px;">Nakes Lainnya</span>
                        <span class="font-weight-bolder text-break" id="nakeslain" style="font-size: 14px;"></span>
                    </div>
                    --}}

                    <div class="row">
                        <div class="col-12">
                            <a href="#" id="p1" class="font-small-3 hiddendiv">Lihat Selengkapnya</a>
                        </div>
                    </div>

                    <div id="rekapitulasi">
                        <div class="d-flex justify-content-between mb-50 dokwrap" style="cursor:pointer" onclick="detail_dokter(1, 'Umum')">
                            <span style="font-size: 14px;">Dokter Umum</span>
                            <span class="font-weight-bolder text-break" id="doku" style="font-size: 14px;"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-50 dokwrap" style="cursor:pointer" onclick="detail_dokter(3, 'Gigi')">
                            <span style="font-size: 14px;">Dokter Gigi</span>
                            <span class="font-weight-bolder text-break" id="dokg" style="font-size: 14px;"></span>
                        </div>

                        <h6 class="font-weight-bolder mt-1" style="font-size: 16px;">Spesialis</h6>

                        <div id="doksp"></div>

                        {{--
                        <h6 class="font-weight-bolder mt-1" style="font-size: 16px;">Paramedis</h6>

                        <div id="prmds"></div>

                        <h6 class="font-weight-bolder mt-1" style="font-size: 16px;">Nakes Lainnya</h6>

                        <div id="nkslain"></div>
                        --}}

                        <a href="#" id="p2" class="font-small-3">Sembunyikan</a>
                    </div>  

                    <br>
                    
                    {{--

                    <h6 class="font-weight-bolder">Detail Fasilitas</h6>

                    <div class="row mb-1" id="detailfas">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Ambulance</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Rawat Jalan</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">IGD</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Rawat Inap</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Rawat Inap Khusus</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Fasilitas Unggulan</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Penunjang Diagnostik</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Radiologi</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Penunjang Klinis</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                            <label class="text-muted">Fasilitas Lainnya</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-12 text-right">
                            <a href="#" class="font-small-3">Lihat Selengkapnya</a>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /Faskes Detail Sidebar -->
    <!-- END: Content-->
@endsection

@section("page_script")
<script>

var data = {!!json_encode($rs)!!};
var map;
var markers = [];
var badge = {'AD': 'badge-success', 'AL': 'badge-info', 'AU': 'badge-primary', 'MABES': 'badge-warning'};
var rs;

$( document ).ready(function() {
    function show() {
        document.getElementById('rekapitulasi').className='visiblediv'; 
        document.getElementById('p1').className='hiddendiv'; 
    }

    function hide() {
        document.getElementById('rekapitulasi').className='hiddendiv'; 
        document.getElementById('p1').className='visiblediv'; 
    }

    var p1 = document.getElementById("p1");
    p1.onclick = show;
    var p2 = document.getElementById("p2");
    p2.onclick = hide;

    $('#inp-faskes').keypress(function(event) {
        if (event.key === "Enter") {
            for(i=0;i<markers.length;i++) {
                if (($(this).val() == '' || markers[i].data.nama_rs.toLowerCase().indexOf($(this).val().toLowerCase()) != -1) && ($('#' + markers[i].data.jenis_rs.substr(0, 4)).prop('checked') || ($('#RSS').prop('checked') && markers[i].data.jenis_rs.indexOf('RSS') != -1)) && $('#' + markers[i].data.kode_matra).prop('checked')) markers[i].setVisible(true);
                else markers[i].setVisible(false);
            }
        }
    });
});

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
            content: '<b>' + obj.nama_rs + '</b>'
        });
        var img = obj.jenis_rs != null && obj.jenis_rs.indexOf('RSS') != -1 ? obj.jenis_rs.substr(0, 4) : obj.jenis_rs + '-' + obj.kode_matra;
        var drawmarker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
            map: map,
            window: infowindow,
            data: obj,
            icon: {
                url: '/app-assets/images/ico/' + img + '.png',
                scaledSize: new google.maps.Size(25, 25),
            }
        });
        google.maps.event.addListener(drawmarker,'mouseover',function() {
            this.window.open(map,this);
        });
        google.maps.event.addListener(drawmarker,'click',function() {
            rs = this.data;
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
            $('#tempat_tidur').html(this.data.tempat_tidur ?? '-');

			if (this.data.fasilitas.length == 0) res = 
                        '<div class="d-flex justify-content-between mb-50">' +
                            '<span class="font-weight-bolder" style="font-size: 14px;">-</span>' +
                        '</div>';
            else {
                res = '';
                for(i=0;i<this.data.fasilitas.length;i++) {
                    let nama_fasilitas = this.data.fasilitas[i].nama_fasilitas;
                    if (nama_fasilitas.split(' ').join('').toLowerCase() === 'ambulanceintensif/gawatdarurat') {
                        nama_fasilitas = 'Ambulance'
                    }
                    if (this.data.fasilitas[i].id_fasilitas == 1 || this.data.fasilitas[i].jumlah > 0)
                    res += 
                        '<div class="d-flex justify-content-between mb-50">' +
                            '<span style="font-size: 14px;">- ' + nama_fasilitas + '</span>' +
                            '<label class="float-right font-weight-bolder" style="font-size: 14px;">' + (this.data.fasilitas[i].id_fasilitas == 1 ? this.data.fasilitas[i].jumlah : (this.data.fasilitas[i].jumlah == 0 ? 'Tidak Ada' : 'Ada')) + '</label>' +
                        '</div>';
                }
            }
            $('#fasunggul').html(res);

            $('#dokter').html(this.data.dokter == 0 ? '-' : this.data.dokter);
            $('#paramedis').html(this.data.paramedis == 0 ? '-' : this.data.paramedis);
            $('#nakeslain').html(this.data.nakeslain == 0 ? '-' : this.data.nakeslain);
            
            $('#doku').html('-');
            $('#dokg').html('-');
            if (this.data.detaildok.length == 0) {
                res =       '<div class="d-flex justify-content-between mb-50">' +
                                '<span class="font-weight-bolder" style="font-size: 14px;">-</span>' +
                            '</div>';
            } else {
                res = '';
                for(i=0;i<this.data.detaildok.length;i++) {
                    if (this.data.detaildok[i].kat == 1) $('#doku').html(this.data.detaildok[i].jml);
                    else if (this.data.detaildok[i].kat == 3) $('#dokg').html(this.data.detaildok[i].jml);
                    else res += 
                            '<div class="d-flex justify-content-between mb-50 dokwrap" style="cursor:pointer" onclick="detail_dokter(\'' + this.data.detaildok[i].id_sp + '\', \'' + this.data.detaildok[i].sp + '\')">' +
                                '<span style="font-size: 14px;">' + this.data.detaildok[i].sp + '</span>' +
                                '<span class="font-weight-bolder text-break" style="font-size: 14px;">' + this.data.detaildok[i].jml + '</span>' +
                            '</div>';
                }
            }
            $('#doksp').html(res);
            
			if (this.data.detailpar.length == 0) res =       
                            '<div class="d-flex justify-content-between mb-50">' +
                                '<span class="font-weight-bolder" style="font-size: 14px;">-</span>' +
                            '</div>';
            else {
                res = '';
                for(i=0;i<this.data.detailpar.length;i++) {
                    res += 
                            '<div class="d-flex justify-content-between mb-50">' +
                                '<span style="font-size: 14px;">' + this.data.detailpar[i].kat + '</span>' +
                                '<span class="font-weight-bolder text-break" style="font-size: 14px;">' + this.data.detailpar[i].jml + '</span>' +
                            '</div>';
                }
            }
            $('#prmds').html(res);
            
			if (this.data.detaillain.length == 0) res =       
                            '<div class="d-flex justify-content-between mb-50">' +
                                '<span class="font-weight-bolder" style="font-size: 14px;">-</span>' +
                            '</div>';
            else {
                res = '';
                for(i=0;i<this.data.detaillain.length;i++) {
                    res += 
                            '<div class="d-flex justify-content-between mb-50">' +
                                '<span style="font-size: 14px;">' + this.data.detaillain[i].kat + '</span>' +
                                '<span class="font-weight-bolder text-break" style="font-size: 14px;">' + this.data.detaillain[i].jml + '</span>' +
                            '</div>';
                }
            }
            $('#nkslain').html(res);
            $('#faskes-sidebar').modal('show');
        });
        google.maps.event.addListener(drawmarker,'mouseout',function() {
            this.window.close();
        });
        markers.push(drawmarker);
    }
    $('#inp-faskes').prop('disabled', false);
}
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&callback=initMap"></script>
<script>

var data = {!!json_encode($rs)!!};
var map;
var markers = [];
var badge = {'AD': 'badge-success', 'AL': 'badge-info', 'AU': 'badge-primary', 'MABES': 'badge-warning'};

$( document ).ready(function() {
    function show() {
        document.getElementById('rekapitulasi').className='visiblediv'; 
        document.getElementById('p1').className='hiddendiv'; 
    }

    function hide() {
        document.getElementById('rekapitulasi').className='hiddendiv'; 
        document.getElementById('p1').className='visiblediv'; 
    }

    var p1 = document.getElementById("p1");
    p1.onclick = show;
    var p2 = document.getElementById("p2");
    p2.onclick = hide;

    $('#inp-faskes').keypress(function(event) {
        if (event.key === "Enter") {
            for(i=0;i<markers.length;i++) {
                if (($(this).val() == '' || markers[i].data.nama_rs.toLowerCase().indexOf($(this).val().toLowerCase()) != -1) && ($('#' + markers[i].data.jenis_rs.substr(0, 4)).prop('checked') || ($('#RSS').prop('checked') && markers[i].data.jenis_rs.indexOf('RSS') != -1)) && $('#' + markers[i].data.kode_matra).prop('checked')) markers[i].setVisible(true);
                else markers[i].setVisible(false);
            }
        }
    });
});



function filter(kat, val, checked) {
    for(i=0;i<markers.length;i++) {
        if (kat == 'm') {
            if (markers[i].data.kode_matra == val && ($('#' + markers[i].data.jenis_rs.substr(0, 4)).prop('checked') || ($('#RSS').prop('checked') && markers[i].data.jenis_rs.indexOf('RSS') != -1))) markers[i].setVisible(checked);
        } else if (kat == 'j') {
            if (markers[i].data.jenis_rs == val && $('#' + markers[i].data.kode_matra).prop('checked')) markers[i].setVisible(checked);
        }
    }
}

function detail_dokter(id, nama) {
	$('#table_detail').DataTable({
        destroy: true,
        ajax: "{{ url('yankesin/dokter-faskes-detail/') }}/" + rs.id_rs + '?sp=' + id,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'nama_dokter',
            },
            {
                data: 'klasifikasi',
            },
        ],
        "drawCallback": function(settings) {
            $('h4.modal-title').html('Detail Dokter ' + nama + ' ' + rs.nama_rs);
            $('#detail-dokter').modal('show');
        }
    });
}
</script>
@endsection
