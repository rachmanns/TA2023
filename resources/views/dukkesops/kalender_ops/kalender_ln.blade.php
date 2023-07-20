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
                            <h2 class="content-header-title float-left">Kalender Ops LN</h2>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group input-group-merge form-input">
                                <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer"
                                    placeholder="Tahun" readonly />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 text-right">
                            <a href="/dukkesops/satgas-ln"><button class="btn btn-outline-primary"> Bekkes Satgas LN
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-2">
                                <h4 class="card-title font-weight-bolder font-large-1">2022</h4>
                                <ul class="nav nav-pills justify-content-end border border-primary">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="kalender-ops" data-toggle="pill" href="#kalender"
                                            aria-expanded="true">Kalender</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="list-ops" data-toggle="pill" href="#list"
                                            aria-expanded="false">List</a>
                                    </li>
                                </ul>
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
                                                            <li class="timeline-item period">
                                                                <div class="timeline-info"></div>
                                                                <div class="timeline-marker"></div>
                                                                <div class="timeline-content">
                                                                    <h2 class="timeline-title">Januari</h2>
                                                                </div>
                                                            </li>
                                                            <li class="timeline-item">
                                                                <div class="timeline-info">
                                                                    <h3 class="timeline-title">Kedatangan pekan 1</h3>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-marker"></div>
                                                                <div class="timeline-content">
                                                                    <h3 class="timeline-title">Kepulangaan pekan 1</h3>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="timeline-item">
                                                                <div class="timeline-info">
                                                                    <h3 class="timeline-title">Kedatangan pekan 1</h3>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-marker"></div>
                                                                <div class="timeline-content">
                                                                    <h3 class="timeline-title">Kepulangaan pekan 1</h3>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="card bg-primary text-white">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title text-white">
                                                                                        Primary card title</h4>
                                                                                    <p class="card-text">Some quick example
                                                                                        text to build on the card title and
                                                                                        make up.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>





                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="list" role="tabpanel" aria-labelledby="list-ops"
                                        aria-expanded="false">
                                        <div class="border rounded">
                                            <table class="table table-striped table-responsive-lg" id="kalender-list">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th style="min-width: 150px;">Batalyon</th>
                                                        <th style="min-width: 150px;">Satgas Ops</th>
                                                        <th style="min-width: 150px;">Berangkat Ops</th>
                                                        <th style="min-width: 150px;">Pulang Ops</th>
                                                        <th class="text-center">Total Jumlah Personil</th>
                                                        <th class="text-center" style="min-width: 100px;">Bekkes</th>
                                                        <th class="text-center" style="min-width: 100px;">Nota Dinas</th>
                                                        <th class="text-center" style="min-width: 150px;">Status</th>
                                                        <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>

                                        <!-- Modal Detail Bekkes-->
                                        <div class="modal fade" id="detail-bekkes" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Bekkes
                                                            Satgas</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>YONIF 725 WOROAGI - PAMTAS RI PNG SEKTOR TENGAH</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th style="min-width: 150px;">Pos</th>
                                                                        <th>KAT PRAPAS</th>
                                                                        <th>KAT DOKTER</th>
                                                                        <th>KAT WAT</th>
                                                                        <th>KAT BANWAT</th>
                                                                        <th>KAT AMBULANS</th>
                                                                        <th>KAT PRATUGAS</th>
                                                                        <th>KAT POS SATGASOPS</th>
                                                                        <th>KAT SERPAS</th>
                                                                        <th>KAT Kesyon</th>
                                                                        <th>KAT ENDEMIK A</th>
                                                                        <th>KAT ENDEMIK B</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>Simpang PNG</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                        <td>1</td>
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th class="text-right" colspan="2">Total :
                                                                        </th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                        <th>4</th>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Jumlah Personil-->
                                        <div class="modal fade" id="detail-personil" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Jumlah
                                                            Personil Satgas</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>YONIF 725 WOROAGI - PAMTAS RI PNG SEKTOR TENGAH</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Pos</th>
                                                                        <th>Jumlah Personil</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>Simpang PNG</td>
                                                                        <td>12</td>
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th class="text-right" colspan="2">Total :
                                                                        </th>
                                                                        <th>12</th>
                                                                </tfoot>
                                                            </table>
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
    </div>
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
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
