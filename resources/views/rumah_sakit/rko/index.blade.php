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
                        <div class="col-md-10 col-10">
                            <h2 class="content-header-title float-left">Daftar Pengajuan RKO</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                            readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                @if(!isset(Auth::user()->id_faskes))
                <div class="col-md-3">
                    <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="status">
                            <option disabled>Status Pengajuan</option>
                            <option value="*">Semua</option>
                            <option selected value="Belum">Belum Mengajukan</option>
                            <option>Disetujui</option>
                            <option>Menunggu Persetujuan</option>
                            <option>Ditolak</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                @endif
                <div class="col-md-6 text-right">
                    <a href="/lafibiovak/rko/download_template" target="_blank"><button class="btn btn-primary">Download Template RKO</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="rko">
                                    <thead>
                                        <tr>
                                            @if(!Auth::user()->id_faskes)
                                            <th class="text-center">Nama Faskes</th>
                                            @endif
                                            <th class="text-center">Tanggal Pengajuan</th>
                                            <th class="text-center">Tahun Anggaran</th>
                                            <th class="text-center">Status Pengajuan</th>
                                            @if(!Auth::user()->id_faskes)
                                            <th class="text-center">Keterangan</th>
                                            @endif
                                            <th class="text-center">File</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            {{-- Modal Add --}}
                            <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18">Upload RKO</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">     
                                          <form>
                                            <label class="form-label">Faskes</label>
                                            <div class="form-group form-input">
                                                <input type="text" id="nama_rs" class="form-control" readonly />
                                                <input type="hidden" name="faskes" required />
                                            </div>
                                            <label class="form-label">Tahun Anggaran*</label>
                                            <div class="input-group input-group-merge form-input">
                                                <input type="number" name="tahun" id="periode_form"
                                                    class="form-control" readonly
                                                    required />
                                                <div class="invalid-feedback">Tahun harus diisi</div>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="customFile1">Dokumen RKO*</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input" id="customFile1"
                                                        accept=".xlsx" required />
                                                    <label class="custom-file-label" for="customFile1">Dokumen RKO</label>
                                                    <div class="invalid-feedback">Dokumen harus diisi</div>
                                                </div>
                                            </div>
                                            @csrf
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
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
    var param = '',
        id = '',
        table_;

    function table_reload() {
        param = 'tahun=' + $('#periode').val();
        if ($('#status').val() != '*') param += '&status=' + $('#status').val();

        table_ = $('#rko').DataTable({
        scrollX: true,
        destroy: true,
        ajax: "{{ url('/lafibiovak/rko/list-faskes') }}?" + param,
        order: [],
        columns: [
            @if(!Auth::user()->id_faskes)
            {
                data: 'nama_rs'
            },
            @endif
            {
                data: 'waktu_pengajuan',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!data ? '-' :
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: 'numeric'
                        })
                    );
                }
            },
            {
                data: 'periode_pengajuan',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (data ?? $('#periode').val())
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    if (!data) data = 'Belum Mengajukan';
                    else if (data == 'Ditolak') data += '<br /><br /> Alasan:<br />' + full.reject_reason;
                    return (
                        "<div class='badge badge-light-" + (data == 'Disetujui' ? 'primary' : data == 'Menunggu Persetujuan' ? 'success' : data == 'Ditolak' ? 'secondary' : 'danger') + " font-small-4'>" + data + '</div>'
                    );
                }
            },
            @if(!Auth::user()->id_faskes)
            {
                data: '',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!full.confirmed_at ? '' :
                        '<div class="mt-50"><b>' + full.status +
                            '</b> oleh <b>' + full.confirmed_by + '</b> pada <b>' + new Date(full.confirmed_at).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: 'numeric'
                        }) + '</b></div>'
                    );
                }
            },
            @endif
            {
                data: 'id_rko',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!data ? '-' :
                        '<div class="mt-50"><a href="{{url("lafibiovak/rko/download")}}/' + data +
                            '" target="_blank"><i data-feather="download" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>'
                    );
                }
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

        function edit_rko(e) {
            $('input[name=faskes]').val(e.attr('data-id'));
            $('#nama_rs').val(e.attr('data-nama'));
            $('input[name=tahun]').val($('#periode').val());
            $('#add').modal('show');
        }

        $(document).ready(function() {
            $("#add").on("hide.bs.modal", function() {
                id = '';
                $('.modal-body input').val("");
                $('#periode_form').val(<?php echo date('Y'); ?>);
            });

            $(".modal-footer button").click(function() {
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    form_data = new FormData($('form')[0]);
                    $.ajax({
                        url: "{{ url('/lafibiovak/rko/upload') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: form_data,
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
                        $('#add').modal('hide');
                    });
                } else {
                    $('form').addClass('was-validated');
                    if ($('input[name=tahun]').val() == '') $('.input-group-append').css('display', 'none');
                }
            });

            $('#periode').change(function() {
                table_reload();
            });
            $('#status').change(function() {
                table_reload();
            });
            $('#periode').val(<?php echo date('Y'); ?>).trigger('change');
            $('#periode_form').val(<?php echo date('Y'); ?>);
        });
    </script>
@endsection
