@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                <div class="content-header-left col-md-12 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-6">
                            <h2 class="content-header-title float-left mb-0">Pangkat</h2>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create_pangkat_modal">Tambah
                                Pangkat</button>
                        </div>
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
                                    <table class="table table-striped table-responsive-xl" id="pangkat-table">
                                        <thead>
                                            <tr>
                                                <th>Matra</th>
                                                <th>Nama Pangkat</th>
                                                <th>Masa Kenkat</th>
                                                <th>Jenis Pangkat</th>
                                                <th>Next Pangkat</th>
                                                <th>Usia Pensiun</th>
                                                <th class="text-center" style="min-width: 150px;">Aksi</th>
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
    @include('bidum.master.pangkat.create')

    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        var table = $('#pangkat-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: `{{ route('pangkat.list') }}`,
            columns: [{
                    data: 'kode_matra',
                    name: 'kode_matra'
                },
                {
                    data: 'nama_pangkat',
                    name: 'nama_pangkat'
                },
                {
                    data: 'masa_kenkat',
                    name: 'masa_kenkat'
                },
                {
                    data: 'jenis_pangkat',
                    name: 'jenis_pangkat'
                },
                {
                    data: 'next_pangkat',
                    name: 'next_pangkat'
                },
                {
                    data: 'usia_pensiun',
                    name: 'usia_pensiun'
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

        function edit_pangkat(e) {
            let id_pangkat = e.attr('data-id');

            let action = `{{ route('pangkat.update', ':pangkat') }}`;
            var url = `{{ route('pangkat.edit', ':pangkat') }}`;

            url = url.replace(':pangkat', id_pangkat);
            action = action.replace(':pangkat', id_pangkat);


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Pangkat")
                    $("[name='_method']").val("PUT");
                    $('#create_pangkat_modal form').attr('action', action);
                    $('#kode_matra').val(response.kode_matra).trigger('change');
                    $('#nama_pangkat').val(response.nama_pangkat);
                    $('#masa_kenkat').val(response.masa_kenkat);
                    $('#jenis_pangkat').val(response.jenis_pangkat);
                    $('#usia_pensiun').val(response.usia_pensiun);
                    var check_next_pangkat = setInterval(function() {
                        if ($('#next_pangkat option').length) {
                            $('#next_pangkat').val(response.next_pangkat).trigger('change');
                            clearInterval(check_next_pangkat);
                        }
                    }, 100);
                    $('#create_pangkat_modal').modal('show');
                }
            });
        }

        $('#kode_matra').change(function() {
            let kode_matra = $(this).val();
            next_pangkat("{{ url('master/pangkat/next-pangkat') }}", 'next_pangkat', "Pangkat Selanjutnya",
                kode_matra)
        });

        function next_pangkat(url, field, placeholder, kode_matra) {
            $('#' + field).empty().trigger("change");
            $.ajax({
                url: url + '/' + kode_matra,
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#' + field).data('select2')) {

                        $("#" + field).val("");
                        $("#" + field).trigger("change");
                        $("#" + field).empty().trigger("change");

                    }

                    $("#" + field).select2({
                        data: result.data,
                        placeholder: "Pilih " + placeholder,
                        allowClear: true,
                        dropdownParent: $('#create_pangkat_modal')
                    });
                    $('#' + field).prop('disabled', false)
                }
            });
        }

        $("#create_pangkat_modal").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Pangkat")

            $('#create_pangkat_modal form')[0].reset();
            $('#create_pangkat_modal form').attr('action', "{{ route('pangkat.store') }}");
            $("#next_pangkat").empty().trigger("change");
            $("[name='_method']").val("POST");

        });
    </script>
@endsection
