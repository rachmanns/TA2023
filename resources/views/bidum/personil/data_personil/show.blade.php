@extends('partials.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page_style')
    <style>
        #hidden_div {
            display: none;
        }

        .img-fluid {
            max-width: 100%;
            height: 12em;
        }

        .flatpickr-wrapper {
            display: block;
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
                            <h2 class="content-header-title float-left mb-0">Detail Personil</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-2 col-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <img class="img-fluid rounded" src="{{ asset('personil/' . $personil->foto) }}"><br>
                                <div class="badge badge-glow badge-light-success font-small-3 mt-2">Aktif</div>
                                <div class="text-left">
                                    <h6 class="font-weight-bolder mt-1">{{ $personil->nama }}</h6>
                                    <div class="mt-1">
                                        <i data-feather="award" class="font-small-3 mr-75 mt-50 mb-1"></i><span
                                            class="font-small-3">{{ $personil->nama_pangkat }}</span>
                                    </div>
                                    <h6 class="font-weight-bolder mt-50">{{ $personil->nama_jabatan_terakhir }}</h6>
                                    <span
                                        class="badge badge-glow badge-success font-small-2 mt-50">{{ $personil->korps->matra->nama_matra }}</span>
                                    <hr class="mt-2">
                                    <div class="font-small-3">
                                        <span class="text-secondary font-weight-bolder">EMAIL</span><br>
                                        {{ $personil->email }}
                                    </div>
                                    <div class="font-small-3 mt-1">
                                        <span class="text-secondary font-weight-bolder">NO HP</span><br>
                                        {{ $personil->no_telp }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a target="_blank"
                                href="{{ route('bidum.personil.cetak_data_personil', $personil->id_personil) }}"><button
                                    class="btn btn-primary">Cetak Riwayat Hidup</button></a>
                                    @if ($personil->kategori->nama_kategori != 'AKTIF')
                                    <button class="btn btn-success mt-1 mb-3" id="aktifkan_personil">Aktifkan
                                        Personil</button>
                                    @else
                                        <button class="btn btn-danger mt-1 mb-3" data-toggle="modal" data-target="#nonaktif">Nonaktifkan
                                        Personil</button>
                                    @endif
                        </div>
                        @include(
                            'bidum.personil.data_personil.modal.form_nonaktif_personil'
                        )
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class="card">
                            <div class="card-body">
                                <nav class="nav-justified">
                                    <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-hidup-tab" data-toggle="tab"
                                            href="#nav-hidup" role="tab" aria-controls="nav-hidup"
                                            aria-selected="true"><span class="font-small-3 font-weight-bolder">Riwayat
                                                Hidup</span></a>
                                        <a class="nav-item nav-link" id="nav-pendidikan-tab" data-toggle="tab"
                                            href="#nav-pendidikan" role="tab" aria-controls="nav-pendidikan"
                                            aria-selected="false"><span class="font-small-3 font-weight-bolder">Riwayat
                                                Pendidikan</span></a>
                                        <a class="nav-item nav-link" id="nav-pendidikan-tab" data-toggle="tab"
                                            href="#nav-pangkat" role="tab" aria-controls="nav-pangkat"
                                            aria-selected="false"><span class="font-small-3 font-weight-bolder">Riwayat
                                                Pangkat/Gol</span></a>
                                        <a class="nav-item nav-link" id="nav-jabatan-tab" data-toggle="tab"
                                            href="#nav-jabatan" role="tab" aria-controls="nav-jabatan"
                                            aria-selected="false"><span class="font-small-3 font-weight-bolder">Riwayat
                                                Jabatan</span></a>
                                        <a class="nav-item nav-link" id="nav-penugasan-tab" data-toggle="tab"
                                            href="#nav-penugasan" role="tab" aria-controls="nav-penugasan"
                                            aria-selected="false"><span
                                                class="font-small-3 font-weight-bolder">Penugasan</span></a>
                                        <a class="nav-item nav-link" id="nav-pakaian-tab" data-toggle="tab"
                                            href="#nav-pakaian" role="tab" aria-controls="nav-pakaian"
                                            aria-selected="true"><span class="font-small-3 font-weight-bolder">Data
                                                Pakaian</span></a>
                                        <a class="nav-item nav-link" id="nav-keluarga-tab" data-toggle="tab"
                                            href="#nav-keluarga" role="tab" aria-controls="nav-keluarga"
                                            aria-selected="true"><span class="font-small-3 font-weight-bolder">Data
                                                Keluarga</span></a>
                                        <a class="nav-item nav-link" id="nav-bahasa-tab" data-toggle="tab"
                                            href="#nav-bahasa" role="tab" aria-controls="nav-bahasa"
                                            aria-selected="false"><span class="font-small-3 font-weight-bolder">Bahasa dan
                                                Penghargaan</span></a>
                                    </div>
                                </nav>
                                <div class="tab-content pt-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-hidup" role="tabpanel"
                                        aria-labelledby="nav-hidup-tab">
                                        <div class="row mb-2">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">DATA DIRI</h3>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#rh">Edit Data</button>
                                            </div>

                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Nama Lengkap</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->nama }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Jenis Kelamin</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->jenis_kelamin }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Tempat Lahir</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->tempat_lahir }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Tanggal Lahir</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($personil->tgl_lahir)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Status Perkawinan</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->status_pernikahan }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Tanggal Perkawinan</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">
                                                    @if ($personil->tgl_pernikahan == null || $personil->tgl_pernikahan == '0000-00-00')
                                                        -
                                                    @else
                                                        {{ date('d/m/Y', strtotime($personil->tgl_pernikahan)) }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Agama</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->agama }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Suku</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->suku }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">NIK</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->nik }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">No. KK</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->no_kk }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">NPWP</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3"> {{ $personil->npwp }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">No. BPJS</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->no_bpjs }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">No. Asabri</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->no_asabri }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">KPIS</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->no_kpis }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Alamat</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->alamat }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">No. Surat Nikah</div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->no_surat_nikah }}</span>
                                            </div>
                                        </div>

                                        <h5 class="mt-2 mb-2 text-secondary">Ciri Fisik</h5>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Jenis Rambut</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->jenis_rambut }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Warna Kulit</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->warna_kulit }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Tinggi Badan</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->tinggi_badan }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Berat Badan</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->berat_badan }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Gol. Darah</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->gol_darah }}</span>
                                            </div>
                                        </div>                                        

                                        <h5 class="mt-2 mb-2 text-secondary">Data TNI</h5>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">MKG</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $mkg }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT MKG</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($personil->tmt_tni)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Kategori Personil</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->kategori->nama_kategori }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Kategori</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($tmt_kategori)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Sumber Masuk</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->sumber_masuk }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Tahun Lulus</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('Y', strtotime($personil->tmt_tni)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT TNI</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($personil->tmt_tni)) }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Perwira</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">
                                                    @if ($personil->tmt_perwira == null || $personil->tmt_perwira == '0000-00-00')
                                                        -
                                                    @else
                                                        {{ date('d/m/Y', strtotime($personil->tmt_perwira)) }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Bintara</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">
                                                    @if ($personil->tmt_bintara == null || $personil->tmt_bintara == '0000-00-00')
                                                        -
                                                    @else
                                                        {{ date('d/m/Y', strtotime($personil->tmt_bintara)) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Tamtama</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">
                                                    @if ($personil->tmt_tamtama == null || $personil->tmt_tamtama == '0000-00-00')
                                                        -
                                                    @else
                                                        {{ date('d/m/Y', strtotime($personil->tmt_tamtama)) }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <h5 class="mt-2 mb-2 text-secondary">Pangkat & Jabatan Terakhir</h5>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Matra</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->korps->matra->nama_matra }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Kesatuan</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->nama_kesatuan }}</span>
                                            </div>
                                        </div>                                        
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">NRP</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->nrp }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Korps</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->kode_korps }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Pangkat</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->nama_pangkat }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Pangkat</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($personil->tmt_pangkat_terakhir)) }}</span>
                                            </div>
                                        </div>                                        
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Jabatan</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->nama_jabatan_terakhir }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">TMT Jabatan</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ date('d/m/Y', strtotime($personil->tmt_jabatan_terakhir)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Grade</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->grade }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Eselon</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->eselon }}</span>
                                            </div>
                                        </div>

                                        <h5 class="mt-2 mb-2 text-secondary">Penilaian</h5>
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Psikologi</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->psikologi }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Jasmani</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->jasmani }}</span>
                                            </div>
                                        </div>                                        
                                        <div class="row mb-50">
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Kesehatan</span></div>
                                            <div class="col-lg-4 col-6">
                                                <span class="font-small-3">{{ $personil->kesehatan }}</span>
                                            </div>
                                            <div class="col-lg-3 col-6"><span class="font-small-3 font-weight-bolder">Dapen</span></div>
                                            <div class="col-lg-2 col-6">
                                                <span class="font-small-3">{{ $personil->dapen }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-pakaian" role="tabpanel"
                                        aria-labelledby="nav-pakaian-tab">
                                        <div class="row mb-2">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">DATA PAKAIAN</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#ubah-pakaian">Edit Data Pakaian</button>
                                            </div>

                                        </div>

                                        {{-- <table class="table">
                                            @foreach ($pakaian as $item)
                                                <tr>
                                                    <td class="border-top-0 pt-0 pl-0 font-small-3">
                                                        {{ strtoupper($item->item_pakaian) }}</td>
                                                    <td class="border-top-0 pt-0">{{ $item->ukuran }}</td>
                                                </tr>
                                            @endforeach
                                        </table> --}}
                                        <?php

                                        $i = 0;
                                        
                                        echo '  <table style="width:100%">
                                                    <tr>';
                                                        foreach ($pakaian as $item) {
                                                            $i++;
                                                            echo '<td>' . $item->item_pakaian . '</td>';
                                                            echo '<td>' . ':' . '</td>';
                                                            echo '<td class="pr-5">' . $item->ukuran . '</td>';
                                                        
                                                            if ($i == 3) {
                                                                echo '</tr><tr>';
                                                                $i = 0;
                                                            }
                                                        }
                                        echo '      </tr>
                                                </table>';

                                        ?>

                                    </div>
                                    <div class="tab-pane fade" id="nav-keluarga" role="tabpanel"
                                        aria-labelledby="nav-keluarga-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">DATA ANGGOTA KELUARGA</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#anggota-keluarga">Tambah Anggota Keluarga</button>
                                            </div>
                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_keluarga">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nama Anggota Keluarga</th>
                                                                        <th>Tempat, Tanggal Lahir</th>
                                                                        <th>Hubungan Keluarga</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="nav-pendidikan" role="tabpanel"
                                        aria-labelledby="nav-pendidikan-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">DATA PENDIDIKAN UMUM</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#umum">Tambah Pendidikan Umum</button>
                                            </div>

                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_pendidikan_umum">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tingkat Pendidikan</th>
                                                                        <th>Nama Sekolah</th>
                                                                        <th>Tahun Lulus</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">DATA PENDIDIKAN MILITER</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#militer">Tambah Pendidikan Militer</button>
                                            </div>
                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_pendidikan_militer">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Kategori Pendidikan</th>
                                                                        <th>Kriteria Tingkat</th>
                                                                        <th>Nama Sekolah</th>
                                                                        <th>Tahun Lulus</th>
                                                                        <th class="text-center" style="min-width: 150px;">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="nav-pangkat" role="tabpanel"
                                        aria-labelledby="nav-pangkat-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">RIWAYAT KEPANGKATAN</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#pangkat">Tambah Riwayat Pangkat/Gol</button>
                                            </div>
                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_riwayat_pangkat">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Pangkat</th>
                                                                        <th style="min-width: 80px;">TMT Pangkat</th>
                                                                        <th>NO SKEP</th>
                                                                        <th style="min-width: 80px;">TGL SKEP</th>
                                                                        <th style="min-width: 80px;">NO SPRIN</th>
                                                                        <th style="min-width: 80px;">TGL SPRIN</th>
                                                                        <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="nav-jabatan" role="tabpanel"
                                        aria-labelledby="nav-jabatan-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">RIWAYAT JABATAN</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#jabatan">Tambah Jabatan</button>
                                            </div>
                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_riwayat_jabatan">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Jabatan</th>
                                                                        <th style="min-width: 80px;">TMT Jabatan</th>
                                                                        <th>NO SKEP</th>
                                                                        <th style="min-width: 80px;">TGL SKEP</th>
                                                                        <th>NO SPRIN</th>
                                                                        <th style="min-width: 80px;">TGL SPRIN</th>
                                                                        <th class="text-center" style="min-width: 100px;">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="nav-penugasan" role="tabpanel"
                                        aria-labelledby="nav-penugasan-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">PENUGASAN OPERASI</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#operasi">Tambah Penugasan Operasi</button>
                                            </div>

                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_penugasan_dn">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Macam Tugas</th>
                                                                        <th>Tahun</th>
                                                                        <th>Lokasi Operasi</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">PENUGASAN LN</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#ln">Tambah Penugasan LN</button>
                                            </div>

                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_penugasan_ln">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Macam Tugas</th>
                                                                        <th>Tahun</th>
                                                                        <th>Negara Tujuan</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="tab-pane fade" id="nav-bahasa" role="tabpanel"
                                        aria-labelledby="nav-bahasa-tab">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">KECAKAPAN BAHASA</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#bahasa">Tambah Bahasa</button>
                                            </div>
                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_bahasa">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Jenis Bahasa</th>
                                                                        <th>Bahasa</th>
                                                                        <th>Kompetensi</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h4 class="text-secondary my-auto">PENGHARGAAN/TANDA JASA</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#jasa">Tambah Tanda Jasa</button>
                                            </div>

                                        </div>
                                        <section id="multilingual-datatable">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-datatable table-responsive">
                                                            <table class="table table-striped table-bordered"
                                                                id="data_tanda_jasa">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Jenis Tanda Jasa</th>
                                                                        <th>Tahun Perolehan</th>
                                                                        <th class="text-center">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('bidum.personil.data_personil.modal.keluarga', [
        'id_personil' => $personil->id_personil,
    ])
    @include(
        'bidum.personil.data_personil.modal.create_pend_umum_pers',
        ['pendidikan_umum' => $pendidikan_umum, 'id_personil' => $personil->id_personil]
    )
    @include(
        'bidum.personil.data_personil.modal.create_pend_militer_pers',
        ['id_personil' => $personil->id_personil]
    )
    @include('bidum.personil.data_personil.modal.riwayat_pangkat', [
        'id_personil' => $personil->id_personil,
        'pangkat' => $pangkat,
    ])
    @include('bidum.personil.data_personil.modal.riwayat_jabatan', [
        'id_personil' => $personil->id_personil,
        'jabatan' => $jabatan,
    ])
    @include(
        'bidum.personil.data_personil.modal.penugasan_operasi',
        ['id_personil' => $personil->id_personil]
    )
    @include('bidum.personil.data_personil.modal.penugasan_ln', [
        'id_personil' => $personil->id_personil,
    ])
    @include('bidum.personil.data_personil.modal.bahasa', [
        'id_personil' => $personil->id_personil,
    ])
    @include('bidum.personil.data_personil.modal.tanda_jasa', [
        'id_personil' => $personil->id_personil,
    ])
    @include('bidum.personil.data_personil.modal.riwayat_hidup', [
        'personil' => $personil,
    ])
    @include('bidum.personil.data_personil.modal.pakaian', [
        'id_personil' => $personil->id_personil,
        'pakaian' => $pakaian,
    ])
    @include(
        'bidum.personil.data_personil.modal.edit_pend_militer_pers'
    )
    @include(
        'bidum.personil.data_personil.modal.edit_pend_umum_pers'
    )
    @include(
        'bidum.personil.data_personil.modal.edit_riwayat_pangkat'
    )
    @include(
        'bidum.personil.data_personil.modal.edit_riwayat_jabatan'
    )
    @include('bidum.personil.data_personil.modal.edit_keluarga')
    @include('bidum.personil.data_personil.modal.edit_bahasa')
    @include('bidum.personil.data_personil.modal.edit_tanda_jasa')
    @include(
        'bidum.personil.data_personil.modal.edit_penugasan_dn'
    )
    @include(
        'bidum.personil.data_personil.modal.edit_penugasan_ln'
    )
    <!-- END: Content-->
@endsection
@section('page_js')
    <script src="{{ url('js/tables.js') }}"></script>
    <script src="{{ url('js/data_personil_edit.js') }}"></script>
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            select_ajax("{{ url('bidum/personil/list-korps') }}",'korps',"Korps","{{ $personil->korps->matra->kode_matra }}");
            setTimeout(function(){$("#list_korps").val("{{ $personil->kode_korps }}").trigger('change.select2')}, 1000);

            let url = {!! json_encode($url) !!}
            let target_data = {!! json_encode($target_data) !!}
            $.each(colums_table, function(index, value) {
                ajax_table(url[index], value, target_data[index])
            });

        });


        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == 3 ? 'block' : 'none';
        }

        $(".pick-year").yearpicker({
            onChange: function(value) {
                // YOUR CODE COMES_HERE
            }
        });
        $(".flatpickr-false").flatpickr({
            static: true
        });

        $('#matra').change(function(){
            let kode_matra = $(this).val();
            select_ajax("{{ url('bidum/personil/list-korps') }}",'korps',"Korps",kode_matra)
        });

        function select_ajax(url,field,placeholder,kode_matra){
            $('#list_'+field).empty().trigger("change");
            $.ajax({
                    url: url+'/'+kode_matra, 
                    method: "GET",
                    dataType: "json",
                    success: function (result) {
                        $("#list_"+field).empty().trigger("change");
                        $("#list_"+field).select2({ data: result.data,placeholder: "Pilih "+placeholder,allowClear: false,dropdownParent: $("#rh") });
                    }
                });
        }

        $('#aktifkan_personil').click(function(){
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, activate it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "PUT",
                        data:{_token:'{{ csrf_token() }}'},
                        url: "{{ url('bidum/personil/aktif') }}/"+'{{ $personil->id_personil }}',
                        success: function(response){
                            Swal.fire(
                                'Activated!',
                                'Personil Activated.',
                                'success'
                            ).then(() => {
                                location.reload();
                                }
                            )
                        },
                        error:(jqXHR)=>{
                            const {
                                responseJSON: response
                            } = jqXHR;
                            Swal.fire({
                                title: "Error",
                                text: response.message,
                                icon: "error",
                                heightAuto: false
                            })
                        }
                    });
                }
            })
        })
    </script>
@endsection
