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

    body.modal-open{
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

    .yearpicker-container {
        margin-top: 0rem !important;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Maps Kegiatan Kermabaktikes <font id="tahun-title"></font></h2>
                        </div>
                        <div class="col-md-4 col-12">
                            <input type="text" id="tahun" class="form-control cursor-pointer bg-white" placeholder="Tahun" readonly/>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="demo-inline-spacing">
                                <div class="custom-control custom-checkbox mt-50">
                                    <input type="checkbox" class="custom-control-input filter_keg" id="kerma" onchange="filter(this.id, this.checked)" checked/>
                                    <label class="custom-control-label" for="kerma">Kerma</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-50">
                                    <input type="checkbox" class="custom-control-input filter_keg" id="bakti" onchange="filter(this.id, this.checked)" checked/>
                                    <label class="custom-control-label" for="bakti">Bakti</label>
                                </div>
                            </div>
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

    <div class="modal modal-slide-in fade" id="modal-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">
                        <span class="align-middle"></span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <p class="font-weight-bolder mb-50" style="font-size: 20px;" id="jenis_keg">Kerja Sama</p>
                    <p class="font-weight-bold mb-50" style="font-size: 14px;" id="jenis_kerma">Bilateral</p>
                    <p style="font-size: 16px;" id="nama_event">USIBDD</p>

                    <hr>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">NAMA KEGIATAN</span>
                        <p class="mb-0" id="nama_kegiatan">ASM</p>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">NAMA ACARA</span>
                        <p class="mb-0"  id="nama_acara">ASM Biothreats</p>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">JENIS KEGIATAN</span>
                        <p class="mb-0" id="jenis_kegiatan">Conference</p>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">TANGGAL KEGIATAN</span>
                        <p class="mb-0" id="tgl_pelaksanaan">28 January 2019</p>
                    </div>

                    <div class="mb-1">
                        <span class="text-muted" style="font-size: 12px;">TEMPAT</span>
                        <p class="mb-0" id="nama_tempat">Washington DC USA</p>
                    </div>

                    <span class="badge badge-success mr-50" id="keterangan">Terlaksana</span>
                    <!-- <span class="badge badge-danger mr-50">Batal</span> -->
                    <span class="badge badge-light-success" id="nama_status">Undangan</span>  
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section("page_script")
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>

<script>
    let data = {!!json_encode($lokasi_acara)!!};
    let data_length = data.length;
    let markers = [];

    function initMap() {
        const uluru = { lat: -1.770340, lng: 118.409108 };  
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: uluru,
        });  

        for (let i = 0; i < data_length; i++) {
            var obj = data[i];
            
            var infowindow = new google.maps.InfoWindow({
                content: obj.nama_tempat
            });

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(obj.latitude),parseFloat(obj.longitude)),
                map: map,
                window: infowindow,
                data: obj
            });

            google.maps.event.addListener(marker,'mouseover',function() {
                this.window.open(map,this);
            });

            google.maps.event.addListener(marker,'mouseout',function() {
                this.window.close();
            });
            
            google.maps.event.addListener(marker,'mouseover',function() {
                this.window.open(map,this);
            });
            google.maps.event.addListener(marker,'click',function() {
                $('#modal-sidebar').modal('show');
                $('#jenis_keg').html(this.data.jenis_keg);
                $('#jenis_kerma').html(this.data.jenis_kerma);
                $('#nama_event').html(this.data.nama_event);
                $('#nama_kegiatan').html(this.data.nama_kegiatan);
                $('#nama_acara').html(this.data.nama_acara);
                $('#jenis_kegiatan').html(this.data.jenis_kegiatan);
                $('#tgl_pelaksanaan').html(this.data.tgl_pelaksanaan);
                $('#nama_tempat').html(this.data.nama_tempat);
                $('#keterangan').html(this.data.keterangan);
                $('#nama_status').html(this.data.nama_status);
            });
            google.maps.event.addListener(marker,'mouseout',function() {
                this.window.close();
            });
            markers.push(marker);
        }
    }
    window.initMap = initMap;

    function filter(val, checked) {

        let tahun = $('#tahun').val();

        for(i=0;i<markers.length;i++) { 
            if (tahun != '') {
                if (markers[i].data.kategori_keg == val && markers[i].data.periode == tahun) markers[i].setVisible(checked);
            } else {
                if (markers[i].data.kategori_keg == val) markers[i].setVisible(checked);
            }
        }
    }

    $("#tahun").yearpicker()

    $(document).on('change','#tahun',function(e){
        let tahun = $(this).val();
        $('#tahun-title').html("- " + tahun);
        for(i=0;i<markers.length;i++) {
            if ($('input.filter_keg').is(':checked')) {
                if (markers[i].data.periode == tahun) markers[i].setVisible(true);
                else markers[i].setVisible(false)
            }
        }
    });
</script>
@endsection
