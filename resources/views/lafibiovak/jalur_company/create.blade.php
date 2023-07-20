@extends('partials.template')

@section('page_style')
<style>
    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 8px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 22px;
        cursor: text;
    }

    .bootstrap-tagsinput input {
        border: none;
        box-shadow: none;
        outline: none;
        background-color: transparent;
        padding: 0 6px;
        margin: 0;
        width: auto;
        max-width: inherit;
    }

    .bootstrap-tagsinput.form-control input::-moz-placeholder {
        color: #777;
        opacity: 1;
    }

    .bootstrap-tagsinput.form-control input:-ms-input-placeholder {
        color: #777;
    }

    .bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
        color: #777;
    }

    .bootstrap-tagsinput input:focus {
        border: none;
        box-shadow: none;
    }

    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
        background-color: #7367F0;
        padding: 3px;
        border-radius: 4px;
    }

    .bootstrap-tagsinput .tag [data-role="remove"] {
        margin-left: 8px;
        cursor: pointer;
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:after {
        content: "x";
        padding: 0px 2px;
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:hover {
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    }

</style>
@endsection
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="row breadcrumbs-top">
            <div class="col-12 mb-1">
                <a href="/lafibiovak/jalur-company"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
            </div>
            <div class="col-12">
                <h2 class="content-header-title float-left">{{ request()->segment(3)=='create'?'Tambah':'Edit' }} Jalur Company</h2>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <form>
                            <div class="form-group form-input">
                                <label class="form-label" for="tujuan">Nama Company*</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Company" value="{{$data->nama_jalur ?? ''}}" required />
                                <div class="invalid-feedback">Nama harus diisi</div>
                            </div>
                            <div class="form-group form-input">
                                <label for="alamat">Alamat Lengkap</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat Lengkap">{{$data->alamat ?? ''}}</textarea>
                                    <button type="button" class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#map_modal"><i data-feather="map" class="mr-75"></i>Cari Lokasi dengan Map</button>
                                </div>
                                <input type="hidden" name="lat" id="lat" value="{{$data->latitude ?? ''}}" />
                                <input type="hidden" name="lng" id="lng" value="{{$data->longitude ?? ''}}" />
                            </div>
                            <div class="row">
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Kemampuan Personil</label>
                                    <input type="number" class="form-control" name="jmlp" placeholder="Kemampuan Personil" value="{{$data->jml_personil ?? ''}}" />
                                </div>
                                <div class="form-group form-input col-md-6 col-12">
                                    <label class="form-label">Jumlah Mesin</label>
                                    <input type="number" class="form-control" name="jmlm" placeholder="Jumlah Mesin" value="{{$data->jml_mesin ?? ''}}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="form-label">Apakah ada izin Operasional?</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio1" name="izin" class="custom-control-input" value="1" @if(isset($data) && $data->izin_opr) checked="true" @endif />
                                            <label class="custom-control-label" for="customRadio1">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio2" name="izin" class="custom-control-input" value="0" @if(isset($data) && !$data->izin_opr) checked="true" @endif />
                                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label">Apakah ada Sertifikat CPOB?</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio3" name="cpob" class="custom-control-input" value="1" @if(isset($data) && $data->cpob) checked="true" @endif />
                                            <label class="custom-control-label" for="customRadio3">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-0">
                                            <input type="radio" id="customRadio4" name="cpob" class="custom-control-input" value="0" @if(isset($data) && !$data->cpob) checked="true" @endif />
                                            <label class="custom-control-label" for="customRadio4">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="font-weight-bolder mt-1">Detail Obat</h5>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label class="form-label">Sumber Dana Puskes</label>
                                        <input class="form-control" type="text" data-role="tagsinput" name="sumberp" value="{{$data->sumber_puskes ?? ''}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group form-input">
                                        <label class="form-label">Sumber Dana Angkatan</label>
                                        <input class="form-control" type="text" data-role="tagsinput" name="sumbera" value="{{$data->sumber_angkatan ?? ''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label for="customFile1">Upload File Foto @if(request()->segment(3)=='create')*@endif</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="foto" @if(request()->segment(3)=='create') required @endif />
                                        <label class="custom-file-label" for="customFile1">Upload File Foto</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="customFile2">Link Video</label>
                                    <input type="url" class="form-control" name="video" value="{{$data->video ?? ''}}" />
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <button type="button" class="btn btn-primary btn-save">Simpan Data</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Maps -->
                <div class="modal fade text-left" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:87%">
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
                            <div class="text-center">
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                            <br />
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
    <script src="{{ url('assets/js/bootstrap-tagsinput.js') }}"></script>
    <script>
        var clickmarker, latClicked, lngClicked, tempat;
        var id = "{{ request()->segment(3)=='create'?'':request()->segment(3) }}";
        $(function(){
            $(".btn-save").click(function() {
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('lafibiovak/jalur-company') }}/" + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: new FormData($('form')[0]),
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                            }).then(function() {
                                if (!res.error) location.href = '/lafibiovak/jalur-company';
                            });
                        }
                    }).always(function() {
                        $(".btn-save").prop('disabled', false);
                        $(".btn-save").text('Simpan Data');
                    });
                } else {
                    $('form').addClass('was-validated');
                }
            });
            $('#map_modal button').click(function () {
                $('#lat').val(latClicked);
                $('#lng').val(lngClicked);
                $('#alamat').val(tempat);
                $('#map_modal').modal('hide');
            });
        });
        function initMap() {
            const uluru = { lat: -1.770340, lng: 118.409108 };  
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: uluru,
            });
            map.addListener('click', function(e) {
                if (clickmarker != null) clickmarker.setMap(null);
                latClicked = parseFloat(e.latLng.lat());
                lngClicked = parseFloat(e.latLng.lng());
                clickmarker = new google.maps.Marker({
                    position: new google.maps.LatLng(latClicked, lngClicked),
                    map: map,
                });
                var latlng = {lat: latClicked, lng: lngClicked};
                var geo = new google.maps.Geocoder;
                geo.geocode({'location': latlng}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        tempat = results[0].formatted_address;
                    } else {
                        alert(status);
                    }
                });
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&callback=initMap"></script>
@endsection