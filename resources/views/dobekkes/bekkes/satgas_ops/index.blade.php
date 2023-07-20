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
                    <div class="d-flex justify-content-between">
                        <h2 class="content-header-title float-left">Bekkes Satgas Ops - TA 2022 </h2>
                        <a href="/update_status"><button class="btn btn-primary">Update Status</button></a>

                        <!-- Modal Upload -->
                        <div class="modal fade text-left" id="excell" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title">Upload Excell</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group form-input">
                                            <label for="customFile1">Upload Excell</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile1" />
                                                <label class="custom-file-label dbd" for="customFile1">Upload Excell</label>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                            <a href="#" class="float-right font-small-3 mt-50"><u>Download Template Excell</u></a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/preview_data_satgas_operasi"><button type="submit" class="btn btn-primary">Upload</button></a>
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
                                <table class="table table-striped" id="dn">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Status</th>
                                            <th style="min-width: 200px">Nama Batalyon</th>
                                            <th style="min-width: 200px">Nama Satgas Ops</th>
                                            <th style="min-width: 150px">Berangkat Ops</th>
                                            <th style="min-width: 150px">Kembali Ops</th>
                                            <th>Personil</th>
                                            <th>Kat Prapas</th>
                                            <th>Kat Dokter</th>
                                            <th>Kat Wat</th>
                                            <th>Kat Banwat</th>
                                            <th>Kat Ambulans</th>
                                            <th>Kat Pratugas</th>
                                            <th>Kat Pos Satgasops</th>
                                            <th>Kat Serpas</th>
                                            <th>Kat Kesyon</th>
                                            <th>Kat Endemik A</th>
                                            <th>Kat Endemik B</th>
                                            <th>Endemik/Non Endemik</th>
                                            <th>Keterangan</th>
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
        var table = $('#dn').DataTable({
            scrollX: true,
            ajax: "{{ url('/app-assets/data/bekkes_new.json') }}",
            columns: [
                {
                    data: 'no'
                },                
                {
                    data: 'status'
                },
                {
                    data: 'batalyon'
                },
                {
                    data: 'satgas'
                },
                {
                    data: 'berangkat'
                },
                {
                    data: 'kembali'
                },
                {
                    data: 'personil'
                },
                {
                    data: 'prapas'
                },
                {
                    data: 'dokter'
                },
                {
                    data: 'wat'
                },
                {
                    data: 'banwat'
                },
                {
                    data: 'ambulans'
                },
                {
                    data: 'pratugas'
                },
                {
                    data: 'satgasops'
                },
                {
                    data: 'serpas'
                },
                {
                    data: 'kesyon'
                },
                {
                    data: 'endemik_a'
                },
                {
                    data: 'endemik_b'
                },
                {
                    data: 'endemik_non'
                },
                {
                    data: 'ket'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection
