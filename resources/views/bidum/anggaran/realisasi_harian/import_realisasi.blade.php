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
                            <h2 class="content-header-title float-left mb-0">Review Data Import Realisasi</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>Bidang</th>
                                                <th>Akun</th>
                                                <th>Uraian</th>
                                                <th>Tanggal Realisasi</th>
                                                <th>Nilai Realisasi</th>
                                                <th>Kewenangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <td>{{ $item['bidang'] }}</td>
                                                    <td>{{ $item['akun'] }}</td>
                                                    <td>{{ $item['uraian'] }}</td>
                                                    <td>{{ $item['tgl_realisasi'] }}</td>
                                                    <td>{{ $item['jumlah'] }}</td>
                                                    <td>{{ $item['kewenangan'] }}</td>
                                                </tr>
                                            @empty
                                                No Data
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    <form id="form-import">
                                        <input type="hidden" name="realisasi" value="{{ json_encode($data) }}">
                                        <button type="button" class="btn btn-primary" id="import">Import Data</button>
                                    </form>
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultSize">Import Data</button> --}}
                                </div>
                                <!-- Modal Import-->
                                <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ url('app-assets/images/pages/eCommerce/ok.png') }}"
                                                    class="pb-2" />
                                                <h1>Data Berhasil Di Impor</h1>
                                            </div>
                                            <div class="row pb-2 pt-2">
                                                <div class="col-12 text-center">
                                                    <a href="/daftar_realisasi"><button type="submit"
                                                            class="btn btn-success">Ok</button></a>
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
    </div>
    <!-- END: Content-->
@endsection
@section('page_js')
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
@section('page_script')
    <script>
        $('#import').on('click', function() {
            let data = $('#form-import').serialize()

            $.ajax({
                url: `{{ route('bidum.anggaran.realisasi_import_store') }}`,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
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
                            }),
                            setTimeout(function() {
                                window.location.replace(
                                    `{{ route('bidum.anggaran.realisasi') }}`);
                            }, 1000);
                    }
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
