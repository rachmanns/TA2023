@extends('partials.template')

@section('page_style')
    <style>
        .nav-pills .nav-link {
            border-radius: 0rem;
        }

        .nav-pills {
            margin-bottom: 0rem;
        }

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

        /// timeline css

        .example-header {
            background: #3d4351;
            color: #fff;
            font-weight: 300;
            padding: 3em 1em;
            text-align: center;
        }

        .example-header h1 {
            color: #fff;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .example-header p {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 700;
        }

        .container-fluid .row {
            padding: 0 0 4em 0;
        }

        /* .container-fluid .row:nth-child(even) {
                        background: #f1f4f5;
                    } */

        .example-title {
            text-align: center;
            margin-bottom: 60px;
            padding: 3em 0;
            border-bottom: 1px solid #e4eaec;
        }

        .example-title p {
            margin: 0 auto;
            font-size: 16px;
            max-width: 400px;
        }

        /*==================================
                        TIMELINE
                    ==================================*/
        /*-- GENERAL STYLES
                        ------------------------------*/
        .timeline {
            line-height: 1.4em;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .timeline h1,
        .timeline h2,
        .timeline h3,
        .timeline h4,
        .timeline h5,
        .timeline h6 {
            line-height: inherit;
        }

        /*----- TIMELINE ITEM -----*/
        .timeline-item {
            padding-left: 40px;
            position: relative;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        /*----- TIMELINE INFO -----*/
        .timeline-info {
            /* font-size: 12px; */
            /* font-weight: 700; */
            /* letter-spacing: 3px; */
            /* margin: 0 0 0.5em 0; */
            /* text-transform: uppercase; */
            /* white-space: nowrap; */
        }

        /*----- TIMELINE MARKER -----*/
        .timeline-marker {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 15px;
        }

        .label-berangkat-pulang:before {
            background: #d9d9d9 !important;
        }

        .timeline-marker:before {
            background: #ff6b6b;
            border: 3px solid transparent;
            border-radius: 100%;
            content: "";
            display: block;
            height: 15px;
            position: absolute;
            top: 4px;
            left: 0;
            width: 15px;
            transition: background 0.3s ease-in-out, border 0.3s ease-in-out;
        }

        .timeline-marker:after {
            content: "";
            width: 3px;
            background: #ccd5db;
            display: block;
            position: absolute;
            top: 24px;
            bottom: 0;
            left: 6px;
        }

        .timeline-item:last-child .timeline-marker:after {
            content: none;
        }

        .timeline-item:not(.period):hover .timeline-marker:before {
            background: transparent;
            border: 3px solid #ff6b6b;
        }
        .timeline-item:not(.period):hover .label-berangkat-pulang:before {
            background: transparent;
            border: 3px solid #a1a1a1 !important;
        }
        
        /*----- TIMELINE CONTENT -----*/
        .timeline-content {
            padding-bottom: 40px;
        }

        .timeline-content p:last-child {
            margin-bottom: 0;
        }

        /*----- TIMELINE PERIOD -----*/
        .period {
            padding: 0;
        }

        .period .timeline-info {
            display: none;
        }

        .period .timeline-marker:before {
            background: transparent;
            content: "";
            width: 15px;
            height: auto;
            border: none;
            border-radius: 0;
            top: 0;
            bottom: 30px;
            position: absolute;
            border-top: 3px solid #ccd5db;
            border-bottom: 3px solid #ccd5db;
        }

        .period .timeline-marker:after {
            content: "";
            height: 32px;
            top: auto;
        }

        .period .timeline-content {
            padding: 40px 0 70px;
        }

        .period .timeline-title {
            margin: 0;
        }

        /*----------------------------------------------
                            MOD: TIMELINE SPLIT
                        ----------------------------------------------*/
        @media (min-width: 768px) {

            .timeline-split .timeline,
            .timeline-centered .timeline {
                display: table;
            }

            .timeline-split .timeline-item,
            .timeline-centered .timeline-item {
                display: table-row;
                padding: 0;
            }

            .timeline-split .timeline-info,
            .timeline-centered .timeline-info,
            .timeline-split .timeline-marker,
            .timeline-centered .timeline-marker,
            .timeline-split .timeline-content,
            .timeline-centered .timeline-content,
            .timeline-split .period .timeline-info {
                display: table-cell;
                vertical-align: top;
            }

            .timeline-split .timeline-marker,
            .timeline-centered .timeline-marker {
                position: relative;
            }

            .timeline-split .timeline-content,
            .timeline-centered .timeline-content {
                padding-left: 30px;
            }

            .timeline-split .timeline-info,
            .timeline-centered .timeline-info {
                padding-right: 30px;
            }

            .timeline-split .period .timeline-title,
            .timeline-centered .period .timeline-title {
                position: relative;
                left: -45px;
            }
        }

        /*----------------------------------------------
                            MOD: TIMELINE CENTERED
                        ----------------------------------------------*/
        @media (min-width: 992px) {

            .timeline-centered,
            .timeline-centered .timeline-item,
            .timeline-centered .timeline-info,
            .timeline-centered .timeline-marker,
            .timeline-centered .timeline-content {
                display: block;
                margin: 0;
                padding: 0;
            }

            .timeline-centered .timeline-item {
                padding-bottom: 40px;
                overflow: hidden;
            }

            .timeline-centered .timeline-marker {
                position: absolute;
                left: 50%;
                margin-left: -7.5px;
            }

            .timeline-centered .timeline-info,
            .timeline-centered .timeline-content {
                width: 50%;
            }

            .timeline-centered>.timeline-item:nth-child(odd) .timeline-info {
                float: left;
                text-align: right;
                padding-right: 30px;
            }

            .timeline-centered>.timeline-item:nth-child(odd) .timeline-content {
                float: right;
                text-align: left;
                padding-left: 30px;
            }

            .timeline-centered>.timeline-item:nth-child(even) .timeline-info {
                float: left;
                text-align: right;
                padding-right: 30px;
            }

            .timeline-centered>.timeline-item:nth-child(even) .timeline-content {
                float: right;
                text-align: left;
                padding-left: 30px;
            }

            .timeline-centered>.timeline-item.period .timeline-content {
                float: none;
                padding: 0;
                width: 100%;
                text-align: center;
            }

            .timeline-centered .timeline-item.period {
                padding: 50px 0 90px;
            }

            .timeline-centered .period .timeline-marker:after {
                height: 30px;
                bottom: 0;
                top: auto;
            }

            .timeline-centered .period .timeline-title {
                left: auto;
            }
        }

        /*----------------------------------------------
                            MOD: MARKER OUTLINE
                        ----------------------------------------------*/
        .marker-outline .timeline-marker:before {
            background: transparent;
            border-color: #ff6b6b;
        }

        .marker-outline .timeline-item:hover .timeline-marker:before {
            background: #ff6b6b;
        }

        .timeline .timeline-item {
            border-left: 0px !important;
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
                            <h2 class="content-header-title float-left">Kalender Ops {{ strtoupper($type) }}</h2>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="form-control bg-white cursor-pointer"
                                    placeholder="Tahun" readonly value="{{ $year_current }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 text-right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-2">
                                <h4 class="card-title font-weight-bolder align-center font-large-1">{{ $year_current }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="kalender"
                                        aria-labelledby="kalender-ops" aria-expanded="true">
                                        <div class="row">

                                            <div class="container-fluid">
                                                <div class="row example-centered">
                                                    <div class="col-xs-10 col-xs-offset-1 col-sm-11 col-sm-offset-1">
                                                        <ul class="timeline timeline-centered">
                                                            @foreach ($month as $key => $item)
                                                                @if (isset($return[$key]))
                                                                    <li class="timeline-item period">
                                                                        <div class="timeline-info"></div>
                                                                        <div class="timeline-marker"></div>
                                                                        <div class="timeline-content">
                                                                            <h2 class="timeline-title">{{ $item }}
                                                                            </h2>
                                                                        </div>
                                                                    </li>
                                                                    <li class="timeline-item ">
                                                                        <div class="timeline-info">
                                                                            <h3 class="timeline-title">Keberangkatan</h3>
                                                                        </div>
                                                                        <div class="timeline-marker label-berangkat-pulang"></div>
                                                                        <div class="timeline-content">
                                                                            <h3 class="timeline-title">Kepulangan</h3>
                                                                        </div>
                                                                    </li>

                                                                    @foreach ($return[$key] as $pekan => $detail_pekan)
                                                                        <li class="timeline-item">
                                                                            <div class="timeline-info">
                                                                                <h4 class="timeline-title">
                                                                                    {{ $pekan }}</h4>
                                                                                <div class="row">
                                                                                    @if (isset($detail_pekan['berangkat']))
                                                                                        @foreach ($detail_pekan['berangkat'] as $satgas => $batalyon)
                                                                                            <div class="col-12">
                                                                                                <div class="card" style="border: 3px solid lightblue;">
                                                                                                    <div class="card-body p-0">
                                                                                                        <h5 class="font-weight-bolder p-1 mb-1" style="background-color: lightblue;">
                                                                                                            {{ $satgas }}
                                                                                                        </h5>
                                                                                                        @foreach ($batalyon as $pasukan)
                                                                                                        <div class="mb-75 px-1">
                                                                                                            <a href="/dukkesops/pos-satgas/peta-sebaran?id_pos={{$pasukan->pos_satgas[0]->id_pos ?? '#'}}"><u> {{ $pasukan->nama_batalyon }} </u></a>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                            <div class="timeline-marker"></div>
                                                                            <div class="timeline-content">
                                                                                <h4 class="timeline-title">{{ $pekan }}</h4>
                                                                                <div class="row">

                                                                                    @if (isset($detail_pekan['pulang']))
                                                                                        @foreach ($detail_pekan['pulang'] as $satgas => $batalyon)
                                                                                            <div class="col-12">
                                                                                                <div class="card" style="border: 3px solid rgba(76, 175, 80, 0.3);">
                                                                                                    <div class="card-body p-0">
                                                                                                        <h5
                                                                                                            class="font-weight-bolder p-1 mb-1" style="background-color: rgba(76, 175, 80, 0.3);">
                                                                                                            {{ $satgas }}
                                                                                                        </h5>
                                                                                                        @foreach ($batalyon as $pasukan)
                                                                                                        <div class="mb-75 px-1">
                                                                                                            <a href="/dukkesops/pos-satgas/peta-sebaran?id_pos={{$pasukan->pos_satgas[0]->id_pos ?? '#'}}"><u> {{ $pasukan->nama_batalyon }} </u></a>
                                                                                                        </div>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $("#tahun").yearpicker({
            startYear: new Date().getFullYear() - 10,
            endYear: new Date().getFullYear() + 10,
            onChange: function(value) {
                if (value) window.location.href = "{{ url('/dukkesops/kalender/' . $type) }}/" + value;
            }
        });
        var table = $('#kalender-list').DataTable({
            ajax: "{{ url('/app-assets/data/kalender-dn.json') }}",
            scrollX: true,
            columns: [{
                    data: 'no'
                },
                {
                    data: 'batalyon'
                },
                {
                    data: 'satgas'
                },
                {
                    data: 'berangkat'
                },
                {
                    data: 'pulang'
                },
                {
                    data: 'jml'
                },
                {
                    data: 'bekkes'
                },
                {
                    data: 'nota'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                }
            ],
            "drawCallback": function(settings) {
                feather.replace();
            }
        });
    </script>
@endsection
