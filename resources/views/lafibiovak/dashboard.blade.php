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
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-md-12 col-12">
                            <h2 class="content-header-title float-left">Dashboard Lafibiovak - <span class="tahun"><?php echo request()->tahun ?? date('Y'); ?></span></h2>
                        </div>
                    </div>
                    <div class="row mb-1 mt-1">
                        <div class="col-md-3">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun"
                                    class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun Anggaran"
                                    readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Status Pengajuan RKO <span class="tahun"><?php echo request()->tahun ?? date('Y'); ?></span></div>
                            </div>
                            <div class="card-body">
                                <div id="status-pengajuan-rko"></div>

                                <!-- Modal Chart Status Pengajuan RKO -->
                                <div class="modal fade text-left" id="modal-rko" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-title">Daftar Pengajuan RKO <?php echo request()->tahun ?? date('Y'); ?> dengan Status <span class="statrko"></span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="rko">
                                                        <thead>
                                                            <tr>
                                                                <th style="min-width:200px;">Nama Faskes</th>
                                                                <th>Tanggal Pengajuan</th>
                                                                <th>Keterangan</th>
                                                                <th>File</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Kategori Bahan Produksi</div>
                            </div>
                            <div class="card-body">
                                <div id="kategori-bahan-produksi"></div>

                                <!-- Modal Chart Kategori Bahan Produksi -->
                                <div class="modal fade text-left" id="modal-kat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-title">Daftar Bahan Produksi Kategori <span class="statkbb"></span></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <table class="table table-striped" id="kat">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2">No.</th>
                                                            <th rowspan="2" style="min-width: 200px;">Nama Bahan</th>
                                                            <th rowspan="2">Satuan</th>
                                                            <th rowspan="2" style="min-width: 200px;">Spesifikasi Teknis</th>
                                                            <th rowspan="2" class="border-right">Kemasan Minimal</th>
                                                            <th colspan="2" class="text-center">Sumber</th>
                                                            <th rowspan="2" class="border-left">Renada</th>
                                                            <th rowspan="2">Jumlah Awal</th>
                                                            <th rowspan="2" class="border-right">Jumlah Masuk</th>
                                                            <th colspan="6" class="text-center">Jumlah Keluar</th>
                                                            <th rowspan="2" class="border-left">Sisa</th>
                                                            <th rowspan="2">Keterangan</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Perusahaan</th>
                                                            <th class="text-center">Asal Negara</th>
                                                            <th class="text-center">Lafi AD</th>
                                                            <th class="text-center">Lafi AL</th>
                                                            <th class="text-center">Lafi AU</th>
                                                            <th class="text-center">Labiovak</th>
                                                            <th class="text-center">Labiomed</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">                            
                            <div class="card-header">
                                <div class="card-title">Renprod</div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="renprod"></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Produksi</div>
                            </div>
                            <div class="card-body">
                                <div id="persediaan"></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Distribusi</div>
                            </div>
                            <div class="card-body">
                                <div id="distribusi"></div>  
                            </div>
                        </div>
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
            $('#tahun').change(function() {
                location.href = '{{request()->url}}?tahun=' + $('#tahun').val();
            });
            $('#tahun').val(<?php echo request()->tahun ?? date('Y'); ?>);
        });


        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            chartColors = {
                pie: {
                    merah: '#EE3124',
                    ijo: '#28C76F',
                    kuning: '#FFAB00',
                    biru: '#2045B8',
                    ungu: '#BD5C91',
                    birmud: '#00CFE8',
                    ijomud: '#85C808',
                    pink: '#EA5455',
                    orange: '#F24E1E',
                    peach: '#FF9F43'
                },
            };

            let pie_color = Object.keys(chartColors['pie']) 
            .map(function(key) { 
                return chartColors['pie'][key]; 
            });

        var options = {
            series: [{
                name: 'Jumlah',
                data: [{!! implode(', ', $prds) !!}]
            }],
            chart: {
            type: 'bar',
            height: 350
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '30%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
            enabled: false
            },
            colors: ['#7367F0', '#d2b0ff'],
            stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
            },
            xaxis: {
            categories: {!! json_encode($prd) !!},
            labels: {
                rotate: 0
            }
            },
            fill: {
            opacity: 1
            },
            tooltip: {
            y: {
                formatter: function (val) {
                    return formatRupiah(val)
                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#renprod"), options);
        chart.render();

        var options = {
            series: [{
                name: "Produksi",
                data: [{!! implode(', ', $prdss) !!}]
            },
            {
                name: "Renprod",
                data: [{!! implode(', ', $prds) !!}]
            }],
            chart: {
            type: 'bar',
            height: 400
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '40%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
            enabled: false
            },
            colors: ['#7367F0', '#d2b0ff'],
            stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
            },
            xaxis: {
            categories: {!! json_encode($prd) !!},
            labels: {
                rotate: 0
            }
            },
            fill: {
            opacity: 1
            },
            tooltip: {
            shared: true,
            y: {
                formatter: function (val) {
                    return formatRupiah(val)
                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#persediaan"), options);
        chart.render();

        var options = {
            series: [{
                name: "Persediaan",
                data: [{!! implode(', ', $pers) !!}]
            },
            {
                name: "Distribusi",
                data: [{!! implode(', ', $dis) !!}]
            }],
            chart: {
            type: 'bar',
            height: 400
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '40%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
            enabled: false
            },
            colors: ['#7367F0', '#d2b0ff'],
            stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
            },
            xaxis: {
            categories: {!! json_encode($prd) !!},
            labels: {
                rotate: 0
            }
            },
            fill: {
            opacity: 1
            },
            tooltip: {
            shared: true,
            y: {
                formatter: function (val) {
                    return formatRupiah(val)
                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#distribusi"), options);
        chart.render();

        // Chart Status Pengajuan RKO
        var catrko = ['Menunggu Persetujuan', 'Disetujui', 'Belum'];
        var labelrko = ['Diajukan', 'Disetujui', 'Belum Mengajukan'];
        var options = {
            series: [{
                name: 'Jumlah',
                data: [{!! implode(', ', $rko) !!}]
            }],
            chart: {
                type: 'bar',
                height: 330,
                events: {
                    click: function(event, chartContext, config) {
                        if (config.dataPointIndex == -1) return;
                        $('.statrko').text(labelrko[config.dataPointIndex]);
                        detail_rko(catrko[config.dataPointIndex]);
                    }
                }
            },
            colors: [chartColors.pie.kuning, chartColors.pie.ijo, chartColors.pie.merah],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '45%',
                    endingShape: 'rounded',
                    distributed: true
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: labelrko,
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                shared: true,
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#status-pengajuan-rko"), options);
        chart.render();

        // Chart Kategori Bahan Produksi
        var catkbb = [{!! count($kbb) == 0 ? '' : "'" . implode("', '", $kbb) .  "'" !!}];
        var idkbb = [{!! count($kbbid) == 0 ? '' : "'" . implode("', '", $kbbid) .  "'" !!}];
        var options = {
            series: [{
                name: 'Jumlah',
                data: [{!! implode(', ', $kbbs) !!}]
            }],
            chart: {
                type: 'bar',
                height: 330,
                events: {
                    click: function(event, chartContext, config) {
                        if (config.dataPointIndex == -1) return;
                        $('.statkbb').text(catkbb[config.dataPointIndex]);
                        detail_kbb(idkbb[config.dataPointIndex]);
                    }
                }
            },
            colors: [chartColors.pie.merah, chartColors.pie.ijo, chartColors.pie.kuning, chartColors.pie.biru],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                    distributed: true
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: catkbb,
            },
            yaxis: {
                title: {
                    // text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                shared: true,
                y: {
                    formatter: function(val) {
                        return formatRupiah(val)
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#kategori-bahan-produksi"), options);
        chart.render();

var table_rko, table_kbb;
function detail_rko(kat) {
    table_rko = $('#rko').DataTable({
        scrollX: true,
        loading: true,
        destroy: true,
        lengthMenu: [ 9, 25, 50, 75, 100 ],
        ajax: '{{ url("lafibiovak/rko/list-faskes") }}?tahun=' + $('#tahun').val() + '&status=' + kat,
        columns: [
            {
                data: 'nama_rs'
            },
            {
                data: 'waktu_pengajuan',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!data ? '-' :
                        new Date(data).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: 'numeric'
                        })
                    );
                }
            },
            {
                data: '',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!full.confirmed_at ? '' :
                        '<div class="mt-50"><b>' + full.status +
                            '</b> oleh <b>' + full.confirmed_by + '</b> pada <b>' + new Date(full.confirmed_at).toLocaleString('id-ID', {
                            year: 'numeric',
                            month: '2-digit',
                            day: 'numeric'
                        }) + '</b></div>'
                    );
                }
            },
            {
                data: 'id_rko',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return (!data ? '-' :
                        '<div class="mt-50"><a href="{{url("lafibiovak/rko/download")}}/' + data +
                            '" target="_blank"><i data-feather="download" class="font-medium-4 mr-75"></i>Lihat Dokumen</a></div>'
                    );
                }
            },
        ],
        "drawCallback": function(settings) {
            $("#modal-rko").modal('show');
        }
    });
}

function detail_kbb(kat) {
    table_kbb = $('#kat').DataTable({
        scrollX: true,
        loading: true,
        destroy: true,
        lengthMenu: [ 6, 25, 50, 75, 100 ],
        ajax: "{{ url('/lafibiovak/bahan-produksi/list') }}?kategori=" + kat,
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
            },
            {
                data: 'nama_bahan_produksi',
            },
            {
                data: 'satuan',
                className: 'text-center',
            },
            {
                data: 'spesifikasi',
                className: 'text-center',
            },
            {
                data: 'kemasan_min',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return data ? formatRupiah(data) : '';
                }
            },
            {
                data: 'perusahaan',
                className: 'text-center',
            },
            {
                data: 'negara',
                className: 'text-center',
            },
            {
                data: 'renada',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return data ? formatRupiah(data) : '';
                }
            },
            {
                data: 'jumlah_awal',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'transaksi_sum_jumlah',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafiad',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafial',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Lafiau',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Labiomed',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'Labiovak',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(data);
                }
            },
            {
                data: '',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(full.Lafiad + full.Lafial + full.Lafiau + full.Labiomed + full.Labiovak);
                }
            },
            {
                data: '',
                className: 'text-right',
                render: function(data, type, full, meta) {
                    return formatRupiah(full.jumlah_awal + parseInt(full.transaksi_sum_jumlah) - full.Lafiad - full.Lafial - full.Lafiau - full.Labiomed - full.Labiovak);
                }
            },
            {
                data: 'keterangan',
            }
        ],
        "drawCallback": function(settings) {
            $("#modal-kat").modal('show');
        }
    });
}
    </script>
@endsection
