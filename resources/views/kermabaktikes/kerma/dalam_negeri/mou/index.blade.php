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

        table.dataTable tbody td {
            vertical-align: top;
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
                            <h2 class="content-header-title float-left">Data MoU</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('kerma.mou.create') }}"><button class="btn btn-primary">Tambah Data MoU</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="mou-list">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Jenis</th>
                                            <th>Pihak</th>
                                            <th style="min-width: 200px;">Nama Lembaga</th>
                                            <th style="min-width: 200px;">Nomor Dokumen Kerjasama</th>
                                            <th style="min-width: 200px;">Tanggal Terbit</th>
                                            <th class="text-center">Status</th>
                                            <th style="min-width: 300px;">Tentang</th>
                                            <th style="min-width: 200px;">Ket</th>
                                            <th style="min-width: 200px;">File Doc</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
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

        let tahun = ''

        $('#tahun').change(function(){
            tahun = $(this).val()
            mou_list(tahun)
        })

        $(function () {
            mou_list()
        });

        function mou_list(tahun='') {
            let data = {tahun:tahun}

            var table = $('#mou-list').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('kerma.mou.list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'jenis_doc_kerma', name: 'jenis_doc_kerma'},
                    {data: 'pihak', name: 'pihak'},
                    {data: 'lembaga', name: 'lembaga'},
                    {data: 'no_doc', name: 'no_doc'},
                    {data: 'tgl_terbit', name: 'tgl_terbit'},
                    {data: 'status_perjanjian', name: 'status_perjanjian'},
                    {data: 'desc', name: 'desc'},
                    {data: 'keterangan', name: 'keterangan'},
                    {data: 'file_doc', name: 'file_doc'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                  "drawCallback": function(settings) {
                      feather.replace();
                  }
            });
        }
    </script>
@endsection
