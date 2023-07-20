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

        .box {
            display: none;
        }

        .flatpickr-wrapper {
            display: block;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar Transaksi Masuk - Aset
                                <font id="tgl_title"></font>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">
                    <div class="input-group input-group-merge bg-white">
                        <input type="text" id="fp-range" class="form-control flatpickr-range"
                            placeholder="Filter Tanggal" />
                        <div class="input-group-append">
                            <span class="input-group-text" id="calendaricon"><i data-feather="calendar"></i></span>
                            <span id="clear" class="input-group-text" style="display: none;"><i
                                    data-feather='x'></i></span>
                            <input type="hidden" id="from_date">
                            <input type="hidden" id="to_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-pusat-tab"
                                                data-toggle="tab" href="#nav-pusat" role="tab" aria-controls="nav-pusat"
                                                aria-selected="true"><span
                                                    class="font-medium-4 font-weight-bolder">Pengadaan Pusat</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-daerah-tab" data-toggle="tab"
                                                href="#nav-daerah" role="tab" aria-controls="nav-daerah"
                                                aria-selected="false"><span
                                                    class="font-medium-4 font-weight-bolder">Pengadaan Daerah</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-transfer-tab" data-toggle="tab"
                                                href="#nav-transfer" role="tab" aria-controls="nav-transfer"
                                                aria-selected="false"><span
                                                    class="font-medium-4 font-weight-bolder">Transfer Masuk</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-hibah-tab" data-toggle="tab"
                                                href="#nav-hibah" role="tab" aria-controls="nav-hibah"
                                                aria-selected="false"><span
                                                    class="font-medium-4 font-weight-bolder">Hibah</span></a>
                                        </div>
                                    </nav>
                                    <hr class="m-0">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pusat" role="tabpanel"
                                            aria-labelledby="nav-pusat-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-pengadaan-pusat">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Nomor Kontrak</th>
                                                            <th style="min-width: 200px;">Nominal Kontrak</th>
                                                            <th style="min-width: 200px;">Tanggal Kontrak</th>
                                                            <th style="min-width: 200px;">Pelaksana Kontrak</th>
                                                            <th style="min-width: 300px;">Dokumen RTH</th>
                                                            <th style="min-width: 100px;">Status</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        @include('bidum.logistik.transaksi_masuk.aset.form_pengadaan')
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-pengadaan-daerah">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Nomor Kontrak</th>
                                                            <th style="min-width: 200px;">Nominal Kontrak</th>
                                                            <th style="min-width: 200px;">Tanggal Kontrak</th>
                                                            <th style="min-width: 200px;">Pelaksana Kontrak</th>
                                                            <th style="min-width: 300px;">Dokumen RTH</th>
                                                            <th style="min-width: 100px;">Status</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-transfer" role="tabpanel"
                                            aria-labelledby="nav-transfer-tab">
                                            <div class="text-right pr-2 pt-2">
                                                <a data-toggle="modal" data-target="#transfer_modal"><button
                                                        class="btn btn-primary">Input Dokumen</button></a>
                                            </div>
                                            @include('bidum.logistik.transaksi_masuk.aset.form_dokumen_tm')
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="transfer-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Nomor Kontrak</th>
                                                            <th style="min-width: 200px;">Nominal Kontrak</th>
                                                            <th style="min-width: 200px;">Tanggal Kontrak</th>
                                                            <th style="min-width: 200px;">Pelaksana</th>
                                                            <th style="min-width: 300px;">Dokumen RTH TM</th>
                                                            <th style="min-width: 100px;">Status</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        @include('bidum.logistik.transaksi_masuk.aset.form_hibah')
                                        <div class="tab-pane fade" id="nav-hibah" role="tabpanel"
                                            aria-labelledby="nav-hibah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-hibah">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Nomor BA</th>
                                                            <th style="min-width: 200px;">Nominal Hibah</th>
                                                            <th style="min-width: 200px;">Tanggal BA</th>
                                                            <th style="min-width: 200px;">Pemberi Hibah</th>
                                                            <th style="min-width: 300px;">Dokumen Persetujuan</th>
                                                            <th style="min-width: 100px;">Status</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        $(function() {

            let from_date = moment().format('YYYY-01-01');
            let to_date = moment().format('YYYY-12-31');
            $('#from_date').val(from_date)
            $('#to_date').val(to_date)
            $('#fp-range').val(`${from_date} to ${to_date}`)
            report_list(from_date, to_date);

            pengadaan_table('#table-pengadaan-pusat', from_date, to_date, 'DIPPUS', 'A');
            pengadaan_table('#table-pengadaan-daerah', from_date, to_date, 'DIPDAERAH', 'A');

            $('#clear').show();
            $('#calendaricon').hide();

            $('#tgl_title').html('(' + {{ date('Y') }} + ')');
        });

        $('#clear').click(function() {

            $("#fp-range").val('');

            tanggal = '*';
            report_list(tanggal, tanggal);
            pengadaan_table('#table-pengadaan-pusat', tanggal, tanggal, 'DIPPUS', 'A');

            $('#clear').hide();
            $('#calendaricon').show();

            $('#tgl_title').html('');
        })

        $("#fp-range").flatpickr({
            mode: 'range',
            onChange: function(selectedDate) {
                let _this = this;
                let dateArr = selectedDate.map(function(date) {
                    return _this.formatDate(date, 'Y-m-d');
                });

                $('#clear').show();
                $('#calendaricon').hide();

                let start = dateArr[0];
                let end = dateArr[1];
                $('#from_date').val(start)
                $('#to_date').val(end)

                if (start != null && end != null) {
                    if (start.split('-')[0] == end.split('-')[0]) {
                        $('#tgl_title').html('(' + start.split('-')[0] + ')');
                    } else {
                        $('#tgl_title').html('(' + start.split('-')[0] + ' - ' + end.split('-')[0] + ')');
                    }
                }

                report_list(start, end);
                pengadaan_table('#table-pengadaan-pusat', start, end, 'DIPPUS', 'A');
                pengadaan_table('#table-pengadaan-daerah', start, end, 'DIPDAERAH', 'A');
            }
        })

        function report_list(from_date, to_date) {
            let url_transfer =
                `{{ url('bidum/logistik/transfer-masuk/list-transfer') }}/${from_date}/${to_date}/aset`;

            let url_hibah =
                `{{ url('bidum/logistik/hibah-masuk/list-hibah') }}/${from_date}/${to_date}/A`;

            var table = $('#table-hibah').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url_hibah,
                columns: [{
                        data: 'no_ba_hibah',
                        name: 'no_ba_hibah'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'tgl_ba_hibah',
                        name: 'tgl_ba_hibah'
                    },
                    {
                        data: 'vendor.nama_vendor',
                        name: 'vendor.nama_vendor'
                    },
                    {
                        data: 'file_app_hibah',
                        name: 'file_app_hibah'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

            var table = $('#transfer-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url_transfer,
                columns: [{
                        data: 'no_kontrak_tktm',
                        name: 'no_kontrak_tktm'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'tgl_kontrak_tktm',
                        name: 'tgl_kontrak_tktm'
                    },
                    {
                        data: 'pelaksana_tktm',
                        name: 'pelaksana_tktm'
                    },
                    {
                        data: 'file_rth_tm',
                        name: 'file_rth_tm'
                    },
                    // {
                    //     data: 'file_rth_tk',
                    //     name: 'file_rth_tk'
                    // },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

        }

        $('#transfer_modal').on('hide.bs.modal', function(e) {
            $("#modal-title").html("Tambah Dokumen Transfer Masuk - Aset")
            $('#transfer_modal form')[0].reset();
            $('#transfer_modal form').attr('action',
                "{{ route('bidum.logistik.transfer_masuk.store_transfer', 'aset') }}");
            $("[name='_method']").val("POST");
            $("label[for='file_kontrak_tktm']").text('Pilih Dokumen Kontrak');
            $("label[for='file_rth_tm']").text('Pilih Dokumen RTH TM');
            $("label[for='file_rth_tk']").text('Pilih Dokumen RTH TK');
        })

        function edit_transfer(e) {
            var id_in_tktm = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/transfer-masuk/edit-transfer') }}" + '/' + id_in_tktm,
                success: function(response) {
                    $("#modal-title").html("Edit Dokumen Transfer Masuk - Aset")
                    $('#transfer_modal form').attr('action', action);
                    $("[name='_method']").val("PUT");
                    $('#no_kontrak_tktm').val(response.no_kontrak_tktm);
                    var date_flatpickr = $(".flatpickr-basic").flatpickr({
                        altInput: true,
                        altFormat: 'j F Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: response.tgl_kontrak_tktm
                    });

                    $('#pelaksana_tktm').val(response.pelaksana_tktm).trigger("change");
                    $('#nominal').val(formatRupiah(response.nominal.toString(), 'Rp. '));
                    $('#no_rth_tm').val(response.no_rth_tm);
                    // $('#no_rth_tk').val(response.no_rth_tk);

                    $('#transfer_modal').modal('show');

                }
            });

        }

        function pengadaan_table(table_id, from_date, to_date, kode_dipa, prefix_kontrak) {

            var url =
                `{{ url('bidum/logistik/pengadaan-masuk/list-pengadaan') }}/${from_date}/${to_date}/${kode_dipa}/${prefix_kontrak}`;

            url = url.replace(":kode_dipa", kode_dipa);
            url = url.replace(":prefix_kontrak", prefix_kontrak);

            var table = $(table_id).DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                destroy: true,
                columns: [{
                        data: 'nomor_kontrak',
                        name: 'nomor_kontrak'
                    },
                    {
                        data: 'nilai_kontrak',
                        name: 'nilai_kontrak'
                    },
                    {
                        data: 'tgl_kontrak',
                        name: 'tgl_kontrak'
                    },
                    {
                        data: 'pelaksana_kontrak',
                        name: 'pelaksana_kontrak'
                    },
                    {
                        data: 'file_rth',
                        name: 'file_rth'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }

        function edit_pengadaan(e) {
            var id_in_tktm = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/pengadaan-masuk/edit-pengadaan') }}" + '/' + id_in_tktm,
                success: function(response) {
                    $("#modal-title").html("Upload Dokumen Pengadaan - Aset")
                    $('#pengadaan_modal form').attr('action', action);
                    $('#pengadaan_nomor_kontrak').html(response.kontrak.nomor_kontrak);
                    $('#pengadaan_nominal').html(formatRupiah(response.nominal.toString(), 'Rp. '));

                    $('#no_rth').val(response.no_rth);

                    $('#pengadaan_modal').modal('show');

                }
            });

        }

        function edit_hibah(e) {
            var id_ba_hibah = e.attr('data-id');

            let action = e.attr('data-url');



            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/hibah-masuk/edit-hibah') }}" + '/' + id_ba_hibah,
                success: function(response) {
                    $("#modal-title").html("Upload Dokumen Hibah - Aset")
                    $('#hibah_modal form').attr('action', action);
                    $('#no_ba_hibah').html(response.no_ba_hibah);
                    $('#nominal_hibah').html(formatRupiah(response.nominal.toString(), 'Rp. '));

                    $('#no_app_hibah').val(response.no_app_hibah);
                    const tgl_app_hibah = $('#tgl_app_hibah').flatpickr({
                        altInput: true,
                        altFormat: "j F Y",
                        dateFormat: "Y-m-d",
                        defaultDate: response.tgl_app_hibah,
                        static: true
                    });

                    $('#hibah_modal').modal('show');

                }
            });

        }

        var rupiah = document.querySelector('.jumlah')
        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
    </script>
@endsection
