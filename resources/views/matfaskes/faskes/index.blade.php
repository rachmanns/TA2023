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
                            <h2 class="content-header-title float-left mb-0">Daftar Faskes TNI</h2>
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
                    <select class="select2 form-control form-control-lg" id="filter_k">
                        <option selected disabled>Filter Kotama</option>
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <select class="select2 form-control form-control-lg" id="filter_t">
                        <option value="*">Semua Tipe</option>
                        <option value="FKTP">FKTP</option>
                        <option value="FKTL">FKTL</option>
                        <option value="RSS">RS Sandaran</option>
                    </select>
                </div>
            </div>
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped" id="faskes-table">
                                        <thead>
                                            <tr>
                                                <th class="width-250">Nama Faskes</th>
                                                <th>Matra</th>
                                                <th>Kotama</th>
                                                <th>Satker/Subsatker</th>
                                                <th>Tipe Faskes</th>
                                                <th>Alamat</th>
                                                <th class="text-center">Aksi</th>
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
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table;

        function reload_table() {
            var params = '';
            if ($('#filter_m').val() != '*') params += '&matra=' + $('#filter_m').val();
            if ($('#filter_k').val() != null && $('#filter_k').val() != '') params += '&kotama=' + $('#filter_k').val();
            if ($('#filter_t').val() != '*') params += '&tipe=' + $('#filter_t').val();
            table = $('#faskes-table').DataTable({
                destroy: true,
                processing: true,
                scrollX: true,
                ajax: "{{ url('matfaskes/faskes/list') }}?" + params,
                columns: [{
                        data: 'nama_rs',
                        name: 'nama_rs'
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'kotama',
                    },
                    {
                        data: 'satker',
                    },
                    {
                        data: 'jenis_rs',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
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
                }
            });
        }

        $(document).ready(function() {
            reload_table();

            $('#filter_m').on('select2:select', function(e) {
                $.ajax({
                    url: "{{ url('master/komando/select') }}/" + $(this).val(),
                    method: "GET",
                    dataType: "json",
                    success: function(result) {
                        if ($('#filter_k').data('select2')) {
                            $("#filter_k").val("");
                            $("#filter_k").trigger("change");
                            $("#filter_k").empty().trigger("change");
                        }
                        $("#filter_k").select2({
                            data: result.data,
                            placeholder: "Pilih Kotama",
                            allowClear: true
                        });
                    }
                });
                reload_table();
            });

            $('#filter_k').on('select2:select', function(e) {
                reload_table();
            });

            $('#filter_t').on('select2:select', function(e) {
                reload_table();
            });

            $('#filter_k').on('select2:clear', function(e) {
                reload_table();
            });
        });
    </script>
@endsection
