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
    
    .nav-vertical .nav.nav-tabs .nav-item .nav-link.active:after{left:auto;right:15.5rem;-webkit-transform:rotate(90deg) translate3d(0,225%,0);transform:rotate(90deg) translate3d(0,225%,0);top:1.25rem;width:2.14rem}
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
                                        {{ $rs->nama_rs }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 font-weight-bolder">
                                        Jenis RS
                                    </div>
                                    <div class="col-9">
                                        {{ $rs->jenis_rs }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 font-weight-bolder">
                                        Alamat                               
                                    </div>
                                    <div class="col-9">
                                        {{ $rs->alamat }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 font-weight-bolder">
                                        Kotama / Satker / Sub Satker
                                    </div>
                                    <div class="col-9">
                                        {{ $rs->ket }}
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
                                        <h1 class="font-large-4 text-primary font-weight-bolder text-center mb-1">{{ ($nakes['Dokter Umum TNI']+$nakes['Dokter Umum PNS']+$nakes['Dokter Umum Honorer']) }}</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Dokter Umum</h5>
                                        <div class="text-center">
                                            <span class="font-small-2">Spesialis: {{ ($nakes['Dokter Spesialis TNI']+$nakes['Dokter Spesialis PNS']+$nakes['Dokter Spesialis Honorer']) }} Orang</span><br />
                                            <span class="font-small-2">Sub-Spesialis: {{ ($nakes['Dokter Sub-Spesialis TNI']+$nakes['Dokter Sub-Spesialis PNS']+$nakes['Dokter Sub-Spesialis Honorer']) }} Orang</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h1 class="font-large-4 text-primary font-weight-bolder text-center mb-1">{{ ($nakes['Dokter Gigi Umum TNI']+$nakes['Dokter Gigi Umum PNS']+$nakes['Dokter Gigi Umum Honorer']) }}</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Gigi Umum</h5>
                                        <div class="text-center">
                                            <span class="font-small-2">Spesialis: {{ ($nakes['Dokter Gigi Spesialis TNI']+$nakes['Dokter Gigi Spesialis PNS']+$nakes['Dokter Gigi Spesialis Honorer']) }} Orang</span><br />
                                            <span class="font-small-2">Sub-Spesialis: {{ ($nakes['Dokter Gigi Sub-Spesialis TNI']+$nakes['Dokter Gigi Sub-Spesialis PNS']+$nakes['Dokter Gigi Sub-Spesialis Honorer']) }} Orang</span>
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
                                                <p class="card-text font-small-3 mb-0">{{ ($nakes['Dokter Umum TNI']+$nakes['Dokter Spesialis TNI']+$nakes['Dokter Sub-Spesialis TNI']+$nakes['Dokter Gigi Umum TNI']+$nakes['Dokter Gigi Spesialis TNI']+$nakes['Dokter Gigi Sub-Spesialis TNI']) }} Orang</p>
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
                                                <p class="card-text font-small-3 mb-0">{{ ($nakes['Dokter Umum PNS']+$nakes['Dokter Spesialis PNS']+$nakes['Dokter Sub-Spesialis PNS']+$nakes['Dokter Gigi Umum PNS']+$nakes['Dokter Gigi Spesialis PNS']+$nakes['Dokter Gigi Sub-Spesialis PNS']) }} Orang</p>
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
                                                <p class="card-text font-small-3 mb-0">{{ ($nakes['Dokter Umum Honorer']+$nakes['Dokter Spesialis Honorer']+$nakes['Dokter Sub-Spesialis Honorer']+$nakes['Dokter Gigi Umum Honorer']+$nakes['Dokter Gigi Spesialis Honorer']+$nakes['Dokter Gigi Sub-Spesialis Honorer']) }} Orang</p>
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
                                            @php $idx = 1; @endphp
                                            @foreach($kategori as $k)
                                            <li class="nav-item font-medium-2 pr-1">
                                                <a class="nav-link pl-3 {{$idx==1?'active':''}}" id="baseVerticalLeft-tab{{$idx}}" data-toggle="tab" aria-controls="tabVerticalLeft{{$idx}}" href="#tabVerticalLeft{{$idx++}}" role="tab" aria-selected="{{$idx==2?'true':'false'}}">{{$k->nama_kategori}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Ambulance</h4>    
                                                            <p class="text-muted mb-1">Mohon isi jumlah fasilitas ambulance yang tersedia</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['Ambulance'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-0"><span class="bullet bullet-primary"></span></td>
                                                        <td class="border-top-0 width-250 pr-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Unit</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft2" role="tabpanel" aria-labelledby="baseVerticalLeft-tab2">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Jalan</h4>    
                                                            <p class="text-muted mb-1">Mohon isi daftar poli umum dan spesialis</p> 
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table">
                                                    <tr>
                                                        <th class="border-top-0 width-200 pl-0">Poli Umum</th>
                                                        <th class="border-top-0 width-200">Poli Gigi</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border-top-0 text-muted pl-0">Spesialis</th>
                                                        <th class="border-top-0 text-muted">Spesialis</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                        @forelse($poli['PS'] as $p)
                                                            <span class="bullet bullet-primary mr-50 cursor-pointer"></span><span class="font-small-5 ml-1">{{$p}}</span><br />
                                                        @empty
                                                            -
                                                        @endforelse
                                                        </td>
                                                        <td class="border-top-0">
                                                        @forelse($poli['PGS'] as $p)
                                                            <span class="bullet bullet-primary mr-50 cursor-pointer"></span><span class="font-small-5 ml-1">{{$p}}</span><br />
                                                        @empty
                                                            -
                                                        @endforelse
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="border-top-0 text-muted pl-0">Sub - Spesialis</th>
                                                        <th class="border-top-0 text-muted">Sub - Spesialis</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                        @forelse($poli['PSB'] as $p)
                                                            <span class="bullet bullet-primary mr-50 cursor-pointer"></span><span class="font-small-5 ml-1">{{$p}}</span><br />
                                                        @empty
                                                            -
                                                        @endforelse
                                                        </td>
                                                        <td class="border-top-0">
                                                        @forelse($poli['PGSB'] as $p)
                                                            <span class="bullet bullet-primary mr-50 cursor-pointer"></span><span class="font-small-5 ml-1">{{$p}}</span><br />
                                                        @empty
                                                            -
                                                        @endforelse
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>                                            
                                            <div class="tab-pane" id="tabVerticalLeft3" role="tabpanel" aria-labelledby="baseVerticalLeft-tab3">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas IGD</h4>    
                                                            <p class="text-muted mb-1">Mohon isi jumlah tempat tidur IGD yang tersedia</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['IGD'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 width-100 pr-0 pl-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Tempat Tidur</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft4" role="tabpanel" aria-labelledby="baseVerticalLeft-tab4">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat inap</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['Rawat Inap'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-0"><span class="bullet bullet-primary"></span></td>
                                                        <td class="border-top-0 width-200 pr-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Tempat Tidur</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft5" role="tabpanel" aria-labelledby="baseVerticalLeft-tab5">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Khusus</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat inap khusus</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['Rawat Inap Khusus'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-0"><span class="bullet bullet-primary"></span></td>
                                                        <td class="border-top-0 width-200 pr-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Tempat Tidur</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft6" role="tabpanel" aria-labelledby="baseVerticalLeft-tab6">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Covid</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat inap covid</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['Rawat Inap Covid'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-0"><span class="bullet bullet-primary"></span></td>
                                                        <td class="border-top-0 width-200 pr-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Tempat Tidur</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>                                            
                                            <div class="tab-pane" id="tabVerticalLeft7" role="tabpanel" aria-labelledby="baseVerticalLeft-tab7">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Unggulan</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas unggulan yang tersedia di Rumah Sakit. (abaikan jika tidak ada)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <section id="accordion-with-margin" class="mb-2">
                                                    <div class="collapse-icon">
                                                        <div class="collapse-margin" id="accordionExample">
                                                        @foreach($fasrs['Fasilitas Unggulan'] as $f)
                                                            @if($f->jumlah == 1)
                                                            <div class="card">
                                                                <div class="card-header" data-toggle="collapse" role="button" data-target="#c{{$f->id_fasilitas}}" aria-expanded="false" aria-controls="c{{$f->id_fasilitas}}">
                                                                    <span class="lead collapse-title"> <i data-feather="command" class="font-medium-5 mr-75"></i> {{$f->fasilitas->nama_fasilitas}}</span>
                                                                </div>                            
                                                                <div id="c{{$f->id_fasilitas}}" class="collapse" data-parent="#accordionExample">
                                                                    <div class="card-body">
                                                                        <table class="table ml-0">
                                                                            <tr>
                                                                                <td class="border-top-0 pl-0" id="ket{{$f->id_fasilitas_rs}}">
{{$f->keterangan}}
                                                                                </td>
                                                                                <td class="border-top-0 pl-0 pr-0 width-150 text-right">
                                                                                    <button class="btn btn-outline-primary waves-effect" data-id="{{$f->id_fasilitas_rs}}" data-fas="{{$f->fasilitas->nama_fasilitas}}" onclick="edit_ket($(this))">
                                                                                        <i data-feather="edit" class="mr-50"></i><span>Edit</span>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft8" role="tabpanel" aria-labelledby="baseVerticalLeft-tab8">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Diagnostik</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang diagnostik  yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <section id="accordion-with-margin" class="mb-2">
                                                    <div class="collapse-icon">
                                                        <div class="collapse-margin" id="accordionExample1">
                                                        @foreach($fasrs['Penunjang Diagnostik'] as $f)
                                                            @if($f->jumlah == 1)
                                                            <div class="card">
                                                                <div class="card-header" data-toggle="collapse" role="button" data-target="#c{{$f->id_fasilitas}}" aria-expanded="false" aria-controls="c{{$f->id_fasilitas}}">
                                                                    <span class="lead collapse-title"> <i data-feather="command" class="font-medium-5 mr-75"></i> {{$f->fasilitas->nama_fasilitas}}</span>
                                                                </div>                            
                                                                <div id="c{{$f->id_fasilitas}}" class="collapse" data-parent="#accordionExample1">
                                                                    <div class="card-body">
                                                                        <table class="table ml-0">
                                                                            <tr>
                                                                                <td class="border-top-0 pl-0" id="ket{{$f->id_fasilitas_rs}}">
{{$f->keterangan}}
                                                                                </td>
                                                                                <td class="border-top-0 pl-0 pr-0 width-150 text-right">
                                                                                    <button class="btn btn-outline-primary waves-effect" data-id="{{$f->id_fasilitas_rs}}" data-fas="{{$f->fasilitas->nama_fasilitas}}" onclick="edit_ket($(this))">
                                                                                        <i data-feather="edit" class="mr-50"></i><span>Edit</span>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft9" role="tabpanel" aria-labelledby="baseVerticalLeft-tab9">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Radiologi</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas radiologi yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <section id="accordion-with-margin" class="mb-2">
                                                    <div class="collapse-icon">
                                                        <div class="collapse-margin" id="accordionExample2">
                                                        @foreach($fasrs['Radiologi'] as $f)
                                                            @if($f->jumlah == 1)
                                                            <div class="card">
                                                                <div class="card-header" data-toggle="collapse" role="button" data-target="#c{{$f->id_fasilitas}}" aria-expanded="false" aria-controls="c{{$f->id_fasilitas}}">
                                                                    <span class="lead collapse-title"> <i data-feather="command" class="font-medium-5 mr-75"></i> {{$f->fasilitas->nama_fasilitas}}</span>
                                                                </div>                            
                                                                <div id="c{{$f->id_fasilitas}}" class="collapse" data-parent="#accordionExample2">
                                                                    <div class="card-body">
                                                                        <table class="table ml-0">
                                                                            <tr>
                                                                                <td class="border-top-0 pl-0" id="ket{{$f->id_fasilitas_rs}}">
{{$f->keterangan}}
                                                                                </td>
                                                                                <td class="border-top-0 pl-0 pr-0 width-150 text-right">
                                                                                    <button class="btn btn-outline-primary waves-effect" data-id="{{$f->id_fasilitas_rs}}" data-fas="{{$f->fasilitas->nama_fasilitas}}" onclick="edit_ket($(this))">
                                                                                        <i data-feather="edit" class="mr-50"></i><span>Edit</span>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft10" role="tabpanel" aria-labelledby="baseVerticalLeft-tab10">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Klinis</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang klinis yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <section id="accordion-with-margin" class="mb-2">
                                                    <div class="collapse-icon">
                                                        <div class="collapse-margin" id="accordionExample3">
                                                        @foreach($fasrs['Penunjang Klinis'] as $f)
                                                            @if($f->jumlah == 1)
                                                            <div class="card">
                                                                <div class="card-header" data-toggle="collapse" role="button" data-target="#c{{$f->id_fasilitas}}" aria-expanded="false" aria-controls="c{{$f->id_fasilitas}}">
                                                                    <span class="lead collapse-title"> <i data-feather="command" class="font-medium-5 mr-75"></i> {{$f->fasilitas->nama_fasilitas}}</span>
                                                                </div>                            
                                                                <div id="c{{$f->id_fasilitas}}" class="collapse" data-parent="#accordionExample3">
                                                                    <div class="card-body">
                                                                        <table class="table ml-0">
                                                                            <tr>
                                                                                <td class="border-top-0 pl-0" id="ket{{$f->id_fasilitas_rs}}">
{{$f->keterangan}}
                                                                                </td>
                                                                                <td class="border-top-0 pl-0 pr-0 width-150 text-right">
                                                                                    <button class="btn btn-outline-primary waves-effect" data-id="{{$f->id_fasilitas_rs}}" data-fas="{{$f->fasilitas->nama_fasilitas}}" onclick="edit_ket($(this))">
                                                                                        <i data-feather="edit" class="mr-50"></i><span>Edit</span>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft11" role="tabpanel" aria-labelledby="baseVerticalLeft-tab11">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Ruang Operasi</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas ruang operasi yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table width-50-per">
                                                    @foreach($fasrs['Ruang Operasi'] as $f)
                                                    <tr>
                                                        <td class="border-top-0 pl-0 pr-0"><span class="bullet bullet-primary"></span></td>
                                                        <td class="border-top-0 width-200 pr-0">{{$f->fasilitas->nama_fasilitas}}</td>
                                                        <td class="border-top-0">:</td>
                                                        <td class="border-top-0">{{$f->jumlah}} Tempat Tidur</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
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
                <div class="modal fade text-left" id="modal-ket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Update Keterangan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <h5>Fasilitas : <span id="nama-fas"></span></h5>
                                <form>
                                    <label for="ket-fas">Keterangan</label>
                                    <textarea class="form-control" id="ket-fas" name="keterangan" rows="3"></textarea>
                                    @csrf
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
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
            $(".modal-footer button").click(function() {
                if ($('form')[0].checkValidity()) {
                    $(this).prop('disabled', true);
                    $(this).text('Menyimpan...');
                    $.ajax({
                        url: "{{ url('matfaskes/faskes/update-keterangan') }}/" + id,
                        method: 'POST',
                        dataType: "json",
                        data: $('form').serialize(),
                        success: function(res) {
                            if (!res.error) {
                                $('#ket'+id).text($('#ket-fas').val());
                                Swal.fire({
                                    title: 'Info',
                                    text: res.message,
                                    icon: 'info',
                                });
                            }
                        }
                    }).always(function() {
                        $(".modal-footer button").prop('disabled', false);
                        $(".modal-footer button").text('Simpan');
                        $('#modal-ket').modal('hide');
                    });
                } else $('form').addClass('was-validated');
            });
        });
        var id = '';

        function edit_ket(e) {
            id = e.attr('data-id');
            $('form').removeClass('was-validated');
            $('#nama-fas').html(e.attr('data-fas'));
            $('#ket-fas').val($('#ket'+id).text().trim());
            $('#modal-ket').modal('show');
        }
    </script>
@endsection