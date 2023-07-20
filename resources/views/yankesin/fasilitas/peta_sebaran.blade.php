@extends('partials.template') 

@section('main')   
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Sebaran Fasilitas Faskes Puskes TNI - CT Scan</h2>
                        </div>
                        <div class="col-md-4 col-12">
                            <select class="select2 form-control">
                                <option>CT Scan</option>
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
                                <div class="card-body" id="map" style="height:400px"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section("page_script")
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>
<script>

var data = {!!json_encode($rs)!!};
var map;
var markers = [];

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
            content: obj.nama_rs + ' <br> CT Scan : <b> 1 Buah </b>'
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
            $('#namafaskes').html(this.data.nama_rs);
            $('#jenisfaskes').html(this.data.jenis_rs);
            $('#noopr').html(this.data.no_ijin_opr);
            $('#alamat').html(this.data.alamat);
            $('#doku').html(this.data.jmldoku == 0 ? '-' : 'Ada');
            $('#jmldoku').html(this.data.jmldoku);
            $('#dokg').html(this.data.jmldokg == 0 ? '-' : 'Ada');
            $('#jmldokg').html(this.data.jmldokg);
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
            if (markers[i].data.jenis_rs.indexOf(val) != -1 && $('#' + markers[i].data.kode_matra).prop('checked')) markers[i].setVisible(checked);
        }
    }
}
</script>
@endsection
