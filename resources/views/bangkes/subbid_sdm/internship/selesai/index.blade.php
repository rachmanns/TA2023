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
                    <div class="row breadcrumbs-top">
                        <div class="col-md-10 col-10">
                            <h2 class="content-header-title float-left">Daftar Selesai Internship</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-3 col-12 d-md-block d-none">
                    <div class="input-group input-group-merge form-input">
                        <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                            placeholder="Tahun" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="selesai">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Nama</th>
                                            <th>Pangkat/Korp</th>
                                            <th>NRP</th>
                                            <th>Jabatan/Kesatuan</th>
                                            <th>Matra</th>
                                            <th>Wahana Program</th>
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
       $(function(){
            selesai_list()
        })

        $('#tahun').change(function(){
            selesai_list($(this).val())
        })

        function selesai_list(tahun='') {
            
            $('#selesai').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('bangkes/selesai-internship/list') }}",
                    method: 'POST',
                    data: {tahun:tahun},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'tgl_mulai',
                        name: 'tgl_mulai'
                    },
                    {
                        data: 'tgl_selesai',
                        name: 'tgl_selesai'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'pangkat_korps',
                        name: 'pangkat_korps'
                    },            
                    {
                        data: 'nrp',
                        name: 'nrp'
                    },
                    {
                        data: 'jabatan_kesatuan',
                        name: 'jabatan_kesatuan'
                    },
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'wahana',
                        name: 'wahana'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
    
            });
        } 
    </script>
@endsection