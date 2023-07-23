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

    .detail {
        cursor: pointer;
    }

    .detail:hover {
        color: red !important;
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
                <div class="content-header-left col-md-9 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Bed Occupancy Ratio (Update terakhir: <b> {{ $last_update }} </b>)</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-3">
                    <select id="matra" class="select2 form-control form-control-lg" onchange="location.href='/yankesin/bor-covid/'+this.value">
                        <option disabled>Pilih Matra</option>
                        <option value="all" selected>Semua Matra</option>
                        @foreach($matra as $m)
                        <option value="{{$m->kode_matra}}" @if(request()->segment(3) == $m->kode_matra) selected @endif>{{$m->nama_matra}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="content-body">
                 <!-- Line Chart Card -->
                <div class="row match-height">
                    <!-- Code Changes: remove class col-md-6 -->
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('IGD')">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('IGD')">Ruang IGD<h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['IGD_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['IGD']-$data['IGD_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('Kamar Bersalin')">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('Kamar Bersalin')">Kamar Bersalin</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Kamar Bersalin_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Kamar Bersalin']-$data['Kamar Bersalin_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">Rawat Inap</h3>
                                </div>                                      
                            </div>
                            <div class="card-body">
                                <div id="rawat-inap"></div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <div>
                                    <h3 class="font-weight-bolder text-center">ICU</h3>
                                </div>                                
                            </div>
                            <div class="card-body">
                                <div id="icu"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart Card -->  
                <div class="row match-height">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('Unit Luka Bakar')">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('Unit Luka Bakar')">Unit Luka Bakar</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Unit Luka Bakar_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Unit Luka Bakar']-$data['Unit Luka Bakar_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('Ruang Isolasi Non-Covid')">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('Ruang Isolasi Non-Covid')">Ruang Isolasi</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Isolasi Non-Covid_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Isolasi Non-Covid']-$data['Ruang Isolasi Non-Covid_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-developer-meetup">
                            <div class="card-header justify-content-center pb-0">
                                <h3 class="font-weight-bolder text-center">Ruang Rawat Khusus</h3><br>    
                            </div>         
                            <div class="card-header">               
                                <div class="row">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25" onclick="detail_fas('Perina/ Bayi')">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25 detail" onclick="detail_fas('Perina/ Bayi')">Perina / Bayi</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Perina_isi'] ?? 0}}</td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Perina']-$data['Perina_isi']}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25" onclick="detail_fas('Anak')">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25 detail" onclick="detail_fas('Anak')">Anak</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Anak_isi'] ?? 0}}</td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Anak']-$data['Anak_isi']}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12">
                                        <div class="meetup-header d-flex align-items-center">
                                            <div class="meetup-day">
                                                <div class="avatar bg-light-primary p-25" onclick="detail_fas('Trauma Militer')">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="card-title m-0 pb-25 detail" onclick="detail_fas('Trauma Militer')">Trauma Militer</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 p-0 pr-2">Terisi</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Trauma Militer_isi'] ?? 0}}</td>
                                                        <td class="border-top-0 p-0 pr-2">Tersedia</td>
                                                        <td class="border-top-0 p-0 pr-1">:</td>
                                                        <td class="border-top-0 p-0 pr-2">{{$data['Trauma Militer']-$data['Trauma Militer_isi']}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('Ruang Operasi IGD')">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('Ruang Operasi IGD')">Ruang Operasi IGD<h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Operasi IGD_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Operasi IGD']-$data['Ruang Operasi IGD_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="row justify-content-center">
                                <div class="media pt-2">
                                    <div class="avatar bg-light-primary mr-2 p-75" onclick="detail_fas('Ruang Operasi Sentral')">
                                        <div class="avatar-content">
                                            <i data-feather="monitor" class="avatar-icon font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 detail" onclick="detail_fas('Ruang Operasi Sentral')">Ruang Operasi Sentral</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Terisi</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Operasi Sentral_isi'] ?? 0}}</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Tersedia</p>
                                        <h3 class="font-weight-bolder mb-0">{{$data['Ruang Operasi Sentral']-$data['Ruang Operasi Sentral_isi']}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Detail Rawat Inap</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="font-weight-bolder">Fasilitas : <span id="fas"></span></h4>
                            
                            <div class="table-responsive border rounded my-1">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Faskes</th>
                                            <th>Terisi</th>
                                            <th>Tersedia</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">BOR Covid</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="modal" data-target="#send-invoice-sidebar"><i
                                    data-feather="filter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Line Chart Card -->
                <section id="apexchart">
                    <div class="row match-height">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h3 class="font-weight-bolder">TT ICU</h3>
                                </div>
                                <div class="text-center">
                                    <span class="bullet mr-1" style="background-color: #1C55E0;"></span><span
                                        class="font-medium-1">Terisi :</span><span
                                        class="font-medium-1 ml-1 font-weight-bolder"
                                        style="color: #1C55E0;">{{ $tt_icu['Terisi'] }}</span>
                                    <span class="bullet mr-1 ml-2 bg-warning"></span><span class="font-medium-1">Tersedia
                                        :</span><span
                                        class="font-medium-1 ml-1 font-weight-bolder text-warning">{{ $tt_icu['Tersedia'] }}</span>
                                </div>
                                <div class="card-body mt-0">
                                    <div id="tt-icu"></div>
                                    <div class="text-center mt-1">
                                        <span class="font-medium-4 font-weight-bolder mr-2">Total TT ICU</span><span
                                            class="text-success font-medium-4 font-weight-bolder">{{ $tt_icu['Terisi'] + $tt_icu['Tersedia'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h3 class="font-weight-bolder">TT Isolasi</h3>
                                </div>
                                <div class="text-center">
                                    <span class="bullet mr-1" style="background-color: #1C55E0;"></span><span
                                        class="font-medium-1">Terisi :</span><span
                                        class="font-medium-1 ml-1 font-weight-bolder"
                                        style="color: #1C55E0;">{{ $tt_isolasi['Terisi'] }}</span>
                                    <span class="bullet mr-1 ml-2 bg-warning"></span><span class="font-medium-1">Tersedia
                                        :</span><span
                                        class="font-medium-1 ml-1 font-weight-bolder text-warning">{{ $tt_isolasi['Tersedia'] }}</span>
                                </div>
                                <div class="card-body mt-0">
                                    <div id="tt-isolasi"></div>
                                    <div class="text-center mt-1">
                                        <span class="font-medium-4 font-weight-bolder mr-2">Total TT Isolasi</span><span
                                            class="text-success font-medium-4 font-weight-bolder">{{ $tt_isolasi['Terisi'] + $tt_isolasi['Tersedia'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Line Chart Card -->

                <!-- ChartJS section start -->
                <section id="chartjs-chart">
                    <div class="row">
                        <!--Bar Chart Start -->
                        <div class="col-xl-6 col-6">
                            <div class="card">
                                <div
                                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">BOR Covid ICU</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="bor-covid-rs chartjs" data-height="600" id="bor-covid-rs"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart End -->
                        <!--Bar Chart Start -->
                        <div class="col-xl-6 col-6">
                            <div class="card">
                                <div
                                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">BOR Covid ISOLASI</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="tt-covid-rs chartjs" data-height="600" id="bar_isolasi"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart End -->
                    </div>
                </section>
                <!-- ChartJS section end -->
            </div>
        </div>
    </div>



    <!-- Send Invoice Sidebar -->
    <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">
                        <span class="align-middle">Filter</span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <form>
                        <div class="form-group">
                            <label for="nasional" class="form-label">Provinsi</label>
                            <select class="select2 form-control" id="nasional">
                                <option value="*">Nasional</option>
                                @foreach ($wil as $w)
                                    <option value="{{ $w->id_provinsi }}" @if (request()->prov == $w->id_provinsi) selected @endif>
                                        {{ $w->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matra2" class="form-label">Matra</label>
                            <select class="select2 form-control" id="matra2">
                                <option value="*">Semua Matra</option>
                                <option value="AD">TNI AD</option>
                                <option value="AL">TNI AL</option>
                                <option value="AU">TNI AU</option>
                                <option value="MABES">MABES</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kotama" class="form-label">Kotama</label>
                            <select class="select2 form-control" id="kotama" disabled>
                                <option value="*">Semua Kotama</option>
                            </select>
                        </div>
                        <div class="form-group d-flex flex-wrap mt-2">
                            <button type="button" class="btn btn-primary mr-1 btn-filter"
                                data-dismiss="modal">Filter</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Send Invoice Sidebar -->
    <!-- END: Content-->
@endsection

@section('page_script')
    <script>
        var table;
        function detail_fas(fas, kat='') {
            params = 'fas=' + fas;
            if ($('#matra').val() != 'all') params += '&matra=' + $('#matra').val();
            table = $('#table').DataTable({
                loading: true,
                destroy: true,
                ajax: "{{ url('yankesin/bor-covid/detail') }}?" + params,
                columns: [
                    {
                        data: 'nama_rs',
                    },
                    {
                        data: '',
                        render: function(data, a, row) {
                            return row.bor ? row.bor.terpakai : '0';
                        }
                    },
                    {
                        data: 'jumlah',
                        render: function(data, a, row) {
                            return data - (row.bor ? row.bor.terpakai : 0);
                        }
                    },
                ],
                displayLength: 9,
                lengthMenu: [9, 25, 50, 75, 100],
            });
            $('.modal-title').html('Detail BOR ' + fas + ' per Faskes');
            $('#fas').html(fas);
            $('#modal-detail').modal('show');
        }

        $(document).ready(function() {
            // Rawat Inap
            // --------------------------------------------------------------------
            var columnChartEl = document.querySelector('#rawat-inap'),
                columnChartConfig = {
                    chart: {
                        height: 250,
                        type: 'bar',
                        stacked: true,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        },
                        events: {
                            dataPointSelection: function(event, chartContext, config) {
                                detail_fas(config.w.config.xaxis.categories[config.dataPointIndex]);
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '40%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    colors: ['#7367F0', '#f8d3ff'],
                    stroke: {
                        show: true,
                        colors: ['transparent']
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    series: [{
                            name: 'Terisi',
                            data: [{{ $data['VIP_isi'] ?? 0 }}, {{ $data['Kelas 1_isi'] ?? 0 }},
                                {{ $data['Kelas 2_isi'] ?? 0 }}, {{ $data['Kelas 3_isi'] ?? 0 }}
                            ]
                        },
                        {
                            name: 'Tersedia',
                            data: [{{ ($data['VIP'] ?? 0) - ($data['VIP_isi'] ?? 0) }},
                                {{ ($data['Kelas 1'] ?? 0) - ($data['Kelas 1_isi'] ?? 0) }},
                                {{ ($data['Kelas 2'] ?? 0) - ($data['Kelas 2_isi'] ?? 0) }},
                                {{ ($data['Kelas 3'] ?? 0) - ($data['Kelas 3_isi'] ?? 0) }}
                            ]
                        }
                    ],
                    xaxis: {
                        categories: ['VIP', 'Kelas 1', 'Kelas 2', 'Kelas 3']
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        shared: true
                    },
                    yaxis: {
                        opposite: $('html').attr('data-textdirection') === 'rtl'
                    }
                };
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }

            // ICU
            // --------------------------------------------------------------------
            var columnChartEl = document.querySelector('#icu'),
                columnChartConfig = {
                    chart: {
                        height: 250,
                        type: 'bar',
                        stacked: true,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        },
                        events: {
                            dataPointSelection: function(event, chartContext, config) {
                                detail_fas(config.w.config.xaxis.categories[config.dataPointIndex]);
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '40%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    colors: ['#00CFE8', '#EA5455'],
                    stroke: {
                        show: true,
                        colors: ['transparent']
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    series: [{
                            name: 'Terisi',
                            data: [{{ $data['ICU_isi'] ?? 0 }}, {{ $data['NICU_isi'] ?? 0 }},
                                {{ $data['ICCU_isi'] ?? 0 }}, {{ $data['HCU_isi'] ?? 0 }},
                                {{ $data['ICU Isolasi_isi'] ?? 0 }}
                            ]
                        },
                        {
                            name: 'Tersedia',
                            data: [{{ ($data['ICU'] ?? 0) - ($data['ICU_isi'] ?? 0) }},
                                {{ ($data['NICU'] ?? 0) - ($data['NICU_isi'] ?? 0) }},
                                {{ ($data['ICCU'] ?? 0) - ($data['ICCU_isi'] ?? 0) }},
                                {{ ($data['HCU'] ?? 0) - ($data['HCU_isi'] ?? 0) }},
                                {{ ($data['ICU Isolasi'] ?? 0) - ($data['ICU Isolasi_isi'] ?? 0) }}
                            ]
                        }
                    ],
                    xaxis: {
                        categories: ['ICU', 'PICU/NICU', 'ICCU', 'HCU', 'ICU Isolasi']
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        shared: true
                    },
                    yaxis: {
                        opposite: $('html').attr('data-textdirection') === 'rtl'
                    }
                };
            if (typeof columnChartEl !== undefined && columnChartEl !== null) {
                var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
                columnChart.render();
            }


            $('#matra2').change(function() {
                if ($(this).val() == '*') {
                    $('#kotama').val('*').trigger('change');
                    $('#kotama').prop('disabled', true);
                } else $.ajax({
                    url: "{{ url('master/komando/select') }}/" + $(this).val(),
                    method: "GET",
                    dataType: "json",
                    success: function(result) {
                        $('#kotama').empty();
                        result.data[0] = {
                            id: '*',
                            text: 'Semua Kotama'
                        }
                        $('#kotama').select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            dropdownParent: $('#kotama').parent(),
                            data: result.data,
                        });
                        $('#kotama').prop('disabled', false);
                        @if (request()->kotama)
                            $('#kotama').val('{{ request()->kotama }}').trigger('change');
                        @endif
                    }
                });
            });
            @if (request()->matra)
                $('#matra2').val('{{ request()->matra }}').trigger('change');
            @endif

            $(".btn-filter").click(function() {
                params = 'p';
                if ($('#nasional').val() != '*') params += '&prov=' + $('#nasional').val();
                if ($('#matra2').val() != '*') params += '&matra=' + $('#matra2').val();
                if ($('#kotama').val() != '*') params += '&kotama=' + $('#kotama').val();
                location.href = '{{ request()->url }}?' + params;
            });

            // donat_chart("#bor-covid19",[20,50],["Tersedia","Terisi"])
            donat_chart("#tt-icu", {!! json_encode(array_values($tt_icu), JSON_NUMERIC_CHECK) !!}, {!! json_encode(array_keys($tt_icu)) !!})
            donat_chart("#tt-isolasi", {!! json_encode(array_values($tt_isolasi), JSON_NUMERIC_CHECK) !!}, {!! json_encode(array_keys($tt_isolasi)) !!})
            // tt_icu()
            // donat_chart("#tt-isolasi",[20,40],["Tersedia","Terisi"])

            bar_chart("#bor-covid-rs", {!! json_encode($bar_icu['angkatan']) !!}, {!! json_encode($bar_icu['tersedia'], JSON_NUMERIC_CHECK) !!}, {!! json_encode($bar_icu['terisi'], JSON_NUMERIC_CHECK) !!})
            bar_chart("#bar_isolasi", {!! json_encode($bar_isolasi['angkatan']) !!}, {!! json_encode($bar_isolasi['tersedia'], JSON_NUMERIC_CHECK) !!}, {!! json_encode($bar_isolasi['terisi'], JSON_NUMERIC_CHECK) !!})
            // bar_chart(".tt-covid-rs")

        });

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            grid_line_color = 'rgba(200, 200, 200, 0.2)',
            labelColor = '#6e6b7b',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            successColorShade = '#28dac6',
            chartColors = {
                column: {
                    series1: '#826af9',
                    series2: '#d2b0ff',
                    bg: '#f8d3ff'
                },
                success: {
                    shade_100: '#7eefc7',
                    shade_200: '#06774f'
                },
                donut: {
                    series1: '#ffe700',
                    series2: '#00d4bd',
                    series3: '#826bf8',
                    series4: '#2b9bf4',
                    series5: '#FFA1A1'
                },
                pie: {
                    terisi: '#1D55E0',
                    tersedia: '#FF9F42'
                },
                area: {
                    series3: '#a4f8cd',
                    series2: '#60f2ca',
                    series1: '#2bdac7'
                },
                line: {
                    red: "#ff4961",
                    grey: "#4F5D70",
                    grey_light: "#EDF1F4",
                    sky_blue: "#2b9bf4",
                    blue: "#1D55E0",
                    pink: "#F8D3FF",
                    gray_blue: "#ACBBEA",
                    success: "#2bdac7"
                }
            };

        function donat_chart(selector, series, labels) {
            var bor_covid_element = document.querySelector(selector),
                bor_covid_config = {
                    chart: {
                        height: 250,
                        type: 'pie'
                    },
                    colors: [chartColors.pie.tersedia, chartColors.pie.terisi],
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
                        show: false
                    },
                    stroke: {
                        lineCap: 'round'
                    },
                    series: series,
                    labels: labels
                };
            if (typeof bor_covid_element !== undefined && bor_covid_element !== null) {
                var radialChart = new ApexCharts(bor_covid_element, bor_covid_config);
                radialChart.render();
            }

        }

        function bar_chart(selector, label, data_tersedia, data_terisi) {
            var bar_chart_element = $(selector);

            if (bar_chart_element.length) {
                var barChartExample = new Chart(bar_chart_element, {
                    type: 'horizontalBar',
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderSkipped: 'right'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                            display: true,

                        },
                        tooltips: {
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        },
                        scales: {
                            xAxes: [{
                                barThickness: 15,
                                display: true,
                                gridLines: {
                                    display: true,
                                    color: grid_line_color,
                                    zeroLineColor: grid_line_color
                                },
                                scaleLabel: {
                                    display: false
                                },
                                ticks: {
                                    fontColor: labelColor
                                }
                            }],
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    color: grid_line_color,
                                    zeroLineColor: grid_line_color
                                },
                                ticks: {
                                    stepSize: 100,
                                    min: 0,
                                    max: 400,
                                    fontColor: labelColor
                                }
                            }]
                        }
                    },
                    data: {
                        labels: label,
                        datasets: [{
                                label: "Terisi",
                                data: data_terisi,
                                backgroundColor: chartColors.line.blue,
                                borderColor: 'transparent'
                            },
                            {
                                label: "Tersedia",
                                data: data_tersedia,
                                backgroundColor: chartColors.line.red,
                                borderColor: 'transparent'
                            }
                        ]
                    }
                });
            }
        }

        

    </script>
@endsection
