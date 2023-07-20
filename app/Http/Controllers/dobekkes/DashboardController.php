<?php

namespace App\Http\Controllers\dobekkes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailBrgMatkesM;
use App\Models\MasterBekkes;

class DashboardController extends Controller
{
    public function grafik_sisa_stok(Request $request)
    {
        $active_menu = 'grafik_sisa_stok';
        $tahun = $request->tahun ?? date('Y');
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get()->pluck('nama_bekkes');
        $brg = DetailBrgMatkesM::selectRaw('(SUM(detail_brg_matkes_m.jumlah) - COALESCE(SUM(jml_keluar), 0)) as sisa, nama_matkes')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'brg_out.id_matkes_dobek', 'detail_brg_matkes_d.id_matkes_dobek')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $tahun)
            ->groupBy('nama_matkes')
            ->get();
        $berjalan = [];
        foreach($brg as $b) {
            $berjalan[$b->nama_matkes] = $b->sisa;
        }
        $brg = DetailBrgMatkesM::selectRaw('(SUM(detail_brg_matkes_m.jumlah) - COALESCE(SUM(jml_keluar), 0)) as sisa, nama_matkes')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'brg_out.id_matkes_dobek', 'detail_brg_matkes_d.id_matkes_dobek')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $tahun-1)
            ->groupBy('nama_matkes')
            ->get();
        $lampau = [];
        foreach($brg as $b) {
            $lampau[$b->nama_matkes] = $b->sisa;
        }
        $categories = [];
        $data_berjalan = [];
        $data_lampau = [];
        foreach ($master_bekkes as $v) {
            $categories[] = ['label' => $v];
            $data_berjalan[] = ['value' => $berjalan[$v] ?? 0];
            $data_lampau[] = ['value' => $lampau[$v] ?? 0];
        }
        return view('dobekkes.grafik_bekkes.index', compact('active_menu', 'tahun', 'categories', 'data_berjalan', 'data_lampau'));
    }
}
