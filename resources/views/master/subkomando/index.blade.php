@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
@section('main')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">

                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Master Data Satker & Sub Satker</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Tambah Satker / Sub Satker</button>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="table" id="datatables-ajax">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Matra</th>
                                                <th>Kotama</th>
                                                <th>Satker</th>
                                                <th>Sub Satker</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Tambah Satker / Sub Satker</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_data" class="form-data-validate" novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_angkatan" id="id_angkatan" value="">
                    <div class="modal-body">
                        <input type="hidden" name="kode_matra" id="kode_matra" value="">
                        <div class="row mb-1">
                            <div class="col-md-3 col-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="sat" value="sat" name="level" class="custom-control-input" checked />
                                    <label class="custom-control-label" for="sat">Satker</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="sub" value="sub" name="level" class="custom-control-input" />
                                    <label class="custom-control-label" for="sub">Sub Satker</label>
                                </div>
                            </div>
                        </div>
                        <label>Kotama: </label>
                        <div class="form-group">
                            <select class="form-control" id="parent" name="parent"></select>

                            <div class="invalid-feedback">Please Select Kotama</div>
                        </div>


                        <label>Satker: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Satker" name="nama_angkatan" id="nama_angkatan"
                                required class="form-control" />
                            <div id="satker" style="display:none">
                                <select class="form-control" name="satker"></select>
                            </div>
                            <div class="invalid-feedback">Please enter Satker Name.</div>
                        </div>

                        <label class="subsatker" style="display:none">Sub Satker: </label>
                        <div class="subsatker" class="form-group" style="display:none">
                            <input type="text" placeholder="Sub Satker" name="subsatker" id="subsatker"
                                class="form-control" />
                            <div class="invalid-feedback">Please enter name for Sub Satker.</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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

            $('#modal-form').on('hidden.bs.modal', function(e) {

                var reset_form = $('#form_data')[0];
                $(reset_form).removeClass('was-validated');
                reset_form.reset();

                $("#modal_title").html("Tambah Satker / Sub Satker")

                $("#id_angkatan").val()
                $("#kode_matra").val()
                $("#nama_angkatan").val('')
                $("#subsatker").val('')
                $('#parent').val('').trigger('change');
                $('#satker select').val('').trigger('change');
                $('#sat').click();
                formdata = null

            })



            $.ajax({
                url: "{{ url('master/komando/select') }}",
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#parent').data('select2')) {

                        $("#parent").val("");
                        $("#parent").trigger("change");
                        $('#parent').empty().trigger("change");

                    }

                    $("#parent").select2({
                        data: result.data,
                        dropdownParent: $('#modal-form') 
                    });

                }
            });
            var dt_ajax_table = $("#datatables-ajax");

            if (dt_ajax_table.length) {
                var dt_ajax = dt_ajax_table.dataTable({
                    processing: true,
                    // scrollX: true,
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    ajax: "{{ url('master/subkomando/list') }}",
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'kode_matra',
                            name: 'Matra'
                        },
                        {
                            data: 'kotama',
                        },
                        {
                            data: 'satker',
                        },
                        {
                            data: 'sub',
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                        //   {data: 'phone', name: 'phone'},
                    ],
                    "drawCallback": function(settings) {
                        feather.replace();
                    }
                });
            }

            $('input[type=radio').click(function(e) {
                if ($(this).attr('id') == 'sat') {
                    $("#nama_angkatan").css("display", "");
                    $("#nama_angkatan").prop("required", true);
                    $("#satker").css("display", "none");
                    $(".subsatker").css("display", "none");
                    $("#subsatker").prop("required", false);
                } else {
                    $("#nama_angkatan").prop("required", false);
                    $("#subsatker").prop("required", true);
                    if (res && res.length > 0) {
                        $("#nama_angkatan").css("display", "none");
                        $("#satker").css("display", "");
                        $(".subsatker").css("display", "");
                    }
			    }
            });

        });

        var res, formdata;
        $('#parent').on('change', function() {
            if ($(this).val() != '') $.ajax({
                url: "{{ url('master/subkomando/select') }}/" + $(this).val(),
                method: "GET",
                dataType: "json",
                success: function(result) {
                    $('#kode_matra').val(result.matra);
                    $('#satker select').empty().trigger("change");
                    res = result.data;

                    if (result.data.length > 0) {

                        $('#sub').prop('disabled', false);
                        $("#satker select").val("");
                        $("#satker select").trigger("change");

                    } else {
                        $('#sat').click();
                        $('#sub').prop('disabled', true);
                    }
                    $("#satker select").select2({
                        dropdownParent: $('#modal-form'),
                        data: result.data
                    });

                    if (formdata) {
                        $('#satker select').val(formdata.parent).trigger('change');
                        $('#sub').click();
                        $('#subsatker').val(formdata.nama_angkatan);
                    }
                }
            });
        });

        $('#code_angkatan').keypress(function(e) {
            if (e.which === 32)
                return false;
        });

        Array.prototype.filter.call($('#form_data'), function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    form.classList.add('invalid');
                }
                form.classList.add('was-validated');
                event.preventDefault();

                let id_angkatan = $("#id_angkatan").val();

                var url = (id_angkatan !== undefined && id_angkatan !== null && id_angkatan) ?
                    "{{ url('master/subkomando/update') }}" + "/" + id_angkatan :
                    "{{ url('master/subkomando/store') }}";

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
                        $("#modal_title").html("Tambah Satker / Sub Satker")
                        $("#id_angkatan").val()

                    },
                });

            });

        });


        function edit_data(e) {

            $.ajax({
                url: "{{ url('master/subkomando/edit') }}" + "/" + e.attr('data-id'),
                method: "GET",
                dataType: "json",
                success: function(result) {
                    $('#modal-form').modal('show');

                    $("#modal_title").html("Edit Satker / Sub Satker")
                    $('#id_angkatan').val(result.data.id_angkatan);
                    $('#kode_matra').val(result.data.kode_matra);
                    if (result.data.level == 'sub') {
                        formdata = result.data;
                        $('#parent').val(result.data.parent_.parent).trigger('change');
                    } else {
                        $('#sat').click();
                        $('#nama_angkatan').val(result.data.nama_angkatan);
                        $('#parent').val(result.data.parent).trigger('change');
					}


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
                        url: "{{ url('master/subkomando/delete/') }}" + "/" + id,
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
