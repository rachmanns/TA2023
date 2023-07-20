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

    [pointer-events="bounding-box"] {
        display: none
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
            <div class="content-body"> 
                <div class="row"> 
                    <div class="content-header-left col-md-12 col-1">
                        <h2 class="content-header-title float-left">Data Sisa Stok Bekkes</h2>
                    </div>
                    <div class="col-md-3 col-12 mb-1">
                        <input type="text" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Berjalan" readonly />
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div id="lampau">Grafik will load here!</div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="d-flex justify-content-between mb-1">
                    <h2 class="content-header-title float-left">Peta Lokasi Barang Keluar Dobekkes</h2>
                </div>
                <div class="row match-height">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-body" id="map" style="height:400px"></div>
                        </div>
                    </div>
                </div>
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
                    <p class="font-weight-bolder mb-50" style="font-size: 24px;" id="penerima"></p>
                    <span class="text-muted mb-0" style="font-size: 12px;">Jenis Pengeluaran</span>
                    <p class="font-weight-bold" style="font-size: 16px;" id="jenis"></p>

                    <hr>

                    <p class="font-weight-bolder mb-50" style="font-size: 16px;">Dokumen</p>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">No. PPM</span>
                        <p class="mb-0" id="ppm"></p>
                        <a href="#" target="_blank" id="linkppm"><u><i data-feather='file-text' class=' font-medium-1 mr-50'></i>Lihat Dokumen</u></a>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">No. Nota Dinas</span>
                        <p class="mb-0" id="nodin"></p>
                        <a href="#" target="_blank" id="linknodin"><u><i data-feather='file-text' class=' font-medium-1 mr-50'></i>Lihat Dokumen</u></a>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">No. SPB</span>
                        <p class="mb-0" id="spb"></p>
                        <a href="#" target="_blank" id="linkspb"><u><i data-feather='file-text' class=' font-medium-1 mr-50'></i>Lihat Dokumen</u></a>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">No. Sprindis</span>
                        <p class="mb-0" id="sprindis"></p>
                        <a href="#" target="_blank" id="linksprindis"><u><i data-feather='file-text' class=' font-medium-1 mr-50'></i>Lihat Dokumen</u></a>
                    </div>

                    <div class="mb-50">
                        <span class="text-muted" style="font-size: 12px;">No. SKB</span>
                        <p class="mb-0" id="skb"></p>
                        <a href="#" target="_blank" id="linkskb"><u><i data-feather='file-text' class=' font-medium-1 mr-50'></i>Lihat Dokumen</u></a>
                    </div>

                    <hr>

                    <p class="font-weight-bolder mb-50" style="font-size: 16px;">Barang</p>

                    <table class="table align-item-left">
                        <tr>
                            <th class="border-0 p-0" style="vertical-align: top;"><span class="text-muted" style="font-size: 12px;">Nama Barang</span></th>
                            <th class="border-0 p-0 pl-1" style="vertical-align:top;"><span class="text-muted" style="font-size: 12px;">Satuan</span></th>
                            <th class="border-0 p-0 pl-1" style="vertical-align:top;"><span class="text-muted" style="font-size: 12px;">Jumlah</span></th>
                        </tr>
                      <tbody></tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section("page_script")
<script src="{{ url('assets/js/fusioncharts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.charts.js') }}"></script>
<script src="{{ url('assets/js/fusioncharts.theme.fusion.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>

<script type="text/javascript">
    FusionCharts.ready(function() {
        var chartObj = new FusionCharts({
            type: 'scrollmsstackedcolumn2d',
            renderAt: 'lampau',
            width: '100%',
            height: '450',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "numVisiblePlot": "12",
                    "plottooltext": "<b>$seriesName</b><br>$label: <b>$dataValue</b><hr>",
                    "formatNumberScale": "0",
                    "thousandSeparator": ".",
                    "drawCrossLine": "1",
                    "showSum": "1"
                },
                "categories": [{
                    "category": {!! json_encode($categories) !!}
                }],
                "dataset": [{
                        "dataset": [
                            {
                                "seriesname": "Sisa Stok Tahun Ini ({{ $tahun }})",
                                "color": "#ffb976",
                                "data": {!! json_encode($data_berjalan) !!}
                            },
                            {
                                "seriesname": "Sisa Stok Tahun Lalu ({{ ($tahun-1) }})",
                                "color": "#48da89",
                                "data": {!! json_encode($data_lampau) !!}
                            }
                        ]
                    }
                ]
            }
        });
        chartObj.render();
    });
    $(document).ready(function() {
        $('.yearpicker').val({{ $tahun }});
        $('.yearpicker').change(function() {
            location.href = '{{ request()->url() }}?tahun=' + $(this).val();
        });
    });
</script>

<script>
    var data = {!!json_encode($data)!!};
    function initMap() {
    const uluru = { lat: -1.770340, lng: 118.409108 };  
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: uluru,
    });  
      for (var i=0;i<data.length;i++) {
        var obj = data[i];
        var infowindow = new google.maps.InfoWindow({
            content: '<b>' + obj.penerima + ' (' + obj.tgl_keluar + ')</b>'
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
            $('#penerima').html(this.data.penerima);
            $('#jenis').html(this.data.jenis_pengeluaran);
            $('#ppm').html(this.data.no_ppm ?? '-');
            $('#linkppm').attr('href', this.data.file_ppm ? '/dobekkes/barang-keluar/file-ppm/' + this.data.file_ppm : '-').css('display', this.data.file_ppm ? '' : 'none');
            $('#nodin').html(this.data.no_nota_dinas ?? '-');
            $('#linknodin').attr('href', this.data.file_nota_dinas ? '/dobekkes/barang-keluar/file-nota-dinas/' + this.data.file_nota_dinas : '-').css('display', this.data.file_nota_dinas ? '' : 'none');
            $('#spb').html(this.data.no_spb ?? '-');
            $('#linkspb').attr('href', this.data.file_spb ? '/dobekkes/barang-keluar/file-spb/' + this.data.file_spb : '-').css('display', this.data.file_spb ? '' : 'none');
            $('#sprindis').html(this.data.no_sprindis ?? '-');
            $('#linksprindis').attr('href', this.data.file_sprindis ? '/dobekkes/barang-keluar/file-sprindis/' + this.data.file_sprindis : '-').css('display', this.data.file_sprindis ? '' : 'none');
            $('#skb').html(this.data.no_pak ?? '-');
            $('#linkskb').attr('href', this.data.file_pak ? '/dobekkes/barang-keluar/file-PAK/' + this.data.file_pak : '-').css('display', this.data.file_pak ? '' : 'none');
            $('.table tbody').html('');
            for (var j=0; j<this.data.brg_out.length; j++) {
                brg = '<tr>' +
                            '<td class="border-0 p-1"><span style="font-size: 12px;">' + this.data.brg_out[j].detail_brg_matkes_d.detail_brg_matkes_m.nama_matkes + '</span></td>' +
                            '<td class="border-0 p-1"><span style="font-size: 12px;">' + this.data.brg_out[j].detail_brg_matkes_d.detail_brg_matkes_m.satuan_brg + '</span></td>' +
                            '<td class="border-0 p-1 text-center"><span class="font-weight-bolder" style="font-size: 12px;">' + this.data.brg_out[j].jml_keluar + '</span></td>' +
                        '</tr>';
                $('.table tbody').append(brg);
            }
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
