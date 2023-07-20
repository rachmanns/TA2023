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
                            <h2 class="content-header-title float-left">Kegiatan Pengadaan - <span id="tahun-text">{{ $tahun }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" class="form-control bg-white yearpicker" placeholder="Periode" id="tahun" value="{{ $tahun }}" autocomplete="off" />
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{ route('matfaskes.pengadaan.create') }}"><button class="btn btn-primary">Tambah
                            Pengadaan</button></a>
                    @include('matfaskes.kegiatan.pengadaan.edit_lapju')
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active ml-2 mr-2 mt-2" id="nav-nakes-tab"
                                                data-toggle="tab" href="#nav-nakes" role="tab" aria-controls="nav-nakes"
                                                aria-selected="true"><span
                                                    class="font-medium-4 font-weight-bolder">Kewenangan Daerah</span></a>
                                            <a class="nav-item nav-link ml-2 mr-2 mt-2" id="nav-paramedis-tab"
                                                data-toggle="tab" href="#nav-paramedis" role="tab"
                                                aria-controls="nav-paramedis" aria-selected="false"><span
                                                    class="font-medium-4 font-weight-bolder">Kewenangan Pusat</span></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-nakes" role="tabpanel"
                                            aria-labelledby="nav-nakes-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped"
                                                    id="table-pengadaan-daerah">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Dipa/Kep Kegiatan</th>
                                                            <th style="min-width: 200px;">Kontrak/SPK</th>
                                                            <th style="min-width: 200px;">Sisa Anggaran</th>
                                                            <th style="min-width: 250px;">Pelaksanaan</th>
                                                            <th style="min-width: 100px;">Lapju Min (%)</th>
                                                            <th style="min-width: 100px;">Lapju Sik (%)</th>
                                                            <th style="min-width: 100px;">Keterangan</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-paramedis" role="tabpanel"
                                            aria-labelledby="nav-paramedis-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped"
                                                    id="table-pengadaan-pusat">
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width: 200px;">Dipa/Kep Kegiatan</th>
                                                            <th style="min-width: 200px;">Kontrak/SPK</th>
                                                            <th style="min-width: 200px;">Sisa Anggaran</th>
                                                            <th style="min-width: 250px;">Pelaksanaan</th>
                                                            <th style="min-width: 100px;">Lapju Min (%)</th>
                                                            <th style="min-width: 100px;">Lapju Sik (%)</th>
                                                            <th style="min-width: 100px;">Keterangan</th>
                                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
        $(function() {
            let tahun = moment().format('YYYY');
            
            $(document).on('change','#tahun',function(){
                pengadaan_list('#table-pengadaan-pusat', 'DIPPUS', $(this).val())
                pengadaan_list('#table-pengadaan-daerah', 'DIPDAR', $(this).val())
                $('#tahun-text').text($(this).val())
            });
            
            pengadaan_list('#table-pengadaan-pusat', 'DIPPUS',tahun)
            pengadaan_list('#table-pengadaan-daerah', 'DIPDAR',tahun)
        })

        function pengadaan_list(selector, kode_dipa,tahun) {
            var table = $(selector).DataTable({
                destroy: true,
                scrollX: true,
                // processing: true,
                // serverSide: true,
                ajax: "{{ url('matfaskes/pengadaan/get') }}" + '/' + kode_dipa+ '/' + tahun,
                columns: [{
                        data: 'dipa_kegiatan',
                        name: 'dipa_kegiatan'
                    },
                    {
                        data: 'kontrak',
                        name: 'kontrak'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'pelaksanaan',
                        name: 'pelaksanaan'
                    },
                    {
                        data: 'lapju_min',
                        name: 'lapju_min'
                    },
                    {
                        data: 'lapju_sik',
                        name: 'lapju_sik'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                },
                "createdRow": function( row, data, dataIndex){
                    if( data['nomor_kontrak'] ==  null){
                        $(row).addClass('bg-light-danger');
                    }
                }
            });
        }

        function edit_lapju(e) {
            var id_kontrak = e.attr('data-id');

            let action = e.attr('data-url');

            $.ajax({
                type: 'GET',
                url: "{{ url('matfaskes/pengadaan/edit-lapju') }}" + '/' + id_kontrak,
                success: function(response) {
                    $('#lapju').modal('show');
                    $('#lapju form').attr('action', action);
                    $("#lapju_min").val(response.lapju_min);
                    $("#lapju_sik").val(response.lapju_sik);
                    $("#keterangan").val(response.keterangan);
                }
            });
        }

    </script>
@endsection
