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
                            <h2 class="content-header-title float-left">Daftar Paramedis</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="matra">
                        <option disabled selected>Matra</option>
                        @foreach ($matra as $m)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="content-header-left text-md-left col-md-2 col-12 d-md-block d-none">
                    <select class="select2 form-control form-control-lg" id="jenis_paramedis">
                        <option disabled selected>Jenis Paramedis</option>
                        @foreach ($jenis_paramedis as $jp)
                            <option value="{{ $jp->id_jenis_paramedis }}">{{ $jp->nama_jenis_paramedis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right col-md-8 col-12 d-md-block d-none">
                    <a href="{{ url('bangkes/paramedis/create') }}"><button class="btn btn-primary">Tambah Daftar Paramedis</button></a>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="paramedis">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="min-width: 100px;">Aksi</th>
                                            <th style="min-width: 150px;">Sebaran</th>
                                            <th class="text-center" style="min-width: 150px;">Kategori</th>
                                            <th>Ijazah</th>
                                            <th style="min-width: 200px;">Nama</th>
                                            <th>Matra</th>
                                            <th>Pangkat/NRP/NIP</th>
                                            <th>Jabatan Struktural</th>
                                            <th>Jabatan Fungsional</th>
                                            <th style="min-width: 100px;">Ket</th>
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

        let matra = '';
        let jenis_paramedis = '';

        $(function(){
            paramedis_list(matra, jenis_paramedis);
        })
        
        $('#matra').change(function(){
            matra = $(this).val();
            paramedis_list(matra,jenis_paramedis);
        });

        $('#jenis_paramedis').change(function(){
            jenis_paramedis = $(this).val();
            paramedis_list(matra,jenis_paramedis);
        });

        function paramedis_list(matra, jenis_paramedis) {
            let data = {matra:matra, jenis_paramedis:jenis_paramedis}
            $('#paramedis').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ url('bangkes/paramedis/list') }}",
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'sebaran',
                        name: 'sebaran'
                    },
                    {
                        data: 'jenis_paramedis',
                        name: 'jenis_paramedis'
                    },
                    {
                        data: 'jenis_ijazah',
                        name: 'jenis_ijazah'
                    },
                    {
                        data: 'nama_paramedis',
                        name: 'nama_paramedis'
                    },            
                    {
                        data: 'matra',
                        name: 'matra'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'jabatan_struktural',
                        name: 'jabatan_struktural'
                    },
                    {
                        data: 'jabatan_fungsional',
                        name: 'jabatan_fungsional'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }
                ],
                "drawCallback": function(settings) {
                    feather.replace();
                }
    
            });
        } 

    </script>
@endsection