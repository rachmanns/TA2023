@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
        }

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
                            <h2 class="content-header-title float-left mb-0">Rekap Barang Gudang</h2>
                        </div>
                    </div>
                </div>
            </div>
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-datatable">
                                <nav class="nav-justified">
                                    <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active ml-2 mr-2 mt-2" id="nav-g1-tab" data-toggle="tab"
                                            href="#nav-g1" role="tab" aria-controls="nav-g1" aria-selected="true"><span
                                                class="font-medium-4 font-weight-bolder">Gudang 1</span></a>
                                        <a class="nav-item nav-link ml-2 mr-2 mt-2" id="nav-g2-tab" data-toggle="tab"
                                            href="#nav-g2" role="tab" aria-controls="nav-g2" aria-selected="false"><span
                                                class="font-medium-4 font-weight-bolder">Gudang 2</span></a>
                                        <a class="nav-item nav-link ml-2 mr-2 mt-2" id="nav-g3-tab" data-toggle="tab"
                                            href="#nav-g3" role="tab" aria-controls="nav-g3" aria-selected="false"><span
                                                class="font-medium-4 font-weight-bolder">Gudang 3</span></a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-g1" role="tabpanel"
                                        aria-labelledby="nav-g1-tab">
                                        <div class="table-responsive-lg">
                                            <table class="gudang1 table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No. Kontrak / BA</th>
                                                        <th class="text-center">Jenis Kegiatan</th>
                                                        <th class="text-center">Nama Bekkes / Alkes</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th class="text-center">Exp. Date</th>
                                                        <th class="text-center">Tgl. Pendataan</th>
                                                        <th class="text-center" title="Keterangan diambil dari data Matfaskes">Ket.</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <!--
                                                    <thead>
                                                        <tr>
                                                            <th class="bg-light" colspan="7" height="25">Obat Batuk/Anti Flu</th>
                                                        </tr>
                                                    </thead>
                                                    -->
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-g2" role="tabpanel" aria-labelledby="nav-g2-tab">
                                        <div class="table-responsive-lg">
                                            <table class="gudang2 table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No. Kontrak / BA</th>
                                                        <th class="text-center">Jenis Kegiatan</th>
                                                        <th class="text-center">Nama Bekkes / Alkes</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th class="text-center">Exp. Date</th>
                                                        <th class="text-center">Tgl. Pendataan</th>
                                                        <th class="text-center" title="Keterangan diambil dari data Matfaskes">Ket.</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-g3" role="tabpanel" aria-labelledby="nav-g3-tab">
                                        <div class="table-responsive-lg">
                                            <table class="gudang3 table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No. Kontrak / BA</th>
                                                        <th class="text-center">Jenis Kegiatan</th>
                                                        <th class="text-center">Nama Bekkes / Alkes</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th class="text-center">Exp. Date</th>
                                                        <th class="text-center">Tgl. Pendataan</th>
                                                        <th class="text-center" title="Keterangan diambil dari data Matfaskes">Ket.</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit -- --}}
                                <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel18">Edit Exp Date</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="fp-human-friendly">Exp Date</label>
                                                            <input type="text" id="fp-human-friendly"
                                                                class="form-control flatpickr-human-friendly"
                                                                placeholder="Exp Date" />
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
                </div>
            </section>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <!-- <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> -->
    <script>
        flatpickr.localize(flatpickr.l10ns.id);
        var id, table_1, table_2, table_3, dtpicker;
        $(document).ready(function() {
            $(".flatpickr-human-friendly").flatpickr({
                altInput: true,
                altFormat: 'd/m/Y',
                minDate: "today",
                dateFormat: 'Y-m-d'
            });
            table_load(1);

            $(".modal-footer button").click(function() {
                if (!$('.modal-body input[type=text]').val()) {
                    Swal.fire({
                        title: 'Info',
                        text: 'Tanggal harus diisi',
                    });
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: '{{ route('dobekkes.rekap_barang.update_exp_date') }}',
                    method: 'post',
                    dataType: "json",
                    data: '_token=' + $('meta[name=csrf-token]').attr('content') + '&exp=' + $(
                        '.modal-body input[type=hidden]').val() + '&id=' + id,
                    success: function(res) {
                        if (!res.error) {
                            $('#exp' + id).text($('.modal-body input[type=text]').val());
                            $('[data-id="' + id + '"]').attr('data-exp', $(
                                '.modal-body input[type=hidden]').val());
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                            });
                        }
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan');
                    $('#edit').modal('hide');
                });
            });

            $(".nav-item").click(function() {
                table_load($(this).attr('id').charAt(5));
            });
        });

        function table_load(idg) {
            $('.gudang' + idg).DataTable({
                ajax: '{{ url('dobekkes/rekap-barang/list-barang-gudang') }}/Gudang ' + idg,
                destroy: true,
                order: [[2, 'asc']],
                columns: [
                    {
                        data: 'no'
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'nama_matkes'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'exp_date'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: 'action'
                    },
                ],
                columnDefs: [{
                        className: 'text-center',
                        targets: 2,
                        render: function(datas, type, data, meta) {
                            return (
                                (data.jumlah - (data.brg_out_sum_jml_keluar ?? 0)) + ' ' + data
                                .satuan_brg
                            );
                        }
                    },
                    {
                        targets: 3,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                '<span id="exp' + data.id + '">' +
                                (data.exp_date == '0000-00-00' ? '-' : new Date(data.exp_date)
                                    .toLocaleString('id-ID', {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit'
                                    })) + '</span>'
                            );
                        }
                    },
                    {
                        targets: 4,
                        className: 'text-center',
                        render: function(datas, type, data, meta) {
                            return (
                                new Date(data.created_at).toLocaleString('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                })
                            );
                        }
                    },
                    {
                        className: 'text-center',
                        targets: 5
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                },
            });
        }

        function edit_exp(e) {
            id = e.attr('data-id');
            dtpicker = document.querySelector(".flatpickr-human-friendly")._flatpickr;
            dtpicker.setDate(e.attr('data-exp'));
            $('#edit').modal('show');
        }
    </script>
@endsection
