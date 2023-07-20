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

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css')}}">
    <script src="{{ url('assets/js/monthpicker.js')}}"></script>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar 
                            @if ($hbd !=null)
                                Ulang Tahun
                            @else
                                Pensiun
                            @endif </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-3">
                    <input type="text" id="month" class="form-control bg-white" placeholder="Periode"/>
                </div>
            </div>
            @if ($hbd == null)
                <div class="row">
                    <div class="col-12">
                        <div class="demo-spacing-0">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <i data-feather="info" class="mr-50 align-middle"></i>
                                    <span> Data yang ditampilkan adalah data personil yang akan Pensiun. </span>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="table table-striped table-responsive-xl" id="pensiun-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Personil</th>
                                                <th>Pangkat Saat Ini</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Usia Saat Ini</th>
                                                <th>TMT TNI</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $(function(){
            $('#month').val(moment().format('YYYY-MM'))
            pensiun_list(moment().format('YYYY-MM'),'{{ $hbd }}')
            
        })

        $('#month').change(function(){
            var month_year = $(this).val()
            pensiun_list(month_year,'{{ $hbd }}')
        })

        $('#month').flatpickr({
            altInput: true,
            altFormat: 'F Y',
            plugins: [
                new monthSelectPlugin({
                    dateFormat: "Y-m",
                })
            ]
        });

        function pensiun_list(month_year,hbd) {
            var table = $('#pensiun-table').DataTable({
                destroy:true,
                processing: true,
                serverSide: true,
                ajax: "{{ url('bidum/personil/pensiun/list') }}"+'/'+month_year+'/'+hbd,
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama_pangkat_terakhir',
                        name: 'nama_pangkat_terakhir'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir'
                    },
                    {
                        data: 'usia',
                        name: 'usia'
                    },
                    {
                        data: 'tmt_tni',
                        name: 'tmt_tni'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
            });
        }
    </script>
@endsection
