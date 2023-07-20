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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Data Pagu Anggaran - {{ $year }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-12">
                    <select class="select2 form-control">
                        <option disabled selected>Filter Bidang</option>
                        @foreach ($bidang as $v)
                            <option value="{{ $v->kode_bidang }}">{{ $v->kode_bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-9 col-12 text-right">
                    <button class="btn btn-primary mr-75" data-toggle="modal" data-target="#add">Tambah Pagu</button>
                    <a href="{{ route('bidum.anggaran.pagu_realisasi', $year) }}"><button type="button" class="btn btn-outline-success">Lihat Realisasi</button></a>
                </div>
            </div>

            <!-- Modal Add Pagu -->
            <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel18">Tambah Pagu Anggaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('bidum/anggaran/pagu') }}" class="default-form" autocomplete="off" method="post">
                            @csrf
                            <input type="hidden" name="tahun_anggaran" value="{{ $year }}">
                            <div class="modal-body">
                                <div class="form-group form-input">
                                    <label class="form-label">Bidang</label>
                                    <select class="select2 form-control" name="kode_bidang">
                                        <option disabled selected>Bidang</option>
                                        @foreach ($bidang as $v)
                                            <option value="{{ $v->kode_bidang }}">{{ $v->kode_bidang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Dipa</label>
                                    <select class="select2 form-control" name="kode_dipa">
                                        <option value="DIPPUS">Pusat</option>
                                        <option value="DIPDAR">Daerah</option>
                                    </select>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Akun</label>
                                    <input type="text" class="form-control" placeholder="Akun" name="kode_akun">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Uraian</label>
                                    <input type="text" class="form-control" placeholder="Uraian" name="nama_uraian">
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label">Pagu Awal</label>
                                    <input type="text" class="form-control rupiah" placeholder="Pagu Awal" name="pagu_awal">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Import-->
            <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel18">Import Pagu Anggaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- <form action="{{ route('pagu_anggaran.excel_import') }}" method="post"
                                            enctype="multipart/form-data"> --}}
                            <form action="{{ route('bidum.anggaran.pagu_import') }}" method="post"
                                enctype="multipart/form-data" id="form-data">
                                @csrf
                                {{-- <div class="form-group">
                                                <label class="form-label" for="tahun">Input Tahun Anggaran</label>
                                                <input type="text" id="tahun" class="form-control" placeholder="Input Tahun Anggaran"required />
                                            </div> --}}
                                <div class="form-group">
                                    <label for="customFile1">Pilih File Excel Pagu Anggaran</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile1"
                                            required />
                                        <label class="custom-file-label" for="customFile1">Tambah File</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            {{-- <a href="/import_pagu"><button type="submit" class="btn btn-primary">Upload</button></a> --}}
                            {{-- <button type="button" class="btn btn-primary" id="upload_pagu_anggaran">Upload</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            @include('bidum.anggaran.pagu_anggaran.revisi_modal')
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    {{-- <div class="row">
                        <div class="col-6">
                            <form action="{{ route('pagu_anggaran.excel_import') }}" method="post"
                                enctype="multipart/form-data" class="form-row">
                                @csrf
                                <div class="col-auto">
                                    <input class="form-control" type="file" name="file" id="">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-success" type="submit">Import</button>
                                </div>
                            </form>
                            <a href="{{ route('pagu_anggaran.excel_export') }}" class="btn btn-success">Export</a>
                        </div>
                    </div> --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-pusat-tab"
                                                data-toggle="tab" href="#nav-pusat" role="tab" aria-controls="nav-pusat"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Pusat</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-daerah-tab" data-toggle="tab"
                                                href="#nav-daerah" role="tab" aria-controls="nav-daerah"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Dipa
                                                    Kewenangan Daerah</span></a>
                                        </div>
                                    </nav>
                                    <hr class="mb-0">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pusat" role="tabpanel"
                                            aria-labelledby="nav-pusat-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-pusat">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>BIDANG</th>
                                                            <th>AKUN</th>
                                                            <th style="min-width: 200px;">URAIAN</th>
                                                            <th>PAGU AWAL</th>
                                                            <th>Revisi Pagu (Tambah)</th>
                                                            <th>Revisi Pagu (Kurang)</th>
                                                            <th>Pagu Setelah Revisi</th>
                                                            <th class="text-center" style="min-width: 150px;">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-daerah" role="tabpanel"
                                            aria-labelledby="nav-daerah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-daerah">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>BIDANG</th>
                                                            <th>AKUN</th>
                                                            <th style="min-width: 200px;">URAIAN</th>
                                                            <th>PAGU AWAL</th>
                                                            <th>Revisi Pagu (Tambah)</th>
                                                            <th>Revisi Pagu (Kurang)</th>
                                                            <th>Pagu Setelah Revisi</th>
                                                            <th class="text-center" style="min-width: 150px;">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <table class="dt-nasional table"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_js')
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
@section('page_script')
    <script>
        $(function() {

            var url_pusat = '{{ route('bidum.anggaran.pagu_pusat', ':year') }}';
            url_pusat = url_pusat.replace(':year', '{{ $year }}');

            var url_daerah = '{{ route('bidum.anggaran.pagu_daerah', ':year') }}';
            url_daerah = url_daerah.replace(':year', '{{ $year }}');

            dataTable_pagu(url_pusat, 'pusat');
            dataTable_pagu(url_daerah, 'daerah');

        });

        function dataTable_pagu(url,table) {
            table = $(`#table-${table}`).DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'kode_bidang',
                        name: 'kode_bidang',
                        visible: false
                    },
                    {
                        data: 'kode_akun',
                        name: 'kode_akun'
                    },
                    {
                        data: 'nama_uraian',
                        name: 'nama_uraian'
                    },
                    {
                        data: 'pagu_awal',
                        name: 'pagu_awal'
                    },
                    {
                        data: 'revisi_tambah',
                        name: 'revisi_tambah'
                    },
                    {
                        data: 'revisi_kurang',
                        name: 'revisi_kurang'
                    },
                    {
                        data: 'pagu_revisi',
                        name: 'pagu_revisi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                // order: [[ 1, 'desc' ]],
                drawCallback: function ( settings ) {
                    feather.replace();
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(1, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<th colspan="8" class="group text-center font-medium-4" style="background-color:#F3F2F7;">' +
                                group + '</th>'
                            );

                            last = group;
                        }
                    });
                }
            });
        }

        function revisi(e) {
            let id_uraian = e.attr('data-id');
            let url = `{{ route('bidum.anggaran.revisi_pagu', ':id_uraian') }}`;
            url = url.replace(':id_uraian', id_uraian)

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $('#revisi-modal').modal('show')
                    $('#pagu').val(formatRupiah(response.data.pagu_awal.toString(),'Rp'))
                    $('#pagu_terakhir').val(formatRupiah(response.data.pagu_terakhir.toString(),'Rp'))
                    $('#id_uraian').val(response.data.id_uraian)
                }
            });
        }

        $("input[name='operator']").change(function() {

            var radioValue = this.value
            let nilai = $('#nilai').val()
            nilai = parseInt(nilai.replace('Rp','').replaceAll(".",''))
            count_revisi(nilai,radioValue)
        });

        $("#nilai").keyup(function(){
            let nilai = this.value
            nilai = parseInt(nilai.replace('Rp','').replaceAll(".",''))
            let operator = $("input[name='operator']:checked").val();
            if (operator != undefined) {
                count_revisi(nilai,operator)
            }

        });
        

        function count_revisi(nilai, operator) {
            let pagu = $('#pagu_terakhir').val()
            pagu = parseInt(pagu.replace('Rp','').replaceAll(".",''))
            
            if (operator == 'tambah') {
                let revisi = pagu + nilai
                $('#revisi').val(formatRupiah(revisi.toString(),'Rp'))
            } else {
                let revisi = pagu - nilai;
                if (revisi < 0) revisi = 0;
                $('#revisi').val(formatRupiah(revisi.toString(),'Rp'))
            }
        }

        var rupiah = document.getElementsByClassName('rupiah')
        for (const rp of rupiah) {
            rp.addEventListener('keyup', function(e) {
                rp.value = formatRupiah(this.value, 'Rp. ');
            });
        }

        $("#revisi-modal").on("hide.bs.modal", function () {

            var reset_form = $('#revisi-modal form')[0];
            reset_form.reset();

        });

        $("#add").on("hide.bs.modal", function() {
            $('#add form')[0].reset();
        });
    </script>
@endsection
