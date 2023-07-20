<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\BaHibah;
use App\Models\DetailBrgMatkesM;
use App\Models\InPengadaan;
use App\Models\InTktm;
use App\Models\KategoriLaporan;
use App\Models\Kontrak;
use App\Models\Pelaporan;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class DashboardLogistikController extends Controller
{
    public function index()
    {
        $active_menu = 'dashboard_bidlog';
        $month_year = date('Y-m-d');
        $from = date('Y-01-01');
        $to = date('Y-12-31');
        $month_now = date('Y-m');
        $status = [
            'aktif' => 'Aktif',
            'tidak aktif' => 'Tidak Aktif',
        ];

        $kategori_laporan = KategoriLaporan::get();
        $pelaporan = Pelaporan::get();

        $latest_pelaporan = Pelaporan::select('id_kategori', 'tgl_upload', 'file', DB::raw('MAX(created_at) as last_pelaporan'))
            ->groupBy('id_kategori');

        $master_aset = KategoriLaporan::leftJoinSub($latest_pelaporan, 'latest_pelaporan', function ($join) {
            $join->on('kategori_laporan.id_kat_lap', '=', 'latest_pelaporan.id_kategori');
        })->where('type', 'M')->get();
        $master_aset_file = $master_aset->pluck('file')->toArray();

        $empty_master_aset = empty(array_filter($master_aset_file, function ($a) {
            return $a !== null;
        }));


        return view('bidum.logistik.dashboard', compact(
            'active_menu',
            'month_year',
            'master_aset',
            'month_now',
            'status',
            'empty_master_aset',
            'from',
            'to'
        ));
    }

    public function chart_aset_masuk($from, $to)
    {

        // $in_hibah = BaHibah::where('kode_ba_hibah', 'A')->whereMonth('tgl_ba_hibah', date('m', strtotime($month_year)))->whereYear('tgl_ba_hibah', date('Y', strtotime($month_year)))->get();
        $in_hibah = BaHibah::where('kode_ba_hibah', 'A')->whereBetween('tgl_ba_hibah', [$from, $to])->get();

        // $in_pengadaan = InPengadaan::with('kontrak')->whereHas('kontrak', function (Builder $query) use ($month_year) {
        //     $query->where('kode_kontrak', 'A')->whereMonth('tgl_kontrak', date('m', strtotime($month_year)))->whereYear('tgl_kontrak', date('Y', strtotime($month_year)));
        // })->get();
        $in_pengadaan = InPengadaan::with('kontrak')->whereHas('kontrak', function (Builder $query) use ($from, $to) {
            $query->where('kode_kontrak', 'A')->whereBetween('tgl_kontrak', [$from, $to]);
        })->get();


        // $in_tktm = InTktm::where('jenis_tktm', 'aset')->whereMonth('tgl_kontrak_tktm', date('m', strtotime($month_year)))->whereYear('tgl_kontrak_tktm', date('Y', strtotime($month_year)))->get();
        $in_tktm = InTktm::where('jenis_tktm', 'aset')->whereBetween('tgl_kontrak_tktm', [$from, $to])->get();

        $data = [
            'chart' => [
                'Pengadaan Pusat' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->count(),
                'Pengadaan Daerah' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->count(),
                'Transfer Masuk' => $in_tktm->count(),
                'Hibah Masuk' => $in_hibah->count()
            ],
            'nominal' => [
                'Pengadaan Pusat' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->sum('nominal'),
                'Pengadaan Daerah' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->sum('nominal'),
                'Transfer Masuk' => $in_tktm->sum('nominal'),
                'Hibah Masuk' => $in_hibah->sum('nominal'),
                'Total Nilai' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->sum('nominal') + $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->sum('nominal') + $in_tktm->sum('nominal') + $in_hibah->sum('nominal')
            ]
        ];
        return $data;
    }

    public function chart_persediaan_masuk($from, $to)
    {
        // $in_hibah = BaHibah::where('kode_ba_hibah', 'P')->whereMonth('tgl_ba_hibah', date('m', strtotime($month_year)))->whereYear('tgl_ba_hibah', date('Y', strtotime($month_year)))->get();
        $in_hibah = BaHibah::where('kode_ba_hibah', 'P')->whereBetween('tgl_ba_hibah', [$from, $to])->get();

        $in_pengadaan = InPengadaan::with('kontrak')->whereHas('kontrak', function (Builder $query) use ($from, $to) {
            $query->where('kode_kontrak', 'P')->whereBetween('tgl_kontrak', [$from, $to]);
        })->get();
        // $in_pengadaan = InPengadaan::with('kontrak')->whereHas('kontrak', function (Builder $query) use ($month_year) {
        //     $query->where('kode_kontrak', 'P')->whereMonth('tgl_kontrak', date('m', strtotime($month_year)))->whereYear('tgl_kontrak', date('Y', strtotime($month_year)));
        // })->get();


        $in_tktm = InTktm::where('jenis_tktm', 'persediaan')->whereBetween('tgl_kontrak_tktm', [$from, $to])->get();
        // $in_tktm = InTktm::where('jenis_tktm', 'persediaan')->whereMonth('tgl_kontrak_tktm', date('m', strtotime($month_year)))->whereYear('tgl_kontrak_tktm', date('Y', strtotime($month_year)))->get();

        $data = [
            'chart' => [
                'Pengadaan Pusat' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->count(),
                'Pengadaan Daerah' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->count(),
                'Transfer Masuk' => $in_tktm->count(),
                'Hibah Masuk' => $in_hibah->count()
            ],
            'nominal' => [
                'Pengadaan Pusat' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->sum('nominal'),
                'Pengadaan Daerah' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->sum('nominal'),
                'Transfer Masuk' => $in_tktm->sum('nominal'),
                'Hibah Masuk' => $in_hibah->sum('nominal'),
                'Total Nilai' => $in_pengadaan->where('kontrak.kode_dipa', 'DIPPUS')->sum('nominal') + $in_pengadaan->where('kontrak.kode_dipa', 'DIPDAR')->sum('nominal') + $in_tktm->sum('nominal') + $in_hibah->sum('nominal')
            ]
        ];
        return $data;
    }

    public function chart_aset_keluar($from, $to)
    {
        $out_hibah = DetailBrgMatkesM::join('ba_hibah', 'ba_hibah.id_ba_hibah', '=', 'detail_brg_matkes_m.id_barang_masuk')
            ->join('rencana_pengeluaran', 'rencana_pengeluaran.id_rencana', '=', 'detail_brg_matkes_m.id_rencana')
            ->join('brg_out', 'brg_out.id_rencana', '=', 'rencana_pengeluaran.id_rencana')
            ->where('ba_hibah.kode_ba_hibah', 'A')
            ->whereBetween('brg_out.created_at', [$from, $to])
            ->whereNotNull('rencana_pengeluaran.tgl_keluar')
            ->select('rencana_pengeluaran.jenis_pengeluaran', DB::raw('SUM(brg_out.jml_keluar) AS jumlah_brg'), DB::raw('SUM(brg_out.jml_keluar*detail_brg_matkes_m.harga_satuan) AS harga_satuan'))
            ->groupBy('rencana_pengeluaran.jenis_pengeluaran')
            ->get();

        $out_tktm = DetailBrgMatkesM::join('in_tktm', 'detail_brg_matkes_m.id_barang_masuk', '=', 'in_tktm.id_in_tktm')
            ->join('rencana_pengeluaran', 'rencana_pengeluaran.id_rencana', '=', 'detail_brg_matkes_m.id_rencana')
            ->join('brg_out', 'brg_out.id_rencana', '=', 'rencana_pengeluaran.id_rencana')
            ->where('in_tktm.jenis_tktm', 'aset')
            ->whereBetween('brg_out.created_at', [$from, $to])
            ->whereNotNull('rencana_pengeluaran.tgl_keluar')
            ->select('rencana_pengeluaran.jenis_pengeluaran', DB::raw('SUM(brg_out.jml_keluar) AS jumlah_brg'), DB::raw('SUM(brg_out.jml_keluar*detail_brg_matkes_m.harga_satuan) AS harga_satuan'))
            ->groupBy('rencana_pengeluaran.jenis_pengeluaran')
            ->get();

        $arr = [
            'Pemakaian',
            'TKTM',
            'Hibah'
        ];

        $hibah_jml_keluar = [];
        $hibah_harga_satuan = [];
        $tktm_jml_keluar = [];
        $tktm_harga_satuan = [];

        $data = [];

        foreach ($out_hibah as $k => $v) {
            $hibah_jml_keluar[$v->jenis_pengeluaran] = $v->jumlah_brg;
            $hibah_harga_satuan[$v->jenis_pengeluaran] = $v->harga_satuan;
        }

        foreach ($out_tktm as $k => $v) {
            $tktm_jml_keluar[$v->jenis_pengeluaran] = $v->jumlah_brg;
            $tktm_harga_satuan[$v->jenis_pengeluaran] = $v->harga_satuan;
        }

        foreach ($arr as $k => $v) {
            $jml_hibah = $hibah_jml_keluar[$v] ?? 0;
            $jml_tktm = $tktm_jml_keluar[$v] ?? 0;

            $harga_hibah = $hibah_harga_satuan[$v] ?? 0;
            $harga_tktm = $tktm_harga_satuan[$v] ?? 0;

            $data['jml_keluar'][$v] = $jml_hibah  + $jml_tktm;
            $data['harga_satuan'][$v] = $harga_hibah  + $harga_tktm;
        }

        $results = [
            "chart" => [
                'Pemakaian' => $data['jml_keluar']['Pemakaian'],
                'Transfer Keluar' => $data['jml_keluar']['TKTM'],
                'Hibah Keluar' => $data['jml_keluar']['Hibah']
            ],
            "nominal" => [
                'Pemakaian' => $data['harga_satuan']['Pemakaian'],
                'Transfer Keluar' => $data['harga_satuan']['TKTM'],
                'Hibah Keluar' => $data['harga_satuan']['Hibah'],
                'Total Nilai' => array_sum($data['harga_satuan'])
            ]
        ];

        return $results;
    }

    public function chart_persediaan_keluar($from, $to)
    {

        $out_hibah = DetailBrgMatkesM::join('ba_hibah', 'ba_hibah.id_ba_hibah', '=', 'detail_brg_matkes_m.id_barang_masuk')
            ->join('rencana_pengeluaran', 'rencana_pengeluaran.id_rencana', '=', 'detail_brg_matkes_m.id_rencana')
            ->join('brg_out', 'brg_out.id_rencana', '=', 'rencana_pengeluaran.id_rencana')
            ->where('ba_hibah.kode_ba_hibah', 'P')
            ->whereBetween('brg_out.created_at', [$from, $to])
            ->whereNotNull('rencana_pengeluaran.tgl_keluar')
            ->select('rencana_pengeluaran.jenis_pengeluaran', DB::raw('SUM(brg_out.jml_keluar) AS jumlah_brg'), DB::raw('SUM(brg_out.jml_keluar*detail_brg_matkes_m.harga_satuan) AS harga_satuan'))
            ->groupBy('rencana_pengeluaran.jenis_pengeluaran')
            ->get();

        $out_tktm = DetailBrgMatkesM::join('in_tktm', 'detail_brg_matkes_m.id_barang_masuk', '=', 'in_tktm.id_in_tktm')
            ->join('rencana_pengeluaran', 'rencana_pengeluaran.id_rencana', '=', 'detail_brg_matkes_m.id_rencana')
            ->join('brg_out', 'brg_out.id_rencana', '=', 'rencana_pengeluaran.id_rencana')
            ->where('in_tktm.jenis_tktm', 'persediaan')
            ->whereBetween('brg_out.created_at', [$from, $to])
            ->whereNotNull('rencana_pengeluaran.tgl_keluar')
            ->select('rencana_pengeluaran.jenis_pengeluaran', DB::raw('SUM(brg_out.jml_keluar) AS jumlah_brg'), DB::raw('SUM(brg_out.jml_keluar*detail_brg_matkes_m.harga_satuan) AS harga_satuan'))
            ->groupBy('rencana_pengeluaran.jenis_pengeluaran')
            ->get();

        $out_pemakaian = DetailBrgMatkesM::join('kontrak', 'detail_brg_matkes_m.id_barang_masuk', '=', 'kontrak.id_kontrak')
            ->join('rencana_pengeluaran', 'rencana_pengeluaran.id_rencana', '=', 'detail_brg_matkes_m.id_rencana')
            ->join('brg_out', 'brg_out.id_rencana', '=', 'rencana_pengeluaran.id_rencana')
            ->where('kontrak.kode_kontrak', 'P')
            ->whereBetween('brg_out.created_at', [$from, $to])
            ->whereNotNull('rencana_pengeluaran.tgl_keluar')
            ->select('rencana_pengeluaran.jenis_pengeluaran', DB::raw('SUM(brg_out.jml_keluar) AS jumlah_brg'), DB::raw('SUM(brg_out.jml_keluar*detail_brg_matkes_m.harga_satuan) AS harga_satuan'))
            ->groupBy('rencana_pengeluaran.jenis_pengeluaran')
            ->get();

        $arr = [
            'Pemakaian',
            'TKTM',
            'Hibah'
        ];

        $hibah_jml_keluar = [];
        $hibah_harga_satuan = [];
        $tktm_jml_keluar = [];
        $tktm_harga_satuan = [];
        $pemakaian_jml_keluar = [];
        $pemakaian_harga_satuan = [];

        $data = [];

        foreach ($out_hibah as $k => $v) {
            $hibah_jml_keluar[$v->jenis_pengeluaran] = $v->jumlah_brg;
            $hibah_harga_satuan[$v->jenis_pengeluaran] = $v->harga_satuan;
        }

        foreach ($out_tktm as $k => $v) {
            $tktm_jml_keluar[$v->jenis_pengeluaran] = $v->jumlah_brg;
            $tktm_harga_satuan[$v->jenis_pengeluaran] = $v->harga_satuan;
        }

        foreach ($out_pemakaian as $k => $v) {
            $pemakaian_jml_keluar[$v->jenis_pengeluaran] = $v->jumlah_brg;
            $pemakaian_harga_satuan[$v->jenis_pengeluaran] = $v->harga_satuan;
        }

        foreach ($arr as $k => $v) {
            $jml_hibah = $hibah_jml_keluar[$v] ?? 0;
            $jml_tktm = $tktm_jml_keluar[$v] ?? 0;
            $jml_pemakaian = $pemakaian_jml_keluar[$v] ?? 0;

            $harga_hibah = $hibah_harga_satuan[$v] ?? 0;
            $harga_tktm = $tktm_harga_satuan[$v] ?? 0;
            $harga_pemakaian = $pemakaian_harga_satuan[$v] ?? 0;

            $data['jml_keluar'][$v] = $jml_hibah + $jml_pemakaian + $jml_tktm;
            $data['harga_satuan'][$v] = $harga_hibah + $harga_pemakaian + $harga_tktm;
        }

        $results = [
            "chart" => [
                'Pemakaian' => $data['jml_keluar']['Pemakaian'],
                'Transfer Keluar' => $data['jml_keluar']['TKTM'],
                'Hibah Keluar' => $data['jml_keluar']['Hibah']
            ],
            "nominal" => [
                'Pemakaian' => $data['harga_satuan']['Pemakaian'],
                'Transfer Keluar' => $data['harga_satuan']['TKTM'],
                'Hibah Keluar' => $data['harga_satuan']['Hibah'],
                'Total Nilai' => array_sum($data['harga_satuan'])
            ]
        ];

        return $results;
    }

    public function export_master_aset(Request $request)
    {
        try {
            $zip      = new ZipArchive;
            $fileName = 'master_aset.zip';
            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($request->master_aset as $key => $value) {
                    $pelaporan = Pelaporan::with('kategori_laporan')->where('id_kategori', $value)->orderBy('created_at', 'desc')->first();
                    if (Storage::disk('report_document')->exists($pelaporan->file)) {
                        $file = Storage::disk('report_document')->get($pelaporan->file);
                        $extension = substr($pelaporan->file, strpos($pelaporan->file, ".") + 1);
                        $zip->addFromString($pelaporan->kategori_laporan->nama_kat_lap . '.' . $extension, $file);
                    }
                }
                $zip->close();
            }
            return response()->download(public_path($fileName));
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        };
    }

    public function export_laporan($id_kategori)
    {
        $pelaporan = Pelaporan::with('kategori_laporan')->whereMonth('periode_laporan', date('m'))->whereYear('periode_laporan', date('Y'))->where('id_kategori', $id_kategori)->orderBy('created_at', 'desc')->first();

        if (!$pelaporan) {
            return redirect('document_not_found');
        }

        $pathToFile = public_path('logistik/report') . '/' . $pelaporan->file;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
    // public function export_laporan(Request $request)
    // {
    //     $pelaporan = Pelaporan::with('kategori_laporan')->whereMonth('periode_laporan', date('m'))->whereYear('periode_laporan', date('Y'))->where('id_kategori', $request->id_kategori)->orderBy('created_at', 'desc')->first();

    //     $extension =  substr($pelaporan->file, strpos($pelaporan->file, ".") + 1);
    //     $file_name = $pelaporan->kategori_laporan->nama_kat_lap . '.' . $extension;

    //     $pathToFile = public_path('logistik/report') . '/' . $pelaporan->file;

    //     $type =  mime_content_type($pathToFile);;
    //     if ($type == "application/zip" && $extension == "xlsx") $type = "application/vnd.openxmlformats-officedocument.spreadsheetml.template";
    //     if ($type == "application/zip" && $extension == "xls") $type = "application/vnd.ms-excel";
    //     $headers = ['Content-Type: ' . $type];

    //     return response()->download($pathToFile, $file_name, $headers);
    // }
}
