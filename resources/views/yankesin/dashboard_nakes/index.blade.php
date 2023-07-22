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

        .text-warning {
            cursor: pointer;
        }

        .text-warning:hover {
            color: #3085d6 !important;
        }

        /* Code Changes: Add style override modal class sizing */

        @media (min-width: 576px) {
            .modal-dialog {
                max-width:500px;
                margin: 1.75rem auto
            }

            .modal-dialog-scrollable {
                max-height: calc(100% - 3.5rem)
            }

            .modal-dialog-scrollable .modal-content {
                max-height: calc(100vh - 3.5rem)
            }

            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem)
            }

            .modal-dialog-centered::before {
                height: calc(100vh - 3.5rem);
                height: -webkit-min-content;
                height: -moz-min-content;
                height: min-content
            }

            .modal-sm {
                max-width: 400px
            }

            
            .modal-lg,
            .modal-xl {
                max-width: 800px; } 
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
                            <h2 class="content-header-title float-left">Data Nakes Dokter</h2> 
                        </div>
                    </div>
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left mb-0">Total Jumlah Nakes Dokter : {{ $total['Dokter'] }}</h5>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="modal" data-target="#send-invoice-sidebar" ><i data-feather="filter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Dokter TNI</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-nakes-tni">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-nakes-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dokter TNI</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES TNI'=>0); @endphp
                                                @foreach($data_dokter['nama_kategori'] as $k => $nk)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{$nk}}</td>
                                                    @foreach($data_dokter['TNI'] as $m => $d)
                                                    @php $res[$m] += $d[$nk]; @endphp
                                                    <td class="border-top-0">{{ $d[$nk] }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade text-left" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modal-title">Detail Dokter</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="font-weight-bolder lbl-cat"></h4>
                                            <h5 class="font-weight-bolder lbl-total"></h5>
                                            
                                            <div class="table-responsive border rounded my-1">
                                                <table class="table table-striped" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Faskes</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table text-center mb-2">
                                @php $a = 0 @endphp
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td class="border-top-0 p-0">{{ $data_dokter['nama_kategori'][$a] }}</td>    
                                        <td class="border-top-0 p-0">{{ $data_dokter['nama_kategori'][$a+1]??null }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="MILITER" data-nakes="{{ $data_dokter['nama_kategori'][$a]??''}}">{{$data_dokter['TNI']['AD'][$data_dokter['nama_kategori'][$a]]+$data_dokter['TNI']['AL'][$data_dokter['nama_kategori'][$a]]+$data_dokter['TNI']['AU'][$data_dokter['nama_kategori'][$a]]+$data_dokter['TNI']['MABES TNI'][$data_dokter['nama_kategori'][$a]]}}</span></td>
                                        
                                        @if (!empty($data_dokter['nama_kategori'][$a+1]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="MILITER" data-nakes="{{ $data_dokter['nama_kategori'][$a+1]??''}}">{{$data_dokter['TNI']['AD'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['TNI']['AL'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['TNI']['AU'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['TNI']['MABES TNI'][$data_dokter['nama_kategori'][$a+1]]}}</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @if (!empty($data_dokter['nama_kategori'][$a+1]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                    </tr>
                                    @php $a = $a+1+1 @endphp
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Dokter PNS</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-nakes-pns">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-nakes-pns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dokter PNS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES TNI'=>0); @endphp
                                                @foreach($data_dokter['nama_kategori'] as $k => $nk)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{$nk}}</td>
                                                    @foreach($data_dokter['PNS'] as $m => $d)
                                                    @php $res[$m] += $d[$nk]; @endphp
                                                    <td class="border-top-0">{{ $d[$nk] }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @php $a = 0 @endphp
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td class="border-top-0 p-0">{{ $data_dokter['nama_kategori'][$a] }}</td>    
                                        <td class="border-top-0 p-0">{{ $data_dokter['nama_kategori'][$a+1]??null }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="PNS" data-nakes="{{ $data_dokter['nama_kategori'][$a]??''}}">{{
                                                $data_dokter['PNS']['AD'][$data_dokter['nama_kategori'][$a]] +
                                                $data_dokter['PNS']['AL'][$data_dokter['nama_kategori'][$a]] +
                                                $data_dokter['PNS']['AU'][$data_dokter['nama_kategori'][$a]] +
                                                $data_dokter['PNS']['MABES TNI'][$data_dokter['nama_kategori'][$a]]
                                            }}</span></td>
                                        
                                        @if (!empty($data_dokter['nama_kategori'][$a+1]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="PNS" data-nakes="{{ $data_dokter['nama_kategori'][$a+1]??''}}">{{$data_dokter['PNS']['AD'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['PNS']['AL'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['PNS']['AU'][$data_dokter['nama_kategori'][$a+1]]+$data_dokter['PNS']['MABES TNI'][$data_dokter['nama_kategori'][$a+1]]}}</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @if (!empty($data_dokter['nama_kategori'][$a+1]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                    </tr>
                                    @php $a = $a+1+1 @endphp
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Dokter Honorer</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-nakes-honorer">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-nakes-honorer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dokter Honorer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES'=>0); @endphp
                                                @for($i=0;$i<6;$i++)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{substr($data2[$i*3], 0, -4)}}</td>
                                                    @foreach($data1 as $m => $d)
                                                    @php $res[$m] += $d[$data2[$i*3+2]]; @endphp
                                                    <td class="border-top-0">{{$d[$data2[$i*3+2]]}}</td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @for($i=0;$i<3;$i++)
                                <tr>
                                    @php $n = strrpos($data2[$i*3+2], ' ');
                                        $nakes1 = substr($data2[$i*3+2], 0, $n);
                                    @endphp
                                    <td class="border-top-0 p-0">{{$nakes1}}</td>
                                      @php $n = strrpos($data2[$i*3+11], ' ');
                                        $nakes2 = substr($data2[$i*3+11], 0, $n);
                                    @endphp
                                    <td class="border-top-0 p-0">{{(!empty($data2[$i*3+11])) ? $nakes2 : ''}}</td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="Honorer" data-nakes="{{ $nakes1 }}">{{$data1['AD'][$data2[$i*3+2]]+$data1['AL'][$data2[$i*3+2]]+$data1['AU'][$data2[$i*3+2]]+$data1['MABES'][$data2[$i*3+2]]}}</span></td>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Dokter" data-klas="Honorer" data-nakes="{{ $nakes2 }}">{{$data1['AD'][$data2[$i*3+11]]+$data1['AL'][$data2[$i*3+11]]+$data1['AU'][$data2[$i*3+11]]+$data1['MABES'][$data2[$i*3+11]]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row breadcrumbs-top mb-1">
                    <div class="col-12">
                        <h2 class="content-header-title float-left">Data Nakes Perawat</h2>
                    </div>
                    <div class="col-12">
                        <h5 class="content-header-title float-left mb-0">Total Jumlah Nakes Perawat : {{ $total['Perawat'] }}</h5>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Perawat TNI</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-param-tni">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-param-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Perawat TNI</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES TNI'=>0); @endphp
                                                @foreach($data_paramedis['jenis_paramedis'] as $k => $nk)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{$nk}}</td>
                                                    @foreach($data_paramedis['TNI'] as $m => $d)
                                                    @php $res[$m] += $d[$nk]; @endphp
                                                    <td class="border-top-0">{{ $d[$nk] }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @php $a = 0 @endphp
                                @for ($i = 0; $i < count($jenis_p); $i++)
                                    <tr>
                                        <td class="border-top-0 p-0">{{ $data_paramedis['jenis_paramedis'][$a]??null }}</td>    
                                        <td class="border-top-0 p-0">{{ $data_paramedis['jenis_paramedis'][$a+1]??null }}</td>
                                    </tr>
                                    <tr>
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="MILITER" data-nakes="{{ $data_paramedis['jenis_paramedis'][$a]??''}}">{{$data_paramedis['TNI']['AD'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['TNI']['AL'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['TNI']['AU'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['TNI']['MABES TNI'][$data_paramedis['jenis_paramedis'][$a]]}}</span></a></td>
                                        @endif

                                        @if (!empty($data_paramedis['jenis_paramedis'][$a+1]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="MILITER" data-nakes="{{ $data_paramedis['jenis_paramedis'][$a+1]??''}}">{{$data_paramedis['TNI']['AD'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['TNI']['AL'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['TNI']['AU'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['TNI']['MABES TNI'][$data_paramedis['jenis_paramedis'][$a+1]]}}</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a+1]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                    </tr>
                                    @php $a=$a+1+1 @endphp
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Perawat PNS</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-param-pns">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-param-pns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Perawat PNS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES TNI'=>0); @endphp
                                                @foreach($data_paramedis['jenis_paramedis'] as $k => $nk)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{$nk}}</td>
                                                    @foreach($data_paramedis['PNS'] as $m => $d)
                                                    @php $res[$m] += $d[$nk]; @endphp
                                                    <td class="border-top-0">{{ $d[$nk] }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @php $a = 0 @endphp
                                @for ($i = 0; $i < count($jenis_p); $i++)
                                    <tr>
                                        <td class="border-top-0 p-0">{{ $data_paramedis['jenis_paramedis'][$a]??null }}</td>    
                                        <td class="border-top-0 p-0">{{ $data_paramedis['jenis_paramedis'][$a+1]??null }}</td>
                                    </tr>
                                    <tr>
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="PNS" data-nakes="{{ $data_paramedis['jenis_paramedis'][$a]??''}}">{{$data_paramedis['PNS']['AD'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['PNS']['AL'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['PNS']['AU'][$data_paramedis['jenis_paramedis'][$a]]+$data_paramedis['PNS']['MABES TNI'][$data_paramedis['jenis_paramedis'][$a]]}}</span></a></td>
                                        @endif

                                        @if (!empty($data_paramedis['jenis_paramedis'][$a+1]))
                                            <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="PNS" data-nakes="{{ $data_paramedis['jenis_paramedis'][$a+1]??''}}">{{$data_paramedis['PNS']['AD'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['PNS']['AL'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['PNS']['AU'][$data_paramedis['jenis_paramedis'][$a+1]]+$data_paramedis['PNS']['MABES TNI'][$data_paramedis['jenis_paramedis'][$a+1]]}}</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                        @if (!empty($data_paramedis['jenis_paramedis'][$a+1]))
                                            <td class="border-top-0 p-0">Orang <br /><br /></td>
                                        @endif
                                    </tr>
                                    @php $a=$a+1+1 @endphp
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Perawat Honorer</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-param-honorer">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-param-honorer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Perawat Honorer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES'=>0); @endphp
                                                @for($i=0;$i<6;$i++)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{substr($datap2[$i*3], 0, -4)}}</td>
                                                    @foreach($datap1 as $m => $d)
                                                    @php $res[$m] += $d[$datap2[$i*3+2]]; @endphp
                                                    <td class="border-top-0">{{$d[$datap2[$i*3+2]]}}</td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @for($i=0;$i<3;$i++)
                                <tr>
                                    @php $n = strrpos($datap2[$i*3+2], ' ');
                                        $nakes1 = substr($datap2[$i*3+2], 0, $n);
                                    @endphp
                                    <td class="border-top-0 p-0">{{$nakes1}}</td>
                                      @php $n = strrpos($datap2[$i*3+11], ' ');
                                        $nakes2 = substr($datap2[$i*3+11], 0, $n);
                                    @endphp
                                    <td class="border-top-0 p-0">{{$nakes2}}</td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="Honorer" data-nakes="{{ $nakes1 }}">{{$datap1['AD'][$datap2[$i*3+2]]+$datap1['AL'][$datap2[$i*3+2]]+$datap1['AU'][$datap2[$i*3+2]]+$datap1['MABES'][$datap2[$i*3+2]]}}</span></td>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Perawat" data-klas="Honorer" data-nakes="{{ $nakes2 }}">{{$datap1['AD'][$datap2[$i*3+11]]+$datap1['AL'][$datap2[$i*3+11]]+$datap1['AU'][$datap2[$i*3+11]]+$datap1['MABES'][$datap2[$i*3+11]]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>     
                <div class="row breadcrumbs-top mb-1">
                    <div class="col-12">
                        <h2 class="content-header-title float-left">Data Nakes Lainnya</h2>
                    </div>
                    <div class="col-12">
                        <h5 class="content-header-title float-left mb-0">Total Jumlah Nakes Lainnya : {{ $total['Lainnya'] }}</h5>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Nakes Lainnya TNI</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-lain-tni">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-lain-tni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nakes Lainnya TNI</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES'=>0); @endphp
                                                @for($i=0;$i<1;$i++)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{substr($datan2[$i*3], 0, -4)}}</td>
                                                    @foreach($datan1 as $m => $d)
                                                    @php $res[$m] += $d[$datan2[$i*3]]; @endphp
                                                    <td class="border-top-0">{{$d[$datan2[$i*3]]}}</td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @for($i=0;$i<1;$i++)
                                <tr>
                                    @php $n = strrpos($datan2[$i*3], ' '); @endphp
                                    <td class="border-top-0 p-0">{{substr($datan2[$i*3], 0, $n)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Nakes Lain" data-klas="TNI" data-nakes="{{ substr($datan2[$i*3], 0, $n) }}">{{$datan1['AD'][$datan2[$i*3]]+$datan1['AL'][$datan2[$i*3]]+$datan1['AU'][$datan2[$i*3]]+$datan1['MABES'][$datan2[$i*3]]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Nakes Lainnya PNS</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-lain-pns">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-lain-pns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nakes Lainnya PNS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                <tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES'=>0); @endphp
                                                @for($i=0;$i<1;$i++)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{substr($datan2[$i*3], 0, -4)}}</td>
                                                    @foreach($datan1 as $m => $d)
                                                    @php $res[$m] += $d[$datan2[$i*3+1]]; @endphp
                                                    <td class="border-top-0">{{$d[$datan2[$i*3+1]]}}</td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @for($i=0;$i<1;$i++)
                                <tr>
                                    @php $n = strrpos($datan2[$i*3+1], ' '); @endphp
                                    <td class="border-top-0 p-0">{{substr($datan2[$i*3+1], 0, $n)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Nakes Lain" data-klas="PNS" data-nakes="{{ substr($datan2[$i*3+1], 0, $n) }}">{{$datan1['AD'][$datan2[$i*3+1]]+$datan1['AL'][$datan2[$i*3+1]]+$datan1['AU'][$datan2[$i*3+1]]+$datan1['MABES'][$datan2[$i*3+1]]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex">
                                <h3 class="font-weight-bolder">Nakes Lainnya Honorer</h3>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod-lain-honorer">Detail</button>
                            </div>

                            <!-- Modal-->
                            <div class="modal fade text-left" id="mod-lain-honorer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nakes Lainnya Honorer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <table class="table">
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    <td class="border-top-0">AD</td>
                                                    <td class="border-top-0">AL</td>
                                                    <td class="border-top-0">AU</td>
                                                    <td class="border-top-0">Mabes</td>
                                                </tr>
                                                @php $res = array('AD'=>0, 'AL'=>0, 'AU'=>0, 'MABES'=>0); @endphp
                                                @for($i=0;$i<1;$i++)
                                                <tr>
                                                    <td class="border-top-0 font-weight-bolder pl-0 pr-0 text-left">{{substr($datan2[$i*3], 0, -4)}}</td>
                                                    @foreach($datan1 as $m => $d)
                                                    @php $res[$m] += $d[$datan2[$i*3+2]]; @endphp
                                                    <td class="border-top-0">{{$d[$datan2[$i*3+2]]}}</td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                                <tr>
                                                    <td class="border-top-0 pl-0 pr-0"></td>
                                                    @foreach($res as $d)
                                                    <td class="border-top-0 font-weight-bolder">{{$d}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center mb-2">
                                @for($i=0;$i<1;$i++)
                                <tr>
                                    @php $n = strrpos($datan2[$i*3+2], ' '); @endphp
                                    <td class="border-top-0 p-0">{{substr($datan2[$i*3+2], 0, $n)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0"><span class="text-warning font-weight-bolder font-large-1" data-kat="Nakes Lain" data-klas="Honorer" data-nakes="{{ substr($datan2[$i*3+2], 0, $n) }}">{{$datan1['AD'][$datan2[$i*3+2]]+$datan1['AL'][$datan2[$i*3+2]]+$datan1['AU'][$datan2[$i*3+2]]+$datan1['MABES'][$datan2[$i*3+2]]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 p-0">Orang <br /><br /></td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>     
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
                                @foreach($wil as $w)
                                <option value="{{$w->id_provinsi}}" @if(request()->prov == $w->id_provinsi) selected @endif >{{$w->nama_provinsi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matra" class="form-label">Matra</label>
                            <select class="select2 form-control" id="matra">
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
                            <button type="button" class="btn btn-primary mr-1 btn-filter" data-dismiss="modal">Filter</button>
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
@section("page_script")
<script>
$( document ).ready(function() {
    $('#matra').change(function() {
        if ($(this).val() == '*') {
            $('#kotama').val('*').trigger('change');
            $('#kotama').prop('disabled', true);
        } else $.ajax({
            url: "{{ url('master/komando/select') }}/" + $(this).val(),
            method: "GET",
            dataType: "json",
            success: function(result) {
                $('#kotama').empty();
                result.data[0] = {id: '*', text: 'Semua Kotama'}
                $('#kotama').select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $('#kotama').parent(),
                    data: result.data,
                });
                $('#kotama').prop('disabled', false);
                @if(request()->kotama)
                $('#kotama').val('{{request()->kotama}}').trigger('change');
                @endif
            }
        });
    });
    @if(request()->matra)
    $('#matra').val('{{request()->matra}}').trigger('change');
    @endif

    $(".btn-filter").click(function() {
        params = 'p';
        if ($('#nasional').val() != '*') params += '&prov=' + $('#nasional').val();
        if ($('#matra').val() != '*') params += '&matra=' + $('#matra').val();
        if ($('#kotama').val() != '*') params += '&kotama=' + $('#kotama').val();
        location.href = '{{request()->url}}?' + params;
    });

    $(".text-warning").click(function() {
        detail_fas($(this).data('kat'), $(this).data('klas'), $(this).data('nakes'));
    });
});
var table;
function detail_fas(kat, klas, nakes) {
    params = '';
    if ($('#nasional').val() != '*') params += '&prov=' + $('#nasional').val();
    if ($('#matra').val() != '*') params += '&matra=' + $('#matra').val();
    if ($('#kotama').val() != '*') params += '&kotama=' + $('#kotama').val();
    table = $('#table').DataTable({
        loading: true,
        destroy: true,
        ajax: "{{ url('yankesin/dashboard_nakes/detail') }}/" + kat + '/' + klas + '/' + nakes + '?' + params,
        columns: [
            {
                data: 'nama_rs',
            },
            {
                data: 'jumlah',
            },
        ],
        displayLength: 9,
        lengthMenu: [9, 25, 50, 75, 100],
    });
    $('.modal-title').html('Detail Jumlah ' + nakes + ' ' + klas + ' per Faskes');
    $('#modal-detail').modal('show');
}
</script>
@endsection