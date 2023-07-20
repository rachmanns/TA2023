@extends('partials.template')

@section('page_style')
    <style>
        .underline {
            text-decoration: underline;
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

        .nav-vertical .nav.nav-tabs .nav-item .nav-link.active:after {
            left: auto;
            right: 15.5rem;
            -webkit-transform: rotate(90deg) translate3d(0, 225%, 0);
            transform: rotate(90deg) translate3d(0, 225%, 0);
            top: 1.25rem;
            width: 2.14rem
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Detail Fasilitas Rumah Sakit</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-2">Informasi Rumah Sakit</h3>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 font-weight-bolder">
                                        Nama RS
                                    </div>
                                    <div class="col-9">
                                        Rumah Sakit Pusat Angkatan Darat
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 font-weight-bolder">
                                        Tingkat RS
                                    </div>
                                    <div class="col-9">
                                        Tingkat
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 font-weight-bolder">
                                        Alamat
                                    </div>
                                    <div class="col-9">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 font-weight-bolder">
                                        Komando
                                    </div>
                                    <div class="col-9">
                                        Kesdam Jaya
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-2">Jumlah Dokter</h3>
                                    </div>
                                </div>
                                <div class="row my-auto">
                                    <div class="col-6">
                                        <h1 class="font-large-4 text-primary font-weight-bolder text-center mb-1">30</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Dokter Umum</h5>
                                        <div class="text-center">
                                            <span class="font-small-2">Spesialis 20 Orang</span>
                                            <span class="font-small-1">Sub-Spesialis 20 Orang</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h1 class="font-large-4 text-primary font-weight-bolder text-center mb-1">30</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Gigi Umum</h5>
                                        <div class="text-center">
                                            <span class="font-small-2">Spesialis 20 Orang</span>
                                            <span class="font-small-1">Sub-Spesialis 20 Orang</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="font-weight-bolder mb-2">Jumlah Nakes</h3>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:5px;">
                                    <div class="col-12 mb-2">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2 p-25">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">Total Nakes Militer</h4>
                                                <p class="card-text font-small-3 mb-0">20 Orang</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2 p-25">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">Total Nakes PNS</h4>
                                                <p class="card-text font-small-3 mb-0">20 Orang</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2 p-25">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">Total Nakes Honorer</h4>
                                                <p class="card-text font-small-3 mb-0">20 Orang</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vertical Tabs start -->
                <section id="vertical-tabs">
                    <div class="row">
                        <!-- Vertical Left Tabs start -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="nav-vertical">
                                        <ul class="nav nav-tabs nav-left flex-column border-right" role="tablist">
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link active pl-3" id="baseVerticalLeft-tab1" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab"
                                                    aria-selected="true">Ambulance</a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab2" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2"
                                                    role="tab" aria-selected="false">Rawat Jalan</a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab3" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3"
                                                    role="tab" aria-selected="false">IGD
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab4" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft4" href="#tabVerticalLeft4"
                                                    role="tab" aria-selected="false">Rawat Inap
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab5" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft5" href="#tabVerticalLeft5"
                                                    role="tab" aria-selected="false">Rawat Inap Khusus
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab6" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft6" href="#tabVerticalLeft6"
                                                    role="tab" aria-selected="false">Rawat Inap Covid
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab7" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft7" href="#tabVerticalLeft7"
                                                    role="tab" aria-selected="false">Fasilitas Unggulan
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab8" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft8" href="#tabVerticalLeft8"
                                                    role="tab" aria-selected="false">Penunjang Diagnostik
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab9" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft9" href="#tabVerticalLeft9"
                                                    role="tab" aria-selected="false">Radiologi
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab10" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft10" href="#tabVerticalLeft10"
                                                    role="tab" aria-selected="false">Penunjang Klinis
                                                </a>
                                            </li>
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3" id="baseVerticalLeft-tab11" data-toggle="tab"
                                                    aria-controls="tabVerticalLeft11" href="#tabVerticalLeft11"
                                                    role="tab" aria-selected="false">Ruang Operasi
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab1">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Ambulance</h4>
                                                            <p class="text-muted mb-1">Mohon isi jumlah fasilitas ambulance
                                                                yang tersedia</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#ambulance">Tambah Fasilitas</button>

                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="ambulance"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Ambulance" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="igd">Ambulance Intensif/Gawat
                                                                    Darurat</label>
                                                                <input type="text" class="form-control" id="igd"
                                                                    placeholder="Ambulance Intensif/Gawat Darurat" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="igd">Ambulance Transfort</label>
                                                                <input type="text" class="form-control" id="igd"
                                                                    placeholder="Ambulance Transfort" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group">
                                                                <label for="igd">Ambulance Jenazah</label>
                                                                <input type="text" class="form-control" id="igd"
                                                                    placeholder="Ambulance Jenazah" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft2" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab2">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Jalan</h4>
                                                            <p class="text-muted mb-1">Mohon isi daftar poli umum dan
                                                                spesialis</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <h5 class="font-weight-bolder">Poli</h5>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 pl-0" style="width: 50%;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customCheck1" />
                                                                <label class="custom-control-label"
                                                                    for="customCheck1">Poli Umum</label>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customCheck2" />
                                                                <label class="custom-control-label"
                                                                    for="customCheck2">Poli Gigi Umum</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Spesialis</label>
                                                                <select class="select2 form-control" multiple>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Spesialis</label>
                                                                <select class="select2 form-control" multiple>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Sub Spesialis</label>
                                                                <select class="select2 form-control" multiple>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Sub Spesialis</label>
                                                                <select class="select2 form-control" multiple>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                    <option selected>Option</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft3" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab3">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas IGD</h4>
                                                            <p class="text-muted mb-1">Mohon isi jumlah tempat tidur IGD
                                                                yang tersedia</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#igd">Tambah Fasilitas</button>

                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="igd"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="IGD" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group pr-1">
                                                    <label for="igd">IGD</label>
                                                    <input type="text" class="form-control" id="igd"
                                                        placeholder="Jumlah tempat tidur IGD" />
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft4" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab4">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap</h4>
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat
                                                                inap</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#rawat_inap">Tambah Fasilitas</button>

                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_inap"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Rawat Inap" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tambah Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table mb-1">
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Vip</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Kelas 1</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Kelas 2</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Kelas 3</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd">
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">ICU</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">NICU/PICU</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">ICCU</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd">
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Unit Luka Bakar</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd">
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Ruang Isolasi</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft5" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab5">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Khusus</h4>
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat
                                                                inap khusus</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#rawat_inap_khusus">Tambah Fasilitas</button>

                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_inap_khusus"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Rawat Inap Khusus" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tambah Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table mb-1">
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Perina/Bayi</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Anak</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Trauma Militer</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft6" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab6">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Covid</h4>
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat
                                                                inap covid</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table mb-1">
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">ICU</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="igd">Isolasi</label>
                                                                <input type="text" class="form-control"
                                                                    id="igd" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft7" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab7">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Unggulan</h4>
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas unggulan yang
                                                                tersedia di Rumah Sakit. (abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#unggulan">Tambah Fasilitas</button>

                                                            <div class="modal fade text-left" id="unggulan"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Fasilitas Unggulan" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tambah Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox trauma">
                                                        <input type="checkbox" class="custom-control-input trauma" id="trauma" onclick="valueChanged()" />
                                                        <label class="custom-control-label" for="trauma">Trauma</label>
                                                    </div>
                                                </div>
                                                <div class="mt-1" id="ket">
                                                    <div class="form-group form-input keterangan" style="display: none;">
                                                        <label class="form-label">Keterangan</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Keterangan" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="estetika" />
                                                        <label class="custom-control-label"
                                                            for="estetika">Estetika/Kecantikan/Anti Aging</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="dsa" />
                                                        <label class="custom-control-label" for="dsa">DSA</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="hipobolic" />
                                                        <label class="custom-control-label"
                                                            for="hipobolic">Hipobolic</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="hiperbolic" />
                                                        <label class="custom-control-label"
                                                            for="hiperbolic">Hiperbolic</label>
                                                    </div>
                                                </div>
                                                <div class="text-right mb-3">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft8" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab8">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Diagnostik
                                                            </h4>
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang
                                                                diagnostik yang tersedia di Faskes. (Abaikan jika tidak ada)
                                                            </p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#diagnostik">Tambah Fasilitas</button>

                                                            <div class="modal fade text-left" id="diagnostik"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Fasilitas Penunjang Diagnostik"
                                                                                    readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="klinik" />
                                                        <label class="custom-control-label" for="klinik">Lab Patologi
                                                            Klinik</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="anatomi" />
                                                        <label class="custom-control-label" for="anatomi">Lab Patologi
                                                            Anatomi</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="mikro" />
                                                        <label class="custom-control-label" for="mikro">Lab
                                                            Mikrobiologi</label>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft9" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab9">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Radiologi</h4>
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas radiologi yang
                                                                tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#radiologi">Tambah Fasilitas</button>

                                                            <div class="modal fade text-left" id="radiologi"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Radiologi" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="mmri" />
                                                        <label class="custom-control-label" for="mmri">MMRI</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="ct" />
                                                        <label class="custom-control-label" for="ct">CT-Scan</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="usg" />
                                                        <label class="custom-control-label" for="usg">USG</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="ray" />
                                                        <label class="custom-control-label" for="ray">X-Ray</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="endoskopi" />
                                                        <label class="custom-control-label"
                                                            for="endoskopi">Endoskopi</label>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft10" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab10">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Klinis</h4>
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang
                                                                klinis yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#klinis">Tambah Fasilitas</button>

                                                            <div class="modal fade text-left" id="klinis"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Penunjang Klinis" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nama Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="fisio" />
                                                        <label class="custom-control-label"
                                                            for="fisio">Fisioterapi</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="radio" />
                                                        <label class="custom-control-label"
                                                            for="radio">Radioterapi</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="haemo" />
                                                        <label class="custom-control-label"
                                                            for="haemo">Haemodialisa</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="cath" />
                                                        <label class="custom-control-label"
                                                            for="cath">Cath-Lab</label>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft11" role="tabpanel"
                                                aria-labelledby="baseVerticalLeft-tab11">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Ruang Operasi</h4>
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas ruang operasi
                                                                yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#rawat_operasi">Tambah Fasilitas</button>

                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_operasi"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">
                                                                                Tambah Fasilitas</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="Ruang Operasi" readonly />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Tambah Fasilitas</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tambah Fasilitas" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#"><button type="submit"
                                                                                    class="btn btn-primary">Simpan</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table mb-1">
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label>Ruang Operasi IGD</label>
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label>Ruang Operasi Sentral</label>
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Vertical Left Tabs ends -->
                    </div>
                </section>
                <!-- Vertical Tabs end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
        function toggleText() {
            var x = document.getElementById("show");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function valueChanged() {
            if ($('.trauma').is(":checked")) {
                $(".keterangan").show();
            } else {
                $(".keterangan").hide();
            }
        }

        // function hide(){
        //     document.getElementById('ket').style.display ='none';
        // }
        // function show(){
        //     document.getElementById('ket').style.display = 'block';
        // }
    </script>
@endsection
