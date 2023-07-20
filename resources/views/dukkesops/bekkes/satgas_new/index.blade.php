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
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-12 col-12">
                    <div class="d-flex justify-content-between">
                        <h2 class="content-header-title float-left">Bekkes Satgas Ops <span class="text-uppercase"> {{ request()->segment(3) }} </span> <font id="tahun-title"></font>
                        </h2>
                    </div>
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
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tambah Data Satgas</button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                                href="{{ url('dukkesops/bekkes-satgas/' . request()->segment(3) . '/create') }}">Tambah Data
                                Satgas Operasi</a>
                            <a class="dropdown-item" data-toggle='modal' data-target='#excell'>Upload Excell</a>
                        </div>
                    </div>

                    <!-- Modal Upload -->
                    <div class="modal fade text-left" id="excell" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{ url('dukkesops/bekkes-satgas/preview') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="jenis_satgas" value="{{ request()->segment(3) }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title">Upload Excell</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group form-input">
                                            <label for="customFile1">Upload Excell</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile1"
                                                    name="file" />
                                                <label class="custom-file-label dbd" for="customFile1">Upload Excell</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                            <a href="{{ url('template/bekkes-satgas') }}"
                                                class="float-right font-small-3 mt-50"><u>Download Template Excell</u></a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="dn">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center" style="min-width: 100px">Aksi</th>
                                            <th style="min-width: 200px">Nama Satgas</th>
                                            <th style="min-width: 200px">Operasi</th>
                                            <th style="min-width: 150px">Berangkat Ops</th>
                                            <th style="min-width: 150px">Kembali Ops</th>
                                            <th>Personil</th>
                                            @foreach ($master_bekkes as $v)
                                                <th>{{ $v->data }}</th>
                                            @endforeach
                                            <th>Endemik/Non Endemik</th>
                                            <th>Keterangan</th>
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
            bekkes_list(tahun);

            $('#tahun-title').hide();
            $('#clear').hide();
            $('#calendaricon').show();
        })

        $(document).ready(function() {
            $('#tahun-title').html('- TA ' + {{ date('Y') }});
            $('#tahun').val({{ date('Y') }});
        });


        $('#tahun').change(function() {
            tahun = $(this).val()
            bekkes_list(tahun)

            $('#tahun-title').show().html('- TA ' + tahun);

            $('#clear').show();
            $('#calendaricon').hide();
        })

        function bekkes_list(tahun = '') {
            let data_kat = [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_satgas'
                },
                {
                    data: 'operasi'
                },
                {
                    data: 'tgl_berangkat'
                },
                {
                    data: 'tgl_kembali'
                },
                {
                    data: 'jumlah_pers'
                }
            ];

            let data_kat2 = [{
                    data: 'endemik'
                },
                {
                    data: 'keterangan'
                }
            ];

            let master_bekkes = {!! json_encode($master_bekkes) !!};
            data_kat = data_kat.concat(master_bekkes, data_kat2);

            let filter = {
                jenis_satgas: '{{ request()->segment(3) }}',
                tahun: tahun
            }


            var table = $('#dn').DataTable({
                scrollX: true,
                destroy: true,
                // ajax: "{{ url('dukkesops/bekkes-satgas/' . request()->segment(3) . '/get') }}",
                ajax: {
                    url: "{{ url('dukkesops/bekkes-satgas/' . request()->segment(3) . '/get') }}",
                    method: 'POST',
                    data: filter,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: data_kat,
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
@endsection
