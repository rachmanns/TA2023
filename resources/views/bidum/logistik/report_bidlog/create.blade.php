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

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top mb-2">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Report dan Master Aset</h2>
                </div>
            </div> 
            <div class="alert alert-danger">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        {{-- <form action="{{ route('bidum.logistik.report.store') }}" class="default-form" autocomplete="off"> --}}
                        <form autocomplete="off" id="pelaporan-form">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-6">
                                            <div class="form-group form-input">
                                                <label for="periode_laporan">Periode Laporan</label>
                                                <input type="text" id="periode_laporan" class="form-control flatpickr-basic" placeholder="Periode Laporan" name="periode_laporan"/>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="mb-1">Report</h3>
                                    <div class="row">
                                        @foreach ($kl_report as $item)
                                            <div class="col-lg-4 col-6">
                                                <div class="form-group form-input">
                                                    <label for="{{ $item->id_kat_lap }}">{{ $item->nama_kat_lap }}</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="id_kat_lap[{{ $item->id_kat_lap }}]" class="custom-file-input" id="{{ $item->id_kat_lap }}" />
                                                        <label class="custom-file-label" for="{{ $item->id_kat_lap }}">Tambah File</label>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h3 class="mb-1 mt-2">Master Aset</h3>
                                    <div class="row">
                                        @foreach ($kl_master as $item)
                                            <div class="col-lg-4 col-6">
                                                <div class="form-group form-input">
                                                    <label for="{{ $item->id_kat_lap }}">{{ $item->nama_kat_lap }}</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="id_kat_lap[{{ $item->id_kat_lap }}]" class="custom-file-input" id="{{ $item->id_kat_lap }}" />
                                                        <label class="custom-file-label" for="{{ $item->id_kat_lap }}">Tambah File</label>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{-- <button type="submit" class="btn btn-primary">Simpan Data</button> --}}
                                    <button id="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $('#submit').click(function(e){
            e.preventDefault();
            let form_data = new FormData($('#pelaporan-form')[0]);
            
            $.ajax({
                url : `{{ route('bidum.logistik.report.store') }}`,
                type : 'POST',
                data : form_data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                cache: false,
                success : function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }else{
                        Swal.fire(
                            'Success!',
                            'Dokumen berhasil di-upload',
                            'success'
                        ),
                        setTimeout(function() {
                            window.location.replace("{{ route('bidum.logistik.report.index') }}");
                        }, 1000);
                    }
                },
                error: (xhr, status, error) => {
                    const {
                        responseJSON: response
                    } = xhr;
                    if (response.errors) {
                        $(".alert-danger").empty();
                        $('.alert-danger').append('<ul></ul>');
                        for (let form_data in response.errors) {
                            let form_name = form_data.replace(/\.(\d+)\.(\w+)/g, "[$1][$2]");
                            $('.alert-danger ul').append(`<li>${response.errors[form_data][0]}</li>`);
                        }
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error",
                            heightAuto: false
                        })
                    }
                }
            });
        });
    </script>
@endsection
