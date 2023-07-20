@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
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
                            <h2 class="content-header-title float-left mb-0">Data Barang Keluar - <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun_anggaran" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <div class='btn-group'><button class='btn btn-primary dropdown-toggle' type='button'
                            id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Input
                            Barang Keluar </button>
                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuButton'> <a
                                class='dropdown-item' href='/dobekkes/data_rp'>Dari Rencana</a> <a class='dropdown-item'
                                href='/dobekkes/tdk_ada_rp'>Spontan</a></div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="daftar-keluar table table-striped table-responsive-xl">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="min-width:150px;">Tanggal Keluar</th>
                                                <th style="min-width:200px;">Tujuan Dalam Rangka</th>
                                                <th class="text-center" style="min-width:200px;">Total Barang</th>
                                                <!-- <th class="width-150 text-center">Nota Dinas</th> -->
                                                <th class="text-center" style="min-width:200px;">SPB</th>
                                                <!-- <th class="text-center">SPRINDIS</th> -->
                                                <!-- <th class="text-center">SKB</th> -->
                                                <th class="text-center" style="min-width:200px;">PPM</th>
                                                <th style="min-width:300px;">Tempat</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Modal Kontrak-->
                <div class="modal fade text-left" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Upload Kelengkapan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="form-group form-input">
                                    <label class="form-label" for="nota">Nota Dinas</label>
                                    <input type="text" name="nodin" class="form-control" placeholder="Nota Dinas" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile0">Upload Nota Dinas</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_nodin" class="custom-file-input" id="customFile0" />
                                        <label class="custom-file-label" for="customFile0">Upload Nota Dinas</label>
                                    </div>
                                    <div id="ket-nodin">File sebelumnya: <a target="_blank" class="link-primary" id="url-nodin">Lihat Dokumen</a></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="nomor">No. SPB</label>
                                    <input type="text" name="spb" class="form-control" placeholder="No. SPB" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile1">Upload File SPB</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_spb" class="custom-file-input" id="customFile1" />
                                        <label class="custom-file-label" for="customFile1">Upload File SPB</label>
                                    </div>
                                    <div id="ket-spb">File sebelumnya: <a target="_blank" class="link-primary" id="url-spb">Lihat Dokumen</a></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input mt-1">
                                    <label class="form-label" for="nomor">No. Sprindis</label>
                                    <input type="text" name="sprindis" class="form-control" placeholder="No. Sprindis" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile2">Upload File Sprindis</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_sprindis" class="custom-file-input" id="customFile2" />
                                        <label class="custom-file-label" for="customFile2">Upload File Sprindis</label>
                                    </div>
                                    <div id="ket-spr">File sebelumnya: <a target="_blank" class="link-primary" id="url-spr">Lihat Dokumen</a></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input mt-1">
                                    <label class="form-label" for="nomor">No. SKB</label>
                                    <input type="text" name="pak" class="form-control" placeholder="No. SKB" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile4">Upload File SKB</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_pak" class="custom-file-input" id="customFile4" />
                                        <label class="custom-file-label" for="customFile4">Upload File SKB</label>
                                    </div>
                                    <div id="ket-skb">File sebelumnya: <a target="_blank" class="link-primary" id="url-skb">Lihat Dokumen</a></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group form-input mt-1">
                                    <label class="form-label" for="nomor">No. PPM*</label>
                                    <input type="text" name="ppm" class="form-control" placeholder="No. PPM" required />
                                    <div class="invalid-feedback">No. PPM harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="customFile3">Upload File PPM</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_ppm" class="custom-file-input" id="customFile3" />
                                        <label class="custom-file-label" for="customFile3">Upload File PPM</label>
                                    </div>
                                    <div id="ket-ppm">File sebelumnya: <a target="_blank" class="link-primary" id="url-ppm">Lihat Dokumen</a></div>
                                    <div class="invalid-feedback">File PPM harus ada</div>
                                </div>
                                <div class="form-group">
                                    <label>Tempat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tempat" id="tempat" name="tempat" />
                                        <button type="button" class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#map_modal"><i data-feather="map" class="mr-75"></i>Cari Lokasi dengan Map</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Garis Lintang</label>
                                    <input type="text" class="form-control" placeholder="Garis Lintang" id="lat" name="lat" />
                                </div>
                                <div class="form-group">
                                    <label>Garis Bujur</label>
                                    <input type="text" class="form-control" placeholder="Garis Bujur" id="lng" name="lng" />
                                </div>
                                @csrf
                              </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Simpan Data</button>
                            </div>
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
    <!-- END: Content-->
@endsection
@section('page_script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&libraries=&callback=initMap"></script>
    <script>
        var id, table_, param = '';

        $(document).ready(function() {
            $('#tahun_anggaran').val(<?php echo date('Y'); ?>);
            table_reload();
            $('#tahun_anggaran').change(function() {
                table_reload();
            });
        });

        function table_reload() {
            $('.tahun').text($('#tahun_anggaran').val());
            param = 'tahun=' + $('#tahun_anggaran').val();
            table_ = $('.daftar-keluar').DataTable({
                ajax: '{{ route("dobekkes.barang_keluar.list_keluar") }}?' + param,
                destroy: true,
                scrollX: true,
                columns: [{
                        data: ''
                    },
                    {
                        data: 'penerima'
                    },
                    {
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return formatRupiah(datas);
                        },
                        data: 'brg_out_sum_jml_keluar'
                    },
                    // {
                    //     data: ''
                    // },
                    {
                        data: ''
                    },
                    // {
                    //     data: ''
                    // },
                    // {
                    //     data: ''
                    // },
                    {
                        data: ''
                    },
                    {
                        data: 'tempat'
                    },
                    {
                        data: ''
                    }
                ],
                columnDefs: [
                    // {
                    //     targets: 3,
                    //     className: 'text-center',
                    //     render: function(datas, type, data, meta) {
                    //         return (
                    //             '<span id="nodin' + data.id_rencana + '">' + (data.no_nota_dinas ?? '') + '</span><br>' + (data.file_nota_dinas ?
                    //                 '<div class="mt-50"><a href="' + data.file_nota_dinas +
                    //                 '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>' :
                    //                 '<div class="badge badge-light-danger font-small-3 mt-50">Belum Upload <br> Dokumen</div>')
                    //         );
                    //     }
                    // },
                    {
                        targets: 3,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                '<span id="spb' + data.id_rencana + '">' + (data.no_spb ?? '') + '</span><br>' + (data.file_spb ?
                                    '<div class="mt-50"><a href="' + data.file_spb +
                                    '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>' :
                                    '<div class="badge badge-light-danger font-small-3 mt-50">Belum Upload <br> Dokumen</div>'
                                    )
                            );
                        }
                    },
                    // {
                    //     targets: 5,
                    //     className: 'text-center',
                    //     render: function(datas, type, data, meta) {
                    //         return (
                    //             '<span id="spr' + data.id_rencana + '">' + (data.no_sprindis ?? '') + '</span><br>' + (data.file_sprindis ?
                    //                 '<div class="mt-50"><a href="' + data.file_sprindis +
                    //                 '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>' :
                    //                 '<div class="badge badge-light-danger font-small-3 mt-50">Belum Upload <br> Dokumen</div>'
                    //                 )
                    //         );
                    //     }
                    // },
                    // {
                    //     targets: 6,
                    //     className: 'text-center',
                    //     render: function(datas, type, data, meta) {
                    //         return (
                    //             '<span id="pak' + data.id_rencana + '">' + (data.no_pak ?? '') + '</span><br>' + (data.file_pak ?
                    //                 '<div class="mt-50"><a href="' + data.file_pak +
                    //                 '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>' :
                    //                 '<div class="badge badge-light-danger font-small-3 mt-50">Belum Upload <br> Dokumen</div>'
                    //                 )
                    //         );
                    //     }
                    // },
                    {
                        targets: 4,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                '<span id="ppm' + data.id_rencana + '">' + (data.no_ppm ?? '') + '</span><br>' + (data.jenis_pengeluaran ==
                                    'hibah' ? '' : data.file_ppm ?
                                    '<div class="mt-50"><a href="' + data.file_ppm +
                                    '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>' :
                                    '<div class="badge badge-light-danger font-small-3 mt-50">Belum Upload <br> Dokumen</div>'
                                    )
                            );
                        }
                    },
                    {
                        targets: 0,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                new Date(data.tgl_keluar).toLocaleString('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                })
                            );
                        }
                    },
                    {
                        targets: -3,
                        className: 'text-center',
                    },
                    {
                        targets: -1,
                        orderable: false,
                        render: function(datas, type, data, meta) {
                            return (
                                "<div class='text-center'><div class='btn-group'><button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Aksi </button> <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuButton'> <a class='dropdown-item' href='/dobekkes/lihat_barang/" +
                                data.id_rencana +
                                "'>Lihat Barang</a> <button class='dropdown-item' onclick='edit_out($(this))' data-id='" +
                                data.id_rencana + "' data-tempat='" + (data.tempat ?? '') +
                                "' data-lat='" + (data.latitude ?? '') + "' data-lng='" + (data
                                    .longitude ?? '') + "' data-nodin='" + (data.file_nota_dinas ??
                                    '') + "' data-spb='" + (data.file_spb ?? '') +
                                "' data-nodinform='" + (
                                    data.no_nota_dinas ?? '') + "' data-sprindisform='" + (
                                    data.no_sprindis ?? '') + "' data-pakform='" + (
                                    data.no_pak ?? '') + "' data-spr='" + (
                                    data
                                    .file_sprindis ?? '') + "' data-skb='" + (data.file_pak ?? '') +
                                "' data-ppm='" + (data.file_ppm ?? '') +
                                "'>Upload Kelengkapan</button></div></div></div>"
                            );
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
            $('.modal-footer button').click(function() {
                $('form').removeClass('was-validated');
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    form_data = new FormData($('form')[0]);
                    $.ajax({
                        url: '{{ url("dobekkes/barang-keluar/update-keluar") }}/' + id,
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: form_data,
                        success: function(res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                            });
                            table_.ajax.reload();
                        }
                    }).always(function() {
                        $(".modal-footer button").prop('disabled', false);
                        $(".modal-footer button").text('Simpan Data');
                        $('#upload').modal('hide');
                    });
                } else $('form').addClass('was-validated');
            });
            $('#map_modal button').click(function () {
                $('#lat').val(latClicked);
                $('#lng').val(lngClicked);
                $('#tempat').val(tempat);
                $('#map_modal').modal('hide');
            });
        }

        function edit_out(e) {
            $('[type=file]').val('');
            id = e.attr('data-id');
            $('[name=nodin]').val(e.attr('data-nodinform'));
            $('[name=spb]').val($('#spb' + id).html());
            $('[name=sprindis]').val(e.attr('data-sprindisform'));
            $('[name=ppm]').val($('#ppm' + id).html());
            $('[name=pak]').val(e.attr('data-pakform'));
            $('[name=tempat]').val(e.attr('data-tempat'));
            $('[name=lat]').val(e.attr('data-lat'));
            $('[name=lng]').val(e.attr('data-lng'));
            $('#url-nodin').attr('href', e.attr('data-nodin'));
            $('#url-spb').attr('href', e.attr('data-spb'));
            $('#url-spr').attr('href', e.attr('data-spr'));
            $('#url-skb').attr('href', e.attr('data-skb'));
            $('#url-ppm').attr('href', e.attr('data-ppm'));
            $('#ket-nodin').css('display', e.attr('data-nodin') ? '' : 'none');
            $('#ket-spb').css('display', e.attr('data-spb') ? '' : 'none');
            $('#ket-spr').css('display', e.attr('data-spr') ? '' : 'none');
            $('#ket-skb').css('display', e.attr('data-skb') ? '' : 'none');
            $('#ket-ppm').css('display', e.attr('data-ppm') ? '' : 'none');
            $('#upload').modal('show');
        }

        var clickmarker, latClicked, lngClicked, tempat;

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
        window.initMap = initMap;
    </script>
@endsection
