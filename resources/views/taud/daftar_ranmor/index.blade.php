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
                        <div class="col-9">
                            <h2 class="content-header-title float-left mb-0">Daftar Kekuatan Ranmor Puskes TNI</h2>
                        </div>
                        <div class="col-3 text-right">
                            <a data-toggle='modal' data-target='#form_ranmor'><button class="btn btn-primary">Tambah Ranmor</button></a>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left" id="form_ranmor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel18">Tambah Ranmor</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">     
                                        <form method="post">
                                        @include('taud.daftar_ranmor.create')
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
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-datatable">
                                <table class="table table-responsive-xl" id="ranmor">
                                    <thead>
                                        <tr>
                                          <th class="tg-g6o6 text-center" width="30">No.</th>
                                          <th class="tg-g6o6">Merk</th>
                                          <th class="tg-yd5g text-center">No. Reg</th>
                                          <th class="tg-yd5g text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
    var id = '',
        table_;
    $(document).ready(function() {
        table_ = $('#ranmor').DataTable({
        ajax: "{{ url('/taud/ranmor/list') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'merk',
                orderable: false,
            },
            {
                data: 'no_reg',
                className: 'text-center',
                orderable: false,
            },
            {   data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            { data: 'jenis_ranmor', visible: false },
        ],
        "drawCallback": function(settings) {
            feather.replace();
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(4, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr><th></th><th colspan="3" height="25">' + group + '</th></tr>'
                    );

                    last = group;
                }
            });
        }

        });

        $(".modal-footer button").click(function() {
            if ($('form')[0].checkValidity() && $('#jenis').val() != null) {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                $.ajax({
                    url: "{{ url('taud/ranmor') }}/" + id,
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
                    $('#form_ranmor').modal('hide');
                });
            } else {
                $('form').addClass('was-validated');
                if ($('#jenis').val() == null) $('.select-j').css('display', 'block');
            }
        });

        // $('select').select2({
        //     tags: true,
        //     createTag: function (params) {
        //     var term = $.trim(params.term);
        //     if (term === '') return null;
        //     return {
        //         id: term,
        //             text: 'Jenis baru: ' + term,
        //             newTag: true
        //         }
        //     },
        //     templateSelection: function (data) {
        //         return data.text.indexOf('Jenis baru:') == -1 ? data.text : data.text.substr(12);
        //     },
        // });

        $('#jenis').change(function() {
            $('.select-j').css('display', 'none');
        });

        $("#form_ranmor").on("hide.bs.modal", function() {
            id = '';
            $('form').attr('method', 'post');
            $('.modal-title').html('Tambah Ranmor');
            $('.modal-body input').val("");
            $('#jenis').val(null).trigger('change');
        });
    });

    function edit_ranmor(e) {
        id = e.attr('data-id');
        $('form').attr('method', 'put');
        $('.modal-title').html('Edit Ranmor');

        $.ajax({
            type: 'GET',
            url: "{{ url('taud/ranmor') }}/" + id,
            success: function(response) {
                $('#jenis').val(response.data.jenis_ranmor).trigger('change');
                $('input[name=merk]').val(response.data.merk);
                $('input[name=no_reg]').val(response.data.no_reg);
                $('#form_ranmor').modal('show');
            }
        });
    }
    </script>
@endsection