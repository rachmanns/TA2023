@extends('partials.template')

@section('page_style')
    <style>
        .select {
            display: none;
        }

        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_length label {
            margin-left: 1.5rem;
            margin-right: 1.5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin-right: 1.5rem;
        }

        div.dataTables_wrapper .dataTables_info {
            margin-left: 1.5rem;
        }

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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row pb-1">
                <div class="col-6">
                    <a href="/dobekkes/data_rp"><button type="button" class="btn btn-outline-primary">
                            <i data-feather="arrow-left"></i>
                            <span>Back</span>
                        </button></a>
                </div>
            </div>
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Rencana Pengeluaran Barang</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data"
                                        action="{{ route('dobekkes.barang_keluar.input_keluar', request()->segment(3)) }}"
                                        novalidate>
                                        <div class="row">
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="nomor">Kepada/Tujuan</label>
                                                <input type="text" class="form-control" value="{{ $rp['penerima'] }}"
                                                    readonly />
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label class="form-label" for="nomor">Jenis Pengeluaran</label>
                                                <select name="jenis_pengeluaran" class="select2 form-control form-control-lg"
                                                    required>
                                                    <option disabled>Jenis Pengeluaran</option>
                                                    <option>Pemakaian</option>
                                                    <option>TKTM</option>
                                                    <option>Hibah</option>
                                                </select>
                                                <div class="invalid-feedback">Jenis harus diisi</div>
                                            </div>
                                            <div class="form-group form-input col-12">
                                                <label class="form-label" for="cat">Catatan</label>
                                                <textarea rows="3" class="form-control" readonly />{{ $rp['tujuan_penggunaan'] }}</textarea>
                                            </div>                                            
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="ppm">No. PPM*</label>
                                                <input type="text" name="ppm" class="form-control" placeholder="No. PPM" required />
                                                <div class="invalid-feedback">No. PPM harus diisi</div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label for="customFile5">Upload File PPM*</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_ppm" class="custom-file-input"
                                                        id="customFile5" required />
                                                    <label class="custom-file-label" for="customFile5">Upload File PPM</label>
                                                    <div class="invalid-feedback">File PPM harus ada</div>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="nota">Nota Dinas</label>
                                                <input type="text" name="nodin" class="form-control" placeholder="Nota Dinas"
                                                />
                                                <div class="invalid-feedback">Nota Dinas harus diisi</div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label for="customFile1">Upload Nota Dinas</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_nodin" class="custom-file-input"
                                                        id="customFile1" />
                                                    <label class="custom-file-label" for="customFile1">Upload Nota Dinas</label>
                                                    <div class="invalid-feedback">File Nota Dinas harus ada</div>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="nomor">No. SPB</label>
                                                <input type="text" name="spb" class="form-control" placeholder="No. SPB" />
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label for="customFile2">Upload File SPB</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_spb" class="custom-file-input"
                                                        id="customFile2" />
                                                    <label class="custom-file-label" for="customFile2">Upload File SPB</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="nomor">No. Sprindis</label>
                                                <input type="text" name="sprindis" class="form-control"
                                                    placeholder="No. Sprindis" />
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label for="customFile3">Upload File Sprindis</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_sprindis" class="custom-file-input"
                                                        id="customFile3" />
                                                    <label class="custom-file-label" for="customFile3">Upload File
                                                        Sprindis</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label class="form-label" for="nomor">No. SKB</label>
                                                <input type="text" name="pak" class="form-control"
                                                    placeholder="No. SKB" />
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label for="customFile4">Upload File SKB</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_pak" class="custom-file-input"
                                                        id="customFile4" />
                                                    <label class="custom-file-label" for="customFile4">Upload File
                                                        SKB</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <label>Bekkes untuk Batalyon</label>
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-radio mt-0">
                                                        <input type="radio" onclick="javascript:radioCheck();" id="ya" name="customRadio" class="custom-control-input" />
                                                        <label class="custom-control-label" for="ya">Ya</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mt-0">
                                                        <input type="radio" onclick="javascript:radioCheck();" id="tidak" name="customRadio" class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="tidak">Tidak</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-input col-md-6 col-12">
                                                <div id="show" style="display:none">
                                                    <label class="form-label">Batalyon Tujuan</label>
                                                    <select class="form-control select2 batalyon" name="batalyon" multiple>
                                                    @foreach($bats as $b)
                                                        <option>{{ $b }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @csrf
                                    <section id="multilingual-datatable">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card border mb-2 mt-1">
                                                    <div class="card-header pb-0">
                                                        <h5>Daftar Barang</h5>
                                                    </div>
                                                    <div class="card-datatable">
                                                        <table
                                                            class="daftar-barang-rencana table table-striped table-responsive-xl">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">No.</th>
                                                                    <th class="text-center">No. Kontrak</th>
                                                                    <th class="text-center">Nama Barang</th>
                                                                    <th class="text-center">Satuan</th>
                                                                    <th class="text-center">Jumlah</th>
                                                                    <th class="text-center">Ket</th>
                                                                </tr>
                                                            </thead>
                                                            <!--
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="6" class="bg-light" height="25">Obat Analgetik/Antipiretik</th>
                                                                    </tr>
                                                                </thead>
                                                                -->
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <div class="d-flex justify-content-between">
                                                <h5>Titik Koordinat</h5>
                                                <button type="button" class="btn btn-outline-primary round" data-toggle="modal" data-target="#map_modal"><i data-feather="map" class="mr-75"></i>Cari Lokasi dengan Map</button>

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
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <select class="form-control" id="tempat" name="tempat">
                                                    <option selected disabled>Pilih Lokasi</option>
                                                    @foreach($locs as $d)
                                                    <option data-lat="{{ $d->latitude }}" data-lng="{{ $d->longitude }}">{{ $d->tempat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Garis Lintang</label>
                                                <input type="text" class="form-control" placeholder="Garis Lintang" id="lat" name="lat" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Garis Bujur</label>
                                                <input type="text" class="form-control" placeholder="Garis Bujur" id="lng" name="lng" />
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-primary btn-save">Keluarkan Barang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script src="{{ url('assets/js/bootstrap-tagsinput.js') }}"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>

    <script>
        var clickmarker, latClicked, lngClicked, tempat, map;

        function initMap() {
            const uluru = { lat: -1.770340, lng: 118.409108 };  
            map = new google.maps.Map(document.getElementById("map"), {
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
        window.initMap = initMap;
    </script>

    <script>
        $(document).ready(function() {
            var table_ = $('.daftar-barang-rencana').DataTable({
                // scrollX: true,
                ajax: '{{ route('dobekkes.barang_keluar.list_barang_rencana', request()->segment(3)) }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'no'
                    },
                    {
                        data: 'nama_matkes'
                    },
                    {
                        data: 'satuan_brg'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'keterangan'
                    }
                ],
                columnDefs: [{
                    targets: [0, 3, 4],
                    className: 'text-center',
                }, ],
            });

            $(".btn-save").click(function() {
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $("form").submit();
                } else $('form').addClass('was-validated');
            });

            $('#map_modal button').click(function () {
                var newOption = new Option(tempat, tempat, true, true);
                $('#tempat').append(newOption).trigger('change');
                $('#lat').val(latClicked);
                $('#lng').val(lngClicked);
                $('#map_modal').modal('hide');
            });

            $('.batalyon').select2({
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;
                    return {
                        id: term.toUpperCase(),
                        text: 'Input Batalyon baru: ' + term.toUpperCase(),
                        newTag: true
                    }
                },
                templateSelection: function (data) {
                    return data.text.indexOf('Input Batalyon baru:') == -1 ? data.text.toUpperCase() : data.text.substr(21).toUpperCase();
                },
            });

            $('#tempat').select2({
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;
                    return {
                        id: term.toUpperCase(),
                        text: 'Input Lokasi baru: ' + term.toUpperCase(),
                        newTag: true
                    }
                },
                templateSelection: function (data) {
                    return data.text.indexOf('Input Lokasi baru:') == -1 ? data.text.toUpperCase() : data.text.substr(19).toUpperCase();
                },
            });

            $('#tempat').change(function() {
                opt = $(this).children('option:selected');
                $('#lat').val(opt.data('lat'));
                $('#lng').val(opt.data('lng'));
                if (opt.data('lat') != '' && opt.data('lng') != '') {
                    if (clickmarker != null) clickmarker.setMap(null);
                    clickmarker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(opt.data('lat')), parseFloat(opt.data('lng'))),
                        map: map,
                    });
                }
            });
        });

        function radioCheck() {
            if (document.getElementById('ya').checked) {
                document.getElementById('show').style.display = 'block';
            }
            else document.getElementById('show').style.display = 'none';
        }
    </script>
@endsection
