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

    .flatpickr-wrapper {
        display: block;
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
                    <h2 class="content-header-title float-left">Daftar Hutang</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2>{{ $hutang->batalyon }}</h2>
                            <p class="font-weight-bold" id="status"></p>
                            <!-- <p>Status: <span class="badge badge-danger ml-1">Belum Lunas</span></p> -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <h4>{{ $hutang->operasi }} - {{ $hutang->jml_personil }} Personil (Indeks : {{ $hutang->indeks }})</h4>
                            <p class="font-weight-bold" id="tgl_lunas"></p>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-12">
                                <span class="text-muted">Jumlah Tagihan</span><br>
                                <h4 class="font-weight-bolder">Rp{{ indonesian_money_format($hutang->jml_tagihan) }}</h4>
                            </div>
                            <div class="col-md-2 col-12">
                                <span class="text-muted">Pembayaran</span><br>
                                <h4 class="font-weight-bolder text-success" id="jml_bayar"></h4>
                            </div>
                            <div class="col-md-2 col-12">
                                <span class="text-muted">Sisa Tagihan</span><br>
                                <h4 class="font-weight-bolder text-danger" id="sisa_tagihan"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <h2 class="content-header-title float-left">Jumlah Cicilan</h2>
            <button class="btn btn-primary" onclick="tambah_cicilan()">Tambah Cicilan</button>
            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah Cicilan</button> --}}
        </div>
        @include('bidum.anggaran.hutang.cicilan_form')
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pembayaran Ke -</th>
                                        <th>Jumlah Pembayaran (RP)</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th class="text-center">Bukti Bayar</th>
                                        <th class="text-center" style="min-width: 100px;">Aksi</th>
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

    $(document).ready(function(){
        status_hutang();
    })

    function tambah_cicilan() {
        $('#add').modal('show');
        $('#id_hutang').val("{{ request()->segment(4) }}")
    }

    $(".flatpickr-false").flatpickr({
        static: true,
        altInput: true,
        altFormat: 'd-m-Y',
        dateFormat: 'Y-m-d'
    });

    var table = $('#table').DataTable({
        // ajax: "{{ url('/app-assets/data/daftar_hutang.json') }}",
        ajax: "{{ url('bidum/anggaran/cicilan/get/'.$hutang->id_hutang) }}",
        scrollX: true,
        columns: [
            {
                data: 'DT_RowIndex'
            },
            {
                data: 'DT_RowIndex'
            },
            {
                data: 'jml_bayar'
            },
            {
                data: 'tgl_bayar'
            },
            {
                data: 'bukti_bayar'
            },
            {
                data: 'action'
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }
    });

    $('#add').on('hidden.bs.modal', function(e) {
        var reset_form = $('#add form')[0];
        $(reset_form).removeClass('was-validated');
        reset_form.reset();
        $("#modal-title").html("Tambah Cicilan")
    })

    function edit_cicilan(e) {
        let id_cicilan = e.attr('data-id');

        let action = `{{ url('bidum/anggaran/cicilan/') }}/${id_cicilan}`;
        var url = `{{ url('bidum/anggaran/cicilan/') }}/${id_cicilan}/edit`;


        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Cicilan");
                $('#add form').attr('action', action);
                $('#id_hutang').val(response.id_hutang);
                $('#jml_bayar').val(response.jml_bayar);
                $("#tgl_bayar").flatpickr({
                    static: true,
                    altInput: true,
                    altFormat: 'd-m-Y',
                    dateFormat: 'Y-m-d',
                    defaultDate: response.tgl_bayar
                });
                $("[name='_method']").val("PUT");
                $('#add').modal('show');
            }
        });
    }

    function status_hutang() {
        $.ajax({
            method: "GET",
            url: `{{ url('bidum/anggaran/status-hutang/'.$hutang->id_hutang) }}`,
            success:function(response) {
                $('#sisa_tagihan').text(`Rp${response.sisa_tagihan}`);
                $('#jml_bayar').text(`Rp${response.cicilan_bayar}`);
                if (response.status == 'Lunas') {
                    $('#status').html(`Status : <span class="badge badge-success ml-1">Sudah Lunas</span>`);
                    $('#tgl_lunas').html(`Tanggal Lunas : ${response.tgl_lunas}`);
                } else {
                    $('#status').html(`Status : <span class="badge badge-danger ml-1">Belum Lunas</span>`);
                }
            }
        });
    }
</script>
@endsection