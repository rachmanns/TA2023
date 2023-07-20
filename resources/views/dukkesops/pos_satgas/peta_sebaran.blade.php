@extends('partials.template') 

@section('page_style')
<style>
    .graphic-container {
        min-height: 200px;
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .apexcharts-canvas .apexcharts-datalabel {
        fill: #fff;
    }

    .modal-backdrop.show {
        opacity: .0;
        width: 0;
        height: 0;
    }
    /* .modal {
        width: 0;
        height: 0;
    } */

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

    #detail-bekkes {
        z-index: 500;
    }

    #pos-satgas-sidebar {
        z-index: 400;
        width: 0;
        height: 0;
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Peta Sebaran Pos Satgas</h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-1">                
                <div class="col-sm-9 col-12">
                    <div class="demo-inline-spacing mt-0">
                        <label>SATGAS &ensp;: </label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" checked id="darat" class="custom-control-input" onchange="filter(this.id, this.checked)" />
                            <label class="custom-control-label" for="darat">DARAT <img src="{{ url('app-assets/images/ico/darat.png') }}" width="20%"></label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" checked id="puter" class="custom-control-input" onchange="filter(this.id, this.checked)" />
                            <label class="custom-control-label" for="puter">PUTER <img src="{{ url('app-assets/images/ico/puter.png') }}" width="20%"></label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" checked id="bandara" class="custom-control-input" onchange="filter(this.id, this.checked)" />
                            <label class="custom-control-label" for="bandara">BANDARA <img src="{{ url('app-assets/images/ico/bandara.png') }}" width="16%"></label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <label for=""> Pos Satgas/Batalyon</label>
                    <input type="text" class="form-control" placeholder="Cari Pos/Batalyon" id="inp-pos-batal" />
                </div>
            </div>
            <div class="content-body">
                 <!-- Line Chart Card -->
                 <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-lg-12 col-12">
                            <div class="card">                                
                                <div class="card-body" id="map" style="height:600px">
                                </div>
                                <div class="m-2">
                                    <span class="font-weight-bolder"> Keterangan Icon : </span>
                                    <div class="demo-inline-spacing">
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ $icon['darat'] }}" width="22px" class="mr-50">Satgas Darat
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/puter.png') }}" width="22px" class="mr-50">Satgas Puter
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('app-assets/images/ico/bandara.png') }}" width="22px" class="mr-50">Satgas Bandara
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ $icon['mobile'] }}" width="22px" class="mr-50">Satgas Mobile
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ $icon['udara'] }}" width="22px" class="mr-50">Pos Udara
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ $icon['kapal'] }}" width="22px" class="mr-50">Pos Kapal
                                        </div>
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
                                            <img src="{{ url('app-assets/images/ico/FKTP-MABES.png') }}" width="22px" class="mr-50">FKTP MABES
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
                                        <div class="d-flex justify-content-between">
                                            <img src="{{ url('img/pos_satgas/RSUD.png') }}" width="22px" class="mr-50">RS Pemda/RS Swasta 
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </section>
                <!--/ Line Chart Card -->                
            </div>
        </div>
    </div>
    
    @include('dukkesops.pos_satgas.detail_bekkes')

    <!-- Faskes Detail Sidebar -->
    <div class="modal modal-slide-in fade" id="pos-satgas-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="align-middle"></span>
                    </h5>
                </div>
                <div class="modal-body pb-1" id="detail-satgas">
                    <p class="font-weight-bolder mb-25" id="nama_pos" style="font-size: 20px;"></p>
                    <p id="nama_batalyon">YONIF 725 WOROAGI</p>
                    <p class="font-weight-bolder mb-25" id="nama_kat_satgas"></p>

                    <span class="badge" id="status_endemik"> </span>
                    {{-- <span class="badge badge-light-success"> Evakuasi Darat </span> --}}

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <span style="font-size: 14px;">Jumlah Pers</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span class="font-weight-bolder" style="font-size: 14px;" id="jml_pers"></span>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Nama Personil Kes</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span class="font-weight-bolder" style="font-size: 14px;" id="nama_pers"></span>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">No. Telepon</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span class="font-weight-bolder" style="font-size: 14px;" id="no_telp"></span>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Keterangan</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span class="font-weight-bolder" style="font-size: 14px;" id="keterangan_pos_satgas"></span>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <span style="font-size: 16px;" class="font-weight-bolder">Bekkes</span>
                        </div>
                    </div>

                    <div id="bekkes_pos"></div>

                    <hr>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <span style="font-size: 16px;" class="font-weight-bolder">Data Geomedik</span>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Geografis</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="jenis_geografis">Pegunungan</label>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Pendapatan Perkapita</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="pendapatan">80,288</label>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Kepadatan Penduduk</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="kepadatan">650,834 Jiwa</label>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Ekonomi</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="ekonomi">Petani</label>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Suku Mayoritas</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="budaya">Sunda</label>
                        </div>
                        <div class="col-12">
                            <span style="font-size: 14px;">Ideologi</span>
                        </div>
                        <div class="col-12 mb-50">
                            <span style="font-size: 14px;" class="font-weight-bolder" id="ideologi">Islam</label>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <span style="font-size: 16px;" class="font-weight-bolder">Faskes Terdekat</span>
                        </div>
                    </div>

                    <div id="rs_terdekat" style="text-transform: capitalize;"></div>
                </div>
                <div class="modal-body flex-grow-1" id="detail-rs"></div>
            </div>
        </div>
    </div>
    <!-- /Faskes Detail Sidebar -->
    <!-- END: Content-->
@endsection    

@section("page_script")
<script>

var data = {!!json_encode($pos_satgas)!!};
var rs = {!! json_encode($rs) !!};
var icon = {!!json_encode($icon)!!};
var markers_rs = [];
var circle_rs = [];
var markers_satgas = [];
var map;
var latClicked;
var lngClicked;
var radius_range = 100000;
let jarak_rs = [];
let temp_rs_terdekat = [];
let init_location = {{isset($pos_cari) ? "{lat: ".$pos_cari->latitude.", lng: ".$pos_cari->longitude."}" :"{lat: -1.770340, lng: 118.409108}" }}
let init_zoom = {{isset($pos_cari) ? 13 : 5 }}

function initMap() {
    map = new google.maps.Map(
        document.getElementById('map'), {
            center: init_location,
            zoom: init_zoom
        }
    );
    for (var i=0;i<data.length;i++) {
        var obj = data[i];
        var infowindow = new google.maps.InfoWindow({
            content: obj.nama_pos
        });
        
        let url_image;

        if ((obj.tipe != 'darat' &&  obj.keterangan == 'darat') || obj.keterangan == null) {
            // url_image='/img/pos_satgas/' + obj.tipe + '.png';
            url_image= icon[obj.tipe];
        }else{
            // url_image='/app-assets/images/ico/' + obj.keterangan + '.png';
            url_image= obj.keterangan == 'darat' ? icon[obj.keterangan] : '/app-assets/images/ico/' + obj.keterangan + '.png';
        }

        var drawmarker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
            map: map,
            window: infowindow,
            data: obj,
            icon: {
                url: url_image,
                scaledSize: new google.maps.Size(25, 25),
            }
        });
        google.maps.event.addListener(drawmarker,'mouseover',function() {
            this.window.open(map,this);
        });

        google.maps.event.addListener(drawmarker, 'click', (function(drawmarker, e) {
            
            return function() {
                jarak_rs = [];
                temp_rs_terdekat = [];

                let bekkes_pos = this.data.bekkes_pos.sort((a,b) => a.urutan - b.urutan);
                let bekkes_html ='';
                $('#nama_pos').html(this.data.nama_pos);
                $('#nama_kat_satgas').html(this.data.nama_kat_satgas);
                $('#jenis_geografis').html(this.data.jenis_geografis);
                $('#pendapatan').html(this.data.pendapatan);
                $('#kepadatan').html(this.data.kepadatan);
                $('#ekonomi').html(this.data.ekonomi);
                $('#budaya').html(this.data.budaya);
                $('#ideologi').html(this.data.ideologi);
                $('#nama_batalyon').html(this.data.nama_batalyon);
                $('#jml_pers').html(this.data.jml_pers);
                $('#nama_pers').html(this.data.nama_pers);
                $('#no_telp').html(this.data.no_telp);
                $('#keterangan_pos_satgas').html(this.data.keterangan_pos_satgas);
                
                if (this.data.status_endemik === 1) {
                    $('#status_endemik').html('Daerah Endemik Malaria').addClass('badge-danger').removeClass('badge-success')
                } else {
                    $('#status_endemik').html('Daerah Non Endemik').addClass('badge-success').removeClass('badge-danger')
                }

                for (const bp in bekkes_pos) {
                    bekkes_html += `<div class="d-flex justify-content-between mb-50">
                                        <div class="mb-0"><a onclick="detail_bekkes($(this))" class="coba" data_nama="${bekkes_pos[bp].nama_bekkes}" data_id_mas_bek="${bekkes_pos[bp].id_mas_bek}">${bekkes_pos[bp].nama_bekkes}</a></div>
                                        <b>${bekkes_pos[bp].jumlah}</b>
                                    </div>
                                `;
                }
                $('#bekkes_pos').html(bekkes_html);
                $('#pos-satgas-sidebar').modal('show');
                $('#detail-satgas').fadeIn();
                $('#detail-rs').fadeOut();
                latClicked = parseFloat(this.data.latitude);
                lngClicked = parseFloat(this.data.longitude);
                
                hitung_faskes_terdekat(this.data.rs_pos_pem_swas);
                showCircle();
                remarker_pos();
                drawmarker.setIcon();
            };
        })(drawmarker, i));
        markers_satgas.push(drawmarker);

        google.maps.event.addListener(drawmarker,'mouseout',function() {
            this.window.close();
        });
    }
    @if($pos_cari)
    $('#inp-pos-batal').val('{{$pos_cari->nama_pos}}');
    reload_data();
    @endif
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=geometry&callback=initMap"
        defer></script>
<script>


$( document ).ready(function() {

    $('#inp-pos-batal').keypress(function(event) {
        if (event.key === "Enter") {
            reload_data();
        }
    });
});

        function reload_data() {
            remarker_pos();
            removeCircle();
            removeMarkersRs();
            for(i=0;i<markers_satgas.length;i++) {
                if (
                    ($('#inp-pos-batal').val() == '' ||
                    markers_satgas[i].data.nama_pos.toLowerCase().indexOf($('#inp-pos-batal').val().toLowerCase()) !== -1 ||
                    markers_satgas[i].data.nama_batalyon.toLowerCase().indexOf($('#inp-pos-batal').val().toLowerCase()) !== -1)
                    &&  $('#' + markers_satgas[i].data.keterangan).prop('checked')
                    ) markers_satgas[i].setVisible(true);
                else markers_satgas[i].setVisible(false);
            }
        }

function remarker_pos() {
    for (var j = 0; j < markers_satgas.length; j++) {
        let url_image;
        if ((markers_satgas[j].data.tipe != 'darat' &&  markers_satgas[j].data.keterangan == 'darat') || markers_satgas[j].data.keterangan == null) {
            // url_image='/img/pos_satgas/' + markers_satgas[j].data.tipe + '.png';
            url_image= icon[markers_satgas[j].data.tipe];
        }else{
            // url_image='/app-assets/images/ico/' + markers_satgas[j].data.keterangan + '.png';
            url_image= markers_satgas[j].data.keterangan == 'darat' ? icon[markers_satgas[j].data.keterangan] : '/app-assets/images/ico/' + markers_satgas[j].data.keterangan + '.png';
        }
        markers_satgas[j].setIcon({
            url: url_image,
            scaledSize: new google.maps.Size(25, 25)
        });
    }
}

function hitung_faskes_terdekat(rs_pos_pem_swas) {
    removeMarkersRs();
    let rs_terdekat_html = '';
    let rs_length = rs.length;
    const image =
        "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
    var x = radius_range,y;
    var clicked = new google.maps.LatLng(latClicked,lngClicked);
    for (let i = 0; i < rs_length; i++) {
        y = google.maps.geometry.spherical.computeDistanceBetween (new google.maps.LatLng(parseFloat(rs[i].latitude),parseFloat(rs[i].longitude)), clicked);
        if (y<x) {
            var obj = rs[i];
            jarak_rs.push({
                jarak: y,
                id_rs: obj.id_rs
            });
            obj['evakuasi'] = 'DARAT';
            temp_rs_terdekat.push(obj);

            var infowindow = new google.maps.InfoWindow({
                content: obj.nama_rs
            });
            var img = obj.jenis_rs != null && obj.jenis_rs.indexOf('RSS') != -1 ? obj.jenis_rs.substr(0, 4) : obj.jenis_rs + '-' + obj.kode_matra;
            var drawMarkerRs = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
                map: map,
                window: infowindow,
                data: obj,
                icon: {
                    url: img == 'darat' ? icon[img] : '/app-assets/images/ico/' + img + '.png',
                    scaledSize: new google.maps.Size(25, 25),
                }
            });
            markers_rs.push(drawMarkerRs);
            google.maps.event.addListener(drawMarkerRs,'mouseover',function() {
                this.window.open(map,this);
            });
            google.maps.event.addListener(drawMarkerRs,'click',function() {
                $.ajax({
                    method: "POST",
                    url: "{{ url('dukkesops/get-faskes') }}",
                    data: { _token: "{{ csrf_token() }}", id_rs: this.data.id_rs },
                    success: function(response){
                        $('#detail-satgas').fadeOut();
                        $('#detail-rs').fadeIn();
                        $('#detail-rs').html(response);

                    }
                })
            });
            google.maps.event.addListener(drawMarkerRs,'mouseout',function() {
                this.window.close();
            });
        }
    }

    var xz = radius_range,yz;
    for (let index = 0; index < rs_pos_pem_swas.length; index++) {
        yz = google.maps.geometry.spherical.computeDistanceBetween (new google.maps.LatLng(parseFloat(rs_pos_pem_swas[index].latitude),parseFloat(rs_pos_pem_swas[index].longitude)), clicked);

        let obj_temp = rs_pos_pem_swas[index];
        jarak_rs.push({
            jarak: yz, 
            id_rs: obj_temp.id_rs_pem_swas
        });
        obj_temp['id_rs'] = obj_temp.id_rs_pem_swas;
        temp_rs_terdekat.push(obj_temp);
        let infowindow = new google.maps.InfoWindow({
                content: obj_temp.nama_rs
            });
        var drawMarkerRs = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(obj_temp.latitude),parseFloat(obj_temp.longitude)),
                map: map,
                window: infowindow,
                data: obj,
                icon: {
                    url: '/img/pos_satgas/RSUD.png',
                    scaledSize: new google.maps.Size(25, 25),
                }
            });
            markers_rs.push(drawMarkerRs);

            google.maps.event.addListener(drawMarkerRs,'mouseover',function() {
                this.window.open(map,this);
            });
            google.maps.event.addListener(drawMarkerRs,'mouseout',function() {
                this.window.close();
            });
        
    }
    showRsTerdekat();
}

// sorting berdasarkan jarak terdekat
function showRsTerdekat() {
    let sort_jarak = jarak_rs.sort((a,b) => a.jarak - b.jarak);
    let sort_jarak_length = sort_jarak.length;
    let rs_terdekat_html = '';

    if (sort_jarak_length == 0) {
        rs_terdekat_html += `nihil`;
    } else {
        for (let i = 0; i < sort_jarak_length; i++) {
            let jarak = Math.round(sort_jarak[i].jarak) / 1000;
            let result = temp_rs_terdekat.find(({ id_rs }) => id_rs == sort_jarak[i].id_rs);
            rs_terdekat_html += `<div class="d-flex justify-content-between mb-50">
                                        <div class="mb-0">${result.nama_rs}</div>
                                        <span class="badge badge-light-success"> ${Math.round(jarak)} KM ${result.evakuasi}</span>
                                    </div>
                            `;
        }
    }

    $('#rs_terdekat').html(rs_terdekat_html);
}


function removeMarkersRs(){
    for(i=0; i<markers_rs.length; i++){
        markers_rs[i].setMap(null);
    }
}

function showCircle() {
    removeCircle();
    const cityCircle = new google.maps.Circle({
      strokeColor: "#ffcc00",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#ffcc00",
      fillOpacity: 0.45,
      map,
      center: {lat: parseFloat(latClicked), lng: parseFloat(lngClicked)},
      radius: radius_range,
    });
    circle_rs.push(cityCircle);
}

function removeCircle() {
    circle_rs.forEach((crs) => {
        crs.setMap(null);
    });
    circle_rs = [];
}

function filter(val, checked) {
    remarker_pos();
    removeCircle();
    removeMarkersRs();
    for(i=0;i<markers_satgas.length;i++) {
        if (markers_satgas[i].data.keterangan == val) markers_satgas[i].setVisible(checked);
    }
}

function detail_bekkes(e) {
    $('#detail-bekkes').modal('show');
    $('#nama_kat_bekkes').text(e.attr('data_nama'));
    let nama_image = e.attr('data_nama').split(' ').join('_').toLowerCase();
    $("#kat_image").attr("src",`{{ url('/img/bekkes/${nama_image}.jpeg') }}`);
    detail_bekkes_table(e.attr('data_id_mas_bek'));
}

function detail_bekkes_table(id_mas_bek) {
    $('#detail_bekkes_table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: `{{ url('dukkesops/pos-satgas/get-bekkes/${id_mas_bek}') }}`,
        // scrollX: true,
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_kategori_brg',
                name: 'nama_kategori_brg'
            },
            {
                data: 'jenis_brg',
                name: 'jenis_brg'
            },
            {
                data: 'nama_brg',
                name: 'nama_brg'
            },
            {
                data: 'satuan',
                name: 'satuan'
            },
            {
                data: 'jml',
                name: 'jml'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }
    });
}

</script>
@endsection