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
                    <div class="col-md-9">
                        <h2 class="content-header-title float-left">Daftar Pos Satgas</h2>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ url('dukkesops/pos-satgas/create') }}"><button class="btn btn-primary">Tambah Pos Satgas</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped table-responsive-xl" id="pos-satgas">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pos</th>
                                        <th>Satgas Ops</th>
                                        <th>Garis Lintang</th>
                                        <th>Garis Bujur</th>
                                        <th class="text-center">Endemik</th>
                                        <th class="text-center" style="min-width: 150px;">Aksi</th>
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
    var table = $('#pos-satgas').DataTable({
        destroy: true,
        processing: true,
        ajax: "{{ url('dukkesops/pos-satgas/get') }}",
        // scrollX: true,
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_pos',
                name: 'nama_pos'
            },
            {
                data: 'satgas_ops',
                name: 'satgas_ops'
            },
            {
                data: 'latitude',
                name: 'latitude'
            },
            {
                data: 'longitude',
                name: 'longitude'
            },
            {
                data: 'endemik',
                name: 'endemik'
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

    function show_pos_satgas(e) {
        let id_pos = e.attr('data-id');
        var url = `{{ url('dukkesops/pos-satgas') }}/${id_pos}`;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('#jenis_geografis').html((response.geografis != null)?response.geografis.jenis_geografis:'-');
                $('#pendapatan').html(response.pendapatan);
                $('#kepadatan').html(response.kepadatan);
                $('#ekonomi').html(response.ekonomi);
                $('#sosial').html(response.sosial);
                $('#budaya').html(response.budaya);
                $('#ideologi').html(response.ideologi);
                $('#geomedik').modal('show');
            }
        });
    }

    $("#ps").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Pos Satgas")
        $('#ps form')[0].reset();
        $('#ps form').attr('action', "{{ url('dukkesops/pos-satgas') }}");
        $("[name='_method']").val("POST");
    });
</script>
@endsection