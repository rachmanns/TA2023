<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RumahSakit;
use App\Models\RKO;
use App\Models\BahanProduksi;
use App\Models\KategoriBahanProduksi;
use App\Models\Renprod;
use App\Models\DetilRenprod;
use App\Models\JalurCompany;
use App\Models\Distribusi;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $rs = RumahSakit::count();
        $data1 = RKO::where('status', 'Menunggu Persetujuan')
                ->where('periode_pengajuan', $request->tahun ?? date('Y'))
                ->count();
        $data2 = RKO::where('status', 'Disetujui')
                ->where('periode_pengajuan', $request->tahun ?? date('Y'))
                ->count();
        $rko = [$data1, $data2, $rs-$data1-$data2];
        $kbbid = array();
        $kbb = array();
        $kbbs = array();
        $data = KategoriBahanProduksi::selectRaw('id_kategori, nama_kategori')->withCount('bahan_produksi')->get();
        foreach($data as $d) {
            $kbbid[] = $d->id_kategori;
            $kbb[] = $d->nama_kategori;
            $kbbs[] = $d->bahan_produksi_count;
        }
        $prd = array();
        $prds = array();
        $data = Renprod::selectRaw("CONCAT(nama_produk, ' /') AS nama_produk, nama_kemasan, COALESCE(SUM(bets*jml_spp), 0) AS jml")
                ->where('periode_produksi', $request->tahun ?? date('Y'))
                ->orWhereNull('periode_produksi')
                ->rightJoin('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->groupBy('kemasan.id_kemasan')
                ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $prd[] = array($d->nama_produk, $d->nama_kemasan);
            $prds[] = $d->jml;
        }
        $prdss = array();
        $dis = array();
        $data = DetilRenprod::selectRaw("COALESCE(SUM(jml_hasil_produksi), 0) AS jmlp, COALESCE(SUM(jml_keluar), 0) AS jmlk")
                ->where('periode_produksi', $request->tahun ?? date('Y'))
                ->orWhereNull('periode_produksi')
                ->join('renprod', 'renprod.id_renprod', 'detil_renprod.id_renprod')
                ->rightJoin('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->groupBy('kemasan.id_kemasan')
                ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $prdss[] = $d->jmlp;
            $dis[] = $d->jmlk;
        }
        $data = Distribusi::selectRaw("COALESCE(SUM(dobek_keluar), 0) + COALESCE(SUM(dist_keluar), 0) AS jmlk")
                ->whereYear('tgl_distribusi', $request->tahun ?? date('Y'))
                ->join('kemasan', 'kemasan.id_kemasan', 'distribusi.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->groupBy('kemasan.id_kemasan')
                ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $i => $d) {
            $dis[$i] += $d->jmlk;
        }
        $pers = array();
        $data = DetilRenprod::selectRaw("COALESCE(SUM(jml_hasil_produksi), 0) AS jmlp, COALESCE(SUM(jml_keluar), 0) AS jmlk")
                ->where('periode_produksi', intval($request->tahun ?? date('Y')))
                ->orWhereNull('periode_produksi')
                ->join('renprod', 'renprod.id_renprod', 'detil_renprod.id_renprod')
                ->rightJoin('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->groupBy('kemasan.id_kemasan')
                ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $pers[] = $d->jmlp - $d->jmlk;
        }
        $data = Distribusi::selectRaw("(COALESCE(SUM(dobek_masuk), 0) + COALESCE(SUM(dist_masuk), 0)) AS jmlp, (COALESCE(SUM(dobek_keluar), 0) + COALESCE(SUM(dist_keluar), 0)) AS jmlk")
                ->whereYear('tgl_distribusi', intval($request->tahun ?? date('Y')))
                ->join('kemasan', 'kemasan.id_kemasan', 'distribusi.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->groupBy('kemasan.id_kemasan')
                ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $i => $d) {
            $pers[$i] += $d->jmlp - $d->jmlk;
        }
        $active_menu = 'dashboard_lafi';
        return view('lafibiovak.dashboard', compact(
            'active_menu',
            'rko',
            'kbbid',
            'kbb',
            'kbbs',
            'prd',
            'prds',
            'prdss',
            'pers',
            'dis',
        ));
    }

    public function petaLokasiJalurCompany()
    {
        $active_menu = 'maps_jalur_company';
        $data = JalurCompany::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
        return view('lafibiovak.jalur_company.maps', compact('data', 'active_menu'));
    }
}
