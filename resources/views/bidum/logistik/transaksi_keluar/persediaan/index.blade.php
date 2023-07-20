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
    </style>
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
                            <h2 class="content-header-title float-left mb-0">Daftar Transaksi Keluar - Persediaan  <font id="tgl_title"></font></h2>
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
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-pemakaian-tab"
                                                data-toggle="tab" href="#nav-pemakaian" role="tab"
                                                aria-controls="nav-pemakaian" aria-selected="true"><span
                                                    class="font-medium-4 font-weight-bolder">Pemakaian</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-tk-tab" data-toggle="tab"
                                                href="#nav-tk" role="tab" aria-controls="nav-tk"
                                                aria-selected="false"><span
                                                    class="font-medium-4 font-weight-bolder">Transfer Keluar</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-hibah-tab" data-toggle="tab"
                                                href="#nav-hibah" role="tab" aria-controls="nav-hibah"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Hibah
                                                    Keluar</span></a>
                                        </div>
                                    </nav>
                                    <hr class="m-0">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pemakaian" role="tabpanel"
                                            aria-labelledby="nav-pemakaian-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="pemakaian-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width:200px;">Nota Dinas</th>
                                                            <th style="min-width:150px;">PPM</th>
                                                            <th style="min-width:150px;">SPB</th>
                                                            <th style="min-width:150px;">Nominal Keluar</th>
                                                            <th style="min-width:150px;">Dokumen RTH</th>
                                                            <th style="min-width:150px;" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        @include('bidum.logistik.transaksi_keluar.persediaan.form_pemakaian')
                                        <div class="tab-pane fade" id="nav-tk" role="tabpanel"
                                            aria-labelledby="nav-tk-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="transfer-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width:200px;">Nota Dinas</th>
                                                            <th style="min-width:150px;">PPM</th>
                                                            <th style="min-width:150px;">SPB</th>
                                                            <th style="min-width:150px;">Nominal Keluar</th>
                                                            <th style="min-width:150px;">Tujuan TK</th>
                                                            <th style="min-width:150px;">Dokumen RTH TK</th>
                                                            <th style="min-width:150px;">Dokumen RTH TM</th>
                                                            <th style="min-width:150px;" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            @include('bidum.logistik.transaksi_keluar.persediaan.form_transfer')
                                        </div>
                                        <div class="tab-pane fade" id="nav-hibah" role="tabpanel"
                                            aria-labelledby="nav-hibah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="hibah-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width:200px;">Nota Dinas</th>
                                                            <th style="min-width:150px;">Nominal Hibah</th>
                                                            <th style="min-width:150px;">Dokumen RTH Hibah</th>
                                                            <th style="min-width:150px;" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            @include('bidum.logistik.transaksi_keluar.persediaan.form_hibah')
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

            $('#clear').show();
            $('#calendaricon').hide();

            $('#tgl_title').html('(' + {{ date('Y') }} + ')');

        });

        $('#clear').click(function() {

            $("#fp-range").val('');

            tanggal = '*';
            report_list(tanggal, tanggal);
                    
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
            }
        })

        function report_list(from_date, to_date) {

            let url_pemakaian = `{{ url('bidum/logistik/pemakaian/list') }}/${from_date}/${to_date}`;
            let url_transfer = `{{ url('bidum/logistik/transfer-keluar/list/persediaan') }}/${from_date}/${to_date}`;
            let url_hibah = `{{ url('bidum/logistik/hibah-keluar/list/P') }}/${from_date}/${to_date}`;

            var table = $('#pemakaian-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url_pemakaian,
                columns: [{
                        data: 'no_nota_dinas',
                        name: 'no_nota_dinas'
                    },
                    {
                        data: 'file_ppm',
                        name: 'file_ppm'
                    },
                    {
                        data: 'file_spb',
                        name: 'file_spb'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'file_rth',
                        name: 'file_rth'
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
                        data: 'no_nota_dinas',
                        name: 'no_nota_dinas'
                    },
                    {
                        data: 'file_ppm',
                        name: 'file_ppm'
                    },
                    {
                        data: 'file_spb',
                        name: 'file_spb'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'penerima',
                        name: 'penerima'
                    },
                    {
                        data: 'file_rth_tk',
                        name: 'file_rth_tk'
                    },
                    {
                        data: 'file_rth_tm',
                        name: 'file_rth_tm'
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

            var table = $('#hibah-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url_hibah,
                columns: [{
                        data: 'no_nota_dinas',
                        name: 'no_nota_dinas'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'file_rth_hibah',
                        name: 'file_rth_hibah'
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

        function edit_pemakaian(e) {
            var id_out_pemakaian = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/pemakaian/edit') }}" + '/' + id_out_pemakaian,
                success: function(response) {
                    $('#pemakaian_modal form').attr('action', action);
                    if (response.rencana_pengeluaran == null) {
                        $('#pemakaian_modal').find('#no_nota_dinas').html('-');
                    } else {
                        $('#pemakaian_modal').find('#no_nota_dinas').html(response.rencana_pengeluaran
                            .no_nota_dinas);
                    }
                    $('#pemakaian_modal').find('#nominal').html(formatRupiah(response.nominal.toString(),
                        'Rp. '));
                    $('#no_rth').val(response.no_rth);
                    $('#no_ppm').val(response.no_ppm);

                    $('#pemakaian_modal').modal('show');

                }
            });

        }

        function edit_transfer(e) {
            var id_out_tktm = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/transfer-keluar/edit') }}" + '/' + id_out_tktm,
                success: function(response) {
                    $('#transfer_modal').modal('show');
                    $('#transfer_modal form').attr('action', action);
                    $('#transfer_modal').find('#no_nota_dinas').html(response.rencana_pengeluaran
                        .no_nota_dinas);
                    $('#transfer_modal').find('#nominal').html(formatRupiah(response.nominal.toString(),
                        'Rp. '));
                    $('#no_rth_tk').val(response.no_rth_tk);
                    $('#no_rth_tm').val(response.no_rth_tm);
                    $('#no_ppm').val(response.no_ppm);


                }
            });

        }

        function edit_hibah(e) {
            var id_out_hibah = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('bidum/logistik/hibah-keluar/edit') }}" + '/' + id_out_hibah,
                success: function(response) {
                    $('#hibah_modal').modal('show');
                    $('#hibah_modal form').attr('action', action);
                    $('#hibah_modal').find('#no_nota_dinas').html(response.rencana_pengeluaran.no_nota_dinas);
                    $('#hibah_modal').find('#nominal').html(formatRupiah(response.nominal.toString(), 'Rp. '));
                    $('#no_rth_hibah').val(response.no_rth_hibah);
                }
            });

        }
    </script>
@endsection
