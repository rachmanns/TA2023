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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left">Daftar Matkes</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <input type="text" id="tahun" class="form-control bg-white yearpicker" placeholder="Periode" autocomplete="off"  />
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row mb-2">
                <div class="col-md-3">
                    <select class="select2 form-control form-control-lg">
                        <option selected disabled>No Kontrak</option>
                        <option value="1">No Kontrak 1</option>
                        <option value="2">No Kontrak 2</option>
                    </select>
                </div>
                <div class="col-md-9 text-right">
                    <button class="btn btn-primary">Ekspor Data</button>
                </div>
            </div> -->
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped" id="data-matkes-table">
                                        <thead>
                                            <tr>
                                                <th>Matkes</th>
                                                <th>Tahun</th>
                                                <th>No. Kontrak/Hibah/TKTM</th>
                                                {{-- <th>Nama Matkes</th> --}}
                                                <th>Total Masuk</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Sisa</th>
                                                <th>Keterangan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>                
                @include('matfaskes.data_matkes.detail')
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>

        $(function() {
            data_matkes_table(moment().format('YYYY'))

            $(document).on('change', '#tahun', function() {
                data_matkes_table($(this).val());
            });
        })
        
        function data_matkes_table(tahun) {
            var table = $('#data-matkes-table').DataTable({
                destroy: true,
                processing: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('matfaskes/data-matkes/list') }}",
                    method: 'POST',
                    data:{
                        tahun: tahun
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'jenis_matkes'
                    },
                    {
                        data: 'tahun'
                    },
                    {
                        data: 'nomor_brg_masuk',
                        name: 'nomor_brg_masuk'
                    },
                    // {
                    //     data: 'no_barang_masuk',
                    //     name: 'no_barang_masuk'
                    // },
                    // {
                    //     data: 'nama_matkes',
                    //     name: 'nama_matkes'
                    // },
                    {
                        data: 'jml_brg_matfas',
                        name: 'jml_brg_matfas'
                    },
                    // {
                    //     data: 'jumlah',
                    //     name: 'jumlah'
                    // },
                    {
                        data: 'jml_keluar',
                        name: 'jml_keluar'
                    },
                    // {
                    //     data: 'brg_out_sum_jml_keluar',
                    //     name: 'brg_out_sum_jml_keluar'
                    // },
                    {
                        data: 'sisa',
                        name: 'sisa'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }



        function detail(e) {
            let id = e.attr('data-id');
            let nk = e.attr('data-nk');

            $('#nomor_kontrak_text').text(nk)
            $('#detail_matkes').modal('show')
            var table = $('#detail-table').DataTable({
                destroy:true,
                // scrollX: true,
                ajax:`{{ url('matfaskes/data-matkes/detail/${id}') }}`,
                columns: [
                    {
                        data: 'nama_matkes',
                        name: 'nama_matkes'
                    },
                    {
                        data: 'brg_out_sum_jml_keluar',
                        name: 'brg_out_sum_jml_keluar'
                    },
                    {
                        data: 'penerima',
                        name: 'penerima'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
@endsection
