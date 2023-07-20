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
                            <a href="{{ url('dukkesops/penugasan-pos/detail-personil/'.$penugasan_pos->id_penugasan_pos) }}"><button type="button" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</button></a>
                        </div>
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">List Personil</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <form action="{{ url('dukkesops/penugasan-pos/store-anggota') }}" class="default-form" method="POST">
                    @csrf
                    <input type="hidden" name="id_penugasan_pos" value="{{ $penugasan_pos->id_penugasan_pos }}">
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
                                        <tbody>
                                            {{-- @foreach ($penugasan_pos->penugasan_satgas->data_kegiatan_duk as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->nama }}</td>
                                                    <td>{{ $d->nrp }}/{{ $d->jabatan }}</td>
                                                    <td>{{ $d->pangkat }}</td>
                                                    <td><div class='text-center'><input type='checkbox' class='checkbox' name="id_data_kegiatan_duk[]" value='{{ $d->id_data_kegiatan_duk }}'
                                                        @if (in_array($d->id_data_kegiatan_duk, $detail_anggota))
                                                            checked
                                                        @endif
                                                        /></div></td>
                                                </tr>
                                            @endforeach --}}
                                            @isset($penugasan_satgas->data_kegiatan_duk)
                                                @foreach ($penugasan_satgas->data_kegiatan_duk as $d)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $d->nama }}</td>
                                                        <td>{{ $d->nrp }}/{{ $d->jabatan }}</td>
                                                        <td>{{ $d->pangkat }}</td>
                                                        <td><div class='text-center'><input type='checkbox' class='checkbox' name="id_data_kegiatan_duk[]" value='{{ $d->id_data_kegiatan_duk }}'/></div></td>
                                                    </tr>
                                                @endforeach
                                                
                                            @endisset
                                        </tbody>
                                    </table>                                
                                    @isset($penugasan_satgas->data_kegiatan_duk)
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
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
        $('#table').DataTable();
    </script>

    {{-- <script>
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
    </script> --}}
@endsection
