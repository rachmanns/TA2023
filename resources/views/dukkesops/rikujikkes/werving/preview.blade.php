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
            <div class="row">
                <div class="col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-9">
                            <h2 class="content-header-title">Preview Rikkes Werving</h2>
                        </div>
                        <div class="col-md-3 text-right">
                            @if (isset($id_kegiatan_duk))
                                <form action="{{ url('dukkesops/werving/update-data') }}" method="POST">
                            @else
                                <form action="{{ route('dukkesops.werving.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <button type="submit" class="btn btn-primary">Impor Data</button>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="content-body">
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-striped" id="werving">
                                    <thead>
                                        <tr>
                                            <th>Nomor urut</th>
                                            <th>nomor tes</th>
                                            <th>nama</th>
                                            <th>kelas</th>
                                            <th>prodi</th>
                                            <th>jenis_kelamin</th>
                                            <th>tb / bb</th>
                                            <th>imt</th>
                                            <th>tensi nadi</th>
                                            <th>penyakit dalam</th>
                                            <th>usg</th>
                                            <th>obgyn</th>
                                            <th>jantung</th>
                                            <th>ergometri</th>
                                            <th>paru</th>
                                            <th>ro</th>
                                            <th>lab</th>
                                            <th>tht</th>
                                            <th>kulit</th>
                                            <th>bedah</th>
                                            <th>atas</th>
                                            <th>bawah</th>
                                            <th>pendengaran keseimbangan</th>
                                            <th>mata</th>
                                            <th>gigi</th>
                                            <th>jiwa</th>
                                            <th>ekg</th>
                                            <th>hasil um</th>
                                            <th>hasil wa</th>
                                            <th>nilai</th>
                                            <th>hasil</th>
                                            <th>kesimpulan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_kegiatan_duk as $item)
                                            <tr>
                                                <td>{{ $item['no_urt'] }}</td>
                                                <td>{{ $item['no_tes'] }}</td>
                                                <td>{{ $item['nama'] }}</td>
                                                <td>{{ $item['kelas'] }}</td>
                                                <td>{{ $item['prodi'] }}</td>
                                                <td>{{ $item['jenis_kelamin'] }}</td>
                                                <td>{{ $item['tb_bb'] }}</td>
                                                <td>{{ $item['imt'] }}</td>
                                                <td>{{ $item['tensi_nadi'] }}</td>
                                                <td>{{ $item['peny_dalam'] }}</td>
                                                <td>{{ $item['usg'] }}</td>
                                                <td>{{ $item['obgyn'] }}</td>
                                                <td>{{ $item['jantung'] }}</td>
                                                <td>{{ $item['ergometri'] }}</td>
                                                <td>{{ $item['paru'] }}</td>
                                                <td>{{ $item['ro'] }}</td>
                                                <td>{{ $item['lab'] }}</td>
                                                <td>{{ $item['tht'] }}</td>
                                                <td>{{ $item['kulit'] }}</td>
                                                <td>{{ $item['bedah'] }}</td>
                                                <td>{{ $item['atas'] }}</td>
                                                <td>{{ $item['bawah'] }}</td>
                                                <td>{{ $item['pendengaran_keseimbangan'] }}</td>
                                                <td>{{ $item['mata'] }}</td>
                                                <td>{{ $item['gigi'] }}</td>
                                                <td>{{ $item['jiwa'] }}</td>
                                                <td>{{ $item['ekg'] }}</td>
                                                <td>{{ $item['hasil_um'] }}</td>
                                                <td>{{ $item['hasil_wa'] }}</td>
                                                <td>{{ $item['ket_nilai'] }}</td>
                                                <td>{{ $item['ket_hasil'] }}</td>
                                                <td>{{ $item['kesimpulan'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-primary">Impor Data</button>
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
        $('#werving').DataTable({
            scrollX: true
        });
    </script>
@endsection
