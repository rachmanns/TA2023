<?php

namespace App\Http\Controllers\taud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\JenisBBM;
use App\Models\BBM;

class TaudController extends Controller
{
    public function data(Request $request)
    {
        $data = SuratMasuk::selectRaw('COALESCE(COUNT(sm_id), 0) AS jml, sifat_nama')->rightJoin('sifat_surat', 'sifat_surat.sifat_id', 'surat_masuk.sm_sifat_fk')->where('sifat_group', 'SM')->whereYear('sm_timestamp', $request->tahun ?? date('Y'))->groupBy('sifat_nama')->get();
        $sm = array();
        foreach($data as $d) {
            $sm[$d->sifat_nama] = $d->jml;
        }
        $data = DB::connection('dms')->select("SELECT sifat_nama FROM sifat_surat WHERE sifat_group = 'SK' ORDER BY sifat_id");
        $katsk = array();
        foreach($data as $d) {
            $katsk[] = $d->sifat_nama;
        }
        $data = SuratKeluar::selectRaw('COALESCE(COUNT(sk_id), 0) AS jml, sifat_nama, status_code, sifat_id')->join('status_surat', 'status_surat.status_code', 'surat_keluar.sk_status_fk')->join('sifat_surat', 'sifat_surat.sifat_id', 'surat_keluar.sk_sifat_fk')->where('sifat_group', 'SK')->whereYear('sk_timestamp', $request->tahun ?? date('Y'))->groupByRaw('sifat_nama, status_code')->orderBy('sifat_id')->get();
        $sk_belum = array();
        $sk_sudah = array();
        foreach($data as $d) {
            if ($d->status_code != 'skb') $sk_sudah[$d->sifat_nama] = $d->jml;
            else $sk_belum[$d->sifat_nama] = $d->jml;
        }
        $skb = array();
        $sks = array();
        foreach($katsk as $d) {
           $skb[] = $sk_belum[$d] ?? 0;
           $sks[] = $sk_sudah[$d] ?? 0;
        }
		$data = JenisBBM::select('nama_jenis_bbm')->orderBy('created_at')->get();
        $bbm = array();
        foreach($data as $d) {
            $bbm[$d->nama_jenis_bbm] = array('Terpakai' => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), 'Sisa' => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0));
        }
		$data = BBM::selectRaw('COALESCE(SUM(jml_in), 0) AS jml_in, COALESCE(SUM(jml_out), 0) AS jml_out, SUBSTR(periode, 6, 2) AS bulan, nama_jenis_bbm AS jenis')->join('jenis_bbm', 'jenis_bbm.id_jenis_bbm', 'bbm.id_jenis_bbm')->where('ta', $request->tahun ?? date('Y'))->groupByRaw('nama_jenis_bbm, SUBSTR(periode, 6, 2)')->orderByRaw('jenis_bbm.created_at, periode')->get();
        foreach($data as $d) {
            $bbm[$d->jenis]['Terpakai'][intval($d->bulan)-1] = $d->jml_out;
            $bbm[$d->jenis]['Sisa'][intval($d->bulan)-1] = $d->jml_in - $d->jml_out;
        }
        return response()->json([
            "error" => false,
            'sm' => $sm,
            'skb' => $skb,
            'sks' => $sks,
            'bbm' => $bbm,
        ]);
    }

    public function index()
    {
        $data = DB::connection('dms')->select("SELECT sifat_nama FROM sifat_surat WHERE sifat_group = 'SK' ORDER BY sifat_id");
        $katsk = array();
        foreach($data as $d) {
            $katsk[] = $d->sifat_nama;
        }
		$data = JenisBBM::select('nama_jenis_bbm')->orderBy('created_at')->get();
        $jenis_bbm = array();
        foreach($data as $d) {
            $jenis_bbm[] = $d->nama_jenis_bbm;
        }
        $active_menu = 'dashboard_taud';
        return view('taud.dashboard', compact('active_menu',
            'katsk',
            'jenis_bbm',
        ));
    }

    public function bbm(Request $request)
    {
        $data = JenisBBM::select('nama_jenis_bbm')->orderBy('created_at')->get();
        $jenis_bbm = array();
        foreach($data as $d) {
            $jenis_bbm[] = $d->nama_jenis_bbm;
        }
		$data = BBM::selectRaw('COALESCE(SUM(jml_in), 0) AS jml_in, COALESCE(SUM(jml_out), 0) AS jml_out, nama_jenis_bbm AS jenis')->join('jenis_bbm', 'jenis_bbm.id_jenis_bbm', 'bbm.id_jenis_bbm')->where('periode', $request->periode ?? date('Y-m'))->groupByRaw('nama_jenis_bbm')->orderByRaw('jenis_bbm.created_at')->get();
        $bbm = array();
        foreach($data as $d) {
            $bbm[$d->jenis]['in'] = $d->jml_in;
            $bbm[$d->jenis]['out'] = $d->jml_out;
        }
        $terima = array();
        $keluar = array();
        foreach($jenis_bbm as $d) {
            if (isset($bbm[$d])) {
                $terima[] = intval($bbm[$d]['in']);
                $keluar[] = intval($bbm[$d]['out']);
            } else {
                $terima[] = 0;
                $keluar[] = 0;
            }
        }
        return response()->json([
            "error" => false,
            'terima' => $terima,
            'keluar' => $keluar,
        ]);
    }
}
