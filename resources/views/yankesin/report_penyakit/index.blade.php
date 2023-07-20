@extends('partials.template')
@section('page_style')
    <style>
        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_length label {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin-right: 0.5rem;
        }

        div.dataTables_wrapper .dataTables_info {
            margin-left: 0.5rem;
        }
    </style>
@endsection
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">

                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Report Penyakit</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control" id="filter_periode">
                    @foreach ($periode as $p)
                        <option value="{{ $p->id_periode }}"
                            @if($p->nama_periode == 'Semester I') selected @endif>
                            {{ $p->nama_periode }}
                        </option>
                    @endforeach
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="filter_tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Filter Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-8 col-12 d-md-block d-none">
                    <a class="btn btn-primary" href="/yankesin/report-penyakit/create">Tambah Report Penyakit</a>
                </div>
            </div>
            <div class="content-body">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <section id="ajax-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0">
                                        <div class="card-datatable">
                                            <div class="tab-content" id="nav-tabContent">
                                            @php $tab = 0; @endphp
                                            @foreach($kat as $k)
                                            <div class="tab-pane fade @if($tab==0) show active @endif" id="tab{{ ++$tab; }}" role="tabpanel"
                                            aria-labelledby="nav-tab{{ $tab; }}">
                                            <div class="alert alert-info mx-2 mt-2" role="alert">
                                                <div class="alert-body">
                                                    <i data-feather="info" class="font-medium-3 mr-75"></i>
                                                    Jumlah yang ditampilkan adalah total jumlah kasus lama dan yang baru  terjadi di setiap matra
                                                </div>
                                            </div>
                                            <table class="table" class="datatables-ajax" id="datatables-ajax{{ $tab; }}">
                                                <thead>
                                                    <tr>
                                                        <th>Jenis Kasus</th>
                                                        <th>TNI AD</th>
                                                        <th>TNI AU</th>
                                                        <th>TNI AL</th>
                                                        <th>TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th id="totalAD">0</th>
                                                        <th id="totalAU">0</th>
                                                        <th id="totalAL">0</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot> -->
                                            </table>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        <!-- <div class="p-2">
                                            <div class="alert alert-info" role="alert">
                                                <h4 class="alert-heading">Info</h4>
                                                <div class="alert-body">
                                                    Jumlah yang ditampilkan adalah total jumlah kasus lama dan yang baru  terjadi di setiap matra
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Data Penyakit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_data" class="form-data-validate" novalidate autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" value="">
                    <div class="modal-body">
                        {{-- <div class="row mb-1"> --}}
                            <table class="table" id="datatables-detail">
                                <thead>
                                    <tr>
                                        <th>Satker</th>
                                        <th>Status</th>
                                        <th>Sebelum</th>
                                        <th>Baru</th>
                                        <th>Sembuh</th>
                                        <th>Meninggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        {{-- </div> --}}

                    </div>
                    {{-- <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            $('#filter_tahun').val(<?php echo date('Y'); ?>);
            table_reload();
            $('#filter_periode').change(function() {
                table_reload();
            });
            $('#filter_tahun').change(function() {
                table_reload();
            });

            $('#modal-form').on('hidden.bs.modal', function(e) {

                var reset_form = $('#form_data')[0];
                $(reset_form).removeClass('was-validated');
                reset_form.reset();

                $("#modal_title").html("Data Penyakit")

                $("#id").val()
                $("#jenis_kasus").val();
                $("#baru").val();
                $("#meninggal").val();
                $("#sembuh").val();
                $("#berobat").val();
                $("#sebelumnya").val();
                $('#status select').val('').trigger('change');
                $('#angkatan select').val('').trigger('change');
                formdata = null

            })

        });

        function table_reload() {
            var param = '?periode=' + $('#filter_periode').val() + '&tahun=' + $('#filter_tahun').val();
                
            var dt_ajax_table = $("#datatables-ajax1");

            if (dt_ajax_table.length) {
                var dt_ajax = dt_ajax_table.dataTable({
                    processing: true,
                    scrollX: true,
                    destroy: true,
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    ajax: "{{ url('yankesin/report-penyakit/list') }}" + param,
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        },
                    },
                    columns: [{
                            data: 'nama_penyakit',
                        },
                        {
                            data: 'AD.total',
                            name: 'TNI AD',
                            render: function(data, col, row) {
                                return '<span title="Detail" style="cursor:pointer" data-penyakit="' +
                                    row.id_penyakit +
                                    '" data-angkatan="AD" onclick="detail($(this))">' + data +
                                    '</span>';
                            },
                        },
                        {
                            data: 'AU.total',
                            name: 'TNI AU',
                            render: function(data, col, row) {
                                return '<span title="Detail" style="cursor:pointer" data-penyakit="' +
                                    row.id_penyakit +
                                    '" data-angkatan="AU" onclick="detail($(this))">' + data +
                                    '</span>';
                            },
                        },
                        {
                            data: 'AL.total',
                            name: 'TNI AL',
                            render: function(data, col, row) {
                                return '<span title="Detail" style="cursor:pointer" data-penyakit="' +
                                    row.id_penyakit +
                                    '" data-angkatan="AL" onclick="detail($(this))">' + data +
                                    '</span>';
                            },
                        },
                        {
                            data: 'total',
                            name: 'TOTAL',
                        },
                    ],
                });
            }
        }

        function detail(params) {
            // alert("detail");
            var param = '?periode=' + $('#filter_periode').val() + '&tahun=' + $('#filter_tahun').val();
            
            $("#modal-form").modal("show");
            var dt_ajax_table_detail = $("#datatables-detail");

            if (dt_ajax_table_detail.length) {
                
                if( $.fn.DataTable.isDataTable( '#datatables-detail' )) $("#datatables-detail").DataTable().destroy();
                
                var dt_ajax = dt_ajax_table_detail.dataTable({
                    processing: true,
                    scrollX: true,
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    ajax: "{{ url('yankesin/report-penyakit/detail') }}/"+ params.data('penyakit') + "/" + params.data('angkatan') + param,
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        },
                    },
                    columns: [
                        {
                            data: 'angkatan.nama_angkatan',
                        },
                        {
                            data: 'status',
                        },
                        {
                            data: 'sebelumnya',
                        },
                        {
                            data: 'baru',
                        },
                        {
                            data: 'sembuh',
                        },
                        {
                            data: 'meninggal',
                        },
                        {
                            data: 'action',
                        },
                    ],
                    "drawCallback": function(settings) {
                        feather.replace();
                    }
                });
            }
            // console.log(params.data('penyakit'))
        }
        var res, formdata;

        Array.prototype.filter.call($('#form_data'), function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    form.classList.add('invalid');
                }
                form.classList.add('was-validated');
                event.preventDefault();

                let id_angkatan = $("#id").val();

                var url = (id_angkatan !== undefined && id_angkatan !== null && id_angkatan) ?
                    "{{ url('yankesin/report-penyakit/update') }}" + "/" + id_angkatan :
                    "{{ url('yankesin/report-penyakit/store') }}";

                $.ajax({
                    url: url,
                    type: 'post',
                    data: $('#form_data').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {

                        if (response.error) {

                            Swal.fire({
                                type: "error",
                                title: 'Oops...',
                                text: response.message,
                                confirmButtonClass: 'btn btn-success',
                            });

                        } else {

                            setTimeout(function() {
                                $('#datatables-ajax').DataTable().ajax.reload();
                            }, 1000);

                            Swal.fire({
                                type: "success",
                                title: 'Success!',
                                text: response.message,
                                confirmButtonClass: 'btn btn-success',
                            });

                        }
                        var reset_form = $('#form_data')[0];
                        $(reset_form).removeClass('was-validated');
                        reset_form.reset();
                        $('#modal-form').modal('hide');
                        $("#modal_title").html("Tambah Data Penyakit")
                        $("#id").val()

                    },
                });

            });

        });

        function edit_data(e) {

            $.ajax({
                url: "{{ url('yankesin/report-penyakit/edit') }}" + "/" + e.attr('data-id'),
                method: "GET",
                dataType: "json",
                success: function(result) {
                    $('#modal-form').modal('show');

                    $("#modal_title").html("Edit Data Penyakit")
                    $('#id').val(result.data.id);
                    $("#jenis_kasus").val(result.data.jenis_kasus);
                    $("#baru").val(result.data.baru);
                    $("#meninggal").val(result.data.meninggal);
                    $("#sembuh").val(result.data.sembuh);
                    $("#berobat").val(result.data.berobat);
                    $("#sebelumnya").val(result.data.sebelumnya);
                    $("#periode").val(result.data.periode);
                    $('#status select').val(result.data.status).trigger('change');
                    $('#angkatan select').val(result.data.angkatan).trigger('change');


                }
            });
        }

        function delete_data(e) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,

            }).then(function(result) {

                if (result.value) {

                    var id = e.attr('data-id');

                    jQuery.ajax({
                        url: "{{ url('yankesin/report-penyakit/delete/') }}" + "/" + id,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            '_method': 'delete'
                        },
                        success: function(result) {

                            if (result.error) {

                                Swal.fire({
                                    type: "error",
                                    title: 'Oops...',
                                    text: result.message,
                                    confirmButtonClass: 'btn btn-success',
                                })

                            } else {

                                setTimeout(function() {
                                    $('#datatables-ajax').DataTable().ajax.reload();
                                }, 1000);

                                Swal.fire({
                                    type: "success",
                                    title: 'Deleted!',
                                    text: result.message,
                                    confirmButtonClass: 'btn btn-success',
                                })

                            }
                        }
                    });

                }
            });
        }
    </script>
@endsection
