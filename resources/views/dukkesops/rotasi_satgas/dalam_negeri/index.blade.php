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
                            <h2 class="content-header-title float-left">Rotasi Satgas
                                {{ strtoupper(request()->segment(3)) }} <font id="tahun-title"></font>
                            </h2>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                    placeholder="Tahun" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="calendaricon"><i data-feather="calendar"></i></span>
                                    <span id="clear" class="input-group-text" style="display: none;"><i
                                            data-feather='x'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 text-right">
                            <button class="btn btn-outline-primary mr-75" data-toggle='modal' data-target='#import'> Import
                                Excell</button>

                            {{-- Modal Import --}}
                            <div class="modal fade text-left" id="import" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modal-title">Upload Excel Rotasi Satgas</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('dukkesops/rotasi-satgas/upload/' . request()->segment(3)) }}"
                                            method="POST" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="customFile1">Upload Excell</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file"
                                                            required />
                                                        <label class="custom-file-label">Upload Excell</label>
                                                    </div>
                                                    <hr>
                                                    <div class="row mt-50">
                                                        <div class="col-md-6 col-12">
                                                            <div class="input-group input-group-merge form-input">
                                                                <input type="text" id="tahun-download"
                                                                    class="yearpicker form-control bg-white cursor-pointer"
                                                                    placeholder="Tahun" readonly />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="calendaricon"><i
                                                                            data-feather="calendar"></i></span>
                                                                    <span id="clear" class="input-group-text"
                                                                        style="display: none;"><i
                                                                            data-feather='x'></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 text-right">
                                                            {{-- <a href="{{ url('dukkesops/rotasi-satgas/download-template/' . request()->segment(3)) . '/
                                                                class="font-small-3"> <u>Download Template Excel</u> </a> --}}
                                                            <a onclick="download_excel()" class="font-small-3"> <u>Download
                                                                    Template Excel</u>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('dukkesops/rotasi-satgas/create/' . request()->segment(3)) }}"><button
                                    class="btn btn-primary"> Tambah Jadwal</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="demo-spacing-0">
                    <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif
            @error('file')
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ $message }}
                        </div>
                    </div>
                </div>
            @enderror
            @if (session('error'))
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="rs">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Satgas Ops</th>
                                            <th>Batalyon</th>
                                            <th class="text-center">Berangkat Ops</th>
                                            <th class="text-center">Kembali Ops</th>
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
            tahun = '*';
            rotasi_list(tahun);

            $('#tahun-title').hide();
            $('#clear').hide();
            $('#calendaricon').show();
            // $('#tahun-download').val('');
        })

        $(document).ready(function() {
            $('#tahun-title').html('- Tahun ' + {{ date('Y') }});
            $('#tahun').val({{ date('Y') }});
            $('#tahun-download').val({{ date('Y') }});
        });


        $('#tahun').change(function() {
            tahun = $(this).val()
            rotasi_list(tahun)

            $('#tahun-title').show().html('- Tahun ' + tahun);
            $('#tahun-download').val(tahun);

            $('#clear').show();
            $('#calendaricon').hide();
        })

        function download_excel() {
            var segment = "{{ request()->segment(3) }}";
            var tahun = $('#tahun-download').val();
            window.location.href = "{{ url('dukkesops/rotasi-satgas/download-template/') }}" + "/" + segment + "/" + tahun;
        }

        function rotasi_list(tahun = '') {
            let data = {
                jenis_satgas: '{{ request()->segment(3) }}',
                tahun: tahun
            }
            $('#rs').DataTable({
                scrollX: true,
                destroy: true,
                ajax: {
                    url: "{{ url('dukkesops/rotasi-satgas/get') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_satgas',
                        name: 'nama_satgas'
                    },
                    {
                        data: 'nama_batalyon',
                        name: 'nama_batalyon'
                    },
                    {
                        data: 'dept_date',
                        name: 'dept_date'
                    },
                    {
                        data: 'arrv_date',
                        name: 'arrv_date'
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
