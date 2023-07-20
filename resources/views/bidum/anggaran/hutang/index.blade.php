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
                    <div class="d-flex justify-content-between">
                        <h2 class="content-header-title float-left">Daftar Hutang</h2>
                        <a href="{{ url('bidum/anggaran/hutang/create') }}"><button class="btn btn-primary">Tambah Hutang</button></a>
                    </div>                    
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center" id="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="min-width: 200px;">Nama Batalyon</th>
                                                <th style="min-width: 200px;">Operasi</th>
                                                <th>Jml Pers</th>
                                                <th>Indeks</th>
                                                <th>Jml Tagihan (Rp)</th>
                                                <th>Pembayaran (Rp)</th>
                                                <th>Sisa Tagihan (Rp)</th>
                                                <th style="min-width: 100px;">Tgl Hutang</th>
                                                <th style="min-width: 100px;">Tgl Lunas</th>
                                                <th>Ket</th>
                                                <th class="text-center" style="min-width: 100px">Aksi</th>
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
        
        var table = $('#table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                    url: "{{ url('bidum/anggaran/hutang/get') }}",
                    method: 'POST',
                    // data: {id_kategori:id_kategori},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
            columns: [
                {
                    data: 'DT_RowIndex'
                },
                {
                    data: 'batalyon'
                },
                {
                    data: 'operasi'
                },
                {
                    data: 'jml_pers'
                },
                {
                    data: 'indeks'
                },
                {
                    data: 'jml_tagihan'
                },
                {
                    data: 'jml_bayar'
                },
                {
                    data: 'sisa'
                },
                {
                    data: 'tgl_hutang'
                }, 
                {
                    data: 'tgl_lunas'
                }, 
                {
                    data: 'keterangan'
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
    </script>
@endsection
