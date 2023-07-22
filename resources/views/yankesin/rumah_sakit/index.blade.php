@extends('partials.template')

@section('page_style')
    <style>
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
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <h2 class="content-header-title float-left mb-0">Daftar Faskes TNI</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="filter_m">
                        <option value="*">Semua Matra</option>
                        @foreach ($matra as $item)
                        <option value="{{$item->kode_matra}}">{{(($item->kode_matra != 'MABES')?'TNI':''). " ".$item->kode_matra }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="parent_kotama">
                        <option selected disabled>Filter Kotama</option>
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="filter_t">
                        <option value="*">Semua Tipe</option>
                        <option value="FKTP">FKTP</option>
                        <option value="FKTL">FKTL</option>
                    </select>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-outline-primary mr-75 lbl-covid-report" data-toggle="modal"
                        data-target="#aktivasi"><span>{{ $covid_report ? 'Dea' : 'A' }}</span>ktivasi Covid Report</button>
                    <a data-toggle="modal" data-target="#rumah_sakit_modal"><button type="button"
                            class="btn btn-primary">Tambah Faskes</button></a>
                    @include('yankesin.rumah_sakit.form')
                </div>

                {{-- Modal Aktivasi --}}
                <div class="modal fade text-left" id="aktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title lbl-covid-report" id="myModalLabel18">
                                    <span>{{ $covid_report ? 'Dea' : 'A' }}</span>ktivasi Covid Report</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Mengaktifkan mode ini, membuat rumah sakit dapat mengisi data report dan mengalokasikan
                                tempat tidur untuk covid.
                            </div>
                            <div class="row p-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-danger">Batalkan</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button id="toggleCovid" type="button"
                                        class="btn btn-primary"><span>{{ $covid_report ? 'Non-' : '' }}</span>Aktifkan
                                        Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-9 text-right">
                    <button class="btn btn-outline-danger mr-75" data-toggle="modal" data-target="#deaktivasi">Deaktivasi Covid Report</button>
                    <a data-toggle="modal" data-target="#rumah_sakit_modal"><button type="button" class="btn btn-primary">Tambah Faskes</button></a>
                </div> --}}

                {{-- Modal Deaktivasi --}}
                {{-- <div class="modal fade text-left" id="aktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Deaktivasi Covid Report</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Mengaktifkan mode ini, membuat rumah sakit dapat mengisi data report dan mengalokasikan tempat tidur untuk covid.
                            </div>
                            <div class="row p-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-danger">Batalkan</button>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#"><button type="submit" class="btn btn-danger">Deaktivasi Sekarang</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <!-- Code Changes: Remove unused deep elements -->
                                <table class="table table-striped" id="table-rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th class="text-center">Aksi</th>
                                            <th style="min-width: 200px;">Nama Faskes</th>
                                            <th>Matra</th>
                                            <th>Kotama</th>
                                            <th>Satker/Subsatker</th>
                                            <th>Tipe Faskes</th>
                                            <th style="min-width: 200px;">Alamat</th>
                                            <th>Nomor Izin Operasional</th>
                                        </tr>
                                    </thead>
                                </table>
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
    <script>
        var table;

        function reload_table() {
            var params = '';
            if ($('#filter_m').val() != '*') params += '&matra=' + $('#filter_m').val();
            if ($('#parent_kotama').val() != null && $('#parent_kotama').val() != '') params += '&kotama=' + $('#parent_kotama').val();
            if ($('#filter_t').val() != '*') params += '&tipe=' + $('#filter_t').val();
            table = $('#table-rs').DataTable({
                destroy: true,
                processing: true,
                ajax: "{{ url('yankesin/rumah-sakit/list') }}?" + params,
                // Code Changes: Add scrollX to assign true
                scrollX: true,
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },{
                        data: 'nama_rs',
                        name: 'nama_rs'
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'kotama',
                    },
                    {
                        data: 'satker',
                    },
                    {
                        data: 'jenis_rs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return data == null ? '-' : (data.substr(0, 4) + (data.indexOf('RSS') == -1 ? '' : '-Ops'));
                        }
                    },
                    {
                        data: 'alamat',
                    },
                    {
                        data: 'no_ijin_opr',
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        $(document).ready(function() {
            reload_table();
            $("#parent_subsatker").prop("disabled", true);
            $("#parent_sub_komando").prop("disabled", true);
            $("#parent_komando").prop("disabled", true);
            $("#parent_kota_kab").prop("disabled", true);

            select_daerah()

            $("input[name='kode_matra']").change(function() {

                $('#parent_komando').empty().trigger("change");

                select_ajax("komando", "komando", "Kotama", $(this).val())

                $("#parent_komando").prop("disabled", false);
                $("#parent_sub_komando").prop("disabled", true);
                $("#parent_sub_komando").val("");
                $("#parent_sub_komando").trigger("change");
                $('#parent_sub_komando').empty().trigger("change");
                $("#parent_subsatker").prop("disabled", true);
                $("#parent_subsatker").val("");
                $("#parent_subsatker").trigger("change");
                $('#parent_subsatker').empty().trigger("change");
            });


            $('#parent_komando').on('select2:select', function(e) {
                var data = e.params.data;
                $("#id_angkatan").val(data.id);
                if (data.count) {

                    $("#parent_sub_komando").val("");
                    $("#parent_sub_komando").trigger("change");
                    $('#parent_sub_komando').empty().trigger("change");

                    select_ajax("subkomando", "sub_komando", "Satker", data.id)

                    $("#parent_sub_komando").prop("disabled", false);

                } else {
                    $("#parent_sub_komando").prop("disabled", true);
                    $("#parent_sub_komando").val("");
                    $("#parent_sub_komando").trigger("change");
                    $('#parent_sub_komando').empty().trigger("change");

                }
                $("#parent_subsatker").prop("disabled", true);
                $("#parent_subsatker").val("");
                $("#parent_subsatker").trigger("change");
                $('#parent_subsatker').empty().trigger("change");
            });

            $('#parent_sub_komando').on('select2:select', function(e) {
                var data = e.params.data;
                $("#id_angkatan").val(data.id);
                if (data.count) {

                    $("#parent_subsatker").val("");
                    $("#parent_subsatker").trigger("change");
                    $('#parent_subsatker').empty().trigger("change");

                    select_ajax("subkomando", "subsatker", "Sub Satker", data.id)

                    $("#parent_subsatker").prop("disabled", false);

                } else {
                    $("#parent_subsatker").prop("disabled", true);
                    $("#parent_subsatker").val("");
                    $("#parent_subsatker").trigger("change");
                    $('#parent_subsatker').empty().trigger("change");

                }

            });

            $('#parent_subsatker').on('select2:select', function(e) {
                var data = e.params.data;
                $("#id_angkatan").val(data.id);

            });

            $('#filter_m').on('select2:select', function(e) {
                select_ajax("komando", "kotama", "Kotama", $(this).val());
                $("#parent_kotama").prop("disabled", false);
                reload_table();
            });

            $('#parent_kotama').on('select2:select', function(e) {
                reload_table();
            });

            $('#filter_t').on('select2:select', function(e) {
                reload_table();
            });

            $('#parent_kotama').on('select2:clear', function(e) {
                reload_table();
            });

            $('#parent_sub_komando').on('select2:clear', function(e) {
                $("#id_angkatan").val($('#parent_komando').val());
            });

            $('#parent_subsatker').on('select2:clear', function(e) {
                $("#id_angkatan").val($('#parent_sub_komando').val());
            });

            $('#parent_provinsi').on('select2:select', function(e) {
                var data = e.params.data;
                $("#parent_kota_kab").prop("disabled", false);
                select_daerah("kota-kab", "kota_kab", "Kota/Kabupaten", data.id)
            });

            $("#toggleCovid").click(function() {
                $.ajax({
                    url: '/toggleCovidReport',
                    method: "POST",
                    dataType: "json",
                    data: '_token=' + $("[name='csrf-token']").attr('content'),
                    success: function(res) {
                        Swal.fire({
                            title: 'Info',
                            text: "Covid Report di" + (res.covid_report ? '' : 'non-') +
                                "aktifkan",
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                        $('.covid-report').css('display', res.covid_report ? '' : 'none');
                        $('#aktivasi').modal('hide');
                        $('.lbl-covid-report span').html(res.covid_report ? 'Dea' : 'A');
                        $('#toggleCovid span').html(res.covid_report ? 'Non-' : '');
                    }
                });
            });

            $("form").submit(function(event) {
                event.preventDefault();
                var button = $('.modal-footer button');
                button.prop('disabled', true);
                button.text('Menyimpan...');
                store_data(this, button);
            });
        });

        function select_ajax(type = "angkatan", parent = "angkatan", placeholder = "Angkatan", parent_id = "") {
            let url_target = "{{ url('master') }}/";
            $.ajax({
                url: url_target + type + "/select/" + parent_id,
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#parent_' + parent).data('select2')) {

                        $("#parent_" + parent).val("");
                        $("#parent_" + parent).trigger("change");
                        $("#parent_" + parent).empty().trigger("change");

                    }

                    $("#parent_" + parent).select2({
                        data: result.data,
                        placeholder: "Pilih " + placeholder,
                        allowClear: true,
                        dropdownParent: parent == 'kotama' ? null : $("#rumah_sakit_modal")
                    });

                }
            });
        }

        function select_daerah(type = "provinsi", parent = "provinsi", placeholder = "Provinsi", parent_id = "", selected = "") {
            let url_target = "{{ url('refrensi') }}/";
            $.ajax({
                url: url_target + type + '/' + parent_id,
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#parent_' + parent).data('select2')) {

                        $("#parent_" + parent).val("");
                        $("#parent_" + parent).trigger("change");
                        $("#parent_" + parent).empty().trigger("change");

                    }

                    $("#parent_" + parent).select2({
                        data: result.data,
                        placeholder: "Pilih " + placeholder,
                        allowClear: true,
                        dropdownParent: $("#rumah_sakit_modal")
                    });

                    if (selected != '') $('#parent_kota_kab').val(selected).trigger('change');
                }
            });
        }

        $("#rumah_sakit_modal").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Rumah Sakit")

            $('#nama_rs').val("");
            $('#id_angkatan').val();
            $("#parent_komando").val("").trigger("change");
            $("#parent_sub_komando").val("").trigger("change");
            $("[name='_method']").val("POST");
            $("[name='kode_matra']").prop("checked", false);
            $("#id_tingkat_rs").val("").trigger('change');
            $("#parent_provinsi").val("").trigger('change');
            $("#parent_kota_kab").val("").trigger('change');
            $("#alamat").val("");
            $("#phone-number").val('');
            $("#no").val('');
            $("#imb").val('').trigger('change');
            $("#ipal").val('').trigger('change');
            $("#akreditasi").val('').trigger('change');
            $("#keuangan").val('').trigger('change');
            $('#wilayah').val('');
            $('#latitude').val('');
            $('#longitude').val('');
            $('#rumah_sakit_modal form').attr('action', "{{ route('yankesin.rumah_sakit.store') }}");
            if (clickmarker != null) clickmarker.setMap(null);

        });

        function edit_rs(e) {
            var id_rs = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('yankesin/rumah-sakit') }}" + '/' + id_rs,
                success: function(response) {
                    $("#modal-title").html("Edit Faskes")
                    $('#rumah_sakit_modal form').attr('action', action);
                    $("[name='_method']").val("PUT");
                    $('#nama_rs').val(response.data.nama_rs);
                    $('#id_angkatan').val(response.data.id_angkatan).trigger('change');
                    $('#id_tingkat_rs').val(response.data.id_tingkat_rs).trigger('change');
                    $('#alamat').val(response.data.alamat);
                    $('#phone-number').val(response.data.telp);
                    $('#no').val(response.data.no_ijin_opr);
                    $("#imb").val(response.data.imb).trigger('change');
                    $("#ipal").val(response.data.ipal).trigger('change');
                    $("#akreditasi").val(response.data.akreditasi).trigger('change');
                    $("#keuangan").val(response.data.keuangan).trigger('change');
                    $('#wilayah').val(response.data.wilayah_kerja);
                    $('#latitude').val(response.data.latitude);
                    $('#longitude').val(response.data.longitude);
                    setLatLng(response.data.latitude, response.data.longitude);
                    $("#" + response.data.jenis_rs.substr(0, 4)).prop("checked", true).trigger('change');
                    $("#RSS").prop("checked", response.data.jenis_rs.indexOf('RSS') != -1).trigger('change');
                    $("#" + response.data.angkatan.kode_matra).prop("checked", true).trigger('change');

                    select_provinsi(response.data.kotakab.id_provinsi)
                    select_daerah("kota-kab", "kota_kab", "Kota/Kabupaten", response.data.kotakab.id_provinsi, response.data.id_kotakab)

                    $("#parent_kota_kab").prop("disabled", false);

                    if (response.data.angkatan.level == 'sub') {
                        select_ajax("subkomando", "sub_komando", "Satker", response.data.angkatan.parent_.parent)
                        select_ajax("subkomando", "subsatker", "Sub Satker", response.data.angkatan.parent)
                        select_komando(response.data.angkatan.parent_.parent)
                        select_satker(response.data.angkatan.parent)

                        var checksubkomando = setInterval(function() {
                            if ($('#parent_subsatker option').length) {
                                $('#parent_subsatker').val(response.data.id_angkatan).trigger(
                                    'change');
                                clearInterval(checksubkomando);
                            }
                        }, 100);
                        $("#parent_subsatker").prop("disabled", false);
                    } else if (response.data.angkatan.level == 'sat') {
                        select_ajax("subkomando", "sub_komando", "Satker", response.data.angkatan.parent)
                        select_komando(response.data.angkatan.parent)
                        select_satker(response.data.id_angkatan)
                    } else {
                        select_komando(response.data.id_angkatan)
                    }

                    $('#rumah_sakit_modal').modal('show');
                }
            });
        }

        function select_komando(data_target) {
            $("#parent_komando").prop("disabled", false);

            var checkkomando = setInterval(function() {
                if ($('#parent_komando option').length) {
                    $('#parent_komando').val(data_target).trigger('change');
                    clearInterval(checkkomando);
                }
            }, 100);
        }

        function select_satker(data_target) {
            $("#parent_sub_komando").prop("disabled", false);

            var checkkomando = setInterval(function() {
                if ($('#parent_sub_komando option').length) {
                    $('#parent_sub_komando').val(data_target).trigger('change');
                    clearInterval(checkkomando);
                }
            }, 100);
        }

        function select_provinsi(data_target) {

            var checkprovinsi = setInterval(function() {
                if ($('#parent_provinsi option').length) {
                    $('#parent_provinsi').val(data_target).trigger('change');
                    clearInterval(checkprovinsi);
                }
            }, 100);
        }

        var map, clickmarker;
        function setLatLng(latClicked, lngClicked) {
            if (clickmarker != null) clickmarker.setMap(null);
            clickmarker = new google.maps.Marker({
                position: new google.maps.LatLng(latClicked, lngClicked),
                map: map,
            });
        }
        function initMap() {
            const center = { lat: -1.770340, lng: 118.409108 };
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: center,
            });
            map.addListener('click', function(e) {
                latClicked = parseFloat(e.latLng.lat());
                lngClicked = parseFloat(e.latLng.lng());
                setLatLng(latClicked, lngClicked);
                $('#latitude').val(latClicked);
                $('#longitude').val(lngClicked);
            });
        }
    </script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy9Rzj0GcZLwnkce6cFU92eXnQSo0EIG8&callback=initMap"></script>
@endsection
