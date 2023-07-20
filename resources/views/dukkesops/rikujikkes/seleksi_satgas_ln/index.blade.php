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
                            <h2 class="content-header-title float-left text-capitalize">Rikkes Seleksi Satgas <span class="text-uppercase"> {{ $jenis_kegiatan }} </span> - {{ $keterangan }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                    <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="id_kat_duk">
                            <option selected disabled>Kategori</option>
                            @foreach ($kegiatan_duk as $item)
                                <option value="{{ $item->id_kat_duk }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-4 text-right">
                    {{-- <a href="{{ url('dukkesops/seleksi-satgas-ln/create'.'/'.$keterangan) }}"><button class="btn btn-primary">Tambah Rikkes Satgas LN</button></a> --}}
                    <a href="{{ url('dukkesops/seleksi-satgas/create/'.$jenis_kegiatan.'/'.$keterangan) }}"><button class="btn btn-primary">Tambah Rikkes Satgas <span class="text-uppercase"> {{ $jenis_kegiatan }} </span></button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="seleksi_satgas_ln">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th style="min-width: 200px;">Nama Satgas</th>
                                            <th style="min-width: 200px;">Nama Batalyon</th>
                                            {{-- <th style="min-width: 200px;">Judul Kegiatan</th> --}}
                                            <th>Tahun Anggaran</th>
                                            <th style="min-width: 200px;">Tempat Pelaksana</th>
                                            <th class="text-center" style="min-width: 150px;">Tanggal Pelaksana</th>
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

        $('#clear').click(function() {
            $('#tahun').val('');
            tahun = '';
            satgas_ln_list(tahun);

            $('#clear').hide();
            $('#calendaricon').show();
        })

        let id_kat_duk = ''
        let tahun = ''

        $(document).ready(function() {

            $('#id_kat_duk').select2({
                allowClear: true,
                placeholder: 'Kategori',
                width: '100%',
            });
            $('.select2-selection__clear').hide();

            $('#clear').hide();
            $('#calendaricon').show();
        });

       

        $('#id_kat_duk').change(function(){
            id_kat_duk = $(this).val()
            satgas_ln_list(tahun,id_kat_duk)
        })

        $('#tahun').change(function(){
            tahun = $(this).val()
            satgas_ln_list(tahun,id_kat_duk)

            $('#clear').show();
            $('#calendaricon').hide();
        })

        function satgas_ln_list(tahun='',id_kat_duk='') {
            let data = { 
                id_kat_duk: id_kat_duk,
                tahun: tahun, 
                keterangan:'{{ $keterangan }}',
                jenis_kegiatan:'{{ $jenis_kegiatan }}'
            };

            $('#seleksi_satgas_ln').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('dukkesops/seleksi-satgas/list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'penugasan_satgas.nama_satgas',
                        name: 'penugasan_satgas.nama_satgas'
                    },
                    {
                        data: 'penugasan_satgas.nama_batalyon',
                        name: 'penugasan_satgas.nama_batalyon'
                    },
                    // {
                    //     data: 'judul_kegiatan',
                    //     name: 'judul_kegiatan'
                    // },
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
