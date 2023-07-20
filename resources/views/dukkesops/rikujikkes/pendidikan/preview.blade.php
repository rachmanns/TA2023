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
                        <div class="col-md-10">
                            <h2 class="content-header-title float-left">Preview Rikkes Pendidikan</h2>
                        </div>
                        <div class="col-md-2 text-right">
                            @if (isset($id_kegiatan_duk))
                                <form action="{{ url('dukkesops/pendidikan/update-data') }}" method="POST">
                            @else
                                <form action="{{ url('dukkesops/pendidikan') }}" method="POST">
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
                                <table class="table table-striped" id="preview">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Nomor</th>
                                            <th rowspan="2" class="text-center pl-4 pr-4 border-right border-left">Nama <br> Pangkat <br> NRP/Jabatan</th>
                                            <th colspan="14" class="text-center">Umum (U)</th>
                                            <th rowspan="2" class="border-right border-left">Atas (A)</th>
                                            <th rowspan="2" class="border-right">Bawah (B)</th>
                                            <th rowspan="2" class="border-right">Pendengaran & Keseimbangan (D)</th>
                                            <th rowspan="2" class="border-right">Mata (L)</th>
                                            <th rowspan="2" class="border-right">Gigi (G)</th>
                                            <th rowspan="2" class="border-right">Jiwa (J)</th>
                                            <th colspan="2" class="text-center border-right">Hasil Rikkes</th>
                                            <th colspan="2" class="text-center">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">URT</th>
                                            <th class="text-center">Tes</th>
                                            <th class="text-center">TB/BB</th>
                                            <th class="text-center">IMT</th>
                                            <th class="text-center">Tensi/nadi</th>
                                            <th class="text-center">Peny. Dalam</th>
                                            <th class="text-center">USG</th>
                                            <th class="text-center">Obgyn</th>
                                            <th class="text-center">Jantung</th>
                                            <th class="text-center">Ergometeri</th>
                                            <th class="text-center">Spirometri (Paru)</th>
                                            <th class="text-center">RO</th>
                                            <th class="text-center">LAB</th>
                                            <th class="text-center">THT</th>
                                            <th class="text-center">Kulit</th>
                                            <th class="text-center">Bedah</th>
                                            <th class="text-center">Rikkesum</th>
                                            <th class="text-center border-right">Rikkeswa</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_kegiatan_duk as $item)
                                            <tr>
                                                <td class="text-center">{{ $item['no_urt'] }}</td>
                                                <td class="text-center">{{ $item['no_tes'] }}</td>
                                                <td class="text-center">{{ $item['nama'] }} <br> {{ $item['pangkat'] }} <br> {{ $item['nrp'] }} <br>{{ $item['jabatan'] }}</td>
                                                <td class="text-center">{{ $item['tb_bb'] }}</td>
                                                <td class="text-center">{{ $item['imt'] }}</td>
                                                <td class="text-center">{{ $item['tensi_nadi'] }}</td>
                                                <td class="text-center">{{ $item['peny_dalam'] }}</td>
                                                <td class="text-center">{{ $item['usg'] }}</td>
                                                <td class="text-center">{{ $item['obgyn'] }}</td>
                                                <td class="text-center">{{ $item['jantung'] }}</td>
                                                <td class="text-center">{{ $item['ergometri'] }}</td>
                                                <td class="text-center">{{ $item['paru'] }}</td>
                                                <td class="text-center">{{ $item['ro'] }}</td>
                                                <td class="text-center">{{ $item['lab'] }}</td>
                                                <td class="text-center">{{ $item['tht'] }}</td>
                                                <td class="text-center">{{ $item['kulit'] }}</td>
                                                <td class="text-center">{{ $item['bedah'] }}</td>
                                                <td class="text-center border-right">{{ $item['atas'] }}</td>
                                                <td class="text-center">{{ $item['bawah'] }}</td>
                                                <td class="text-center">{{ $item['pendengaran_keseimbangan'] }}</td>
                                                <td class="text-center">{{ $item['mata'] }}</td>
                                                <td class="text-center">{{ $item['gigi'] }}</td>
                                                <td class="text-center">{{ $item['jiwa'] }}</td>
                                                <td class="text-center">{{ $item['hasil_um'] }}</td>
                                                <td class="text-center">{{ $item['hasil_wa'] }}</td>
                                                <td class="text-center">{{ $item['ket_nilai'] }}</td>
                                                <td class="text-center">{{ $item['ket_hasil'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Impor Data</button>
                        </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        $('#preview').DataTable({
            scrollX: true
        });
    </script>
@endsection