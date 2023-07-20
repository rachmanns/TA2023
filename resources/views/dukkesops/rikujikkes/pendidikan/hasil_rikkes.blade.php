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
        @error('file_kegiatan')
            <div class="demo-spacing-0">
                <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body">
                        <i data-feather="info" class="mr-50 align-middle"></i>
                        {{ $message }}
                    </div>
                </div>
            </div>
        @enderror
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Hasil Rikkes Sesko TNI - TA {{ $pendidikan->tahun_anggaran }}</h2>
                        </div>
                        <div class="col-12">
                            <span class="font-weight-bolder">{{ $pendidikan->tempat }}</span> <span>({{ indonesian_date_format($pendidikan->tanggal) }})</span>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <a data-toggle='modal' data-target='#import'><button class="btn btn-primary">Impor Data Pendidikan</button></a>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h4 class="card-header">Hasil Rikkesum</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="rikkesum" class="mb-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h4 class="card-header">Hasil Rikkeswa</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="rikkeswa" class="mb-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <h4 class="card-header">Hasil Rikkesum & Rikkeswa</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="rikkesumwa" class="mb-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-1">Daftar Peserta</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table table-striped" id="hasil">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center pl-4 pr-4 border-right">Aksi</th>
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
                            </table>
                        </div>
                        @include('dukkesops.rikujikkes.pendidikan.edit_data_kegiatan')
                        @include('dukkesops.rikujikkes.pendidikan.import_data_kegiatan')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            donat_chart("#rikkeswa", {!! json_encode(array_values($chart['hasil_wa']),JSON_NUMERIC_CHECK) !!}, {!! json_encode(array_keys($chart['hasil_wa']),JSON_NUMERIC_CHECK) !!}, [chartColors.pie.msi, chartColors.pie.msii, chartColors.pie.msiii, chartColors.pie.tms, chartColors.pie.th, chartColors.pie.mms])
            donat_chart("#rikkesum",  {!! json_encode(array_values($chart['hasil_um']),JSON_NUMERIC_CHECK) !!}, {!! json_encode(array_keys($chart['hasil_um']),JSON_NUMERIC_CHECK) !!}, [chartColors.pie.msi, chartColors.pie.msii, chartColors.pie.msiii, chartColors.pie.tms, chartColors.pie.th, chartColors.pie.mms])
            donat_chart("#rikkesumwa", {!! json_encode(array_values($chart['um_wa']),JSON_NUMERIC_CHECK) !!}, {!! json_encode(array_keys($chart['um_wa']),JSON_NUMERIC_CHECK) !!}, [chartColors.pie.msi, chartColors.pie.msii, chartColors.pie.msiii, chartColors.pie.tms, chartColors.pie.th, chartColors.pie.mms])
        });

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            chartColors = {
                pie: {
                    msi: '#2B883F',
                    msii: '#1A4322',
                    msiii: '#F1D900',
                    tms: '#E72D2E',
                    th: '#0837CA',
                    mms: '#4BF295'
                },
            };

        function donat_chart(selector, series, labels, colors) {
            var bor_covid_element = document.querySelector(selector),
                bor_covid_config = {
                    chart: {
                        height: 220,
                        type: 'pie'
                    },
                    plotOptions: {
                        radialBar: {
                            size: 185,
                            hollow: {
                                size: '25%'
                            },
                            track: {
                                margin: 15
                            },
                            dataLabels: {
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Montserrat'
                                },
                                value: {
                                    fontSize: '1rem',
                                    fontFamily: 'Montserrat'
                                },
                                total: {
                                    show: true,
                                    fontSize: '1rem',
                                    label: 'Comments',
                                    formatter: function(w) {
                                        return '80%';
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        show: true
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    series: series,
                    colors: colors,
                    labels: labels
                };
            if (typeof bor_covid_element !== undefined && bor_covid_element !== null) {
                var radialChart = new ApexCharts(bor_covid_element, bor_covid_config);
                radialChart.render();
            }

        }

        let pie_color = Object.keys(chartColors['pie'])
            .map(function(key) {
                return chartColors['pie'][key];
            });

        $('#hasil').DataTable({
            scrollX: true,
            ajax: "{{ url('dukkesops/pendidikan/list-data-kegiatan/'.$pendidikan->id_kegiatan_duk) }}",
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_urt',
                    name: 'no_urt'
                },
                {
                    data: 'no_tes',
                    name: 'no_tes'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tb_bb',
                    name: 'tb_bb'
                },
                {
                    data: 'imt',
                    name: 'imt'
                },
                {
                    data: 'tensi_nadi',
                    name: 'tensi_nadi'
                },
                {
                    data: 'peny_dalam',
                    name: 'peny_dalam'
                },
                {
                    data: 'usg',
                    name: 'usg'
                },
                {
                    data: 'obgyn',
                    name: 'obgyn'
                },
                {
                    data: 'jantung',
                    name: 'jantung'
                },
                {
                    data: 'ergometri',
                    name: 'ergometri'
                },
                {
                    data: 'paru',
                    name: 'paru'
                },
                {
                    data: 'ro',
                    name: 'ro'
                },
                {
                    data: 'lab',
                    name: 'lab'
                },
                {
                    data: 'tht',
                    name: 'tht'
                },
                {
                    data: 'kulit',
                    name: 'kulit'
                },
                {
                    data: 'bedah',
                    name: 'bedah'
                },
                {
                    data: 'atas',
                    name: 'atas'
                },
                {
                    data: 'bawah',
                    name: 'bawah'
                },
                {
                    data: 'pendengaran_keseimbangan',
                    name: 'pendengaran_keseimbangan'
                },
                {
                    data: 'mata',
                    name: 'mata'
                },
                {
                    data: 'gigi',
                    name: 'gigi'
                },
                {
                    data: 'jiwa',
                    name: 'jiwa'
                },
                {
                    data: 'hasil_um',
                    name: 'hasil_um'
                },
                {
                    data: 'hasil_wa',
                    name: 'hasil_wa'
                },
                {
                    data: 'ket_nilai',
                    name: 'ket_nilai'
                },
                {
                    data: 'ket_hasil',
                    name: 'ket_hasil'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            },
            createdRow: function (row, data, dataIndex, cells) {
                for (let i = 4; i < cells.length; i++) {
                    if (cells[i]['innerHTML'] == 'TMS') $(cells[i]).addClass('bg-danger text-white')
                    if(cells[i]['innerHTML'].includes('K2')) $(cells[i]).addClass('bg-danger text-white')
                }
            }

        });

        function edit_data_kegiatan(e) {
            let id_data_kegiatan_duk = e.attr('data-id');

            let action = `{{ url('dukkesops/pendidikan') }}/`+id_data_kegiatan_duk;
            var url = `{{ url('dukkesops/pendidikan') }}/`+id_data_kegiatan_duk+'/edit';

            console.table(action);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.table(response);
                    $("#modal-title").html("Edit Jenis Kegiatan")
                    $('#edit form').attr('action', action);
                    $.each(response, function( index, value ) {
                        $('#'+index).val(value);
                    });
                    $('#edit').modal('show');
                }
            });
        }
    </script>
@endsection
