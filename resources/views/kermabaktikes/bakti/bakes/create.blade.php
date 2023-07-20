@extends('partials.template')

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row pb-1">
                <div class="col-6">
                    <a href="{{ url('bakti/bakes') }}"><button type="button" class="btn btn-outline-primary">
                        <i data-feather="arrow-left"></i>
                        <span>Back</span>
                    </button></a>
                </div>
            </div>   
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ request()->segment(3)=='create'?'Input':'Edit' }} Data Bakti</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    @if (isset($bake))
                        <form action="{{ route('bakti.bakes.update',$bake->id_bakti) }}" class="default-form" autocomplete="off">
                            @method('PUT')
                    @else
                        <form action="{{ route('bakti.bakes.store') }}" class="default-form" autocomplete="off">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">   
                                        <div class="demo-inline-spacing">           
                                            @foreach ($jenis_kegiatan as $item)
                                                <div class="custom-control custom-radio mt-0">
                                                    <input type="radio" id="{{ $item->id_jenis_keg }}" name="id_jenis_keg" class="custom-control-input" value="{{ $item->id_jenis_keg }}"
                                                        @isset($bake)
                                                            {{ ($bake->id_jenis_keg==$item->id_jenis_keg)?'checked':'' }}
                                                        @endisset
                                                        />
                                                    <label class="custom-control-label" for="{{ $item->id_jenis_keg }}">{{ $item->jenis_keg }}</label>
                                                </div>   
                                            @endforeach
                                        </div>  
                                        <div class="form-group form-input mt-1">
                                            <label class="form-label" for="nama_acara">Nama Kegiatan</label>
                                            <input type="text" id="nama_acara" class="form-control" placeholder="Nama Kegiatan" name="nama_acara" value="{{ $bake->nama_acara??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="tempat">Tempat</label>
                                            <input type="text" id="tempat" class="form-control" placeholder="Tempat" name="tempat" value="{{ $bake->tempat??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="tgl_pelaksanaan">Tanggal Kegiatan</label>
                                            <input type="text" id="tgl_pelaksanaan" class="form-control flatpickr-basic" placeholder="Tanggal Kegiatan" name="tgl_pelaksanaan" value="{{ $bake->tgl_pelaksanaan??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input">
                                            <label class="form-label" for="sasaran">Sasaran</label>
                                            <input type="text" id="sasaran" class="form-control" placeholder="Sasaran" name="sasaran" value="{{ $bake->sasaran??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group form-input mt-1">
                                            <label class="form-label" for="capaian">Pencapaian</label>
                                            <input type="text" id="capaian" class="form-control" placeholder="Pencapaian" name="capaian" value="{{ $bake->capaian??null }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <label class="form-label mt-1" for="ket">Keterangan</label>
                                            <div class="demo-inline-spacing">
                                                @foreach ($keterangan as $item)
                                                    <div class="custom-control custom-radio mt-0">
                                                        <input type="radio" id="{{ $item->id_keterangan }}" name="id_keterangan" class="custom-control-input" value="{{ $item->id_keterangan }}" 
                                                        @isset($bake)
                                                            {{ ($bake->id_keterangan == $item->id_keterangan)?'checked':'' }}
                                                        @endisset 
                                                        />
                                                        <label class="custom-control-label" for="{{ $item->id_keterangan }}">{{ $item->keterangan }}</label>
                                                    </div>   
                                                @endforeach
                                            </div>
                                        <div class="form-group form-input mt-1">
                                            <label for="customFile1">Laporan</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile1" name="file_laporan"/>
                                                <label class="custom-file-label" for="customFile1">File Laporan</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <h5>Titik Koordinat</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Maps -->
                                        <div class="modal fade text-left" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modal-title">Lihat Map</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="map" style="height:400px"></div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="lokasi_acara_repeater">
                                            <div data-repeater-list="lokasi_acara">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-12 text-right">
                                                            <a onclick="lihat_map(this)" class="lihat-map"><i data-feather="map" class="mr-75"></i>Lihat Map</a>
                                                        </div>
                                                        <div class="col-md-5 col-12">
                                                            <div class="form-group">
                                                                <label>Tempat</label>
                                                                <input type="text" class="form-control nama_tempat" placeholder="Tempat" name="nama_tempat" list="locs" onchange="update_loc(this)" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group">
                                                                <label>Garis Lintang</label>
                                                                <input type="text" class="form-control latitude" placeholder="Garis Lintang" name="latitude" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group">
                                                                <label>Garis Bujur</label>
                                                                <input type="text" class="form-control longitude" placeholder="Garis Bujur" name="longitude"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-12 text-right">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button" title="Delete">
                                                                    <i data-feather="trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>
                                            <div class="row text-right">
                                                <div class="col-12">
                                                    <button class="btn btn-icon btn-outline-primary" type="button" data-repeater-create>
                                                        <i data-feather="plus" class="mr-25"></i>
                                                        <span>Titik Koordinat Baru</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <datalist id="locs">
                                        @foreach($locs as $d)
                                            <option value="{{ $d->nama_tempat }}" data-lat="{{ $d->latitude }}" data-lng="{{ $d->longitude }}" />
                                        @endforeach
                                        </datalist>

                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>

    <script>
        feather.replace()

        // function initMap() {
        //     const uluru = { lat: -1.770340, lng: 118.409108 };  
        //     const map = new google.maps.Map(document.getElementById("map"), {
        //         zoom: 4,
        //         center: uluru,
        //     });  
        //     const marker = new google.maps.Marker({
        //         position: uluru,
        //         map: map
        //     });
        // }
        // window.initMap = initMap;
    </script>

    <script>
        let re_element;

        $(function(){
            $('#periode').val({{ $bake->periode??null }})

            @isset($lokasi_acara)
                fill_la_repeater({!! json_encode($lokasi_acara) !!})
            @endisset
        })

        let lokasi_acara_repeater = $('#lokasi_acara_repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        })

        function fill_la_repeater(lokasi_acara) {
            let lokasi_acara_data = [];

            lokasi_acara.forEach((element) => {
                lokasi_acara_data.push({
                    id_kerma: element.id_kerma,
                    nama_tempat: element.nama_tempat,
                    latitude: element.latitude,
                    longitude: element.longitude,
                })
            });
            lokasi_acara_repeater.setList(lokasi_acara_data)
        }

        function lihat_map(item) {
            let lat = $(item).closest('[data-repeater-item]').find('.latitude').val();
            let lng = $(item).closest('[data-repeater-item]').find('.longitude').val();

            initMap(new google.maps.LatLng(lat, lng));
            $('#map_modal').modal('show');
            re_element = item;
            
        }

        function initMap(myLoc) {
            var marker = new google.maps.Marker({
                position: myLoc
            });
            var opt = {
                center: myLoc,
                zoom: 5,
                // mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"), opt);
            marker.setMap(map);

            map.addListener('click', function(e) {
                marker.setMap(null);
                if (marker != null) marker.setMap(null);
                latClicked = parseFloat(e.latLng.lat());
                lngClicked = parseFloat(e.latLng.lng());
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latClicked, lngClicked),
                    map: map,
                });
                var latlng = {lat: latClicked, lng: lngClicked};
                $(re_element).closest('[data-repeater-item]').find('.latitude').val(latClicked);
                $(re_element).closest('[data-repeater-item]').find('.longitude').val(lngClicked);
                var geo = new google.maps.Geocoder;
                geo.geocode({'location': latlng}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        $(re_element).closest('[data-repeater-item]').find('.nama_tempat').val(results[0].formatted_address);
                    } else {
                        alert(status);
                    }
                });
            });
        };

        function update_loc(inp) {
            opt = $('#locs option[value="' + $(inp).val() + '"]');
            rep = $(inp).parent().parent().parent();
            rep.find('.latitude').val(opt.data('lat'));
            rep.find('.longitude').val(opt.data('lng'));
        }
    </script>
@endsection