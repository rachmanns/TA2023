<!DOCTYPE html>
<html lang="en">
    <head>   
        <title>Cetak Nominatif</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/normalize.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/paper.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/family-roboto.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/family-nunito.css')}}">
        <link rel="stylesheet" href="dist/themes/oldstyle.css" media="print">

        <style>
        @page { 
            size: A4 landscape; 
            margin: 5mm 0 5mm 0; 
        }

        .sheet {
            overflow: visible;
            height: auto !important;
        }

        body { 
            font-family: Nunito 
        }
        
        h1 { 
            font-family: Roboto; 
            font-size: 14pt; 
            line-height: 25px;
        }
        
        h2 { 
            font-family: Roboto; 
            font-size: 12pt; 
        }
        
        table, td, th {
            border: 1px solid black;
            padding: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        .text-center {
            text-align: center;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mt-2 {
            margin-top: 2rem;
        }

        </style>
</head>
<body class="A4 landscape" onload="window.print()">
    <section class="sheet padding-10mm">
        <h1 class="text-center mt-0">MARKAS BESAR TENTARA NEGARA INDONESIA <br> PUSAT KESEHATAN</h1><hr>
        <h2 class="text-center mt-2">DAFTAR NOMINATIF PERSONIL TNI PUSKES TNI</h2>
        <h2 class="text-center">{{ strtoupper($bulan) }}</h2>
        <table class="table">
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>PANGKAT.NRP</th>
                <th>JABATAN</th>
            </tr>
            @foreach ($tni as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_pangkat_terakhir }} {{ $item->kode_korps }}, {{ $item->nrp }}</td>
                    <td>{{ $item->nama_jabatan_terakhir }}</td>
                </tr>
            @endforeach
        </table>        
    </section>
    <section class="sheet padding-10mm">
        <h2 class="text-center">DAFTAR NOMINATIF PERSONIL PNS PUSKES TNI</h2>
        <h2 class="text-center">{{ strtoupper($bulan) }}</h2>
        <table class="table">
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>PANGKAT.NRP</th>
                <th>JABATAN</th>
            </tr>
            @foreach ($pns as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_pangkat_terakhir }} {{ $item->kode_korps }}, {{ $item->nrp }}</td>
                    <td>{{ $item->nama_jabatan_terakhir }}</td>
                </tr>
            @endforeach
        </table>        
    </section>
</body>
</html>