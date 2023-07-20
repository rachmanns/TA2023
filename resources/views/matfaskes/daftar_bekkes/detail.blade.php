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
                        <h2 class="content-header-title float-left">ISI {{ $data_bekkes->master_bekkes->nama_bekkes }} {{ ($data_bekkes->jenis_tujuan == 'ln') ? 'LUAR NEGERI' : 'DALAM NEGERI' }} - {{ $data_bekkes->tahun_anggaran }}</h2>
                    </div>                    
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        {{-- <img src="{{ url('app-assets/images/portrait/small/avatar-s-11.jpg') }}" class="rounded" height="200" width="200" /> --}}
                                        <img src="{{ asset('storage/'.$data_bekkes->foto) }}" class="rounded" height="200" width="200" />
                                        <br>
                                        <div class="mt-1">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#upload">Upload Foto</button>
                                        </div>

                                        <!-- Add Bekkes -->
                                        <div class="modal fade text-left" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modal-title">Upload Foto</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('matfaskes/data-bekkes/update-foto/'.$data_bekkes->id_data_bekkes) }}" class="default-form" autocomplete="off">
                                                        @csrf
                                                        <div class="modal-body"> 
                                                            <div class="text-center">
                                                                <h5 class="mb-1">Preview Foto</h5>
                                                                <img src="{{ asset('storage/'.$data_bekkes->foto) }}" id="fotoPreview" class="rounded" alt="profile image" height="200" width="auto" />
                                                                {{-- <img src="{{ url('app-assets/images/portrait/small/avatar-s-11.jpg') }}" id="fotoPreview" class="rounded" alt="profile image" height="200" width="auto" /> --}}
                                                            </div>
                                                            <div class="form-group mt-1 form-input">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="foto" hidden accept="image/*" name="foto"/>
                                                                    <label class="custom-file-label" for="foto">Upload Foto</label>
                                                                </div>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="d-flex justify-content-between mb-1">
                                <div style="width: 250px;">
                                    <select class="select2 form-control">
                                        <option>Kategori</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary mr-75" data-toggle='modal' data-target='#import'> Import Excell</button>

                                    {{-- Modal Import --}}
                                    <div class="modal fade text-left" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ url('matfaskes/detail-bekkes/preview') }}" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_data_bekkes" value="{{ $data_bekkes->id_data_bekkes }}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modal-title">Upload Excel</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">                    
                                                        <div class="form-group">
                                                            <label for="customFile1">Upload Excell</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="detail_bekkes" required/>
                                                                <label class="custom-file-label">Upload Excell</label>
                                                            </div>
                                                            <div class="text-right">
                                                                <a href="{{ url('template/detail-bekkes') }}" class="text-right" style="font-size: 12px;">
                                                                    <u> Download Template </u>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <a href="/tambah_isi_bekkes"><button class="btn btn-primary">Tambah Isi Bekkes</button></a> --}}
                                    <a href="{{ url('matfaskes/detail-bekkes/create/'.$data_bekkes->id_data_bekkes) }}"><button class="btn btn-primary">Tambah Isi Bekkes</button></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <span class="font-meidum-3 font-weight-bolder">OBAT</span>
                                </div>
                                <hr class="m-0">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th style="min-width: 200px">Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Ket</th>
                                                <th class="text-center" style="min-width: 100px">Aksi</th>
                                            </tr>
                                            {{-- <tr>
                                                <th colspan="7" style="background-color: #EBE9F1; line-height: 2em;">Analgetik/Antipiretik</th>
                                            </tr> --}}
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

        foto.onchange = evt => {
            const [file] = foto.files
            if (file) {
                fotoPreview.src = URL.createObjectURL(file)
            }
        }

        $( document ).ready(function() {
            detail_bekkes_table();
        });

        function detail_bekkes_table() {
            let data = {
                id_data_bekkes: '{{ $data_bekkes->id_data_bekkes }}'
            };

            var table = $('#table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('matfaskes/detail-bekkes/get') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_kategori',
                            visible: false
                        },
                        {
                            data: 'nama_brg'
                        },
                        {
                            data: 'satuan'
                        },
                        {
                            data: 'jml'
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
                    rowGroup: {
                        dataSrc: 'nama_kategori'
                    },
                    "drawCallback": function(settings) {
                        feather.replace();
                    }
            });
        }

        // var table = $('#table').DataTable({
        //     // scrollX: true,
        //     ajax: "{{ url('/app-assets/data/detail-bekkes.json') }}",
        //     columns: [
        //         {
        //             data: 'no'
        //         },
        //         {
        //             data: 'nama'
        //         },
        //         {
        //             data: 'satuan'
        //         },
        //         {
        //             data: 'jumlah'
        //         },
        //         {
        //             data: 'ket'
        //         },                                    
        //         {
        //             data: 'action',
        //             orderable: false,
        //             searchable: false
        //         }
        //     ],
        //     "drawCallback": function(settings) {
        //         feather.replace();
        //     }
        // });
    </script>
@endsection
