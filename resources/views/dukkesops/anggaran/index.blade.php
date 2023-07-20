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
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Daftar Anggaran Dukkesops</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-4">
                    <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="kategori">
                            <option selected disabled>Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-9 col-4 text-right">
                    <a href="{{ route('dukkesops.anggaran.create') }}"><button class="btn btn-primary">Tambah Anggaran</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="anggaran">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tahun</th>
                                            <th>Judul Anggaran</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Dokumen</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @include('dukkesops.anggaran.edit')
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

        $(function() {
            anggaran_list();
        })

        $('#kategori').change(function(){
            let kategori = $(this).val();
            anggaran_list(kategori);
        })

        function anggaran_list(kategori='') {
            let data = {kategori:kategori};
            $('#anggaran').DataTable({
                destroy:true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{ url('dukkesops/anggaran/list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'file_anggaran',
                        name: 'file_anggaran'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
    
            });
        }

        function edit_anggaran_duk(e) {
            let id_anggaran_duk = e.attr('data-id');

            let action = `{{ url('dukkesops/anggaran') }}/${id_anggaran_duk}`;

            $('#edit form').attr('action', action);
            $('#edit').modal('show');
        }
    </script>
@endsection
