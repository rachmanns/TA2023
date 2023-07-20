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
                            <h2 class="content-header-title float-left mb-0">Pagu Anggaran</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#defaultSize">Import Pagu</button>

                    <!-- Modal Import-->
                    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel18">Import Pagu Anggaran</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('bidum.anggaran.pagu_import') }}" method="post"
                                        enctype="multipart/form-data" id="form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="customFile1">Pilih File Excel Pagu Anggaran</label>
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                    id="customFile1" required />
                                                <label class="custom-file-label" for="customFile1">Tambah File</label>
                                            </div>
                                        </div>
                                        <div class="text-right mt-25">
                                            <a href="{{ url('template/pagu_awal') }}"> <u>Download Format Pagu</u> </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="demo-spacing-0">
                    <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif
            @error('file')
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ $message }}
                        </div>
                    </div>
                </div>
            @enderror
            @if (session('error'))
                <div class="demo-spacing-0">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-renponsive-xl" id="table-pagu">
                                        <thead>
                                            <tr>
                                                <th>Tahun Anggaran</th>
                                                <th>Total Pagu Anggaran Pusat</th>
                                                <th>Total Pagu Anggaran Daerah</th>
                                                <th class="text-center" style="min-width: 100px;">Aksi</th>
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
    <!-- END: Content-->
@endsection
@section('page_js')
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
@section('page_script')
    <script>
        $(function() {

            var table = $('#table-pagu').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bidum.anggaran.pagu_list') }}",
                columns: [{
                        data: 'tahun_anggaran',
                        name: 'tahun_anggaran'
                    },
                    {
                        data: 'total_pagu_pusat',
                        name: 'total_pagu_pusat'
                    },
                    {
                        data: 'total_pagu_daerah',
                        name: 'total_pagu_daerah'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });

        });

        $('#upload_pagu_anggaran').on('click', function() {
            var file_data = $('#customFile1').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);

            $.ajax({
                url: `{{ route('bidum.anggaran.pagu_import') }}`, // <-- point to server-side PHP script 
                dataType: 'text', // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                type: 'post',
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            type: "error",
                            title: 'Oops...',
                            text: response.message,
                            confirmButtonClass: 'btn btn-success',
                        });
                    } else {
                        // setTimeout(function () { $('#datatables-ajax').DataTable().ajax.reload(); }, 1000);
                        Swal.fire({
                            type: "success",
                            title: 'Success!',
                            text: response.message,
                            confirmButtonClass: 'btn btn-success',
                        });
                    }
                    var reset_form = $('#form-data')[0];
                    // $(reset_form).removeClass('was-validated');
                    reset_form.reset();
                    $('#defaultSize').modal('hide');
                    // $("#modal_title").html("Create New Angkatan")
                    $("#customFile1").val()
                },
                error: (xhr, status, error) => {
                    // const {
                    //     statusCode:response
                    // } = xhr;
                    if (xhr.status != 201 || xhr.status != 200) {
                        Swal.fire({
                            type: "error",
                            title: 'Oops...',
                            text: xhr.statusText,
                            confirmButtonClass: 'btn btn-success',
                        })
                    }
                    //  else {
                    //     Swal.fire({
                    //         title: "Error",
                    //         text: response.message,
                    //         icon: "error",
                    //         heightAuto: false
                    //     })
                    // }
                }
            });
        });
    </script>
@endsection
