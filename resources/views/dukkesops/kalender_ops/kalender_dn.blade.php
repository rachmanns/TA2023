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
                        <h2 class="content-header-title float-left">Kalender Ops DN</h2>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="input-group input-group-merge form-input">
                            <input type="text" id="tahun" class="yearpicker form-control bg-white cursor-pointer" placeholder="Tahun" readonly />
                            <div class="input-group-append">
                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-12 text-right">
                        <button class="btn btn-outline-primary mr-75"> <i data-feather="upload" class="mr-50"></i> Export Excell</button>
                        <a href="/tambah_kalender_dn"><button class="btn btn-primary"> Tambah Jadwal Penugasan </button></a>
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
                                    <a class="nav-link active" id="kalender-ops" data-toggle="pill" href="#kalender" aria-expanded="true">Kalender</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="list-ops" data-toggle="pill" href="#list" aria-expanded="false">List</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="kalender" aria-labelledby="kalender-ops" aria-expanded="true">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">JANUARI</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>

                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Jadwal Keberangkatan Bulan Januari</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="demo-spacing-0">
                                                                        <div class="alert alert-success mb-1 alert-validation-msg" role="alert">
                                                                            <div class="alert-body font-weight-bolder">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th><i data-feather="circle" class="mr-50 align-middle"></i></th>
                                                                                        <th style="min-width: 150px;"><span class="font-small-2">YONIF RK 744/SYB</span></th>
                                                                                        <th><span class="font-small-2">SATGAS PAMTAS RI-RDTL SEKTOR TIMUR</span></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="alert alert-primary mb-1 alert-validation-msg" role="alert">
                                                                            <div class="alert-body font-weight-bolder">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th><i data-feather="circle" class="mr-50 align-middle"></i></th>
                                                                                        <th style="min-width: 150px;"><span class="font-small-2">YONIF RK 744/SYB</span></th>
                                                                                        <th><span class="font-small-2">SATGAS PAMTAS RI-RDTL SEKTOR TIMUR</span></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="alert alert-warning mb-1 alert-validation-msg" role="alert">
                                                                            <div class="alert-body font-weight-bolder">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th><i data-feather="circle" class="mr-50 align-middle"></i></th>
                                                                                        <th style="min-width: 150px;"><span class="font-small-2">YONIF RK 744/SYB</span></th>
                                                                                        <th><span class="font-small-2">SATGAS PAMTAS RI-RDTL SEKTOR TIMUR</span></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="alert alert-danger mb-1 alert-validation-msg" role="alert">
                                                                            <div class="alert-body font-weight-bolder">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th><i data-feather="circle" class="mr-50 align-middle"></i></th>
                                                                                        <th style="min-width: 150px;"><span class="font-small-2">YONIF RK 744/SYB</span></th>
                                                                                        <th><span class="font-small-2">SATGAS PAMTAS RI-RDTL SEKTOR TIMUR</span></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="alert alert-info mb-1 alert-validation-msg" role="alert">
                                                                            <div class="alert-body font-weight-bolder">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th><i data-feather="circle" class="mr-50 align-middle"></i></th>
                                                                                        <th style="min-width: 150px;"><span class="font-small-2">YONIF RK 744/SYB</span></th>
                                                                                        <th><span class="font-small-2">SATGAS PAMTAS RI-RDTL SEKTOR TIMUR</span></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <span class="font-small-3">Total 5 Batalyon berangkat di bulan Januari</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">FEBRUARI</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">MARET</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">APRIL</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">MEI</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">JUNI</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">JULI</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">AGUSTUS</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">SEPTEMBER</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">OKTOBER</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">NOVEMBER</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="card border">
                                                <div class="card-body shadow">
                                                    <h5 class="text-center font-weight-bolder mb-2">DESEMBER</h5>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF 501/K</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONIF R 400/IV</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-50">
                                                        <span class="bullet bullet-primary bullet-sm mr-1"></span>
                                                        <span>YONMEK 413/K</span>
                                                    </div>
                                                    <div class="text-right mt-2">
                                                        <a href="#" data-toggle='modal' data-target='#detail' class="font-small-1 font-weight-bolder"> <u> +2 LEBIH BANYAK </u></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="list" role="tabpanel" aria-labelledby="list-ops" aria-expanded="false">
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
                                    <div class="modal fade" id="detail-bekkes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Bekkes Satgas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                    <th class="text-right" colspan="2">Total : </th>
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
                                    <div class="modal fade" id="detail-personil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Jumlah Personil Satgas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                    <th class="text-right" colspan="2">Total : </th>
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