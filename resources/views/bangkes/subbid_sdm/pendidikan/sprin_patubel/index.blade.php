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
                        <div class="col-md-10 col-10">
                            <h2 class="content-header-title float-left">Daftar Peserta Patubel</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text" id="calendaricon"><i data-feather="calendar"></i></span>
                            <span id="clear" class="input-group-text" style="display: none;"><i data-feather='x'></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="select2 form-control form-control-lg" id="status">
                        <option disabled selected>Status</option>
                        @foreach ($status as $key=> $s)
                            <option value="{{ $key }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-lg" id="sprin">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2" style="min-width: 100px;">Aksi</th>
                                            <th rowspan="2" style="min-width: 90px;">Tahun Ajaran</th>
                                            <th rowspan="2" style="min-width: 200px;">Nama</th>
                                            <th rowspan="2" style="min-width: 50px;">Pangkat/Korps</th>
                                            <th rowspan="2" style="min-width: 50px;">NRP/NIP</th>
                                            <th rowspan="2" style="min-width: 200px;">Kesatuan</th>
                                            <th rowspan="2" style="min-width: 90px;">Prodi Pilihan</th>
                                            <th class="text-center" rowspan="2" style="min-width: 150px;">Sprindis</th>
                                            <th class="border-right" rowspan="2" style="min-width: 200px;">TMT</th>
                                            <th rowspan="2" class="border-right">Alih Jurusan</th>
                                            <th class="text-center" colspan="2">Prodi Pindahan</th>
                                            <th class="text-center border-left" rowspan="2">Sprindis</th>
                                            <th class="text-center" rowspan="2">Status</th>
                                            <th class="text-center" rowspan="2">IPK</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Peminatan</th>
                                            <th class="text-center border-right">Tempat Pendidikan</th>
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
        let tahun = '';
        let status = '';

        $('#clear').click(function(){
            $('#tahun').val('');
            tahun = '';
            peserta_patubel_list(tahun);

            $('#clear').hide();
            $('#calendaricon').show();
        })

        $(function() {
            $('#status').select2({
                allowClear: true,
                placeholder: 'Status',
                width: '100%',
            });
            $('.select2-selection__clear').hide();

            $('#calendaricon').show();
            $('#clear').hide();

            peserta_patubel_list(tahun,status);
        })

        $('#tahun').change(function(){
            tahun = $(this).val();
            peserta_patubel_list(tahun,status);
            $('#clear').show();
            $('#calendaricon').hide();
        })

        $('#status').change(function(){
            status = $(this).val();
            peserta_patubel_list(tahun,status);
        })
    
        function peserta_patubel_list(tahun,status) {
            let data = {tahun:tahun,status:status};

            $('#sprin').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('bangkes/peserta-patubel/get') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                scrollX: true,
                columns: [
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'no_identitas',
                        name: 'no_identitas'
                    },
                    {
                        data: 'satuan_asal',
                        name: 'satuan_asal'
                    },
                    {
                        data: 'peminatan',
                        name: 'peminatan'
                    },
                    {
                        data: 'file_sprin',
                        name: 'file_sprin'
                    },
                    {
                        data: 'tmt',
                        name: 'tmt'
                    },
                    {
                        data: 'alih_jurusan',
                        name: 'alih_jurusan'
                    },
                    {
                        data: 'peminatan2',
                        name: 'peminatan2'
                    },
                    {
                        data: 'kampus2',
                        name: 'kampus2'
                    },     
                    {
                        data: 'file_sprin2',
                        name: 'file_sprin2'
                    },
                        
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'ipk',
                        name: 'ipk'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
    
            });
            
        }
    </script>
@endsection