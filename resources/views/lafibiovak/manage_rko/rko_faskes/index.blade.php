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
                        <div class="col-md-8 col-12">
                            <h2 class="content-header-title float-left">Data RKO Faskes - TA <span
                                    class="tahun"><?php echo date('Y'); ?></span></h2>
                        </div>
                        <div class="col-md-4 col-12 text-right">
                            <a href="/lafibiovak/rko/faskes"><button class="btn btn-primary">Cek/Upload RKO Faskes</button></a>
                            <!--<a href="/lafibiovak/rko/form"><button class="btn btn-primary">Tambah RKO</button></a>-->
                        </div>
                        <div class="col-12 mt-1">
                            <div class="demo-spacing-0">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <div class="alert-body">
                                        <i data-feather="info" class="mr-50 align-middle"></i>
                                        <span>Sejumlah <b id="jml-faskes"></b> faskes belum mengumpulkan RKO untuk anggaran
                                            <span class="tahun"><?php echo date('Y'); ?></span>. Cek daftar faskes dengan klik
                                            <b>Cek/Upload RKO Faskes</b>.</span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="status">
                            <option disabled>Status Pengajuan</option>
                            <option selected>Disetujui</option>
                            <option>Menunggu Persetujuan</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="periode_setiap_bidang"
                            class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group form-input">
                        <select class="select2 form-control form-control-lg" id="jenis">
                            <option selected disabled>Filter FKTP/FKTL</option>
                            <option value="*" selected>Semua</option>
                            <option>FKTP</option>
                            <option>FKTL</option>
                            <option value="RSS">RS Sandaran</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="rko">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center pl-3 pr-3">Aksi</th>
                                            <th>Faskes</th>
                                            <th class="text-center">FKTP/FKTL</th>
                                            <th class="text-center">Tanggal Pengajuan</th>
                                            @foreach ($data as $d)
                                                <th class="text-center">{{ $d->nama_produk }}</th>
                                            @endforeach
                                        </tr>
                                        <tr id="thstatus">
                                            <th colspan="3" class="bg-light"></th>
                                            <th colspan="2" class="bg-light" height="25">Total Kebutuhan Obat</th>
                                            @foreach ($data as $d)
                                                <th class="text-center bg-light" id="th{{ $d->id_produk }}"></th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                </table>
                                {{-- Reject --}}
                                <div class="modal fade text-left" id="reject" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel18">Penolakan RKO Faskes</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="fp-human-friendly">Alasan Penolakan</label>
                                                            <textarea class="form-control" placeholder="Alasan Penolakan" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Simpan</button>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.js') }}"></script>
    <script>
        var param = '',
            id = '',
            table_;

        function table_reload() {
            param = '';
            param += '&status=' + $('#status').val();
            param += '&tahun=' + $('#periode_setiap_bidang').val();
            if ($('#jenis').val() != '*' && $('#jenis').val() != null) param += '&jenis=' + $('#jenis').val();

            table_ = $('#rko').DataTable({
                scrollX: true,
                ajax: "{{ url('/lafibiovak/rko/list') }}?" + param,
                destroy: true,
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: '',
                        render: function(data, type, full, meta) {
                            return ("<span class='font-weight-bolder'>" + full.nama_rs + "</span> <br> " +
                                full.email + " <br> " + full.no_telp);
                        }
                    },
                    {
                        data: 'jenis_rs',
                        className: 'text-center',
                    },
                    {
                        data: 'waktu_pengajuan',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<span style="display:none">' + data + '</span>' + (new Date(data).toLocaleString('id-ID', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }));
                        }
                    },
                    @foreach ($data as $d)
                        {
                            data: '{{ $d->nama_produk }}',
                            className: 'text-center',
                        },
                    @endforeach
                ],
                buttons: [
                    'excelHtml5',
                ],
                dom: '<""<"head-label"><"text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-3"l><"col-sm-12 col-md-8 pr-0"f><"col-sm-12 col-md-1 gx-0 text-right pl-0"B>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                "drawCallback": function(settings) {
                    $('.buttons-excel').addClass('btn btn-primary mt-50 p-50').html('<i class="font-medium-2 mr-50" data-feather="download"></i> Excel');
                    feather.replace();
                }

            });

            if ($('#status').val() == 'Disetujui') {
                $.ajax({
                    url: "{{ url('/lafibiovak/rko/total') }}?" + param,
                    method: 'get',
                    dataType: "json",
                    success: function(res) {
                        if (!res.error) {
                            for (i = 0; i < res.data.length; i++) {
                                $('#th' + res.data[i].id_produk).html(res.data[i].jml);
                            }
                            $('#jml-faskes').text(res.belum_lapor);
                            $('.tahun').text($('#periode_setiap_bidang').val());
                            $('#thstatus').css('display', '');
                        }
                    }
                });
            } else $('#thstatus').css('display', 'none');
        }

        function approve(e) {
            id = e.attr('data-id');
            Swal.fire({
                title: 'Setujui RKO ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Setujui'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.prop('disabled', true);
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/lafibiovak/rko/approve') }}/" + id,
                        success: function(res) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Info',
                                text: res.message
                            });
                            if (!res.error) table_reload();
                        }
                    });
                }
            });
        }

        function reject(e) {
            id = e.attr('data-id');
            $('#reject').modal('show');
        }

        $(document).ready(function() {
            $('#periode_setiap_bidang').val(<?php echo date('Y'); ?>);
            table_reload();
            $('#status').change(function() {
                table_reload();
            });
            $('#jenis').change(function() {
                table_reload();
            });
            $('#periode_setiap_bidang').change(function() {
                table_reload();
            });
            $(".modal-footer button").click(function() {
                if (!$('textarea').val()) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Alasan harus diisi',
                    });
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/lafibiovak/rko/reject') }}/" + id,
                    dataType: "json",
                    data: 'reason=' + $('textarea').val(),
                    success: function(res) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: res.message
                        });
                        if (!res.error) table_reload();
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan');
                    $('#reject').modal('hide');
                });
            });
        });
    </script>
@endsection
