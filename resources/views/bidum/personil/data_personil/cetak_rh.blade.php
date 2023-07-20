<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak Riwayat Hidup</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/paper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/family-roboto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/family-nunito.css')}}">

    <style>
        @page {
            size: A4;
            margin: 5mm 0 5mm 0;
        }

        .sheet {
            overflow: visible;
            height: auto !important;
        }

        body {
            font-family: Nunito;
            background-color: #e0e0e0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -1rem;
            margin-left: -1rem;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mt-1 {
            margin-top: 1rem !important;
        }

        .mt-2 {
            margin-top: 1.5rem !important;
        }

        .mt-3 {
            margin-top: 3rem !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: 1rem !important;
        }

        .mr-1 {
            margin-right: 1rem !important;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        hr.bold {
            border: 1px solid #6c757d;
            border-radius: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border-top: none;
            font-size: 11px;
            padding: 0px;
        }

        .table td {
            min-width: 10px;
            max-width: 10px;
            word-wrap: break-word;
            vertical-align: top;
            padding-bottom: 0.3rem;
        }

        p {
            margin: 0px;
            padding: 0px;
        }

        .text-center {
            text-align: center !important;
        }

        .font-weight-bolder {
            font-weight: 600 !important;
        }
    </style>

</head>

<body class="A4" onload="window.print()">
    <section class="sheet padding-10mm">
        <h3 class="text-center font-weight-bolder mt-0">MARKAS BESAR TENTARA NEGARA INDONESIA <br> PUSAT KESEHATAN</h3>
        <hr class="bold">
        <p class="text-center font-weight-bolder mt-1">
            <span style="font-size: 14px;"> <u> RIWAYAT HIDUP SINGKAT </u> </span><br>
            <img class="text-center mt-1" src="{{ asset('personil/' . $personil->foto) }}" style="max-width: 20%; height: auto; border-radius:5px;">
        </p>

        <div class="row mt-1">
            <div class="col-12">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">I. <u> DATA POKOK </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>1. NAMA (LENGKAP)</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->nama) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>2. PANGKAT/KORPS</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->nama_pangkat_terakhir) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>3. NRP/NBI</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ $personil->nrp }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>4. JABATAN</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->nama_jabatan_terakhir) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>5. TMT JABATAN</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($personil->tmt_jabatan_terakhir)) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>6. TANGGAL LAHIR</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($personil->tgl_lahir)) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>7. TEMPAT LAHIR</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->tempat_lahir) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>8. KATEGORI</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>AKTIF</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>9. TMT KATEGORI</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>20-06-1988</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>10. SUMBER</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>SEPA WAMIL 1988</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>11. TMT TNI</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($personil->tmt_tni)) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>12. SUKU BANGSA</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->suku) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>13. NO. ASABRI</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ $personil->no_asabri }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>14. AGAMA</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->agama) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>15. JENIS KELAMIN</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->jenis_kelamin) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>16. STATUS KAWIN</p>
                                <p>:</p>
                            </div>
                        </td>
                        @if ($personil->status_pernikahan == 'kawin')
                        <td>KAWIN</td>
                        @else
                        <td>TIDAK KAWIN</td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>17. JUMLAH ANAK</p>
                                <p>:</p>
                            </div>
                        </td>
                        @if ($personil->status_pernikahan == 'kawin')
                        <td>{{ $count_anak }}</td>
                        @else
                        <td>{{ $count_anak }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>18. GOL. DARAH</p>
                                <p>:</p>
                            </div>
                        </td>
                        @if ($personil->gol_darah == null)
                        <td>-</td>
                        @else
                        <td>{{ strtoupper($personil->gol_darah) }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between mr-1">
                                <p>19. ALAMAT</p>
                                <p>:</p>
                            </div>
                        </td>
                        <td>{{ strtoupper($personil->alamat) }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-1">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">II. <u> PENDIDIKAN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-3 text-center">
                <p class="font-weight-bolder" style="font-size: 11px;"><u> UMUM </u></p>
            </div>
            <div class="col-9 text-center">
                <p class="font-weight-bolder" style="font-size: 11px;"><u> MILITER </u></p>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <p class="font-weight-bolder" style="font-size: 11px;"><u> DIKMA/DIKTUK/BANG UM </u></p>
            </div>
            <div class="col-4">
                <p class="font-weight-bolder" style="font-size: 11px;"><u> BANG SPES </u></p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($pendidikan_umum as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp;
                            {{ strtoupper($item->pendidikan_umum->tingkat_pendidikan) }}
                        </td>
                        <td>: &ensp; TH {{ $item->tahun_lulus }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($pend_militer_diktuk as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->nama_sekolah) }}</td>
                        <td>: &ensp; TH {{ $item->tahun_lulus }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($pend_militer_dikbangspes as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->nama_sekolah) }}</td>
                        <td>: &ensp; TH {{ $item->tahun_lulus }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">III. <u> KECAKAPAN BAHASA </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">IV. <u> TANDA JASA <u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">V. <u> RIWAYAT PENUGASAN OPERASI </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> ASING </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($asing as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->bahasa) }}</td>
                        <td>: &ensp; {{ strtoupper($item->kompetensi) }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($tanda_jasa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->tanda_jasa->nama_jasa) }}</td>
                        <td>: &ensp; TH {{ $item->tahun }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> DAERAH </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    @foreach ($daerah as $item)
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->bahasa) }}</td>
                        <td>: &ensp; {{ strtoupper($item->kompetensi) }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">VI. <u> PENUGASAN LUAR NEGERI </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> MACAM TUGAS </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> TAHUN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> NEGARA TUJUAN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>-</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>-</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>-</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-6">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">VII. <u> RIWAYAT KEPANGKATAN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> PANGKAT </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> TMT </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> NOMOR SKEP/SPRIN/ST/RDG </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            @foreach ($riwayat_pangkat as $item)
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>{{ $loop->iteration }}. &ensp; {{ strtoupper($item->pangkat->nama_pangkat) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->tmt_pangkat)) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>{{ strtoupper($item->no_skep_pangkat) }}</td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>

        <div class="row mt-1">
            <div class="col-12">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">VII. <u> RIWAYAT JABATAN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> JABATAN </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> TMT </u></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder"><u> NOMOR SKEP/SPRIN/ST/RDG </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @foreach ($riwayat_jabatan as $item)
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ $loop->iteration }}.
                            {{ strtoupper($item->jabatan->nama_jabatan) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ date('d-m-Y', strtotime($item->tmt_jabatan)) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ strtoupper($item->no_skep_jabatan) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
        <div class="row mt-1">
            <div class="col-12">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">XI. <u> DATA KELUARGA </u></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">NAMA</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">TEMPAT/TGL LAHIR</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            <p class="font-weight-bolder">HUB. KEL</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @foreach ($keluarga as $item)
        <div class="row">
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ $loop->iteration }}.
                            {{ strtoupper($item->nama) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ strtoupper($item->tempat_lahir) . ', ' . date('d-m-Y', strtotime($item->tgl_lahir)) }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table mb-0">
                    <tr>
                        <td>
                            {{ strtoupper($item->hubungan) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
        <div style="font-size: 13px;">
            <div class="row" style="margin-top: 2rem;">
                <div class="col-6 text-center">
                    <p class="font-weight-bolder mb-0">Mengetahui</p>
                    <p class="font-weight-bolder mb-0">a.n. Kepala Pusat Kesehatan TNI</p>
                    <p class="font-weight-bolder mb-0">Waka</p>
                    <p class="font-weight-bolder mb-0">u.b.</p>
                    <p class="font-weight-bolder mb-0">Plh. Kasubbidminpers,</p>
                </div>
                <div class="col-6">
                    <p class="font-weight-bolder mb-0">Dibuat di Jakarta</p>
                    <p class="font-weight-bolder mb-0">Pada Tanggal,</p>
                    <hr>
                    <p class="font-weight-bolder text-center">Yang bersangkutan,</p>
                </div>
            </div>
            <div class="row" style="margin-top: 4rem;">
                <div class="col-6 text-center">
                    <p class="font-weight-bolder">
                        {{ ucwords($config->personil->nama ?? '') }} <br>
                        {{ $config->personil->nama_pangkat_terakhir ?? '' }} {{ $config->personil->kode_korps ?? '' }} NRP
                        {{ $config->personil->nrp ?? '' }}
                        <br>
                        {{ $config->jabatan ?? '' }}
                    </p>
                </div>
                <div class="col-6 text-center">
                    <p class="font-weight-bolder">
                        {{ ucwords($personil->nama) }} <br>
                        {{ $personil->nama_pangkat_terakhir }} NRP {{ $personil->nrp }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>