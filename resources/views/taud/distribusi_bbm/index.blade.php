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

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
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
                        <div class="col-md-9 col-10">
                            <h2 class="content-header-title float-left">Daftar Distribusi BBM <span class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle="modal" data-target="#form_bbm"><button class="btn btn-primary">Tambah Distribusi BBM</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 col-12">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="taud">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Periode</th>
                                            <th class="text-center">Jenis yang diterima</th>
                                            <th class="text-center">Jumlah yang diterima (Liter)</th>
                                            <th class="text-center">Jumlah distribusi (Liter)</th>
                                            <th class="text-center">Sisa (Liter)</th>
                                            <th class="text-center">Ket</th>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal fade text-left" id="form_bbm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel18">Tambah Distribusi BBM</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="form-group form-input">
                                    <label class="form-label" for="tgl">Periode*</label>
                                    <input type="text" id="tgl" class="form-control" placeholder="Periode" name="tanggal" required />
                                    <div class="invalid-feedback input-tgl">Periode harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="jenis">Jenis yang Diterima*</label>
                                    <select class="select2 form-control form-control-lg" id="jenis" name="jenis" required>
                                        <option selected disabled>Jenis BBM</option>
                                        @foreach($jenis as $j)
                                        <option value="{{$j->id_jenis_bbm}}">{{$j->nama_jenis_bbm}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback select-j">Jenis harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="jml">Jumlah Diterima*</label>
                                    <input type="number" name="jml" class="form-control" placeholder="Jumlah Diterima" required max="999999999" />
                                    <div class="invalid-feedback">Jumlah harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="operasional">Jumlah Distribusi*</label>
                                    <input type="number" name="operasional" class="form-control" placeholder="Jumlah Distribusi" required max="999999999" />
                                    <div class="invalid-feedback">Jumlah harus diisi</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="ket">Keterangan</label>
                                    <textarea name="ket" class="form-control" placeholder="Keterangan"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_script')
<script>
    var id = '',
        bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        table_;

    function table_reload() {
        table_ = $('#taud').DataTable({
        ajax: "{{ url('/taud/bbm/list') }}?" + 'tahun=' + $('#periode').val(),
        destroy: true,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'periode',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return bulan[parseInt(data.substr(5))-1];
                }
            },
            {
                data: 'jenis_bbm.nama_jenis_bbm',
                className: 'text-center',
            },
            {
                data: 'jml_in',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'jml_out',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: '',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(full.jml_in - full.jml_out);
                }
            },
            {
                data: 'keterangan',
                className: 'text-center',
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });

        $('.tahun').text($('#periode').val());
    }

    $(document).ready(function() {
        $('#periode').change(function() {
            table_reload();
        });
        $('#periode').val(<?php echo date('Y'); ?>).trigger('change');
        $('#tgl').flatpickr({
            altInput: true,
            altFormat: 'F Y',
            plugins: [
                new monthSelectPlugin({
                    dateFormat: "Y-m",
                })
            ]
        });
        $(".modal-footer button").click(function() {
            if ($('form')[0].checkValidity() && $('#tgl').val() != '' && $('#jenis').val() != null) {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('taud/bbm') }}/" + id,
                    method: $('form').attr('method'),
                    dataType: "json",
                    data: $('form').serialize() + '&_token=' + $('[name="csrf-token"]').attr('content'),
                    success: function(res) {
                        if (!res.error) table_.ajax.reload();
                        Swal.fire({
                            title: 'Info',
                            text: res.message,
                            icon: 'info',
                        });
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan Data');
                    $('#form_bbm').modal('hide');
                });
            } else {
                $('form').addClass('was-validated');
                if ($('#tgl').val() == '') $('.input-tgl').css('display', 'block');
                if ($('#jenis').val() == null) $('.select-j').css('display', 'block');
            }
        });

        $('#jenis').change(function() {
            $('.select-j').css('display', 'none');
        });

        $('#tgl').change(function() {
            $('.input-tgl').css('display', 'none');
        });

        $("#form_bbm").on("hide.bs.modal", function() {
            id = '';
            $('form').attr('method', 'post');
            $('.modal-title').html('Tambah Distribusi BBM');
            $('.modal-body input').val("");
            $('textarea').val("");
            $('#jenis').val(null).trigger('change');
        });
    });

    function edit_bbm(e) {
        id = e.attr('data-id');
        $('form').attr('method', 'put');
        $('.modal-title').html('Edit Distribusi BBM');

        $.ajax({
            type: 'GET',
            url: "{{ url('taud/bbm') }}/" + id,
            success: function(response) {
                document.querySelector("#tgl")._flatpickr.setDate(response.data.periode);
                $('#jenis').val(response.data.id_jenis_bbm).trigger('change');
                $('input[name=jml]').val(response.data.jml_in);
                $('input[name=operasional]').val(response.data.jml_out);
                $('textarea').val(response.data.keterangan);
                $('#form_bbm').modal('show');
            }
        });
    }
</script>
@endsection
