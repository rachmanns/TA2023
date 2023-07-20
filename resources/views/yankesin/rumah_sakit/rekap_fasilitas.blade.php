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
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/fixedColumns.dataTables.min.css')}}">
    {{--
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/fixedHeader.dataTables.min.css')}}">
    --}}
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
                            <h2 class="content-header-title float-left mb-0">Rekap Fasilitas Faskes</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="filter_m">
                        <option value="*">Semua Matra</option>
                        @foreach ($matra as $item)
                        <option value="{{$item->kode_matra}}">{{(($item->kode_matra != 'MABES')?'TNI':''). " ".$item->kode_matra }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="parent_kotama">
                        <option selected disabled>Filter Kotama</option>
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="filter_t">
                        <option value="*">Semua Tipe</option>
                        <option value="FKTP">FKTP</option>
                        <option value="FKTL">FKTL</option>
                    </select>
                </div>
                <div class="col-md-3 col-12 pt-1">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="filter_rss" class="custom-control-input" value="RSS"/>
                        <label class="custom-control-label" for="filter_rss">RS Sandaran Operasi TNI</label>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped" id="table-rs">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Faskes</th>
                                                @foreach($kategori as $k)
                                                <th id="nama{{ $k->id_kategori }}">{{ $k->nama_kategori }}</th>
                                                @endforeach
                                                <th id="namadokter">Jumlah Dokter</th>
                                                <th id="namaparamedis">Jumlah Paramedis</th>
                                                <th id="namaN">Jumlah Nakes Lainnya</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
            <!-- Modal Detail-->
            <div class="modal fade" id="table_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel18">Fasilitas </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section id="multilingual-datatable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border mt-2 mb-0 table-responsive"> 
                                            <table class="table" id="table-detail">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Fasilitas</th>
                                                        <th id="ket">Jumlah</th>
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
            </div>                
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.fixedColumns.min.js') }}"></script>
    {{--
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    --}}
    <script>
        var table, table_d;

        function reload_table() {
            var params = '';
            if ($('#filter_m').val() != '*') params += '&matra=' + $('#filter_m').val();
            if ($('#parent_kotama').val() != null && $('#parent_kotama').val() != '') params += '&kotama=' + $('#parent_kotama').val();
            if ($('#filter_t').val() != '*') params += '&tipe=' + $('#filter_t').val();
            if ($('#filter_rss').prop('checked')) params += '&rss=1';
            table = $('#table-rs').DataTable({
                destroy: true,
                scrollX: true,
                scrollCollapse: true,
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 40, 70, 100, -1],
                             [5, 10, 25, 40, 70, 100, 'Semua']],
                fixedColumns: {
                    left: 2,
                },
                ajax: "{{ url('yankesin/rekap-fasilitas-faskes/list') }}?" + params,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                    },
                    {
                        data: 'nama_rs',
                        className: 'font-weight-bold',
                        render: function(data, col, row) {
                            return '<span id="nama' + row.id_rs + '">' + data + '</span>';
                        },
                    },
                    @foreach($kategori as $k)
                    {
                        data: '{{ $k->id_kategori }}',
                        className: 'text-center font-weight-bold',
                        render: function(data, col, row) {
                            return data ? '<span title="Detail" style="cursor:pointer" onclick="detail_fas(\'{{ $k->id_kategori }}\', ' + row.id_rs + ')">' + data + '</span>' : 'Data Tidak Tersedia';
                        },
                    },
                    @endforeach
                    {
                        data: 'dokter',
                        className: 'text-center font-weight-bold',
                        render: function(data, col, row) {
                            return '<span title="Detail" style="cursor:pointer" onclick="detail_fas(\'dokter\', ' + row.id_rs + ')">' + data + '</span>';
                        },
                    },
                    {
                        data: 'paramedis',
                        className: 'text-center font-weight-bold',
                        render: function(data, col, row) {
                            return '<span title="Detail" style="cursor:pointer" onclick="detail_fas(\'paramedis\', ' + row.id_rs + ')">' + data + '</span>';
                        },
                    },
                    {
                        data: 'nakeslain',
                        className: 'text-center font-weight-bold',
                        render: function(data, col, row) {
                            return '<span title="Detail" style="cursor:pointer" onclick="detail_fas(\'N\', ' + row.id_rs + ')">' + data + '</span>';
                        },
                    },
                ],
            });
            //new $.fn.dataTable.FixedHeader( table );
        }

        $(document).ready(function() {
            reload_table();

            $('#filter_m').on('select2:select', function(e) {
                select_ajax("komando", "kotama", "Kotama", $(this).val());
                $("#parent_kotama").prop("disabled", false);
                reload_table();
            });

            $('#parent_kotama').on('select2:select', function(e) {
                reload_table();
            });

            $('#parent_kotama').on('select2:clear', function(e) {
                reload_table();
            });

            $('#filter_t').on('select2:select', function(e) {
                reload_table();
            });

            $('#filter_rss').on('change', function(e) {
                reload_table();
            });
        });

        function select_ajax(type = "angkatan", parent = "angkatan", placeholder = "Angkatan", parent_id = "") {
            let url_target = "{{ url('master') }}/";
            $.ajax({
                url: url_target + type + "/select/" + parent_id,
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#parent_' + parent).data('select2')) {

                        $("#parent_" + parent).val("");
                        $("#parent_" + parent).trigger("change");
                        $("#parent_" + parent).empty().trigger("change");

                    }

                    $("#parent_" + parent).select2({
                        data: result.data,
                        placeholder: "Pilih " + placeholder,
                        allowClear: true,
                        dropdownParent: parent == 'kotama' ? null : $("#rumah_sakit_modal")
                    });

                }
            });
        }

        function detail_fas(kat, id) {
            table_d = $('#table-detail').DataTable({
                destroy: true,
                ajax: "{{ url('yankesin/rekap-fasilitas-faskes/detail') }}/" + kat + '/' + id,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                    },
                    {
                        data: 'nama_fasilitas',
                    },
                    {
                        data: 'jumlah',
                        render: function(data, x, row) {
                            if (['B', 'G', 'H', 'I', 'J'].includes(kat)) {
                                if (kat == 'B' && row.id_fasilitas != 'PU' && row.id_fasilitas != 'PGU' && row.keterangan) {
                                    return row.keterangan.replace(/\|/g, ', ');
                                } else if (data == 0) return 'Tidak Ada';
                                return 'Ada';
                            }
                            return data;
                        },
                    },
                ],
                "drawCallback": function(settings) {
                    $('.modal-title').html((['dokter', 'paramedis', 'N', 'G'].includes(kat) ? '' : 'Fasilitas ') + $('#nama' + kat).html() + ' ' + $('#nama' + id).html());
                    $('#ket').html(['B', 'G', 'H', 'I', 'J'].includes(kat) ? 'Keterangan' : 'Jumlah');
                    $('#table_detail').modal('show');
                }
            });
        }
    </script>
@endsection
