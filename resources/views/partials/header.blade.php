<!DOCTYPE html>

<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Puskes TNI Information System</title>
    <link rel="apple-touch-icon" href="{{ url('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('app-assets/images/ico/Logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/family-montserrat.css')}}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/calendars/fullcalendar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/fullcalendar-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/swiper.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/bordered-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/semi-dark-layout.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-calendar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/form-wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-calendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/page-knowledge-base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/extensions/ext-component-swiper.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    @yield("page_style")

    <style>
        .main-menu .navbar-header .navbar-brand .brand-text {
            color: #fff !important;
        }

        .semi-dark-layout .main-menu-content .navigation-main .navigation-header {
            color: #D6DCE1 !important;
        }

        html .content .content-wrapper .content-header-title {
            padding-right: 0 rem !important;
            border-right: 0px solid #D6DCE1 !important;
        }
        .select2-dropdown {
            z-index: 1000 !important;
        }
        .main-menu {
            z-index: 100000 !important; 
        }
    </style>
    @yield("meta_header")
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">


    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">

                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                        if (isset(Auth::user()->id_faskes) && !session()->has('faskes')) {
                            if (substr(Auth::user()->id_faskes, 0, 1) == 'L') $org = Auth::user()->id_faskes;
                            else {
                                $rs = App\Models\RumahSakit::find(Auth::user()->id_faskes);
                                $org = $rs->nama_rs;
                            }
                            session()->put('faskes', strtoupper($org));
                        }
                        @endphp
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status">{{
                            isset(Auth::user()->id_faskes) ? session('faskes') : (
                            isset(Auth::user()->roles[0]->name)?Auth::user()->roles[0]->name:"")}}</span></div><span class="avatar"><img class="round" src="{{ file_exists('app-assets/images/profile/user-uploads/' . base64_encode(Auth::user()->id) . '.png') ? url('app-assets/images/profile/user-uploads/' . base64_encode(Auth::user()->id) . '.png') : url('app-assets/images/pages/eCommerce/personil.png') }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/profile"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item"
                        href="#"><i class="mr-50" data-feather="help-circle"></i> FAQ</a> -->
                        <a class="dropdown-item" href="{{url('logout')}}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
                        <img src="{{ url('app-assets/images/ico/Logo.png')}}" height="28" /></span>
                        <h2 class="brand-text">PUSKES TNI</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'struktur_umum' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/struktur_umum"><i data-feather="file"></i><span data-i18n="Struktur">Struktur Organisasi <br> Umum</span></a>
                </li>

                @php
                    $user = Auth::user();
                    $roleId = App\Models\ModelHasRoles::where('model_id', $user->id)->first()->role_id;
                    $roleName = App\Models\Role::where('id', $roleId)->first()->name;
                @endphp

                @if (($roleName == 'PIMPINAN' || $roleName == 'KA/WA.KA PUSKES') || auth()->user()->can('master_data.list') || auth()->user()->can('master_data.manage') )
                    <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/main-dashboard"><i data-feather="home"></i><span data-i18n="Dashboard">Dashboard</span></a>
                    {{-- <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/home"><i data-feather="home"></i><span data-i18n="Dashboard">Dashboard</span></a> --}}
                    </li>
                @endif
                


                @if(auth()->user()->can('dukkesops.list') || auth()->user()->can('dukkesops.dashboard'))
                <li class=" navigation-header"><span>DUKKESOPS</span><i data-feather="more-horizontal"></i>
    
                    <li class="{{ Request::is('struktur-organisasi/'.base64_encode('DUKKESOP'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('DUKKESOP')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>
    
                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'peta_pos_satgas' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('dukkesops/pos-satgas/peta-sebaran') }}"><i data-feather="map-pin"></i><span>Sebaran Pos Satgas</span></a></li>
                    
                    @if(Auth::user()->roles->pluck('secret_access')[0])
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="cpu"></i><span class="menu-title text-truncate">Rikujikkes </span></a>
                        <ul class="menu-content">
        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'werving' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('dukkesops.werving.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Werving</span></a></li>
        
                            <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == '' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/seleksi-satgas-ln') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Seleksi Satgas Lama</span></a> -->

                            <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate">Seleksi Satgas</span></a>
    
                                <ul class="menu-content">

                                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'seleksi_satgas_dn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/rikujikkes_satgas_dn"><span class="menu-item text-truncate">Satgas DN</span></a></li>
    
                                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'seleksi_satgas_ln' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/rikujikkes_satgas_ln"><span class="menu-item text-truncate">Satgas LN</span></a></li>
        
                                </ul>
    
                            </li>
    
                            <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'seleksi_satgas_ln' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/seleksi-satgas-ln') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Seleksi Satgas DN</span></a>
    
                                <ul class="menu-content">
    
                                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'tenaga_medis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate">Seleksi Pratugas</span></a></li>
    
                                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'tenaga_medis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate">Purnatugas</span></a></li>
    
                                </ul>
    
                            </li> -->
        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'pendidikan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('dukkesops.pendidikan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pendidikan</span></a></li>
        
                        </ul>
                    </li>
                    @endif               
    
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="archive"></i><span class="menu-title text-truncate">Kalender Ops</span></a>
                        <ul class="menu-content">
        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'kalender_dn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/dukkesops/kalender/dn"><i data-feather="circle"></i><span class="menu-item text-truncate">Penugasan DN</span></a></li>
                        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'kalender_ln' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/dukkesops/kalender/ln"><i data-feather="circle"></i><span class="menu-item text-truncate">Penugasan LN</span></a></li>
        
                            <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'report_bekkes' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/report_bekkes"><i data-feather="circle"></i><span class="menu-item text-truncate">Report Bekkes
                            </span></a></li> -->
        
                        </ul>
                    </li>
    
                    <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'aturan_bekkes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/aturan_bekkes"><i data-feather="anchor"></i><span>Aturan Bekkes</span></a></li>  -->
    
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="anchor"></i><span class="menu-title text-truncate">Bekkes</span></a>
                        <ul class="menu-content">
        
                            <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'satgas_dn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('dukkesops.satgas-dn.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas DN</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'satgas_ln' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('dukkesops.satgas-ln.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas LN</span></a></li> -->

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'bekkes_dn_dukkesops' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/bekkes-satgas/dn') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas DN</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'bekkes_ln_dukkesops' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/bekkes-satgas/ln') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas LN</span></a></li>        
        
                        </ul>
                    </li>

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="refresh-cw"></i><span class="menu-title text-truncate">Rotasi Satgas</span></a>
                        <ul class="menu-content">
        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'rotasi_satgas_dn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/rotasi-satgas/dn') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dalam Negeri</span></a></li>
        
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'rotasi_satgas_ln' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/rotasi-satgas/ln') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Luar Negeri</span></a></li>
        
                        </ul>
                    </li>

                    <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'anggaran' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('dukkesops.anggaran.index') }}"><i data-feather="briefcase"></i><span>Anggaran</span></a></li>  -->

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'anggaran' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/daftar_anggaran_dukkesops"><i data-feather="briefcase"></i><span>Anggaran</span></a></li> 
    
                    {{-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_dukkesops' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/regulasi_dukkesops"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li> --}}
    
                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_BIDDUKKESOPS' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/BIDDUKKESOPS') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>
    
                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'daftar_dukkes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('dukkesops.dukkes.index') }}"><i data-feather="codepen"></i><span>Daftar Dukkes</span></a></li>

                    <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_dukkesops' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="command"></i><span class="menu-item text-truncate">Manage Password</span></a></li> -->
    
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="aperture"></i><span class="menu-title text-truncate">Master Data</span></a>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'kategori_duk' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/kategori-duk') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Kategori</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'batalyon' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/batalyon') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Batalyon</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'satgas_ops' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/satgas-ops') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas Ops</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'pos_satgas' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/pos-satgas') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pos Satgas</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'geografis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/geografis') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Geografis</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_bekkes' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/master-bekkes') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Bekkes</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_rs' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('dukkesops/rs') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Rumah Sakit</span></a></li>                            
                        </ul>
                        <ul class="menu-content">
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_tipe_pos' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/master_tipe_pos"><i data-feather="circle"></i><span class="menu-item text-truncate">Tipe Pos</span></a></li>                            
                        </ul>
                    </li>
    
                @endif
                
                @if(auth()->user()->can('yankesin.list') || auth()->user()->can('yankesin.dashboard'))
                <li class=" navigation-header"><span>BIDANG YANKESIN</span><i data-feather="more-horizontal"></i>
                
                <li class="{{ Request::is('struktur-organisasi/'.base64_encode('YANKESIN'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('YANKESIN')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_yankesin' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/dashboard_yankesin"><i data-feather="home"></i><span>Sebaran Faskes</span></a></li>

                <li class="@if(!empty($active_menu)) {{ $active_menu == 'peta_yankesin_fas' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/yankesin/peta-sebaran-fasilitas?id=1"><i data-feather="map-pin"></i><span class="menu-item text-truncate">Sebaran Fasilitas </span></a></li>
                
                <!-- <li class=" nav-item covid-report" style="@if(session('covid_report')==0) display:none @endif"><a class="d-flex align-items-center" href="#"><i data-feather="cpu"></i><span class="menu-title text-truncate">Covid Report</span></a>
                    <ul class="menu-content">
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'bor_covid_yankesin' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ route('yankesin.bor_covid.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">BoR Covid Yankesin</span></a></li>
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'pasien_covid_yankesin' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('/yankesin/data-covid') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pasien Covid</span></a></li>
                
                    </ul>
                </li> -->
                
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_nakes' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dashboard_nakes"><i data-feather="package"></i><span>Dashboard Nakes</span></a>
                </li>
                
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_fasilitas' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dashboard_fasilitas"><i data-feather="briefcase"></i><span>Dashboard Fasilitas</span></a></li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'yankesin_rs' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ route('yankesin.rumah_sakit.index') }}"><i data-feather="activity"></i><span class="menu-title text-truncate">Faskes</span></a>
                </li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_posyandu' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('yankesin/posyandu') }}"><i data-feather="check-square"></i><span class="menu-title text-truncate">Posyandu</span></a>
                </li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'rekap_fasilitas_yankesin' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/yankesin/rekap-fasilitas-faskes"><i data-feather="calendar"></i><span class="menu-title text-truncate">Rekap Fasilitas <br />Faskes</span></a>
                </li>
                
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'bor_covid_yankesin' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="{{ route('yankesin.bor_covid.index') }}"><i data-feather="aperture"></i><span>Bed Occupancy Ratio</span></a></li>
                </li>
                
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'pasien_covid_yankesin' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="{{ url('/yankesin/data-covid') }}"><i data-feather="archive"></i><span>Pasien Covid</span></a></li>
                </li>
                
                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'pengajuan_rs' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/faskes/perubahan_faskes"><i data-feather="airplay"></i><span>Log Perubahan <br /> Data Fasilitas Faskes</span></a></li>
                </li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_BIDYANKESIN' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/BIDYANKESIN') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>
                
                <li class="@if(!empty($active_menu)) {{ $active_menu == 'report_penyakit' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{url('/yankesin/report-penyakit/')}}"><i data-feather='thermometer'></i><span class="menu-title text-truncate">Penyakit</span></a>
                </li>
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate">Master Data</span></a>
                    <ul class="menu-content">
                        
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'komando' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/master/komando"><i data-feather="circle"></i><span class="menu-item text-truncate">Kotama</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'subkomando' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/master/subkomando"><i data-feather="circle"></i><span class="menu-item text-truncate">Satker & Sub Satker</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'fasilitas' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('yankesin/fasilitas') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Fasilitas</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'spesialis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.jenis-spesialis.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Spesialis</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'jp' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/jenis-paramedis') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jenis Paramedis</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'tingkat_rs' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('yankesin/tingkat-rs') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Tingkat RS</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'endemik' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('yankesin/endemik') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Endemik</span></a></li>
                
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'penyakit' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('yankesin/penyakit') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Penyakit</span></a></li>
                    </ul>
                </li>
                
                
                
                {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate">Input Data</span></a>
                    <ul class="menu-content">
                        
                        <li><a class="d-flex align-items-center" href="{{url('/yankesin/input/covid')}}"><i data-feather="circle"></i><span class="menu-item text-truncate">Input Covid</span></a>
                
                <li><a class="d-flex align-items-center" href="{{url('/yankesin/input/bor')}}"><i data-feather="circle"></i><span class="menu-item text-truncate">Input BOR</span></a>
                
                <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate">Input NAKES</span></a>
                </li>
                
                </ul>
                </li> --}}
                @endif                

                @if(auth()->user()->can('bangkes.list') || auth()->user()->can('bangkes.manage'))

                <li class=" navigation-header"><span>BANGKES</span><i data-feather="more-horizontal"></i>
    
                <li class="nav-item {{ Request::is('struktur-organisasi/'.base64_encode('BANGKES'))? 'active':'' }}"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('BANGKES')) }}"><i data-feather="file"></i><span data-i18n="Struktur">Struktur Organisasi <br> Bidang</span></a>
                </li>
    
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="archive"></i><span class="menu-title text-truncate">Subbid Sistoda</span></a>
                    <ul class="menu-content">
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_sistoda' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/sistoda/dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard Sistoda</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'katalog_buku' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/katalog-buku') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Katalog Buku</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_buku' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.buku.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Data Buku</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'jadwal_sosialisasi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.jadwal-sosialisasi.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jadwal Sosialisasi</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'jadwal_supervisi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.jadwal-supervisi.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jadwal Supervisi</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_BIDBANGKES' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('regulasi/BIDBANGKES') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_regulasi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('rekap-regulasi') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Rekap Regulasi</span></a></li>
    
                    </ul>
                </li>
    
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="command"></i><span class="menu-title text-truncate">Subbid SDM</span></a>
                    <ul class="menu-content">
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_sdm' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/sdm/dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard</span></a></li>
    
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Nakes TNI</span></a>
                            <ul class="menu-content">
    
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'tenaga_medis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/tenaga-medis') }}"><span class="menu-item text-truncate">Tenaga Medis</span></a></li>
    
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'paramedis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/paramedis') }}"><span class="menu-item text-truncate">Paramedis</span></a></li>
                                
                                <!-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'approval' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/approval-nakes') }}"><span class="menu-item text-truncate">Approval</span></a></li> -->

                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'dokumen_tenaga_medis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/dokumen-tenaga-medis') }}"><span class="menu-item text-truncate">Upload File</span></a></li>
    
                            </ul>
                        </li>
    
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Pendidikan</span></a>
                            <ul class="menu-content">
    
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'patubel' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.calon-patubel.index') }}"><span class="menu-item text-truncate">Calon Patubel</span></a></li>
    
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'sprin_patubel' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.peserta-patubel.index') }}"><span class="menu-item text-truncate">Peserta Patubel</span></a></li>
    
                            </ul>
                        </li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'pelatihan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/pelatihan') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pelatihan</span></a></li>
    
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Internship</span></a>
                            <ul class="menu-content">
    
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'wahana_internship' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/wahana-internship') }}"><span class="menu-item text-truncate">Wahana Internship</span></a></li>
                                
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'selesai_internship' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/selesai-internship') }}"><span class="menu-item text-truncate">Selesai Internship</span></a></li>
    
                            </ul>
                        </li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'rekap_dokter' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/rekap-dokter') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Rekap Dokter</span></a></li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="aperture"></i><span class="menu-title text-truncate">Master Data</span></a>
                    <ul class="menu-content">
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'spesialis' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bangkes.jenis-spesialis.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Spesialis</span></a></li>
                        
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'jp' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/jenis-paramedis') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jenis Paramedis</span></a></li>
    
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'jenis_pelatihan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/jenis-pelatihan') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jenis Pelatihan</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'kategori_regulasi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bangkes/kategori-buku') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Kategori Buku & Regulasi</span></a></li>
                        
                    </ul>
                </li>
                @endif

                @if(
                    auth()->user()->can('bidum.list') ||
                    auth()->user()->can('bidum.dashboard') ||
                    auth()->user()->can('bidum.manage') ||
                    auth()->user()->can('logistik.list') ||
                    auth()->user()->can('logistik.dashboard') ||
                    auth()->user()->can('logistik.manage') ||
                    auth()->user()->can('anggaran.list') ||
                    auth()->user()->can('anggaran.dashboard') ||
                    auth()->user()->can('anggaran.manage') ||
                    auth()->user()->can('subbidminpers.list') ||
                    auth()->user()->can('subbidminpers.dashboard') ||
                    auth()->user()->can('subbidminpers.manage') 
                )
                <li class=" navigation-header"><span>Bidang Umum</span><i data-feather="more-horizontal"></i>

                <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_bidum' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dashboard_bidum"><i data-feather="home"></i><span>Bidang Umum</span></a>
                </li>


                @if(
                    auth()->user()->can('subbidminpers.list') ||
                    auth()->user()->can('subbidminpers.dashboard') ||
                    auth()->user()->can('subbidminpers.manage') 
                )
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate">SUBBIDMINPERS</span></a>
                    <ul class="menu-content">

                        <li class="{{ Request::is('struktur-organisasi/'.base64_encode('SUBBIDMINPERS'))? 'active':'' }}"><a class="d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('SUBBIDMINPERS')) }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Struktur Organisasi <br> Bidang</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_personil' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.personil.dashboard_personil') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_personil' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.personil.index_data_personil') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Data Personil</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'ukp' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.personil.index_ukp') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">UKP</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'kenkat' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.personil.index_kenkat') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Kenkat</span></a></li>
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'pensiun' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bidum/personil/pensiun') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pensiun</span></a></li>

                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Master Data</span></a>
                            <ul class="menu-content">
        
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_kesatuan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kesatuan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Kesatuan</span></a></li>
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_jabatan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('jabatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jabatan</span></a></li>
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_pangkat' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('pangkat.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pangkat</span></a></li>
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_pakaian' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('pakaian.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pakaian</span></a></li>
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_tanda_jasa' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('tanda_jasa.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Tanda Jasa</span></a></li>
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_korps' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('korps.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Korps</span></a>
                                </li>
            
                            </ul>
                        </li>

                        
        
                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'org_personil' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/org_personil"><i data-feather="circle"></i><span class="menu-item text-truncate">Master Struktur</span></a></li>
            
                            
                    </ul>
                </li>
                @endif

                @if(
                    auth()->user()->can('anggaran.list') ||
                    auth()->user()->can('anggaran.dashboard') ||
                    auth()->user()->can('anggaran.manage') 
                )
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-title text-truncate">Anggaran</span></a>
                    <ul class="menu-content">

                        <li class="{{ Request::is('struktur-organisasi/'.base64_encode('SUBBIDRENPROGAR'))? 'active':'' }}"><a class="d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('SUBBIDRENPROGAR')) }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Struktur Organisasi <br> Bidang</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_anggaran' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.anggaran.dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'daftar_pagu' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.anggaran.pagu') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pagu Anggaran</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'realisasi_harian' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bidum/anggaran/realisasi-pertahun') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Realisasi Harian</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'report' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.anggaran.report_pagu') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Report</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'hutang' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ url('bidum/anggaran/hutang') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Daftar Hutang</span></a></li>

                    </ul>
                </li>
                @endif


                @if(
                    auth()->user()->can('logistik.list') ||
                    auth()->user()->can('logistik.dashboard') ||
                    auth()->user()->can('logistik.manage') 
                )
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate">Logistik</span></a>
                    <ul class="menu-content">

                        <li class="{{ Request::is('struktur-organisasi/'.base64_encode('SUBBIDLOG'))? 'active':'' }}"><a class="d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('SUBBIDLOG')) }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Struktur Organisasi <br> Bidang</span></a></li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_bidlog' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard</span></a></li>

                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Transaksi Masuk</span></a>
                            <ul class="menu-content">

                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'aset_masuk' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.aset_masuk.index') }}"><span class="menu-item text-truncate">Aset</span></a></li>

                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'persediaan_masuk' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.persediaan_masuk.index') }}"><span class="menu-item text-truncate">Persediaan</span></a></li>

                            </ul>
                        </li>

                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Transaksi Keluar</span></a>
                            <ul class="menu-content">

                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'aset_keluar' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.aset_keluar.index') }}"><span class="menu-item text-truncate">Aset</span></a></li>

                                <li class="@if(!empty($active_menu)) {{ $active_menu == 'persediaan_keluar' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.persediaan_keluar.index') }}"><span class="menu-item text-truncate">Persediaan</span></a></li>

                            </ul>
                        </li>
                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'daftar_vendor' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('matfaskes.vendor.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Daftar Vendor</span></a>
                        </li>

                        <li class="@if(!empty($active_menu)) {{ $active_menu == 'report_bidlog' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bidum.logistik.report.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Report</span></a></li>

                    </ul>
                </li>
                
                @endif

                <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_BIDUM' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/BIDUM') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>

                @endif



            @if(auth()->user()->can('matfaskes.list') || auth()->user()->can('matfaskes.dashboard'))
            <li class=" navigation-header"><span>MATFASKES</span><i data-feather="more-horizontal"></i>

            <li class="{{ Request::is('struktur-organisasi/'.base64_encode('MATFASKES'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('MATFASKES')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'grafik_bekkes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('matfaskes/dashboard-barang/grafik-bekkes') }}"><i data-feather="home"></i><span>Dashboard Bekkes</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'peta_yankesin_fas' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/yankesin/peta-sebaran-fasilitas?id=1"><i data-feather="map-pin"></i><span class="menu-item text-truncate"> Sebaran Fasilitas</span></a></li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'faskes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('matfaskes.faskes.index') }}"><i data-feather="pen-tool"></i><span>Fasilitas Kesehatan</span></a>
            </li>            

            @if(!auth()->user()->can('yankesin.dashboard'))
            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_fasilitas' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dashboard_fasilitas"><i data-feather="briefcase"></i><span>Dashboard Fasilitas</span></a></li>
            @endif            

            <li class="nav-item covid-report"><a class="d-flex align-items-center" href="#"><i data-feather="cpu"></i><span class="menu-title text-truncate">Kegiatan</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_kegiatan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('matfaskes.dashboard_kegiatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard Kegiatan</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'pengadaan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('matfaskes.pengadaan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pengadaan</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'tktm' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('matfaskes.tktm.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">TKTM</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'hibah' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('matfaskes.hibah.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Hibah</span></a></li>
                </ul>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'daftar_bekkes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('matfaskes/data-bekkes') }}"><i data-feather="archive"></i><span>Daftar Bekkes</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_matkes' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('matfaskes.data_matkes.index') }}"><i data-feather="check-square"></i><span>Daftar Matkes</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'daftar_vendor' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="{{ route('matfaskes.vendor.index') }}"><i data-feather="book-open"></i><span>Daftar Vendor</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_BIDMATFASKES' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/BIDMATFASKES') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>

            {{-- <li class="@if(!empty($active_menu)) {{ $active_menu == 'barang_donasi' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/barang_donasi"><i data-feather="archive"></i><span>Barang Donasi</span></a>
            </li> --}}

            </li>
            @endif


            @if(auth()->user()->can('dobekkes.list') || auth()->user()->can('dobekkes.dashboard'))
            <li class=" navigation-header"><span>DOBEKKES</span><i data-feather="more-horizontal"></i>

            <li class="{{ Request::is('struktur-organisasi/'.base64_encode('DOBEKKES'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('DOBEKKES')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>

            <!-- <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_dobekkes' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/dashboard"><i data-feather="home"></i><span>Dashboard</span></a></li> -->

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'maps_dobekkes' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/maps_dobekkes"><i data-feather="home"></i><span>Dashboard</span></a></li>
            
            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'barang_masuk' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/barang_masuk"><i data-feather="aperture"></i><span>Data Barang Masuk</span></a></li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'rekap_gudang' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/rekap_gudang"><i data-feather="cpu"></i><span>Rekap Gudang</span></a></li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'barang_keluar' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/barang_keluar"><i data-feather="command"></i><span>Data Barang Keluar</span></a></li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'stok_opname' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/stok_opname"><i data-feather="folder"></i><span>Stok Opname</span></a></li>

            <!-- <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'aset_gudang' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/aset_gudang"><i data-feather="briefcase"></i><span>Aset Gudang</span></a></li> -->

            <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="anchor"></i><span class="menu-title text-truncate">Bekkes</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'bekkes_dn_dobek' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/bekkes_dn_dobek"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas DN</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'bekkes_ln_dobek' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/bekkes_ln_dobek"><i data-feather="circle"></i><span class="menu-item text-truncate">Satgas LN</span></a></li>        
        
                </ul>
            </li> -->

            <!-- <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'grafik_sisa_stok' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dobekkes/grafik_sisa_stok"><i data-feather="activity"></i><span>Data Sisa Stok Bekkes</span></a></li> -->

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_DOBEKKES' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/DOBEKKES') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>

            </li>
            @endif


            @if(auth()->user()->can('kermabaktikes.list') || auth()->user()->can('kermabaktikes.dashboard'))
            <li class=" navigation-header"><span>KERMABAKTIKES</span><i data-feather="more-horizontal"></i>

            <li class="{{ Request::is('struktur-organisasi/'.base64_encode('KERMABAKTIKES'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('KERMABAKTIKES')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'maps_kerma' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="{{ url('maps-kerma') }}"><i data-feather="map-pin"></i><span>Maps</span></a></li>
            {{-- <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'maps_kerma' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/maps_kerma"><i data-feather="map-pin"></i><span>Maps</span></a></li> --}}

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="folder"></i><span class="menu-title text-truncate">Kerma</span></a>
                <ul class="menu-content">

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Luar Negeri</span></a>
                        <ul class="menu-content">

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_bilateral' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.bilateral.dashboard') }}"><span class="menu-item text-truncate">Dashboard Bilateral</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_non_bilateral' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.nonbilateral.dashboard') }}"><span class="menu-item text-truncate">Dashboard Multilateral</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_bilateral' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.bilateral.index') }}"><span class="menu-item text-truncate">Data Bilateral</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_non_bilateral' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.nonbilateral.index') }}"><span class="menu-item text-truncate">Data Multilateral</span></a></li>

                        </ul>
                    </li>

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-title text-truncate">Dalam Negeri</span></a>
                        <ul class="menu-content">

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_kdn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.kdn.dashboard') }}"><span class="menu-item text-truncate">Dashboard KDN</span></a></li>
                            
                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'kdn' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.kdn.index') }}"><span class="menu-item text-truncate">Kerjasama Dalam Negeri</span></a></li>

                            <li class="@if(!empty($active_menu)) {{ $active_menu == 'mou' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.mou.index') }}"><span class="menu-item text-truncate">Data Mou</span></a></li>

                        </ul>
                    </li>

                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate">Bakti</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'dashboard_bakes' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bakti.bakes.dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Dashboard Bakti</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'bakes' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('bakti.bakes.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Data Bakti</span></a></li>

                </ul>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_KERMABAKTIKES' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/KERMABAKTIKES') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="aperture"></i><span class="menu-title text-truncate">Master Data</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_kegiatan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.kegiatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Kegiatan</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'master_jenis_kegiatan' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="{{ route('kerma.jenis_kegiatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Jenis Kegiatan</span></a></li>

                </ul>
            </li>
            @endif


            @if(auth()->user()->can('lafibiovak.list') || auth()->user()->can('lafibiovak.dashboard'))
            <li class=" navigation-header"><span>LAFI{{ isset(Auth::user()->id_faskes) ? '' : 'BIOVAK' }}</span><i data-feather="more-horizontal"></i>

            <li class="{{ Request::is('struktur-organisasi/'.base64_encode('LAFIBIOVAK'))? 'active':'' }} nav-item"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('LAFIBIOVAK')) }}"><i data-feather="file"></i><span>Struktur Organisasi <br> Bidang</span></a></li>

            @if(!isset(Auth::user()->id_faskes))
            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_lafi' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/dashboard_lafi"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="sliders"></i><span class="menu-title text-truncate">Jalur Company</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'jalur_company' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/jalur_company"><i data-feather="circle"></i><span class="menu-item text-truncate">Jalur Company</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'maps_jalur_company' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/maps_jalur_company"><i data-feather="circle"></i><span class="menu-item text-truncate">Peta Lokasi Jalur <br />Company</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_jalur_company' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/jalur-company"><i data-feather="circle"></i><span class="menu-item text-truncate">Data Jalur Company</span></a></li>

                </ul>
            </li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'litbang' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/lafibiovak/litbang"><i data-feather="activity"></i><span>Litbang</span></a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="archive"></i><span class="menu-title text-truncate">Kelola Produk</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'jenis_obat' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/satuan-produk"><i data-feather="circle"></i><span class="menu-item text-truncate">Satuan Produk</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'zat_aktif_obat' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/produk"><i data-feather="circle"></i><span class="menu-item text-truncate">Daftar Produk</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'kemasan_obat' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/kemasan"><i data-feather="circle"></i><span class="menu-item text-truncate">Kemasan Produk</span></a></li>

                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="book-open"></i><span class="menu-title text-truncate">Manage RKO</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'rko_faskes' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/rko"><i data-feather="circle"></i><span class="menu-item text-truncate">RKO Faskes</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'rekap_rko' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/rko/rekap"><i data-feather="circle"></i><span class="menu-item text-truncate">Rekap RKO</span></a></li>

                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="rss"></i><span class="menu-title text-truncate">Bahan Produksi</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'kategori_bahan_baku' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/kategori-bahan-produksi"><i data-feather="circle"></i><span class="menu-item text-truncate">Kategori Bahan Produksi</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'persediaan_bahan_baku' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/bahan-produksi"><i data-feather="circle"></i><span class="menu-item text-truncate">Persediaan Bahan Produksi</span></a></li>

                </ul>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'manage_renprod' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/lafibiovak/renprod"><i data-feather="briefcase"></i><span>Manage Renprod</span></a></li>
            @endif

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'timeline_produksi' ? 'active' : '' }} @endif nav-item"><a class="nav-link d-flex align-items-center" href="/lafibiovak/produksi/timeline"><i data-feather="codepen"></i><span>Manage Produksi</span></a></li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="archive"></i><span class="menu-title text-truncate">Produk Jadi</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'persediaan_produk_jadi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/persediaan"><i data-feather="circle"></i><span class="menu-item text-truncate">Persediaan Produksi Jadi</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'report_masuk' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/persediaan/report_masuk"><i data-feather="circle"></i><span class="menu-item text-truncate">Report Jumlah Masuk</span></a></li>
                    
                </ul>
            </li>

            @if(!isset(Auth::user()->id_faskes))
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="cpu"></i><span class="menu-title text-truncate">Distribusi</span></a>
                <ul class="menu-content">

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'distribusi' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/distribusi"><i data-feather="circle"></i><span class="menu-item text-truncate">Daftar Distribusi</span></a></li>

                    <li class="@if(!empty($active_menu)) {{ $active_menu == 'report_keluar' ? 'active' : '' }} @endif"><a class="d-flex align-items-center" href="/lafibiovak/distribusi/report_keluar"><i data-feather="circle"></i><span class="menu-item text-truncate">Report Jumlah Keluar</span></a></li>

                </ul>
            </li>
            @endif

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_LAFIBIOVAK' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/LAFIBIOVAK') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>

            @endif


            @if(auth()->user()->can('taud.list') || auth()->user()->can('taud.dashboard'))
            <li class=" navigation-header"><span>TAUD</span><i data-feather="more-horizontal"></i>

            <li class="nav-item {{ Request::is('struktur-organisasi/'.base64_encode('TAUD'))? 'active':'' }}"><a class="nav-link d-flex align-items-center" href="{{ url('struktur-organisasi/'.base64_encode('TAUD')) }}"><i data-feather="file"></i><span data-i18n="Dashboard">Struktur Organisasi <br> Bidang</span></a>
            </li>

            <li class="nav-item @if(!empty($active_menu)) {{ $active_menu == 'dashboard_taud' ? 'active' : '' }} @endif"><a class="nav-link d-flex align-items-center" href="/taud/dashboard"><i data-feather="home"></i><span data-i18n="Dashboard">Dashboard</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'taud' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/taud/bbm"><i data-feather="briefcase"></i><span class="menu-title text-truncate">Distribusi BBM</span></a>
            </li>
            
            <li class="@if(!empty($active_menu)) {{ $active_menu == 'ranmor' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/taud/ranmor"><i data-feather="cpu"></i><span class="menu-title text-truncate">Daftar Ranmor</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'regulasi_TAUD' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('regulasi/TAUD') }}"><i data-feather="command"></i><span class="menu-item text-truncate">Regulasi & SOP</span></a></li>

            @endif

            @if(auth()->user()->can('rumah_sakit.list') || auth()->user()->can('rumah_sakit.manage'))

            <li class=" navigation-header"><span>FASKES</span><i data-feather="more-horizontal"></i>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'rko' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/faskes/rko"><i data-feather="command"></i><span class="menu-title text-truncate">RKO</span></a>
            </li>
            
            @if(isset(Auth::user()->id_faskes))
            <li class="@if(!empty($active_menu)) {{ $active_menu == 'tenaga' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('faskes/tenaga-medis') }}"><i data-feather="archive"></i><span class="menu-title text-truncate">Tenaga Medis</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'medis' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="{{ url('faskes/paramedis') }}"><i data-feather="slack"></i><span class="menu-title text-truncate">Paramedis</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'rekap_nakes' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/faskes/rekap_nakes"><i data-feather="briefcase"></i><span class="menu-title text-truncate">Rekap Nakes Lainnya & Honorer</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'bor' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/faskes/bor"><i data-feather="folder"></i><span class="menu-title text-truncate">BOR</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'data_covid' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/faskes/data_covid"><i data-feather="aperture"></i><span class="menu-title text-truncate">Data Covid</span></a>
            </li>

            <li class="@if(!empty($active_menu)) {{ $active_menu == 'fasilitas' ? 'active' : '' }} @endif nav-item"><a class="d-flex align-items-center" href="/faskes/fasilitas"><i data-feather="users"></i><span class="menu-title text-truncate">Fasilitas</span></a>
            </li>
            @endif

            @endif

            @if(
                auth()->user()->can('master_data.list') || 
                auth()->user()->can('master_data.manage') ||
                auth()->user()->can('role_permission.list') ||
                auth()->user()->can('role_permission.manage') ||
                auth()->user()->can('users.list') ||
                auth()->user()->can('users.manage') 
                )


            <li class=" navigation-header"><span>Administrator</span><i data-feather="more-horizontal"></i>

            @if(auth()->user()->can('users.list') || auth()->user()->can('users.manage') )
            <li><a class="d-flex align-items-center" href="/users"><i data-feather="circle"></i><span class="menu-item text-truncate">Users</span></a>
            </li>
            @endif

            @if(auth()->user()->can('role_permission.list') || auth()->user()->can('role_permission.manage') )
            <li><a class="d-flex align-items-center" href="/roles"><i data-feather="circle"></i><span class="menu-item text-truncate">Roles</span></a>
            </li>
            @endif



            @endif
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->