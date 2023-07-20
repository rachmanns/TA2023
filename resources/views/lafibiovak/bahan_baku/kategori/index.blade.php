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
                            <h2 class="content-header-title float-left">Kategori Bahan Produksi</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            <a data-toggle='modal' data-target='#form_kat'><button class="btn btn-primary">Tambah Kategori</button></a>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left" id="form_kat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Tambah Kategori Bahan Produksi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">     
                                      <form method="post">
                                        <div class="form-group form-input">
                                            <label class="form-label">Nama Kategori*</label>
                                            <input type="text" name="kategori" class="form-control" placeholder="Kategori" required />
                                            <div class="invalid-feedback">Nama harus diisi</div>
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
                                <table class="table table-striped table-responsive-xl" id="kategori">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
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
        table_ = $('#kategori').DataTable({
        ajax: "{{ url('/lafibiovak/kategori-bahan-produksi/list') }}",
        columns: [
            {
                data: 'nama_kategori',
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

        $(".modal-footer button").click(function() {
            if ($('form')[0].checkValidity()) {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('lafibiovak/kategori-bahan-produksi') }}/" + id,
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
                    $('#form_kat').modal('hide');
                });
            } else {
                $('form').addClass('was-validated');
            }
        });

        $("#form_kat").on("hide.bs.modal", function() {
            id = '';
            $('form').attr('method', 'post');
            $('.modal-title').html('Tambah Kategori Bahan Produksi');
            $('.modal-body input').val("");
        });
    });

    function edit_kat(e) {
        id = e.attr('data-id');
        $('form').attr('method', 'put');
        $('.modal-title').html('Edit Kategori Bahan Produksi');
        $('input[name=kategori]').val(e.attr('data-nama'));
        $('#form_kat').modal('show');
    }
    </script>
@endsection