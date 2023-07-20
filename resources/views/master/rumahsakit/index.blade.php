@extends('partials.template')
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
                            <h2 class="content-header-title float-left mb-0">Master Data Rumah Sakit</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Tambah Rumah Sakit</button>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <section id="ajax-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-datatable">
                                            <table class="table" id="datatables-ajax">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Rumah Sakit</th>
                                                        <th>Angkatan</th>
                                                        <th>Kota/Kab</th>
                                                        <th class="text-center">Actions</th>
                                                        <th style="display: none;">Kota/Kab</th>
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
        </div>
    </div>


    <div class="modal fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Tambah Baru Rumah Sakit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_data" class="form-data-validate" novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_rs" id="id_rs" value="">
                    <input type="hidden" name="id_angkatan" id="id_angkatan" value="">
                    <div class="modal-body">

                        <label>Angkatan: </label>
                        <div class="form-group">
                            <select class="form-control" id="parent_angkatan" name="parent_angkatan" required></select>

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Angkatan.</div>
                        </div>

                        <label>Komando: </label>
                        <div class="form-group">
                            <select class="form-control" id="parent_komando" name="parent_komando"></select>

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Komando.</div>
                        </div>

                        <label>Sub Komando: </label>
                        <div class="form-group">
                            <select class="form-control" id="parent_sub_komando" name="parent_sub_komando"></select>

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Sub Komando.</div>
                        </div>

                        <label>Kota Kabupaten: </label>
                        <div class="form-group">
                            <select class="form-control" id="id_kotakab" name="id_kotakab"></select>

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Angkatan.</div>
                        </div>

                        <label>Rumah Sakit Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="RUmah Sakit Name" name="nama_rs" id="nama_rs" required
                                class="form-control" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter Rumah Sakit Name.</div>
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
            $("#parent_sub_komando").prop("disabled", true);
            $("#parent_komando").prop("disabled", true);

            select_ajax("angkatan", "angkatan", "Angkatan")


            $('#parent_angkatan').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.count) {

                    $('#parent_komando').empty().trigger("change");

                    select_ajax("komando", "komando", "Komando", data.id)

                    $("#parent_komando").prop("disabled", false);

                } else {

                    $("#id_angkatan").val(data.id);
                    $("#parent_komando").prop("disabled", true);
                    $("#parent_sub_komando").prop("disabled", true);

                    $("#parent_komando").val("");
                    $("#parent_komando").trigger("change");
                    $('#parent_komando').empty().trigger("change");

                    $('#parent_sub_komando').empty().trigger("change");

                }
            });

            $('#parent_komando').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.count) {

                    $("#parent_sub_komando").val("");
                    $("#parent_sub_komando").trigger("change");
                    $('#parent_sub_komando').empty().trigger("change");

                    select_ajax("subkomando", "sub_komando", "Sub Komando", data.id)

                    $("#parent_sub_komando").prop("disabled", false);

                } else {

                    $("#id_angkatan").val(data.id);
                    $("#parent_sub_komando").prop("disabled", true);
                    $("#parent_sub_komando").val("");
                    $("#parent_sub_komando").trigger("change");
                    $('#parent_sub_komando').empty().trigger("change");

                }
            });

            $('#parent_sub_komando').on('select2:select', function(e) {
                var data = e.params.data;
                $("#id_angkatan").val(data.id);

            });

            $.ajax({
                url: "{{ url('refrensi/kotakab') }}",
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#id_kotakab').data('select2')) {

                        $("#id_kotakab").val("");
                        $("#id_kotakab").trigger("change");
                        $('#id_kotakab').empty().trigger("change");

                    }


                    $("#id_kotakab").select2({
                        data: result.data
                    });

                }
            });

            var dt_ajax_table = $("#datatables-ajax");
            if (dt_ajax_table.length) {
                var dt_ajax = dt_ajax_table.dataTable({
                    processing: true,
                    scrollX: true,
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    ajax: "{{ url('master/rumahsakit/list') }}",
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
                            data: 'nama_rs',
                            name: 'Nama Rumah Sakit'
                        },
                        {
                            data: 'angkatan.nama_angkatan',
                            name: 'Angkatan'
                        },
                        {
                            data: 'kotakab.nama_kotakab',
                            name: 'Kota/Kabupaten'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                        {
                            data: 'kotakab.jenis',
                            visible: false
                        },
                    ],
                    rowCallback: function(row, data) {

                        $("td:eq(3)", row).html(data.kotakab.jenis + " " + data.kotakab.nama_kotakab);

                    }
                });
            }


        });


        Array.prototype.filter.call($('#form_data'), function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    form.classList.add('invalid');
                }
                form.classList.add('was-validated');
                event.preventDefault();

                let id_komando = $("#id_rs").val();
                // console.log($('#form_data').serialize())

                var url = (id_komando !== undefined && id_komando !== null) && id_komando ?
                    "{{ url('master/rumahsakit/update') }}" + "/" + id_komando :
                    "{{ url('master/rumahsakit/store') }}";

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
                        $("#modal_title").html("Tambah Baru Rumah Sakit")
                        $("#id_rs").val()

                    },
                });
                $("#modal_title").html("Tambah Baru Rumah Sakit")

            });

        });

        $("#modal-form").on("hide.bs.modal", function() {

            $("#modal_title").html("Tambah Baru Rumah Sakit")
            $("#id_rs").val()

            $('#nama_rs').val("");
            $('#id_angkatan').val();
            $("#id_kotakab").val("");
            $("#id_kotakab").trigger("change");

        });

        function select_ajax(type = "angkatan", parent = "angkatan", placeholder = "Angkatan", parent_id = "") {
            let url_target = "{{ url('master') }}/";
            $.ajax({
                url: url_target + type + "/select/" + parent_id,
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#parent_' + parent).data('select2')) {

                        $("#parent_" + parent).val("");
                        $("#parent_" + parent).trigger("change");
                        $("#parent_" + parent).empty().trigger("change");

                    }


                    $("#parent_" + parent).select2({
                        data: result.data,
                        placeholder: "Pilih " + placeholder,
                        allowClear: true
                    });

                }
            });
        }

        function edit_data(e) {

            $('#modal-form').modal('show');

            $.ajax({
                url: "{{ url('master/rumahsakit/edit') }}" + "/" + e.attr('data-id'),
                method: "GET",
                dataType: "json",
                success: function(result) {

                    $("#modal_title").html("Edit Rumah Sakit")
                    $('#nama_rs').val(result.data.nama_rs);
                    $('#id_angkatan').val(result.data.id_angkatan).trigger('change');
                    $('#id_kotakab').val(result.data.id_kotakab).trigger('change');
                    $('#id_rs').val(result.data.id_rs);

                    if (result.data.angkatan.level == "kom") {

                        $("#parent_angkatan").val(result.data.angkatan.parent).trigger("change");
                        select_ajax("komando", "komando", "Komando", result.data.angkatan.parent)

                        $("#parent_komando").prop("disabled", false);

                        var checkkomando = setInterval(function() {
                            if ($('#parent_komando').length) {
                                $('#parent_komando').val(result.data.id_angkatan).trigger('change');
                                clearInterval(checkkomando);
                            }
                        }, 100);

                    } else if (result.data.angkatan.level == "sub") {

                        $.ajax({
                            url: "{{ url('master/komando/edit') }}" + "/" + result.data.angkatan
                                .parent,
                            method: "GET",
                            dataType: "json",
                            success: function(result) {
                                $("#parent_sub_komando").prop("disabled", false);

                                $("#parent_angkatan").val(result.data.parent).trigger("change");
                                select_ajax("komando", "komando", "Komando", result.data.parent)

                                var checkkomando = setInterval(function() {
                                    if ($('#parent_komando').length) {
                                        $('#parent_komando').val(result.data.id_angkatan)
                                            .trigger('change');
                                        clearInterval(checkkomando);
                                    }
                                }, 100);
                            }
                        });


                        select_ajax("subkomando", "sub_komando", "Sub Komando", result.data.angkatan.parent)

                        var checksubkomando = setInterval(function() {
                            if ($('#parent_sub_komando').length) {
                                $('#parent_sub_komando').val(result.data.id_angkatan).trigger('change');
                                clearInterval(checksubkomando);
                            }
                        }, 100);
                        $("#parent_sub_komando").prop("disabled", false);


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
                        url: "{{ url('master/rumahsakit/delete/') }}" + "/" + id,
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
