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
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-9 col-12">
                            <h2 class="content-header-title float-left">Daftar Satuan Produk</h2>
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <a href="/lafibiovak/satuan-produk/create"><button class="btn btn-primary">Tambah Satuan Produk</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="produk">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Satuan Produk</th>
                                            <th>Tahap Produksi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
        $('#produk').DataTable({
        ajax: "{{ url('/lafibiovak/satuan-produk/list') }}",
        columns: [{
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'nama_satuan',
            },
            {
                data: 'tahap_produksi',
                render: function(data, type, full, meta) {
                    var res = '';
                    for(i=0;i<data.length;i++) res += "<div class='badge badge-light-primary font-small-4 mr-50'>" + data[i].nama_tahap + "</div>"
                    return res;
                }
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });
    });
 </script>
@endsection
