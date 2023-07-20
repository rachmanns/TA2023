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
                        <div class="col-12 mb-1">
                            <a href="/detail_personil_rotasi_ln"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">List Personil</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-datatable table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NRP/Jabatan</th>
                                            <th>Pangkat</th>
                                            <th class="text-center">
                                                <input type="checkbox" id="select_all" />
                                            </th>
                                        </tr>
                                    </thead>
                                </table>                                
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
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
        $(document).ready(function(){
            $('#select_all').on('click',function(){
                if(this.checked){
                    $('.checkbox').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('.checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
            
            $('.checkbox').on('click',function(){
                if($('.checkbox:checked').length == $('.checkbox').length){
                    $('#select_all').prop('checked',true);
                }else{
                    $('#select_all').prop('checked',false);
                }
            });
        });
    </script>

    <script>
        $('#table').DataTable({
        scrollX: true,
        ajax: "{{ url('/app-assets/data/tambah-personil.json') }}",
        columns: [
            {
                data: 'no',
                name: 'no'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'jabatan',
                name: 'jabatan'
            },
            {
                data: 'pangkat',
                name: 'pangkat'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        "drawCallback": function(settings) {
            feather.replace();
        }

        });
    </script>
@endsection
