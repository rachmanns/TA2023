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

        table td {
            word-wrap: break-word;
            max-width: 300px;
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
                        <div class="col-md-9 col-10">
                            <h2 class="content-header-title float-left">Transaksi Bahan Produksi {{$data->nama_bahan_produksi}}</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#form_trx'><button class="btn btn-primary">Tambah Transaksi</button></a>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left" id="form_trx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Tambah Transaksi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">     
                                        <form method="post">
                                            <div class="form-group form-input">
                                                <label class="form-label" for="tgl">Tanggal*</label>
                                                <input type="text" id="tgl" class="form-control flatpickr-basic" placeholder="Tanggal" name="tgl" max="new Date()" required />
                                                <div class="invalid-feedback input-tgl">Tanggal harus diisi</div>
                                            </div>
                                            <div class="form-group form-input">
                                                <label class="form-label" for="jml">Jumlah Masuk*</label>
                                                <input type="number" name="jml" class="form-control" placeholder="Jumlah Masuk" required />
                                                <div class="invalid-feedback">Jumlah harus diisi</div>
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
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped table-responsive-xl" id="transaksi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jumlah Masuk</th>
                                            <th class="text-center">Aksi</th>
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
    var id = '',
        table_;
    $(document).ready(function() {
        table_ = $('#transaksi').DataTable({
        ajax: "{{ url('/lafibiovak/transaksi-bahan-produksi/' . request()->segment(3) . '/list') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'tanggal',
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
                data: 'jumlah',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data.toString());
                }
            },
            {   data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });

        $('#tgl').change(function() {
            $('.input-tgl').css('display', 'none');
        });

        $(".modal-footer button").click(function() {
            if ($('form')[0].checkValidity()) {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('lafibiovak/transaksi-bahan-produksi') }}/{{ request()->segment(3) }}/data/" + id,
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
                    $('#form_trx').modal('hide');
                });
            } else {
                $('form').addClass('was-validated');
                if ($('#tgl').val() == '') $('.input-tgl').css('display', 'block');
            }
        });

        $("#form_trx").on("hide.bs.modal", function() {
            id = '';
            $('form').attr('method', 'post');
            $('.modal-title').html('Tambah Transaksi');
            $('.modal-body input').val("");
        });
    });

    function edit_trx(e) {
        id = e.attr('data-id');
        $('form').attr('method', 'put');
        $('.modal-title').html('Edit Transaksi');
        document.querySelector("#tgl")._flatpickr.setDate(e.attr('data-tgl'));
        $('input[name=jml]').val(e.attr('data-jml'));
        $('#form_trx').modal('show');
    }
    </script>
@endsection