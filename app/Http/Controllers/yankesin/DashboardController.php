<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Models\BOR;
use App\Models\RumahSakit;
use App\Models\KategoriFasilitas;
use App\Models\Fasilitas;
use App\Models\FasilitasRS;
use App\Models\Matra;
use App\Models\Angkatan;
use App\Models\Provinsi;
use App\Models\Dokter;
use App\Models\Paramedis;
use App\Models\KategoriDokter;
use App\Models\JenisParamedis;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function dashboard_fasilitas(Request $request)
    {
        $active_menu = 'dashboard_fasilitas';
        $wil = Provinsi::select('id_provinsi', 'nama_provinsi')->get();
        $frs = FasilitasRS::join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->select('nama_fasilitas', 'rs.id_rs', 'nama_rs', DB::raw('SUM(jumlah) as jumlah'))->whereNotIn('nama_kategori', ['Rawat Jalan', 'Nakes', 'Paramedis', 'Non-Medis'])->whereRaw("(LENGTH(fasilitas.id_fasilitas) < 5 OR nama_kategori = 'Fasilitas Unggulan')")->groupBy('nama_fasilitas', 'id_rs', 'nama_rs');
        if (isset($request->prov)) $frs->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $frs->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        if (isset($request->kotama)) {
            $kotama = array();
            $kots = Angkatan::select('id_angkatan')->where("parent", $request->kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kots = Angkatan::select('id_angkatan')->whereIn("parent", $kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kotama[] = $request->kotama;
            $frs->whereIn('rs.id_angkatan', $kotama);
        }
        $frs = $frs->get();
        $data1 = array();
        foreach ($frs as $d) {
            if (!isset($data1[$d->nama_fasilitas])) $data1[$d->nama_fasilitas] = array('total' => 0, 'detil' => array());
            $data1[$d->nama_fasilitas]['total'] += $d->jumlah;
            if ($d->jumlah > 0) $data1[$d->nama_fasilitas]['detil'][] = array('nama' => $d->nama_rs, 'jumlah' => $d->jumlah);
        }
        $frwj = FasilitasRS::join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->select('fasilitas.id_fasilitas', 'rs.id_rs', 'nama_rs', 'keterangan')->where('nama_kategori', 'Rawat Jalan')->whereNotIn('fasilitas.id_fasilitas', ['PU', 'PGU'])->orderBy('nama_fasilitas');
        if (isset($request->prov)) $frwj->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $frwj->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        if (isset($request->kotama)) $frwj->whereIn('rs.id_angkatan', $kotama);
        $frwj = $frwj->get();
        $dataps = array();
        $datapg = array();
        foreach ($frwj as $d) {
            $sp = explode('|', $d->keterangan);
            foreach ($sp as $s) {
                if (substr($d->id_fasilitas, 0, 2) == 'PS') {
                    if (!isset($dataps[$s])) $dataps[$s] = array('total' => 0, 'detil' => array());
                    $dataps[$s]['total'] += 1;
                    $dataps[$s]['detil'][] = array('nama' => $d->nama_rs);
                } else {
                    if (!isset($datapg[$s])) $datapg[$s] = array('total' => 0, 'detil' => array());
                    $datapg[$s]['total'] += 1;
                    $datapg[$s]['detil'][] = array('nama' => $d->nama_rs);
                }
            }
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->whereNotIn('nama_kategori', ['Nakes', 'Paramedis', 'Non-Medis'])->whereRaw("(LENGTH(id_fasilitas) < 5 OR nama_kategori = 'Fasilitas Unggulan')")->orderByRaw('fasilitas.id_kategori, CAST(id_fasilitas AS INT)')->get();
        $series = array('Poli Umum' => array(), 'Poli Gigi' => array());
        $labels = array('Poli Umum' => array(), 'Poli Gigi' => array());
        $data = array('Poli Umum' => array(), 'Poli Gigi' => array());
        $lblnow = '';
        foreach ($fas as $d) {
            if ($lblnow != $d->nama_kategori) {
                $series[$d->nama_kategori] = array();
                $labels[$d->nama_kategori] = array();
                $data[$d->nama_kategori] = array();
                $lblnow = $d->nama_kategori;
            }
            $labels[$d->nama_kategori][] = $d->nama_fasilitas;
            $series[$d->nama_kategori][] = isset($data1[$d->nama_fasilitas]) ? $data1[$d->nama_fasilitas]['total'] : 0;
            $data[$d->nama_kategori][] = isset($data1[$d->nama_fasilitas]) ? $data1[$d->nama_fasilitas]['detil'] : array();
        }
        foreach ($dataps as $lbl => $d) {
            $labels['Poli Umum'][] = $lbl;
            $series['Poli Umum'][] = $d['total'];
            $data['Poli Umum'][] = $d['detil'];
        }
        foreach ($datapg as $lbl => $d) {
            $labels['Poli Gigi'][] = $lbl;
            $series['Poli Gigi'][] = $d['total'];
            $data['Poli Gigi'][] = $d['detil'];
        }
        return view('yankesin.dashboard_fasilitas.index', compact(
            'active_menu',
            'wil',
            'labels',
            'series',
            'data'
        ));
    }

    public function dashboard_nakes(Request $request)
    {
        $active_menu = 'dashboard_nakes';
        $wil = Provinsi::select('id_provinsi', 'nama_provinsi')->get();
        $rs = RumahSakit::select('id_rs', 'nama_rs', 'id_angkatan')->get();
        $matra = Matra::select('kode_matra')->whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        $total = ['Dokter' => 0, 'Perawat' => 0, 'Lainnya' => 0];
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra')->select('nama_fasilitas', 'matra.kode_matra', DB::raw('SUM(jumlah) as jumlah'))->where('nama_kategori', 'Nakes')->whereRaw("nama_fasilitas LIKE '%Honorer'")->whereIn('matra.kode_matra', ['AD', 'AL', 'AU', 'MABES'])->groupBy('kode_matra', 'nama_fasilitas')->orderByRaw('kode_matra ASC, fasilitas.id_fasilitas ASC');
        if (isset($request->prov)) $frs->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $frs->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) {
            $kotama = array();
            $kots = Angkatan::select('id_angkatan')->where("parent", $request->kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kots = Angkatan::select('id_angkatan')->whereIn("parent", $kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kotama[] = $request->kotama;
            $frs->whereIn('rs.id_angkatan', $kotama);
        }
        $frs = $frs->get();
        $data1 = array();
        foreach ($frs as $d) {
            $data1[$d->kode_matra][$d->nama_fasilitas] = $d->jumlah;
            $total['Dokter'] += $d->jumlah;
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Nakes')->get();
        $data2 = array();
        foreach ($fas as $d) {
            $data2[] = $d->nama_fasilitas;
            foreach ($matra as $m) {
                if (!isset($data1[$m->kode_matra][$d->nama_fasilitas])) $data1[$m->kode_matra][$d->nama_fasilitas] = 0;
            }
        }
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra')->select('nama_fasilitas', 'matra.kode_matra', DB::raw('SUM(jumlah) as jumlah'))->where('nama_kategori', 'Paramedis')->whereRaw("nama_fasilitas LIKE '%Honorer'")->whereNotIn('matra.kode_matra', ['TNI', 'PNS', 'KB_TNI', 'KB_PNS'])->groupBy('kode_matra', 'nama_fasilitas')->orderByRaw('kode_matra ASC, fasilitas.id_fasilitas ASC');
        if (isset($request->prov)) $frs->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $frs->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) $frs->whereIn('rs.id_angkatan', $kotama);
        $frs = $frs->get();
        $datap1 = array();
        foreach ($frs as $d) {
            $datap1[$d->kode_matra][$d->nama_fasilitas] = $d->jumlah;
            $total['Perawat'] += $d->jumlah;
        }

        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Paramedis')->get();
        $datap2 = array();
        foreach ($fas as $d) {
            $datap2[] = $d->nama_fasilitas;
            foreach ($matra as $m) {
                if (!isset($datap1[$m->kode_matra][$d->nama_fasilitas])) $datap1[$m->kode_matra][$d->nama_fasilitas] = 0;
            }
        }
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra')->select('nama_fasilitas', 'matra.kode_matra', DB::raw('SUM(jumlah) as jumlah'))->where('nama_kategori', 'Non-Medis')->whereIn('matra.kode_matra', ['AD', 'AL', 'AU', 'MABES'])->groupBy('kode_matra', 'nama_fasilitas')->orderByRaw('kode_matra ASC, fasilitas.id_fasilitas ASC');
        if (isset($request->prov)) $frs->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $frs->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) $frs->whereIn('rs.id_angkatan', $kotama);
        $frs = $frs->get();
        $datan1 = array();
        foreach ($frs as $d) {
            $datan1[$d->kode_matra][$d->nama_fasilitas] = $d->jumlah;
            $total['Lainnya'] += $d->jumlah;
        }

        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Non-Medis')->get();
        $datan2 = array();
        foreach ($fas as $d) {
            $datan2[] = $d->nama_fasilitas;
            foreach ($matra as $m) {
                if (!isset($datan1[$m->kode_matra][$d->nama_fasilitas])) $datan1[$m->kode_matra][$d->nama_fasilitas] = 0;
            }
        }

        $matra_bangkes = ['AD', 'AL', 'AU', 'MABES TNI'];
        $kategori_dokter = [
            'Dokter Umum' => 1,
            'Dokter Gigi Umum' => 3,
            'Dokter Spesialis' => 2,
            'Dokter Gigi Spesialis' => 4,
            'Dokter Sub-Spesialis' => 5,
            'Dokter Gigi Sub-Spesialis' => 6,
        ];

        $dokter = Dokter::join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
            ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
            ->groupByRaw('id_kategori_dokter, matra, UPPER(klasifikasi)')
            ->selectRaw('id_kategori_dokter, matra, UPPER(klasifikasi) AS klasifikasi, COUNT(*) AS jumlah');
        if (isset($request->prov) || isset($request->matra) || isset($request->kotama)) $dokter->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')->join('rs', 'rs.id_rs', 'praktek_d.id_rs');
        if (isset($request->matra)) $dokter->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra');
        if (isset($request->prov)) $dokter->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $dokter->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) $dokter->whereIn('rs.id_angkatan', $kotama);
        $dokter = $dokter->get();
        $data_dokter = array();
        $temp_kategori = array();

        foreach ($kategori_dokter as $kd => $id_kd) {
            if (!in_array($kd, $temp_kategori)) $data_dokter['nama_kategori'][] = $kd;
            $temp_kategori[] = $kd;

            foreach ($matra_bangkes as $mb) {

                $data_dokter['TNI'][$mb][$kd] = $dokter->where('matra', $mb)->where('klasifikasi', 'MILITER')->where('id_kategori_dokter', $id_kd)->pluck('jumlah')->first() ?? 0;

                $data_dokter['PNS'][$mb][$kd] = $dokter->where('matra', $mb)->where('klasifikasi', 'PNS')->where('id_kategori_dokter', $id_kd)->pluck('jumlah')->first() ?? 0;

                $total['Dokter'] += $data_dokter['TNI'][$mb][$kd] + $data_dokter['PNS'][$mb][$kd];
            }
        }

        $jenis_p = JenisParamedis::select('nama_jenis_paramedis')
            ->whereRaw('LOWER(`nama_jenis_paramedis`) = ? ', ['bidan'])
            ->orWhereRaw('LOWER(`nama_jenis_paramedis`) like ? ', ['perawat%'])
            ->get();
        $jenis_paramedis = JenisParamedis::leftJoin('paramedis', 'paramedis.id_jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis')->select('nama_jenis_paramedis', 'matra', DB::raw('upper(klasifikasi) as klasifikasi'), DB::raw('count(paramedis.id_paramedis) as jumlah'))
            ->whereIn('nama_jenis_paramedis', $jenis_p->pluck('nama_jenis_paramedis'))
            ->groupByRaw('matra, nama_jenis_paramedis, upper(klasifikasi)');
        if (isset($request->prov) || isset($request->matra) || isset($request->kotama)) $jenis_paramedis->join('praktek_p', 'praktek_p.id_paramedis', 'paramedis.id_paramedis')->join('rs', 'rs.id_rs', 'praktek_p.id_rs');
        if (isset($request->matra)) $jenis_paramedis->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra');
        if (isset($request->prov)) $jenis_paramedis->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $jenis_paramedis->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) $jenis_paramedis->whereIn('rs.id_angkatan', $kotama);
        $jenis_paramedis = $jenis_paramedis
            ->get();

        $data_paramedis = [];
        $temp_jenis_paramedis = [];
        foreach ($jenis_p as $jp) {
            if ((strpos($jp->nama_jenis_paramedis, 'Perawat') !== false) || (strpos($jp->nama_jenis_paramedis, 'Bidan') !== false)) {
                if (!in_array($jp->nama_jenis_paramedis, $temp_jenis_paramedis)) $data_paramedis['jenis_paramedis'][] = $jp->nama_jenis_paramedis;
                $temp_jenis_paramedis[] = $jp->nama_jenis_paramedis;

                foreach ($matra_bangkes as $mb) {
                    $data_paramedis['TNI'][$mb][$jp->nama_jenis_paramedis] = $jenis_paramedis->where('matra', $mb)->where('klasifikasi', 'MILITER')->where('nama_jenis_paramedis', $jp->nama_jenis_paramedis)->pluck('jumlah')->first() ?? 0;
                    $data_paramedis['PNS'][$mb][$jp->nama_jenis_paramedis] = $jenis_paramedis->where('matra', $mb)->where('klasifikasi', 'PNS')->where('nama_jenis_paramedis', $jp->nama_jenis_paramedis)->pluck('jumlah')->first() ?? 0;
                    $total['Perawat'] += $data_paramedis['TNI'][$mb][$jp->nama_jenis_paramedis] + $data_paramedis['PNS'][$mb][$jp->nama_jenis_paramedis];
                }
            }

        }

        return view('yankesin.dashboard_nakes.index', compact(
            'active_menu',
            'wil',
            'rs',
            'total',
            'data1',
            'data2',
            'datap1',
            'datap2',
            'datan1',
            'datan2',
            'jenis_p',
            'data_dokter',
            'data_paramedis'
        ));
    }

    public function dashboard_nakes_detail(Request $request, $kat, $klasifikasi, $nakes)
    {
        if ($kat == 'Nakes Lain' || $klasifikasi == 'Honorer') {
            if ($klasifikasi == 'MILITER') $klasifikasi = 'TNI';
            $data = RumahSakit::selectRaw('nama_rs, jumlah')
                ->join('fasilitas_rs', 'fasilitas_rs.id_rs', 'rs.id_rs')
                ->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')
                ->where('nama_fasilitas', "$nakes $klasifikasi")
                ->where('jumlah', '>', 0)
                ->orderBy('nama_rs');
        } else if ($kat == 'Dokter') {
            $kat = [
                'Dokter Umum' => 1,
                'Dokter Gigi Umum' => 3,
                'Dokter Spesialis' => 2,
                'Dokter Gigi Spesialis' => 4,
                'Dokter Sub-Spesialis' => 5,
                'Dokter Gigi Sub-Spesialis' => 6,
            ];
            $data = Dokter::selectRaw('nama_rs, COUNT(*) AS jumlah')
                ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                ->join('rs', 'rs.id_rs', 'praktek_d.id_rs')
                ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                ->where('id_kategori_dokter', $kat[$nakes])
                ->whereRaw("UPPER(klasifikasi) = '$klasifikasi'")
                ->groupBy('nama_rs')
                ->orderByRaw('nama_rs');
        } else if ($kat == 'Perawat') {
            $data = Paramedis::selectRaw('nama_rs, COUNT(*) AS jumlah')
                ->join('praktek_p', 'praktek_p.id_paramedis', 'paramedis.id_paramedis')
                ->join('rs', 'rs.id_rs', 'praktek_p.id_rs')
                ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'paramedis.id_jenis_paramedis')
                ->where('nama_jenis_paramedis', $nakes)
                ->whereRaw("UPPER(klasifikasi) = '$klasifikasi'")
                ->groupBy('nama_rs')
                ->orderByRaw('nama_rs');
        }
        if (isset($request->prov)) $data->where('id_kotakab', $request->prov);
        if (isset($request->matra)) $data->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->leftJoin('matra', 'matra.kode_matra', 'angkatan.kode_matra')->where('matra.kode_matra', $request->matra);
        if (isset($request->kotama)) {
            $kotama = array();
            $kots = Angkatan::select('id_angkatan')->where("parent", $request->kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kots = Angkatan::select('id_angkatan')->whereIn("parent", $kotama)->get();
            foreach ($kots as $k) $kotama[] = $k->id_angkatan;
            $kotama[] = $request->kotama;
            $data->whereIn('rs.id_angkatan', $kotama);
        }
        $data = $data->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function dashboard_bor($id = 'all')
    {
        $active_menu = 'bor_yankesin';
        $data = [];
        $matra = Matra::select('kode_matra', 'nama_matra')->whereNotIn('kode_matra', ['TNI', 'PNS'])->get();
        $frs = DB::select("SELECT
            f.nama_fasilitas,
            SUM(fr.jumlah) AS tersedia,
            SUM(b.terpakai) AS terisi
        FROM fasilitas f
        JOIN kategori_fasilitas k USING(id_kategori)
        JOIN fasilitas_rs fr USING(id_fasilitas)" .
            ($id != 'all' ? "
        JOIN rs USING (id_rs)
        JOIN angkatan a USING (id_angkatan) " : '') .
            "LEFT JOIN bor b USING(id_fasilitas_rs)
        WHERE
            (nama_kategori IN ('IGD', 'Rawat Inap', 'Rawat Inap Khusus', 'Ruang Operasi') OR
            fr.id_fasilitas_rs IN (
            SELECT id_fasilitas_rs FROM (
                SELECT MAX(created_at),id_fasilitas_rs FROM bor group by id_fasilitas_rs
            ) AS last
            ))" .
            ($id != 'all' ? " AND kode_matra = '$id'" : '') .
            "GROUP BY
            f.nama_fasilitas");
        foreach ($frs as $d) {
            $i = strpos($d->nama_fasilitas, '/');
            $nama = $i === false ? $d->nama_fasilitas : substr($d->nama_fasilitas, 0, $i);
            $data[$nama] = $d->tersedia;
            $data[$nama . '_isi'] = $d->terisi;
        }
        return view('yankesin.bor.index', compact(
            'active_menu',
            'matra',
            'data',
        ));
    }

    public function dashboard_yankesin()
    {
        $active_menu = 'dashboard_yankesin';
        $fas = Fasilitas::selectRaw('id_fasilitas, nama_fasilitas')
            ->whereIn('id_kategori', ['G', 'I', 'J'])
            ->orWhere('id_fasilitas', '1')
            ->orderBy('id_fasilitas')
            ->get();
        $namafas = array();
        $takeout_namafas = [
            'trauma',
            'eracs',
            'ursz',
            'antiaging',
            'cbct',
            'abus',
            'aestheticcenter',
            'estetika/anti-aging/kecantikan',
            'laserholmium',
            'phacomulsikasi'
        ];
        $takeout_id_fas = [];

        foreach ($fas as $d) {
            $nama_fasilitas = strtolower(str_replace(' ', '', $d->nama_fasilitas));
            if (!in_array($nama_fasilitas, $takeout_namafas)) {
                $namafas[$d->id_fasilitas] = $d->nama_fasilitas;
            } else {
                $takeout_id_fas[] = $d->id_fasilitas;
            }
        }
        $fas_filter = array_diff($fas->pluck('id_fasilitas')->toArray(), $takeout_id_fas);
        $data = Dokter::selectRaw('id_rs, nama_spesialis, id_kategori_dokter, COUNT(*) AS jumlah, jenis_spesialis.id_spesialis')
            ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
            ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
            ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
            ->groupBy('id_rs', 'id_spesialis')
            ->having('jumlah', '>', '0')
            ->orderByRaw('id_rs, id_kategori_dokter, nama_spesialis')
            ->get();
        $jmldok = array();
        foreach ($data as $d) {
            if (!isset($jmldok[$d->id_rs])) $jmldok[$d->id_rs] = array();
            $jmldok[$d->id_rs][] = (object)['kat' => $d->id_kategori_dokter, 'sp' => $d->nama_spesialis, 'jml' => $d->jumlah, 'id_sp' => $d->id_spesialis];
        }
        $data = [];
        /*
        $data = Paramedis::selectRaw('id_rs, nama_jenis_paramedis, COUNT(*) AS jumlah')
            ->join('praktek_p', 'praktek_p.id_paramedis', 'paramedis.id_paramedis')
            ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'paramedis.id_jenis_paramedis')
            ->groupBy('id_rs', 'paramedis.id_jenis_paramedis')
            ->having('jumlah', '>', '0')
            ->orderByRaw('id_rs, paramedis.id_jenis_paramedis')
            ->get();
        */
        $jmlpar = array();
        foreach ($data as $d) {
            if (!isset($jmlpar[$d->id_rs])) $jmlpar[$d->id_rs] = array();
            $jmlpar[$d->id_rs][] = (object)['kat' => $d->nama_jenis_paramedis, 'jml' => $d->jumlah];
        }
        $data = [];
        /*
        $data = Fasilitas::selectRaw('id_rs, nama_fasilitas, SUM(jumlah) AS jumlah')
            ->join('fasilitas_rs', 'fasilitas_rs.id_fasilitas', 'fasilitas.id_fasilitas')
            ->where('id_kategori', 'N')
            ->groupBy('id_rs', 'fasilitas.id_fasilitas')
            ->having('jumlah', '>', '0')
            ->orderBy('id_rs')
            ->get();
        */
        $jmllain = array();
        foreach ($data as $d) {
            if (!isset($jmllain[$d->id_rs])) $jmllain[$d->id_rs] = array();
            $jmllain[$d->id_rs][] = (object)['kat' => $d->nama_fasilitas, 'jml' => $d->jumlah];
        }
        $data = Fasilitas::selectRaw('id_fasilitas')
            ->where('id_kategori', 'D')
            ->pluck('id_fasilitas');
        $tt = FasilitasRS::selectRaw('id_rs, SUM(jumlah) AS jumlah')
            ->whereIn('id_fasilitas', $data)
            ->groupBy('id_rs')
            ->orderBy('id_rs')
            ->get();
        $fasD = array();
        foreach ($tt as $d) {
            $fasD[$d->id_rs] = $d->jumlah;
        }
        $rs = RumahSakit::selectRaw('rs.*,nama_tingkat_rs, kode_matra')
            ->with(['fasilitas' => function ($q) use ($fas, $fas_filter) {
                $q->selectRaw('id_rs, id_fasilitas, jumlah')
                    // ->whereIn('id_fasilitas', $fas->pluck('id_fasilitas'));
                    ->whereIn('id_fasilitas', $fas_filter);
            }])
            ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
            ->leftJoin('tingkat_rs', 'tingkat_rs.id_tingkat_rs', 'rs.id_tingkat_rs')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('id_rs')
            ->get();

        foreach ($rs as $d) {
            foreach ($d->fasilitas as $k => $f) $f->nama_fasilitas = $namafas[$f->id_fasilitas];
            $jml = 0;
            $d->detaildok = $jmldok[$d->id_rs] ?? [];
            foreach ($d->detaildok as $k) {
                $jml += $k->jml;
            }
            $d->dokter = $jml;
            $jml = 0;
            $d->detailpar = $jmlpar[$d->id_rs] ?? [];
            foreach ($d->detailpar as $k) {
                $jml += $k->jml;
            }
            $d->paramedis = $jml;
            $jml = 0;
            $d->detaillain = $jmllain[$d->id_rs] ?? [];
            foreach ($d->detaillain as $k) {
                $jml += $k->jml;
            }
            $d->nakeslain = $jml;
            $d->tempat_tidur = $fasD[$d->id_rs] ?? 0;
        }

        return view('yankesin.dashboard', compact(
            'active_menu',
            'rs',
        ));
    }

    public function peta_sebaran_fasilitas(Request $request)
    {
        $active_menu = 'peta_yankesin_fas';
        $fas = Fasilitas::selectRaw('id_fasilitas, nama_fasilitas')
            ->whereIn('id_kategori', ['G'])
            ->orWhere('id_fasilitas', '1')
            ->orderBy('id_fasilitas')
            ->get();
        $rs = RumahSakit::selectRaw('rs.*, kode_matra, jumlah, nama_tingkat_rs')
            ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
            ->join('fasilitas_rs', 'fasilitas_rs.id_rs', 'rs.id_rs')
            ->leftJoin('tingkat_rs', 'tingkat_rs.id_tingkat_rs', 'rs.id_tingkat_rs')
            ->where('id_fasilitas', $request->id)
            ->where('jumlah', '>', '0')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
        return view('yankesin.rumah_sakit.peta_sebaran', compact(
            'active_menu',
            'rs',
            'fas',
        ));
    }

    public function peta_sebaran_posyandu(Request $request)
    {
        $active_menu = 'data_posyandu';
        $rs = Posyandu::selectRaw('posyandu.*')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
        return view('yankesin.data_posyandu.peta_sebaran', compact(
            'active_menu',
            'rs',
        ));
    }

    public function rekap_fasilitas_faskes()
    {
        $active_menu = 'rekap_fasilitas_yankesin';
        $matra = Matra::select('kode_matra')->whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        $kategori = KategoriFasilitas::whereNotIn('id_kategori', ['L', 'M', 'N'])->get();

        return view('yankesin.rumah_sakit.rekap_fasilitas', compact(
            'active_menu',
            'matra',
            'kategori',
        ));
    }

    public function rekap_fasilitas_faskes_list(Request $request)
    {
        $kategori = KategoriFasilitas::whereNotIn('id_kategori', ['L', 'M', 'N'])->pluck('id_kategori');
        $rumah_sakit = RumahSakit::selectRaw('rs.id_rs, rs.id_angkatan');
        if (isset($request->matra)) $rumah_sakit->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->where('kode_matra', $request->matra);
        if (isset($request->tipe)) $rumah_sakit->where('jenis_rs', $request->tipe);
        if (isset($request->rss)) $rumah_sakit->whereRaw("jenis_rs like '%RSS'");
        $rumah_sakit = $rumah_sakit->get();
        $rs = array();
        foreach ($rumah_sakit as $d) {
            if (isset($request->kotama)) {
                if ($d->angkatan->level == 'sub') {
                    $idk = $d->angkatan->parent_->parent;
                } else if ($d->angkatan->level == 'sat') {
                    $idk = $d->angkatan->parent;
                } else {
                    $idk = $d->id_angkatan;
                }
                if ($request->kotama != $idk) continue;
            }
            unset($d->id_angkatan, $d->angkatan);
            $rs[] = $d->id_rs;
        }
        $data = Fasilitas::selectRaw('id_rs, SUM(jumlah) AS jumlah')
            ->join('fasilitas_rs', 'fasilitas_rs.id_fasilitas', 'fasilitas.id_fasilitas')
            ->where('id_kategori', 'N')
            ->groupBy('id_rs')
            ->orderBy('id_rs')
            ->get();
        $jmllain = array();
        foreach ($data as $d) {
            $jmllain[$d->id_rs] = $d->jumlah;
        }
        $data = RumahSakit::selectRaw('rs.id_rs, nama_rs, id_kategori, SUM(jumlah) AS jumlah')
            ->withCount(['praktek_d' => function ($q) {
                //$q->where('status', 'Disetujui');
                $q->join('dokter', 'dokter.id_dokter', 'praktek_d.id_dokter')->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter');
            }, 'praktek_p' => function ($q) {
                //$q->where('status', 'Disetujui');
                $q->join('paramedis', 'paramedis.id_paramedis', 'praktek_p.id_paramedis');
            }])
            ->join('fasilitas_rs', 'fasilitas_rs.id_rs', 'rs.id_rs')
            ->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')
            ->whereIn('rs.id_rs', $rs)
            ->whereIn('id_kategori', $kategori)
            ->groupByRaw('rs.id_rs, id_kategori')
            ->orderByRaw('nama_rs, rs.id_rs, id_kategori')
            ->get();
        $idnow = '-';
        $rs = array();
        foreach ($data as $d) {
            if ($idnow != $d->id_rs) {
                $idnow = $d->id_rs;
                $rs[$d->id_rs] = [
                    'id_rs' => $d->id_rs,
                    'nama_rs' => $d->nama_rs,
                ];
            }
            if (in_array($d->id_kategori, ['B', 'G', 'H', 'I', 'J'])) {
                if ($d->jumlah == 0) $rs[$d->id_rs][$d->id_kategori] = 'Data Tidak Tersedia';
                else if ($d->id_kategori == 'B') $rs[$d->id_rs][$d->id_kategori] = 'Daftar Poli';
                else $rs[$d->id_rs][$d->id_kategori] = 'Daftar Fasilitas';
            } else
            $rs[$d->id_rs][$d->id_kategori] = $d->jumlah;
            $rs[$d->id_rs]['dokter'] = $d->praktek_d_count;
            $rs[$d->id_rs]['paramedis'] = $d->praktek_p_count;
            $rs[$d->id_rs]['nakeslain'] = $jmllain[$d->id_rs] ?? 0;
        }
        return DataTables::of($rs)
            ->addIndexColumn()
            ->make(true);
    }

    public function rekap_fasilitas_faskes_detail($kat, $id)
    {
        if ($kat == 'dokter') {
            $data = Dokter::selectRaw('nama_spesialis as nama_fasilitas, id_kategori_dokter, COUNT(*) AS jumlah')
                ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                ->where('id_rs', $id)
                ->groupBy('nama_spesialis')
                ->orderByRaw('id_kategori_dokter, nama_spesialis')
                ->get();
            foreach ($data as $d) {
                if ($d->id_kategori_dokter == 1) $d->nama_fasilitas = 'DOKTER UMUM';
                else if ($d->id_kategori_dokter == 3) $d->nama_fasilitas = 'DOKTER GIGI';
            }
        } else if ($kat == 'paramedis') {
            $data = Paramedis::selectRaw('nama_jenis_paramedis as nama_fasilitas, COUNT(*) AS jumlah')
                ->join('praktek_p', 'praktek_p.id_paramedis', 'paramedis.id_paramedis')
                ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'paramedis.id_jenis_paramedis')
                ->where('id_rs', $id)
                ->groupBy('nama_jenis_paramedis')
                ->orderByRaw('nama_jenis_paramedis')
                ->get();
        } else
            $data = RumahSakit::selectRaw('fasilitas.id_fasilitas, nama_fasilitas, jumlah, keterangan')
                ->join('fasilitas_rs', 'fasilitas_rs.id_rs', 'rs.id_rs')
                ->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')
                ->where('id_kategori', $kat)
                ->where('rs.id_rs', $id)
                ->orderBy('nama_fasilitas')
                ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function sebaran_fasilitas_faskes()
    {
        $active_menu = 'dashboard_yankesin';
        $rumah_sakit = RumahSakit::selectRaw('id_rs, nama_rs, jenis_rs, alamat, no_ijin_opr, latitude, longitude, rs.id_angkatan, kode_matra')
            ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
        $rs = $rumah_sakit->get();
        foreach ($rs as $d) {
            $d->jmldoku = Dokter::join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                ->where('id_rs', $d->id_rs)
                ->whereIn('id_kategori_dokter', ['1', '2', '5'])
                ->count();
            $d->jmldokg = Dokter::join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                ->where('id_rs', $d->id_rs)
                ->whereIn('id_kategori_dokter', ['3', '4'])
                ->count();
        }
        return view('yankesin.fasilitas.peta_sebaran', compact(
            'active_menu',
            'rs',
        ));
    }

    public function dokter_faskes_detail($id, Request $request)
    {
        $data = Dokter::selectRaw('nama_dokter, klasifikasi')
                ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                ->join('spesialis_dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                ->where('id_rs', $id)
                ->orderByRaw('nama_dokter');
        if (isset($request->sp)) {
            if ($request->sp == '1' || $request->sp == '3') $data->where('id_kategori_dokter', $request->sp);
            else $data->where('jenis_spesialis.id_spesialis', $request->sp);
        }
        return DataTables::of($data->get())
            ->addIndexColumn()
            ->make(true);
    }
}
