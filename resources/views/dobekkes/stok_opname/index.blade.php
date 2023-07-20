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
                            <h2 class="content-header-title float-left mb-0">Stok Opname</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-right">
                    <a href="/dobekkes/rekap-barang/export-stok-opname" class="btn btn-outline-primary" target="_blank">Export Excel</a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="stok_opname table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Stok Akhir</th>
                                                <th>Jumlah Harga Satuan</th>
                                                <th>Jumlah Harga Total</th>
                                                <th>Keterangan</th>
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
    var table_;
    $( document ).ready(function() {
        table_ = $('.stok_opname').DataTable({
            order: [],
            ajax: '{{ route("dobekkes.rekap_barang.stok_opname") }}',
            columns: [
              { data: 'nama_matkes' },
              { data: 'satuan_brg' },
              { data: 'stok' },
              { data: 'harga_satuan' },
              { data: 'harga_total' },
              { data: 'keterangan' },
              { data: 'nama_kategori', visible: false },
              { data: 'id_gudang', visible: false },
            ],
            columnDefs: [
              {
                targets: [1],
                className: 'text-center',
              },
              {
                targets: [2, 3, 4],
                className: 'text-right',
              },
            ],
            drawCallback: function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(7, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr><th class="text-center bg-light" colspan="6" height="25">' + group + '</th></tr>'
                        );

                        last = group;
                    }
                });

                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(6, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr><th class="bg-light" colspan="6" height="25">' + group + '</th></tr>'
                        );

                        last = group;
                    }
                });
            }
        });
    });
</script>
@endsection
