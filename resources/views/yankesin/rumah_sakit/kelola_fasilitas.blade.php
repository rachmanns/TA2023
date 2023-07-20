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
                                        {{ str_replace('RSS', 'Ops', $rs->jenis_rs) }}
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
                                        <h1 class="font-large-3 text-primary font-weight-bolder text-center mb-1">{{ ($nakes['Dokter Umum TNI']+$nakes['Dokter Umum PNS']+$nakes['Dokter Umum Honorer']) }}</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Dokter Umum</h5>
                                        <div class="text-center">
                                            <span class="font-small-2">Spesialis: {{ ($nakes['Dokter Spesialis TNI']+$nakes['Dokter Spesialis PNS']+$nakes['Dokter Spesialis Honorer']) }} Orang</span><br />
                                            <span class="font-small-2">Sub-Spesialis: {{ ($nakes['Dokter Sub-Spesialis TNI']+$nakes['Dokter Sub-Spesialis PNS']+$nakes['Dokter Sub-Spesialis Honorer']) }} Orang</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h1 class="font-large-3 text-primary font-weight-bolder text-center mb-1">{{ ($nakes['Dokter Gigi Umum TNI']+$nakes['Dokter Gigi Umum PNS']+$nakes['Dokter Gigi Umum Honorer']) }}</h1>
                                        <h5 class="text-center font-weight-bolder mb-1">Gigi <br> Umum</h5>
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
                                                <h4 class="font-weight-bolder mb-0">Total Dokter Militer</h4>
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
                                                <h4 class="font-weight-bolder mb-0">Total Dokter PNS</h4>
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
                                                <h4 class="font-weight-bolder mb-0">Total Dokter Honorer</h4>
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
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#ambulance">Tambah Fasilitas</button>
                                                            
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="ambulance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Ambulance" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Ambulance']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Ambulance']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button id="btn_ambulance" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_ambulance">
                                                  <table class="table tbl_ambulance">
                                                    <tr>
                                                        @php $i=0; @endphp
                                                        @foreach($fasrs['Ambulance'] as $f)
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @php $i++; @endphp
                                                        @if($i%3==0)
                                                    </tr>
                                                    <tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_ambulance" style="{{count($fasrs['Ambulance'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
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
                                                <h5 class="font-weight-bolder">Poli</h5>
                                                <form id="form_rawat_jalan">
                                                  <table class="table">
                                                    <tr>
                                                        <td class="border-top-0 pl-0" style="width: 50%;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="PU" id="cb_p" onchange="togglePoli(this)" @if($poli['PU']==1) checked @endif />
                                                                <label class="custom-control-label" for="cb_p">Poli Umum</label>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 pl-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="PGU" id="cb_pg" onchange="togglePoli(this)" @if($poli['PGU']==1) checked @endif />
                                                                <label class="custom-control-label" for="cb_pg">Poli Gigi Umum</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Spesialis</label>
                                                                <select class="select2 form-control cb_p" name="PS[]" multiple @if($poli['PU']==0) disabled @endif>
                                                                    @foreach($spu as $p)
                                                                    <option value="{{$p}}" @if(in_array($p, $poli['PS'])) selected @endif>{{$p}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Spesialis</label>
                                                                <select class="select2 form-control cb_pg" name="PGS[]" multiple @if($poli['PGU']==0) disabled @endif>
                                                                    @foreach($spg as $p)
                                                                    <option value="{{$p}}" @if(in_array($p, $poli['PGS'])) selected @endif>{{$p}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Sub Spesialis</label>
                                                                <select class="select2 form-control cb_p" name="PSB[]" multiple @if($poli['PU']==0) disabled @endif>
                                                                    @foreach($sbu as $p)
                                                                    <option value="{{$p}}" @if(in_array($p, $poli['PSB'])) selected @endif>{{$p}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <div class="pb-1 pr-1">
                                                                <label>Sub Spesialis</label>
                                                                <select class="select2 form-control cb_pg" name="PGSB[]" multiple @if($poli['PGU']==0) disabled @endif>
                                                                    @foreach($sbg as $p)
                                                                    <option value="{{$p}}" @if(in_array($p, $poli['PGSB'])) selected @endif>{{$p}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_rawat_jalan">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>                                            
                                            <div class="tab-pane" id="tabVerticalLeft3" role="tabpanel" aria-labelledby="baseVerticalLeft-tab3">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas IGD</h4>    
                                                            <p class="text-muted mb-1">Mohon isi jumlah tempat tidur IGD yang tersedia</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#igd">Tambah Fasilitas</button>
                                                            
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="igd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="IGD" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['IGD']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['IGD']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button id="btn_igd" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_igd">
                                                  <div class="tbl_igd">
                                                    @foreach($fasrs['IGD'] as $f)
                                                    <div class="form-group pr-1">
                                                        <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                        <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                        <div class="invalid-feedback">Jumlah harus diisi</div>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_igd" style="{{count($fasrs['IGD'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft4" role="tabpanel" aria-labelledby="baseVerticalLeft-tab4">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat inap</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#rawat_inap">Tambah Fasilitas</button>
                                                            
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_inap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Rawat Inap" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Rawat Inap']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Rawat Inap']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_rawat_inap" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_rawat_inap">
                                                  <table class="table mb-1 tbl_rawat_inap">
                                                    <tr>
                                                        @php $i=0; @endphp
                                                        @foreach($fasrs['Rawat Inap'] as $f)
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @php $i++; @endphp
                                                        @if($i%3==0)
                                                    </tr>
                                                    <tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_rawat_inap" style="{{count($fasrs['Rawat Inap'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-2 mb-2">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft5" role="tabpanel" aria-labelledby="baseVerticalLeft-tab5">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Khusus</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih daftar fasilitas rawat inap khusus</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#rawat_inap_khusus">Tambah Fasilitas</button>
                                                            
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_inap_khusus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Rawat Inap Khusus" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Rawat Inap Khusus']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Rawat Inap Khusus']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_rawat_inap_khusus" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_rawat_inap_khusus">
                                                  <table class="table mb-1 tbl_rawat_inap_khusus">
                                                    <tr>
                                                        @php $i=0; @endphp
                                                        @foreach($fasrs['Rawat Inap Khusus'] as $f)
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @php $i++; @endphp
                                                        @if($i%3==0)
                                                    </tr>
                                                    <tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_rawat_inap_khusus" style="{{count($fasrs['Rawat Inap Khusus'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft6" role="tabpanel" aria-labelledby="baseVerticalLeft-tab6">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Rawat Inap Covid</h4>    
                                                            <p class="text-muted mb-1">Mohon isi fasilitas rawat inap covid</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_rawat_inap_covid">
                                                  <table class="table mb-1">
                                                    <tr>
                                                        @foreach($fasrs['Rawat Inap Covid'] as $f)
                                                        <td class="border-top-0 pl-0 pr-1 pt-0">
                                                            <div class="form-group mb-0">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_rawat_inap_covid">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>                                            
                                            <div class="tab-pane" id="tabVerticalLeft7" role="tabpanel" aria-labelledby="baseVerticalLeft-tab7">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Unggulan</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas unggulan yang tersedia di Rumah Sakit. (abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#unggulan1">Tambah Fasilitas</button>
                                                            
                                                            <div class="modal fade text-left" id="unggulan1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Fasilitas Unggulan" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Fasilitas Unggulan']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Fasilitas Unggulan']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_unggulan1" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_unggulan1">
                                                  <div class="tbl_unggulan1">
                                                    @foreach($fasrs['Fasilitas Unggulan'] as $f)
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="unggulan1{{$f->id_fasilitas_rs}}" name="d{{$f->id_fasilitas_rs}}" @if($f->jumlah==1) checked @endif />
                                                            <label class="custom-control-label" for="unggulan1{{$f->id_fasilitas_rs}}">{{$f->fasilitas->nama_fasilitas}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </form>
                                                <div class="text-right mb-3 btn_simpan" id="btns_unggulan1" style="{{count($fasrs['Fasilitas Unggulan'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft8" role="tabpanel" aria-labelledby="baseVerticalLeft-tab8">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Diagnostik</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang diagnostik  yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0" style="min-width: 300px;">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#diagnostik">Tambah Fasilitas</button>
                                                            
                                                            <div class="modal fade text-left" id="diagnostik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Penunjang Diagnostik" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Penunjang Diagnostik']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Penunjang Diagnostik']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_diagnostik" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_diagnostik">
                                                  <div class="tbl_diagnostik">
                                                    @foreach($fasrs['Penunjang Diagnostik'] as $f)
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="diagnostik{{$f->id_fasilitas_rs}}" name="d{{$f->id_fasilitas_rs}}" @if($f->jumlah==1) checked @endif />
                                                            <label class="custom-control-label" for="diagnostik{{$f->id_fasilitas_rs}}">{{$f->fasilitas->nama_fasilitas}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_diagnostik" style="{{count($fasrs['Penunjang Diagnostik'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div> 
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft9" role="tabpanel" aria-labelledby="baseVerticalLeft-tab9">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Radiologi</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas radiologi yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#radiologi1">Tambah Fasilitas</button>
                                                            
                                                            <div class="modal fade text-left" id="radiologi1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Radiologi" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Radiologi']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Radiologi']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_radiologi1" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_radiologi1">
                                                  <div class="tbl_radiologi1">
                                                    @foreach($fasrs['Radiologi'] as $f)
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="radiologi1{{$f->id_fasilitas_rs}}" name="d{{$f->id_fasilitas_rs}}" @if($f->jumlah==1) checked @endif />
                                                            <label class="custom-control-label" for="radiologi1{{$f->id_fasilitas_rs}}">{{$f->fasilitas->nama_fasilitas}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </form>
                                                <div class="text-right mb-3 btn_simpan" id="btns_radiologi1" style="{{count($fasrs['Radiologi'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div> 
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft10" role="tabpanel" aria-labelledby="baseVerticalLeft-tab10">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Penunjang Klinis</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas penunjang klinis yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#klinis1">Tambah Fasilitas</button>
                                                            
                                                            <div class="modal fade text-left" id="klinis1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Penunjang Klinis" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Penunjang Klinis']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Penunjang Klinis']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_klinis1" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_klinis1">
                                                  <div class="tbl_klinis1">
                                                    @foreach($fasrs['Penunjang Klinis'] as $f)
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="klinis1{{$f->id_fasilitas_rs}}" name="d{{$f->id_fasilitas_rs}}" @if($f->jumlah==1) checked @endif />
                                                            <label class="custom-control-label" for="klinis1{{$f->id_fasilitas_rs}}">{{$f->fasilitas->nama_fasilitas}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </form>
                                                <div class="text-right mb-3 btn_simpan" id="btns_klinis1" style="{{count($fasrs['Penunjang Klinis'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1 mt-1">Simpan Data</button>
                                                </div> 
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft11" role="tabpanel" aria-labelledby="baseVerticalLeft-tab11">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Ruang Operasi</h4>    
                                                            <p class="text-muted mb-1">Mohon pilih fasilitas ruang operasi yang tersedia di Faskes. (Abaikan jika tidak ada)</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#rawat_operasi">Tambah Fasilitas</button>
                                                            
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="rawat_operasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Ruang Operasi" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Ruang Operasi']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Ruang Operasi']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_rawat_operasi" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_rawat_operasi">
                                                  <table class="table mb-1 tbl_rawat_operasi">
                                                    <tr>
                                                        @php $i=0; @endphp
                                                        @foreach($fasrs['Ruang Operasi'] as $f)
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @php $i++; @endphp
                                                        @if($i%3==0)
                                                    </tr>
                                                    <tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right mb-3 btn_simpan" id="btns_rawat_operasi" style="{{count($fasrs['Ruang Operasi'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-1">Simpan Data</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabVerticalLeft12" role="tabpanel" aria-labelledby="baseVerticalLeft-tab12">
                                                <table class="table ml-0">
                                                    <tr>
                                                        <td class="border-top-0 pl-0">
                                                            <h4 class="font-weight-bolder">Fasilitas Lainnya</h4>
                                                            <p class="text-muted mb-1">Mohon mengisi jumlah fasilitas lainnya</p>
                                                        </td>
                                                        <td class="border-top-0 text-right pr-1 pt-0">
                                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#faslain">Tambah Fasilitas</button>
                                                            {{-- Modal --}}
                                                            <div class="modal fade text-left" id="faslain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel18">Tambah Fasilitas</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Kategori Fasilitas</label>
                                                                                <input type="text" class="form-control" value="Fasilitas Lainnya" readonly/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Nama Fasilitas</label>
                                                                                <select class="select2 form-control">
                                                                                    @foreach($kategori['Fasilitas Lainnya']->fasilitas as $fas)
                                                                                    @if(!in_array($fas->nama_fasilitas, $fasrs_['Fasilitas Lainnya']))
                                                                                    <option value="{{$fas->id_fasilitas}}">{{$fas->nama_fasilitas}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="btn_faslain" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <form id="form_faslain">
                                                  <table class="table mb-1 tbl_faslain">
                                                    <tr>
                                                        @php $i=0; @endphp
                                                        @foreach($fasrs['Fasilitas Lainnya'] as $f)
                                                        <td class="border-top-0 pl-0">
                                                            <div class="form-group">
                                                                <label for="">{{$f->fasilitas->nama_fasilitas}}</label>
                                                                <input type="number" class="form-control" name="d{{$f->id_fasilitas_rs}}" value="{{$f->jumlah}}" placeholder="{{$f->fasilitas->nama_fasilitas}}" min="0" required />
                                                                <div class="invalid-feedback">Jumlah harus diisi</div>
                                                            </div>
                                                        </td>
                                                        @php $i++; @endphp
                                                        @if($i%3==0)
                                                    </tr>
                                                    <tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                  </table>
                                                </form>
                                                <div class="text-right btn_simpan" id="btns_faslain" style="{{count($fasrs['Fasilitas Lainnya'])==0?'display:none':''}}">
                                                    <button class="btn btn-primary mr-2 mb-2">Simpan Data</button>
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
    @csrf
    <!-- END: Content-->
@endsection    
@section('page_script')
    <script>
        function togglePoli(d) {
            $('.'+$(d).attr('id')).prop('disabled', !$(d).prop('checked'));
        }
        $( document ).ready(function() {
            $('select').each(function() {
              var sel = $(this);
              sel.select2({
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;
                    return {
                        id: term,
                        text: 'Opsi baru: ' + term,
                        newTag: true
                    }
                },
                templateSelection: function (data) {
                    return data.text.indexOf('Opsi baru:') == -1 ? data.text : data.text.substr(11);
                },
                dropdownParent: sel.parent()
              });
            });
            $('.modal-footer button').click(function() {
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                id = $(this).attr('id').substr(4);
				$.ajax({
                    url: '/yankesin/input/fasilitas',
                    method: "POST",
                    dataType: "json",
                    data: '_token='+$('input[name=_token]').val()+'&id_rs={{ $rs->id_rs }}'+'&idk='+$('#'+id+' input').val()+'&idf='+$('#'+id+' select').val(),
                    success: function (res) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        if (!res.error) {
                            if (id=='ambulance' || id=='rawat_inap' || id=='rawat_inap_khusus' || id=='rawat_operasi') {
                                data = '<td class="border-top-0 pl-0">'+
                                            '<div class="form-group">'+
                                                '<label for="">'+res.nama+'</label>'+
                                                '<input type="number" class="form-control" name="d'+res.idfr+'" value="0" placeholder="'+res.nama+'" min="0" required />'+
                                                '<div class="invalid-feedback">Jumlah harus diisi</div>'+
                                            '</div>'+
                                        '</td>';
                                ntd = $('.tbl_'+id+' tr').last().children().length;
                                if (ntd!=0 && ntd%3==0) $('.tbl_'+id).append('<tr>'+data+'</tr>');
                                else $('.tbl_'+id+' tr').last().append(data);
                            } else if (id=='igd') {
                                $('.tbl_'+id).append(
                                    '<div class="form-group pr-1">'+
                                        '<label for="">'+res.nama+'</label>'+
                                        '<input type="number" class="form-control" name="d'+res.idfr+'" value="0" placeholder="'+res.nama+'" min="0" required />'+
                                        '<div class="invalid-feedback">Jumlah harus diisi</div>'+
                                    '</div>');
                            } else {
                                $('.tbl_'+id).append(
                                    '<div class="form-group">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input type="checkbox" class="custom-control-input" id="append'+res.idfr+'" name="d'+res.idfr+'" />'+
                                            '<label class="custom-control-label" for="append'+res.idfr+'">'+res.nama+'</label>'+
                                        '</div>'+
                                    '</div>');
                            }
                            $('option[value="'+$('#'+id+' select').val()+'"]').remove();
                        }
                    }
                }).always(function() {
                    $('#btn_'+id).prop('disabled', false);
                    $('#btn_'+id).text('Simpan');
                    $('#btns_'+id).css('display', '');
                    $('#'+id).modal('hide');
                });
            });
            $('.btn_simpan button').click(function() {
                id = $(this).parent().attr('id').substr(5);
                if (!$('#form_'+id)[0].checkValidity()) {
                    $('#form_'+id).addClass('was-validated');
                    return;
                }
                $(this).prop('disabled', true);
                $(this).text('Menyimpan...');
                unchecked_cb = '';
                $('#form_'+id+' input:checkbox:not(:checked)').each(function(){
                    unchecked_cb += '&'+$(this).attr('name')+'=off';
                });
				$.ajax({
                    url: '/yankesin/input/fasilitas-rs',
                    method: "POST",
                    dataType: "json",
                    data: $('#form_'+id).serialize()+'&_token='+$('input[name=_token]').val()+'&kat='+id+'&id_rs={{ $rs->id_rs }}'+unchecked_cb,
                    success: function (res) {
                        if (!res.error) {
                            Swal.fire({
                                title: 'Info',
                                text: res.message,
                                icon: 'info',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                            $('#form_'+id).removeClass('was-validated');
                        }
                    }
                }).always(function() {
                    $('#btns_'+id+' button').prop('disabled', false);
                    $('#btns_'+id+' button').text('Simpan Data');
                });
            });
        });
    </script>
@endsection