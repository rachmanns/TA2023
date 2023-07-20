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

    input[type=checkbox] {
        width: 18px;
        height: 18px;
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
                    <div class="col-12 mb-1">
                        <a href="/bekkes_dobek"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                    </div>
                    <div class="col-md-12 col-12">
                        <h2 class="content-header-title float-left">Ubah Status Bekkes Satgas Ops - TA 2022 </h2>
                    </div>
                    <div class="col-md-3">
                        <select class="select2 form-select">
                            <option>All</option>
                            <option>Terdukung</option>
                            <option>Belum Terdukung</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="checkboxlength">
                            <div class="card-header border-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Status Bekkes Satgas Ops</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="demo-inline-spacing">
                                            <div class="custom-control custom-radio mt-50">
                                                <input type="radio" id="terdukung" name="status" class="custom-control-input" />
                                                <label class="custom-control-label" for="terdukung">Terdukung</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-50">
                                                <input type="radio" id="belum-terdukung" name="status" class="custom-control-input" />
                                                <label class="custom-control-label" for="belum-terdukung">Belum Terdukung</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <span class="font-weight-bolder mr-2">0 Data Terpilih </span> <button class="btn btn-primary">Update Status</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="select_all" />
                                            </th>
                                            <th>Nama Batalyon</th>
                                            <th>Nama Satgas Ops</th>
                                            <th>Berangkat Ops</th>
                                            <th>Kembali Ops</th>
                                            <th>Personil</th>
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
@section('page_script')

<script type="text/javascript">
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });
</script>

<script>
    $('#table').DataTable({
        scrollX: true,
        ajax: "{{ url('/app-assets/data/update-status.json') }}",
        columns: [{
                data: 'action'
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
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

    });
</script>
@endsection