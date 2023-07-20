<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Models\DetailBrgMatkesM;
use App\Models\FasilitasRS;
use App\Models\MasterBekkes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardBarangController extends Controller
{
    public function grafik_alkes()
    {
        $frs = FasilitasRS::select('fasilitas.id_fasilitas', 'nama_fasilitas', DB::raw('SUM(jumlah) as jumlah'))->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->where('id_kategori', 'O')->groupBy('fasilitas.id_fasilitas')->orderBy('nama_fasilitas')->get();
        $category = [];
        $data = [];
        foreach ($frs as $f) {
            $category[] = ['label' => $f->nama_fasilitas];
            $data[] = ['value' => $f->jumlah];
        }
        return view('matfaskes.daftar_bekkes.grafik_alkes', compact('category', 'data'), ['active_menu' => 'grafik_alkes']);
    }

    public function grafik_bekkes()
    {
        return view('matfaskes.daftar_bekkes.grafik_bekkes', [
            'active_menu' => 'grafik_bekkes',
            'tahun' => date('Y')
        ]);
    }

    public function berjalan(Request $request)
    {
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get()->pluck('nama_bekkes');
        $detail_brg = DetailBrgMatkesM::has('kontrak')->with('kontrak')->withCount('brg_out')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $request->tahun)
            ->get();

        $data = [];
        $series_list = [
            'Keluar Ada Kontrak',
            'Sisa Ada Kontrak',
            'Keluar Belum Ada Kontrak',
            'Sisa Belum Ada Kontrak'
        ];

        $warna = [
            '#1f9d57',
            '#48da89',
            '#ff8510',
            '#ffb976'
        ];

        $categories = [];

        foreach ($master_bekkes as $k => $v) {
            $categories['category'][] = ['label' => $v];
            $data['Keluar Ada Kontrak'][$v]['value'] = 0;
            $data['Sisa Ada Kontrak'][$v]['value'] = 0;
            $data['Keluar Belum Ada Kontrak'][$v]['value'] = 0;
            $data['Sisa Belum Ada Kontrak'][$v]['value'] = 0;

            foreach ($detail_brg as $key => $d) {

                if ($v == $d->nama_matkes) {
                    if ($d->kontrak->tgl_kontrak != null && $d->brg_out_count != 0) $data['Keluar Ada Kontrak'][$v]['value'] += $d->jumlah;

                    if ($d->kontrak->tgl_kontrak != null && $d->brg_out_count == 0) $data['Sisa Ada Kontrak'][$v]['value'] += $d->jumlah;

                    if ($d->kontrak->tgl_kontrak == null && $d->brg_out_count != 0) $data['Keluar Belum Ada Kontrak'][$v]['value'] += $d->jumlah;

                    if ($d->kontrak->tgl_kontrak == null && $d->brg_out_count == 0) $data['Sisa Belum Ada Kontrak'][$v]['value'] += $d->jumlah;
                }
            }
        }

        $dataset = [];

        foreach ($series_list as $k => $v) {
            $dataset[] = [
                'seriesname' => $v,
                'color' => $warna[$k],
                'data' => array_values($data[$v])
            ];
        }

        $results = [
            'categories' => [$categories],
            'dataset1' => [$dataset[0], $dataset[1]],
            'dataset2' => [$dataset[2], $dataset[3]]

        ];

        return $results;
    }

    public function lampau(Request $request)
    {
        $tahun = $request->tahun - 1;
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get()->pluck('nama_bekkes');
        $detail_brg = DetailBrgMatkesM::has('kontrak')->with('kontrak')->withCount('brg_out')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $tahun)
            ->get();

        $data = [];
        $series_list = [
            'Sisa Ada Kontrak',
            'Sisa Belum Ada Kontrak'
        ];

        $warna = [
            '#1f9d57',
            '#48da89',
            '#ff8510',
            '#ffb976'
        ];

        $categories = [];

        foreach ($master_bekkes as $k => $v) {
            $categories['category'][] = ['label' => $v];
            $data['Sisa Ada Kontrak'][$v]['value'] = 0;
            $data['Sisa Belum Ada Kontrak'][$v]['value'] = 0;

            foreach ($detail_brg as $key => $d) {

                if ($v == $d->nama_matkes) {
                    if ($d->kontrak->tgl_kontrak != null && $d->brg_out_count == 0) $data['Sisa Ada Kontrak'][$v]['value'] += $d->jumlah;

                    if ($d->kontrak->tgl_kontrak == null && $d->brg_out_count == 0) $data['Sisa Belum Ada Kontrak'][$v]['value'] += $d->jumlah;
                }
            }
        }

        $dataset = [];

        foreach ($series_list as $k => $v) {
            $dataset[] = [
                'seriesname' => $v,
                'color' => $warna[$k],
                'data' => array_values($data[$v])
            ];
        }

        $results = [
            'categories' => [$categories],
            'dataset1' => [$dataset[0]],
            'dataset2' => [$dataset[1]]

        ];

        return $results;
    }
}
