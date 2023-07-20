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
        td {
            max-width: 250px;
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
                            <h2 class="content-header-title float-left">Daftar Bekkes Satgas Luar Negeri</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 col-4">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun_filter"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-4 text-right">
                    <a data-toggle='modal' data-target='#add'><button class="btn btn-primary">Input Data Satgas LN</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="ln">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 100px">Tahun</th>
                                            <th style="min-width: 150px">Satgas</th>
                                            <th style="min-width: 50px">Jumlah Personil</th>
                                            <th style="min-width: 100px">Nomor Surat</th>
                                            <th class="text-center" style="min-width: 150px">Bekkes Disetujui</th>
                                            <th class="text-center" style="min-width: 100px">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @include('dukkesops.bekkes.satgas_ln.form')
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

        let tahun = ''

        $('#tahun_filter').change(function(){
            tahun = $(this).val()
            dn_list(tahun)
        })

        function dn_list(tahun='') {
            let data = {tahun:tahun}
            $('#ln').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                        url: "{{ url('dukkesops/satgas-ln/list') }}",
                        method: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    },
                columns: [
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'satgas',
                        name: 'satgas'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'no_surat',
                        name: 'no_surat'
                    },
                    {
                        data: 'file_disetujui',
                        name: 'file_disetujui'
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

        function edit_bekkes_duk(e) {
            let id_bekkes_duk = e.attr('data-id');

            let action = `{{ url('dukkesops/satgas-ln') }}/${id_bekkes_duk}`;
            var url = `{{ url('dukkesops/satgas-ln') }}/${id_bekkes_duk}/edit`;


            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Bekkes Satgas Luar Negeri")
                    $('#add form').attr('action', action);
                    $('#tahun').val(response.tahun);
                    $('#satgas').val(response.satgas);
                    $('#jumlah').val(response.jumlah);
                    $('#no_surat').val(response.no_surat);
                    $("[name='_method']").val("PUT");
                    $('#add').modal('show');
                }
            });
        }

        $("#add").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Bekkes Satgas Luar Negeri")
            $('#add form')[0].reset();
            $('#add form').attr('action', "{{ route('dukkesops.satgas-ln.store') }}");
            $("[name='_method']").val("POST");
            $(".dbp").text("Dokumen Bekkes Pengajuan");
            $(".dbd").text("Dokumen Bekkes Disetujui");

        });
    </script>
@endsection
