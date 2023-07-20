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
            <form action="{{ url('dukkesops/bekkes-satgas/import') }}" method="post" class="default-form">
                @csrf
                <input type="hidden" name="jenis_satgas" value="{{ $jenis_satgas }}">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-1">
                        <div class="d-flex justify-content-between">
                            <h2 class="content-header-title float-left">Preview Data Satgas Operasi</h2>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
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
                                                <th style="min-width: 200px">Nama Satgas</th>
                                                <th style="min-width: 200px">Operasi</th>
                                                <th style="min-width: 150px">Berangkat Ops</th>
                                                {{-- <th style="min-width: 150px">Kembali Ops</th> --}}
                                                <th>Personil</th>
                                                @foreach ($master_bekkes as $mb)
                                                    <th>{{ $mb->nama_bekkes }}</th>
                                                @endforeach
                                                <th>Endemik/Non Endemik</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bekkes_penugasan as $bp)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $bp['nama_satgas'] }}</td>
                                                    <td>{{ $bp['operasi'] }}</td>
                                                    <td>{{ $bp['tgl_berangkat'] }}</td>
                                                    <td>{{ $bp['jumlah_pers'] }}</td>
                                                    @foreach ($bp['mb_data'] as $k => $v)
                                                        <td>{{ $v }}</td>
                                                    @endforeach
                                                    <td>{{ $bp['endemik'] == 1 ? 'endemik':'nonendemik'}}</td>
                                                    <td>{{ $bp['keterangan'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        // var table = $('#dn').DataTable({
        //     scrollX: true,
        //     ajax: "{{ url('/app-assets/data/preview_bekkes_new.json') }}",
        //     columns: [
        //         {
        //             data: 'no'
        //         },
        //         {
        //             data: 'batalyon'
        //         },
        //         {
        //             data: 'satgas'
        //         },
        //         {
        //             data: 'berangkat'
        //         },
        //         {
        //             data: 'kembali'
        //         },
        //         {
        //             data: 'personil'
        //         },
        //         {
        //             data: 'prapas'
        //         },
        //         {
        //             data: 'dokter'
        //         },
        //         {
        //             data: 'wat'
        //         },
        //         {
        //             data: 'banwat'
        //         },
        //         {
        //             data: 'ambulans'
        //         },
        //         {
        //             data: 'pratugas'
        //         },
        //         {
        //             data: 'satgasops'
        //         },
        //         {
        //             data: 'serpas'
        //         },
        //         {
        //             data: 'kesyon'
        //         },
        //         {
        //             data: 'endemik_a'
        //         },
        //         {
        //             data: 'endemik_b'
        //         },
        //         {
        //             data: 'endemik_non'
        //         },
        //         {
        //             data: 'ket'
        //         }
        //     ],
        //     "drawCallback": function(settings) {
        //         feather.replace();
        //     }
        // });
    </script>
@endsection
