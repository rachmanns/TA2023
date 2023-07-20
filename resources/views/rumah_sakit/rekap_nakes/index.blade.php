@extends('partials.template')

@section('page_style')
<style>
    .underline { text-decoration: underline; }
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Daftar Nakes & Paramedis</h2>
                        </div>
                    </div>
                </div>   
            </div>    
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">RSPAD Gatot Subroto </b></h2>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="content-body">
                <!-- Multilingual -->
                <section id="multilingual-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <nav class="nav-justified">
                                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active m-2 mb-0" id="nav-nakes-tab" data-toggle="tab"
                                                href="#nav-nakes" role="tab" aria-controls="nav-nakes"
                                                aria-selected="true"><span class="font-medium-4 font-weight-bolder">Data Nakes</span></a>
                                            <a class="nav-item nav-link m-2 mb-0" id="nav-paramedis-tab" data-toggle="tab"
                                                href="#nav-paramedis" role="tab" aria-controls="nav-paramedis"
                                                aria-selected="false"><span class="font-medium-4 font-weight-bolder">Data Paramedis</span></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-nakes" role="tabpanel"
                                            aria-labelledby="nav-nakes-tab">
                                            <div class="card-header border-bottom pt-0">
                                                <h4 class="card-title">Daftar Nakes</h4>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#nakes">Edit Data Nakes</button></a>
                                            </div>

                                            {{-- Modal Nakes --}}
                                            <div class="modal fade text-left" id="nakes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel18">Edit Data Nakes</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                        
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes TNI
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes PNS
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Nakes Honorer
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Umum
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Spesialis
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Sub - Spesialis
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Gigi Umum
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Gigi Spesialis
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Dokter Gigi Sub - Spesialis
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#"><button type="submit" class="btn btn-primary">Simpan</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped nakes">
                                                <thead>
                                                    <tr>
                                                        <th>Nakes</th>
                                                        <th>Jumlah Nakes Militer</th>
                                                        <th>Jumlah Nakes PNS</th>
                                                        <th>Jumlah Nakes Honorer</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="nav-paramedis" role="tabpanel"
                                            aria-labelledby="nav-paramedis-tab">
                                            <div class="card-header border-bottom pt-0">
                                                <h4 class="card-title">Daftar Paramedis</h4>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#paramedis">Edit Data Paramedis</button></a>
                                            </div>

                                            {{-- Modal Paramedis --}}
                                            <div class="modal fade text-left" id="paramedis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel18">Edit Data Paramedis</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                        
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Paramedis TNI
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Paramedis PNS
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Paramedis Honorer
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Perawat (Umum)
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Perawat (Anastesi)
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Perawat (Bedah)
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Perawat (Gigi)
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Apoteker
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    Paramedis Lainnya
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="igd" placeholder="Jumlah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#"><button type="submit" class="btn btn-primary">Simpan</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped paramedis">
                                                <thead>
                                                    <tr>
                                                        <th>Paramedis</th>
                                                        <th>Jumlah Paramedis Militer</th>
                                                        <th>Jumlah Paramedis PNS</th>
                                                        <th>Jumlah Paramedis Honorer</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Multilingual -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection