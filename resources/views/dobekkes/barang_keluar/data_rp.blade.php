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
                            <h2 class="content-header-title float-left mb-0">Data Rencana Pengeluaran</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="daftar-rencana table table-striped table-responsive-xl">
                                        <thead>
                                            <tr>
                                                <th>Kepada/Tujuan</th>
                                                <th class="width-400 text-center">Catatan</th>
                                                <th class="text-center">Tanggal Kontrak</th>
                                                <th class="text-center">Total Barang</th>
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
        $(document).ready(function() {
            var table_ = $('.daftar-rencana').DataTable({
                // scrollX: true,
                ajax: '{{ route('dobekkes.barang_keluar.list_rencana') }}',
                destroy: true,
                columns: [{
                        data: 'penerima'
                    },
                    {
                        data: 'tujuan_penggunaan'
                    },
                    {
                        data: ''
                    },
                    {
                        data: 'ket'
                    },
                    {
                        data: ''
                    }
                ],
                columnDefs: [{
                        targets: 2,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                new Date(data.tgl).toLocaleString('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                })
                            );
                        }
                    },
                    {
                        targets: 3,
                        className: 'text-center',
                    },
                    {
                        targets: -1,
                        orderable: false,
                        render: function(datas, type, data, meta) {
                            return (
                                data.detail_brg_matkes_m_sum_jumlah == data.brgGudang ?
                                '<div class="text-center">' +
                                '<a href="/dobekkes/ada_rp/' + data.id_rencana +
                                '" class="item-edit" title="Keluarkan Barang">' +
                                feather.icons['log-out'].toSvg({
                                    class: 'font-medium-4'
                                }) +
                                '</a>' +
                                '</div>' : ''
                            );
                        }
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        });
    </script>
@endsection
