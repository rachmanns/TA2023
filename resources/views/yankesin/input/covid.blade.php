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
                            <h2 class="content-header-title float-left mb-0">Data Covid-19</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Tambah Covid-19</button>
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
                                            <table class="table table-striped" id="datatables-ajax">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Rumah Sakit</th>
                                                        <th>Date</th>
                                                        <th>Total TT</th>
                                                        <th>ICU Tersedia</th>
                                                        <th>ICU Terisi</th>
                                                        <th>Isolasi Tersedia</th>
                                                        <th>Isolasi Terisi</th>
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
        </div>
    </div>


    <div class="modal  fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Data Covid</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_data" class="form-data-validate" novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="id_covid" id="id_covid" value="">
                    <div class="modal-body">
                        <br />
                        <h5>General Info</h5>

                        <label>Date: </label>
                        <div class="form-group">
                            <input type="text" id="fp-default" class="form-control flatpickr-human-friendly" name="tanggal"
                                id="tanggal" placeholder="YYYY-MM-DD" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Date.</div>
                        </div>

                        <label>Rumah Sakit: </label>
                        <div class="form-group">
                            <select class="select2-data-ajax form-control" id="id_rs" name="id_rs"></select>

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please Select Rumah Sakit.</div>
                        </div>

                        <br />
                        <h5>Kategori Pasien</h5>

                        <div class="row mb-2">
                            <div class="col-3"> &nbsp; </div>
                            @foreach ($status_pasien as $pasien)
                                <div class="col text-center"> {{ $pasien->nama_status }} </div>
                            @endforeach
                        </div>

                        @foreach ($jenis_pasien as $jenis)
                            <div class="row mb-2">
                                <div class="col-3"> {{ $jenis->nama_jenis }} </div>
                                @foreach ($status_pasien as $pasien)
                                    <div class="col text-center">
                                        <input type="number" placeholder="ex. 30"
                                            name="{{ $jenis->nama_jenis }}__{{ $pasien->pasien_code }}"
                                            id="{{ $jenis->jenis_code }}__{{ $pasien->pasien_code }}" required
                                            class="form-control" />
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

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

            $.ajax({
                url: "{{ url('master/rumahsakit/select') }}",
                method: "GET",
                dataType: "json",
                success: function(result) {

                    if ($('#id_rs').data('select2')) {

                        $("#id_rs").val("");
                        $("#id_rs").trigger("change");
                        $('#id_rs').empty().trigger("change");

                    }

                    $("#id_rs").select2({
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
                    // ajax: "{{ url('yankesin/input/bor-list') }}",
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        },
                    },
                    // columns: [
                    //     {
                    //         data: 'DT_RowIndex',
                    //         name: 'DT_RowIndex'
                    //     },
                    //     {
                    //         data: 'rumahsakit.nama_rs',
                    //         name: 'Rumah Sakit'
                    //     },
                    //     {
                    //         data: 'tanggal',
                    //         name: 'Date'
                    //     },
                    //     {
                    //         data: 'all_tt',
                    //         name: 'Total TT'
                    //     },
                    //     {
                    //         data: 'icu_slot',
                    //         name: 'ICU Tersedia'
                    //     },
                    //     {
                    //         data: 'icu_isi',
                    //         name: 'ICU Terisi'
                    //     },
                    //     {
                    //         data: 'isolate_slot',
                    //         name: 'Isolasi Tersedia'
                    //     },
                    //     {
                    //         data: 'isolate_isi',
                    //         name: 'Isolasi Terisi'
                    //     },
                    //     {
                    //         data: 'action',
                    //         name: 'action'
                    //     },

                    //     //   {data: 'phone', name: 'phone'},
                    // ],
                    createdRow: function(row, data, dataIndex) {
                        // console.log(row)
                        // $('td:eq(1)', row).attr('colspan', 3);
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

                let id_komando = $("#id_covid").val();
                // console.log($('#form_data').serialize())

                var url = (id_komando !== undefined && id_komando !== null) && id_komando ?
                    "{{ url('yankesin/input/covid-update') }}" + "/" + id_komando :
                    "{{ url('yankesin/input/covid-store') }}";

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
                        $("#modal_title").html("Add Data Covid")
                        $("#id_covid").val()

                    },
                });

            });

        });


        function edit_data(e) {

            $('#modal-form').modal('show');

            $.ajax({
                url: "{{ url('yankesin/input/covid-edit') }}" + "/" + e.attr('data-id'),
                method: "GET",
                dataType: "json",
                success: function(result) {

                    $("#modal_title").html("Edit Data Covid")
                    $('#id_rs').val(result.data.id_rs).trigger('change');
                    $('#all_tt').val(result.data.all_tt);
                    $('#isolasi_slot').val(result.data.isolasi_slot);
                    $('#isolasi_isi').val(result.data.isolasi_isi);
                    $('#icu_slot').val(result.data.icu_slot);
                    $('#icu_isi').val(result.data.icu_isi);

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
                        url: "{{ url('yankesin/input/covid-delete/') }}" + "/" + id,
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
