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
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="content-header-title">Detail Daftar Barang Keluar </h2>
                            <h3 class="content-header-title">Tanggal : {{ date_format(date_create_from_format('Y-m-d', $data->tgl_keluar), 'd/m/Y') }}</h3>
                            <h3 class="content-header-title">Tujuan : {{ $data->penerima }} @if($data->batalyon) {{ ', ' . $data->batalyon }} @endif</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="data-barang-keluar table table-striped table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. Kontrak</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Ket</th>
                                            <th style="width:45px">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Modal Edit-->
                <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Edit Jumlah Barang Keluar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label class="form-label" for="nama">Nama Barang</label>
                                        <input type="text" id="nama" class="form-control" readonly />
                                        <input type="hidden" name="id" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="jumlah">Jumlah</label>
                                        <input type="number" id="jumlah" name="jml" class="form-control" placeholder="Jumlah" required min="1" />
                                        <div class="invalid-feedback">Jumlah harus diisi</div>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Simpan Data</button>
                            </div>
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
    var table_;
    $( document ).ready(function() {
        table_ = $('.data-barang-keluar').DataTable({
            // scrollX: true,
            ajax: '{{ route("dobekkes.barang_keluar.list_barang_keluar", request()->segment(3)) }}',
            columns: [
              { data: 'DT_RowIndex' },
              { data: 'no' },
              { data: 'nama_matkes' },
              { data: 'satuan_brg' },
              { data: 'jml_keluar' },
              { data: 'keterangan' },
              { data: 'action' },
            ],
            columnDefs: [
              {
                targets: [0, 3, 4],
                className: 'text-center',
              },
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
        $('.modal-footer button').click(function() {
            $('form').removeClass('was-validated');
            if ($('form')[0].checkValidity()) {
                Swal.fire({
                    title: 'Ubah jumlah barang keluar menjadi ' + $('#jumlah').val() + ' dan retur ' + (parseInt($('#jumlah').attr('max')) + 1 - $('#jumlah').val()) + ' ?',
                    text: "Barang yang diretur bisa dikeluarkan kembali melalui metode Spontan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {

                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: '{{ url("dobekkes/barang-keluar/update-barang-keluar") }}/',
                    method: 'post',
                    dataType: "json",
                    data: $('form').serialize(),
                    success: function(res) {
                        Swal.fire({
                            title: 'Info',
                            text: res.message,
                        });
                        table_.ajax.reload();
                    }
                }).always(function() {
                    $(".modal-footer button").prop('disabled', false);
                    $(".modal-footer button").text('Simpan Data');
                    $('#edit').modal('hide');
                });

                    }
                });
            } else $('form').addClass('was-validated');
        });
    });

    function edit_brg(e) {
        $('[name=id]').val(e.attr('data-id'));
        $('#nama').val(e.attr('data-nama'));
        $('#jumlah').val(e.attr('data-jml'));
        $('#jumlah').attr('max', e.attr('data-jml') - 1);
        $('.invalid-feedback').text('Jumlah harus diisi dan diantara 1-' + $('#jumlah').attr('max'));
        $('#edit').modal('show');
    }

    function hapus_brg(e) {
        Swal.fire({
            title: 'Retur semua barang ini?',
            text: "Barang yang diretur bisa dikeluarkan kembali melalui metode Spontan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url("dobekkes/barang-keluar/hapus-barang-keluar") }}/' + e.attr('data-id'),
                    success: function (response) {
                        if (!response.error) {
                            Swal.fire(
                                'Info',
                                response.message,
                                'success'
                            );
                            table_.ajax.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endsection
