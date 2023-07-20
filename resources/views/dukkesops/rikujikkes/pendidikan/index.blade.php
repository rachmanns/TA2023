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
                            <h2 class="content-header-title float-left">Rikkes Sesko TNI</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 col-4">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text" id="calendaricon"><i data-feather="calendar"></i></span>
                            <span id="clear" class="input-group-text" style="display: none;"><i
                                    data-feather='x'></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-4">
                    {{-- <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="id_kat_duk">
                            <option selected disabled>Kategori</option>
                            @foreach ($kegiatan_duk as $item)
                                <option value="{{ $item->id_kat_duk }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div> --}}
                </div>
                <div class="col-md-6 col-4 text-right">
                    <a href="{{ route('dukkesops.pendidikan.create') }}"><button class="btn btn-primary">Tambah Pendidikan</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="pendidikan">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th class="text-center">Nama Kategori</th>
                                            <th class="text-center">Tahun Anggaran</th>
                                            <th>Tempat Pelaksana</th>
                                            <th class="text-center">Tanggal Pelaksana</th>
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

        $('#clear').click(function() {
            $('#tahun').val('');
            tahun = '';
            pendidikan_list(tahun);

            $('#clear').hide();
            $('#calendaricon').show();
        })

        let id_kat_duk = ''
        let tahun = ''

        $(document).ready(function() {
            $('#clear').hide();
            $('#calendaricon').show();
        });

        // $('#id_kat_duk').change(function(){
        //     id_kat_duk = $(this).val()
        //     pendidikan_list(tahun,id_kat_duk)
        // })

        $('#tahun').change(function(){
            tahun = $(this).val()
            pendidikan_list(tahun,id_kat_duk)

            $('#clear').show();
            $('#calendaricon').hide();
        })

        function pendidikan_list(tahun='',id_kat_duk='') {
            let data = { id_kat_duk: id_kat_duk, tahun: tahun }

            $('#pendidikan').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url: "{{ url('dukkesops/pendidikan/list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'kategori_duk.nama_kategori',
                        name: 'kategori_duk.nama_kategori'
                    },
                    {
                        data: 'tahun_anggaran',
                        name: 'tahun_anggaran'
                    },
                    {
                        data: 'tempat',
                        name: 'tempat'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
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
    </script>
@endsection
