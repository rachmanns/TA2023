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
                        <div class="col-12 mb-1">
                            <a href="{{ url('dukkesops/rotasi-satgas/' . $penugasan_satgas->satgas_ops->jenis_satgas) }}"><button
                                    type="button" class="btn btn-outline-primary"><i class="mr-75"
                                        data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail Rotasi Satgas</h4>
                                </div>
                                <hr class="m-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <h5>Satgas Ops</h5>
                                            <span>{{ $penugasan_satgas->nama_satgas }}</span>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <h5>Batalyon</h5>
                                            <span>{{ $penugasan_satgas->nama_batalyon }}</span>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <h5>Berangkat Ops</h5>
                                            <span>{{ $penugasan_satgas->dept_date }}</span>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <h5>Kembali Ops</h5>
                                            <span>{{ $penugasan_satgas->arrv_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-outline-primary" data-toggle='modal' data-target='#import'> Import
                                Excel</button>

                            {{-- Modal Import --}}
                            <div class="modal fade text-left" id="import" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modal-title">Upload Excel Bekkes Pos</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('dukkesops/penugasan-pos/upload/' . request()->segment(4)) }}"
                                            method="POST" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ request()->segment(4) }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="customFile1">Upload Excell</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input" />
                                                        <label class="custom-file-label">Upload Excell</label>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="{{ url('dukkesops/penugasan-pos/download-template/' . request()->segment(4)) }}"
                                                            class="font-small-3"> <u>Download Template Excel</u> </a>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                            <th>No.</th>
                                            <th style="min-width: 200px;">Nama Pos</th>
                                            <th style="min-width: 200px;">Nama Pers Kesehatan</th>
                                            <th style="min-width: 100px;">No. Telp</th>
                                            <th style="min-width: 100px;">Jumlah Personil</th>
                                            @foreach ($master_bekkes as $mb)
                                                <th>{{ $mb->data }}</th>
                                            @endforeach
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
        let data_kat = [{
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'DT_RowIndex'
            },
            {
                data: 'nama_pos'
            },
            {
                data: 'nama_ketua'
            },
            {
                data: 'no_telp'
            },
            {
                data: 'jml_personil'
            }
        ];

        let master_bekkes = {!! json_encode($master_bekkes) !!};
        data_kat = data_kat.concat(master_bekkes);

        $('#table').DataTable({
            scrollX: true,
            ajax: "{{ url('dukkesops/rotasi-satgas/get-kat/' . $penugasan_satgas->id_tugas) }}",
            // ajax: "{{ url('/app-assets/data/detail-rotasi-satgas-ln.json') }}",
            columns: data_kat,
            "drawCallback": function(settings) {
                feather.replace();
            }

        });
    </script>
@endsection
