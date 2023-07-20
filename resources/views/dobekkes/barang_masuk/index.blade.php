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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar Transaksi Masuk -
                                <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun_anggaran" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="jenis_trx">
                        <option disabled>Jenis Transaksi</option>
                        <option value="*" selected>Semua Jenis Transaksi</option>
                        <option value="DIPPUS|A">Pengadaan KP - Alkes</option>
                        <option value="DIPPUS|P">Pengadaan KP - Bekkes</option>
                        <option value="DIPDAR|A">Pengadaan KD - Alkes</option>
                        <option value="DIPDAR|P">Pengadaan KD - Bekkes</option>
                        <option>TKTM</option>
                        <option>Hibah</option>
                    </select>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="barang-masuk table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="width-200 text-center">No. Kontrak/BA</th>
                                                <th class="text-center">Jenis Transaksi</th>
                                                <th class="text-center">Nilai Kontrak</th>
                                                <th class="text-center">Jumlah Barang</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var param = '',
            table_;

        function table_reload() {
            table_ = $('.barang-masuk').DataTable({
                scrollX: true,
                ajax: '{{ route('dobekkes.barang_masuk.list_kontrak') }}?' + param,
                destroy: true,
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: ''
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'nilai'
                    },
                    {
                        data: 'jml'
                    },
                    {
                        data: ''
                    }
                ],
                columnDefs: [{
                        className: 'control text-center',
                        orderable: false,
                        targets: 0,
                    }, {
                        className: 'text-center',
                        targets: [2, 4]
                    }, {
                        className: 'text-right',
                        targets: 3
                    },
                    {
                        targets: 1,
                        render: function(datas, type, data, meta) {
                            return (
                                data.no + '<br>' + data.tgl + '<br> <div class="mt-50"><a href="' + data
                                .link +
                                '" target="_blank"><i data-feather="file-text" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>'
                            );
                        }
                    },
                    {
                        targets: -1,
                        orderable: false,
                        render: function(datas, type, data, meta) {
                            return (
                                data.jmlBrg == 0 ? '' :
                                '<div class="text-center">' +
                                '<a href="/dobekkes/masuk_gudang/' + data.id +
                                '" class="item-edit" title="Masukkan Barang">' +
                                feather.icons['log-in'].toSvg({
                                    class: 'font-medium-4'
                                }) +
                                '</a>' +
                                '</div>'
                            );
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
        $(document).ready(function() {
            $('#tahun_anggaran').val(<?php echo date('Y'); ?>);
            table_reload();
            $('#jenis_trx').change(function() {
                param = '';
                param += '&tahun=' + $('#tahun_anggaran').val();
                param += '&jenis=' + ($('#jenis_trx').val() == '*' ? '' : $('#jenis_trx').val());
                table_reload();
            });

            $('#tahun_anggaran').change(function() {
                $('.tahun').text($(this).val());
                param = '';
                param += '&tahun=' + $('#tahun_anggaran').val();
                param += '&jenis=' + ($('#jenis_trx').val() == '*' ? '' : $('#jenis_trx').val());
                table_reload();
            });
        });
    </script>
@endsection
