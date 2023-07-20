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
                    <a href="/dobekkes/barang_keluar"><button type="button" class="btn btn-outline-primary">
                            <i data-feather="arrow-left"></i>
                            <span>Back</span>
                        </button></a>
                </div>
            </div>
            <div class="row pb-1">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Input Pengeluaran Barang</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">                                    
                                  <form method="post" enctype="multipart/form-data" action="{{ route('dobekkes.barang_keluar.input_keluar') }}" novalidate>
                                    <div class="row">
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label class="form-label" for="nomor">Kepada/Tujuan*</label>
                                            <input type="text" name="penerima" class="form-control" placeholder="Kepada/Tujuan" required />
                                            <div class="invalid-feedback">Penerima harus diisi</div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label class="form-label" for="nomor">Jenis Pengeluaran</label>
                                            <select name="jenis_pengeluaran" class="select2 form-control form-control-lg">
                                                <option disabled>Jenis Pengeluaran</option>
                                                <option>Pemakaian</option>
                                                <option>TKTM</option>
                                                <option>Hibah</option>
                                            </select>
                                            <div class="invalid-feedback">Jenis harus diisi</div>
                                        </div>
                                        <div class="form-group form-input col-12">
                                            <label class="form-label" for="cat">Catatan*</label>
                                            <textarea rows="3" name="catatan" class="form-control" placeholder="Catatan" required /></textarea>
                                            <div class="invalid-feedback">Catatan harus diisi</div>
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
                                            <input type="text" name="nodin" class="form-control" placeholder="Nota Dinas" />
                                            <div class="invalid-feedback">Nota Dinas harus diisi</div>
                                        </div>
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label for="customFile1">Upload Nota Dinas</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_nodin" class="custom-file-input" id="customFile1" />
                                                <label class="custom-file-label" for="customFile1">Upload Nota Dinas</label>
                                                <div class="invalid-feedback">File Nota Dinas harus ada</div>
                                            </div>
                                        </div>
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label class="form-label" for="nomor">No. SPB</label>
                                            <input type="text" name="spb" class="form-control" placeholder="No. SPB"/>
                                        </div>
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label for="customFile2">Upload File SPB</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_spb" class="custom-file-input" id="customFile2" />
                                                <label class="custom-file-label" for="customFile2">Upload File SPB</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label class="form-label" for="nomor">No. Sprindis</label>
                                            <input type="text" name="sprindis" class="form-control" placeholder="No. Sprindis"/>
                                        </div>
                                        <div class="form-group form-input col-md-6 col-12">
                                            <label for="customFile3">Upload File Sprindis</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_sprindis" class="custom-file-input" id="customFile3" />
                                                <label class="custom-file-label" for="customFile3">Upload File Sprindis</label>
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
                                                SKB </label>
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
                                        <div id="databrg"></div>
                                    </div>
                                    @csrf
                                    <section id="multilingual-datatable">
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="card border mb-1">
                                                    <div class="row pl-2 pr-2 pt-2">
                                                        <div class="col-6 my-auto">
                                                            <h5>Daftar Barang</h5>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kontrak">Tambah Barang</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-datatable">
                                                        <table class="daftar-barang-rencana table table-striped table-responsive-xl">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>No. Kontrak</th>
                                                                    <th>Nama Barang</th>
                                                                    <th>Satuan</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Ket</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
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

                                    <!-- Modal Kontrak-->
                                    <div class="modal fade text-left" id="kontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:90%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel18">Input Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <section id="multilingual-datatable">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="">No. Kontrak/BA</label>
                                                                <select class="select2 form-control form-control-lg no_">
                                                                    <option selected disabled>No. Kontrak/BA</option>
                                                                    @foreach($kontrak as $d)
                                                                    <option value="{{$d->id}}">{{$d->no}}</option>
                                                                    @endforeach
                                                                </select>  
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="text-right">
                                                                    <br />
                                                                    <button type="button" class="btn btn-primary" id="btn_inp" disabled>Tambah Barang Keluar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card border mt-2 mb-0"> 
                                                                    <table class="brg-kontrak table table-responsive-xl">
                                                                        <thead>
                                                                            <tr>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th>Nama Barang</th>
                                                                                <th>Satuan</th>
                                                                                <th>Stok Opname</th>
                                                                                <th>Jumlah yang Dikeluarkan</th>
                                                                                <th>Keterangan</th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- Edit -->
                                        <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width:30%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel18">Edit Barang Keluar</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                              <form>
                                                                <div class="form-group">
                                                                    <label for="">Jumlah</label>
                                                                    <input type="number" id="jml_edit" class="form-control" placeholder="Jumlah" min="1" />
                                                                    <div class="invalid-feedback">
                                                                        Jumlah harus diisi dan berjumlah 1-<span id="max_edit"></span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="id_edit" />
                                                              </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    var table_, table_2, data = [], cb = [];
    $( document ).ready(function() {
        table_ = $('.daftar-barang-rencana').DataTable({
            // scrollX: true,
            columns: [
              { data: 'no' },
              { data: 'no_' },
              { data: 'nama' },
              { data: 'sat' },
              { data: 'jml' },
              { data: 'ket' },
              { data: '' },
            ],
            columnDefs: [
              {
                targets: 0,
                className: 'width-100 text-center',
              },
              {
                targets: [3,4],
                className: 'text-center',
              },
              {
                targets: 6,
                className: 'text-center',
                render: function (data, type, full, meta) {
                  return ('<a class="item-edit" title="Edit" onclick="editData(\'' + full.id + '\')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>&nbsp;' + 
                    '<a class="item-delete" title="Hapus" onclick="hapusData($(this), \'' + full.id + '\')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>');
                }
              },
            ],
        });

        $(".no_").change(function () {
            table_reload();
        });

        $(".btn-save").click(function () {
            if ($('form[method=post]')[0].checkValidity() && data.length > 0) {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                for (i=0;i<data.length;i++) {
                    $('#databrg').append('<input type="hidden" name="id[' + i + ']" value="' + data[i].id + '" /><input type="hidden" name="jml[' + i + ']" value="' + data[i].jml + '" />');
                }
                $("form[method=post]").submit();
            } else $('form[method=post]').addClass('was-validated');
            if (data.length == 0) Swal.fire({
                title: 'Info',
                text: 'Barang keluar masih kosong',
            });
        });

        $("#btn_inp").click(function () {
            brg = [], valid = true;
            for (i=0;i<cb.length;i++) {
                if ($('#form'+cb[i])[0].checkValidity()) {
                    brg.push({
                        id: cb[i],
                        no_: $('.no_ option[value=' + $('.no_').val() + ']').text(),
                        nama: $('#nama'+cb[i]).html(),
                        sat: $('#sat'+cb[i]).html(),
                        jml: parseInt($('#jml'+cb[i]).val()),
                        ket: $('#ket'+cb[i]).html(),
                        stok: $('#stok'+cb[i]).html(),
                    });
                } else {
                    valid = false;
                    $('#form'+cb[i]).addClass('was-validated');
                }
            }
            if (valid) {
                $(this).prop('disabled', true);
                for (i=0;i<cb.length;i++) {
                    stokbaru = parseInt($('#stok'+cb[i]).text())-parseInt($('#jml'+cb[i]).val());
                    $('#stok'+cb[i]).html(stokbaru);
                    $('#max'+cb[i]).html(stokbaru);
                    $('#jml'+cb[i]).val('');
                    $('#jml'+cb[i]).attr('max', stokbaru);
                    if (stokbaru == 0) {
                        $('#form'+cb[i]).css('display', 'none');
                        $('#checkbox'+cb[i]).css('display', 'none');
                    }
                    $('#form'+cb[i]).removeClass('was-validated');
                    $('#checkbox'+cb[i]).prop('checked', false);
                }
                no = data.length;
                for (i=0;i<brg.length;i++) {
                    exist = false;
                    for (j=0;j<data.length;j++) {
                        if (brg[i].id == data[j].id) {
                            data[j].jml += parseInt(brg[i].jml);
                            exist = true;
                            break;
                        }
                    }
                    if (!exist) {
                        brg[i].no = ++no;
                        data.push(brg[i]);
                    }
                }
                table_.clear().rows.add(data).draw();
                cb = [];
                $('#kontrak').modal('hide');
            }
        });

        $('#edit button').click(function () {
            if ($('#edit form')[0].checkValidity()) {
                for (i=0;i<data.length;i++) {
                    if ($('#id_edit').val() == data[i].id) break;
                }
                data[i].jml = $('#jml_edit').val();
                stokbaru = parseInt($('#max_edit').text())-parseInt(data[i].jml);
                $('#stok'+data[i].id).html(stokbaru);
                $('#max'+data[i].id).html(stokbaru);
                $('#jml'+data[i].id).attr('max', stokbaru);
                if (stokbaru == 0) {
                    $('#form'+data[i].id).css('display', 'none');
                    $('#checkbox'+data[i].id).css('display', 'none');
                } else {
                    $('#form'+data[i].id).css('display', '');
                    $('#checkbox'+data[i].id).css('display', '');
                }
                table_.clear().rows.add(data).draw();
                $('#edit').modal('hide');
            } else $('#edit form').addClass('was-validated');
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
    function hapusData(e, id) {
        Swal.fire({
          title: 'Hapus barang?',
          icon: 'warning',
          showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                for (i=0;i<data.length;i++) {
                    if (id == data[i].id) break;
                }
                stokbaru = parseInt(data[i].stok);
                $('#stok'+data[i].id).html(stokbaru);
                $('#max'+data[i].id).html(stokbaru);
                $('#jml'+data[i].id).attr('max', stokbaru);
                $('#form'+data[i].id).css('display', '');
                $('#checkbox'+data[i].id).css('display', '');
                data.splice(i, 1);
                table_.row(e.parents('tr')).remove().draw();
            }
        });
    }
    function editData(id) {
        $("#edit form").removeClass('was-validated');
        for (i=0;i<data.length;i++) {
            if (id == data[i].id) break;
        }
        stokbaru = parseInt(data[i].stok);
        $('#id_edit').val(id);
        $('#jml_edit').val(data[i].jml);
        $('#jml_edit').attr('max', stokbaru);
        $('#max_edit').html(stokbaru);
        $('#edit').modal('show');
    }
    function cbChecked(e) {
        if ($(e).prop('checked')) cb.push($(e).attr('id').substr(8));
        else {
            for (i=0;i<cb.length;i++) {
                if ($(e).attr('id').substr(8) == cb[i]) {
                    $('#form'+cb[i]).removeClass('was-validated');
                    cb.splice(i, 1);
                    break;
                }
            }
        }
        $('#btn_inp').prop('disabled', !cb.length);
    }
    function table_reload() {
        table_2 = $('.brg-kontrak').DataTable({
            // scrollX: true,
            ajax: '{{ route("dobekkes.barang_keluar.list_barang") }}/' + $('.no_').val(),
            destroy: true,
            pageLength: 100,
            columns: [
              { data: 'responsive_id' },
              { data: 'id' },
              { data: 'id' }, // used for sorting so will hide this column
              { data: 'nama_matkes' },
              { data: 'satuan_brg' },
              { data: 'jumlah' },
              { data: '' },
              { data: 'keterangan' }
            ],
            columnDefs: [
              {
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                visible: false,
                targets: 0
              },
              {
                targets: 1,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                  return (
                    '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                    data +
                    '" onchange="cbChecked(this)" /><label class="custom-control-label" for="checkbox' +
                    data +
                    '"></label></div>'
                  );
                },
                checkboxes: {
                  selectAllRender:
                    '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
              },
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                render: function (data, type, full, meta) {
                  return (
                    '<span id="nama' + full.id + '">' + data + '</span>'
                  );
                },
              },
              {
                className: 'text-center',
                targets: 4,
                render: function (data, type, full, meta) {
                  return (
                    '<span id="sat' + full.id + '">' + data + '</span>'
                  );
                },
              },
              {
                className: 'text-center',
                targets: 5,
                render: function (d, type, full, meta) {
                  for (i=0;i<data.length;i++) {
                    if (data[i].id == full.id) d -= data[i].jml;
                  }
                  return (
                    '<span id="stok' + full.id + '">' + d + '</span>'
                  );
                },
              },
              {
                targets: -2,
                className: 'width-100',
                orderable: false,
                render: function (d, type, full, meta) {
                  for (i=0;i<data.length;i++) {
                    if (data[i].id == full.id) full.jumlah -= data[i].jml;
                  }
                  return (
                    '<form id="form' + full.id + '">' +
                    '<div class="form-group">' +
                    '<input type="number" class="form-control"' +
                    ' id="jml' + full.id + '" min="1" max="' +
                    full.jumlah + '" required />' +
                    '<div class="invalid-feedback">' +
                    'Jumlah harus diisi dan berjumlah 1-<span id="max' + full.id + '">'  + full.jumlah + '</span>' +
                    '</div></div>' +
                    '</form>'
                  );
                },
              },
              {
                targets: -1,
                orderable: false,
                render: function (data, type, full, meta) {
                  return (
                    'Ket: <span id="ket' + full.id + '">' + (data ?? '-') + '</span><br>Exp. Date: ' + (full.exp_date =='0000-00-00' ? '-' : new Date(full.exp_date).toLocaleString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })) + '<br>Tgl masuk gudang: ' + new Date(full.created_at).toLocaleString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })
                  );
                },
              },
            ],
            order: [[3, 'asc']],
            lengthMenu: [100],
        });
    }

    function radioCheck() {
        if (document.getElementById('ya').checked) {
            document.getElementById('show').style.display = 'block';
        } else document.getElementById('show').style.display = 'none';
    }
</script>
@endsection
