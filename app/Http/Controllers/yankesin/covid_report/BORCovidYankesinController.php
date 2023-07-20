<?php

namespace App\Http\Controllers\yankesin\covid_report;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use App\Models\BOR;
use App\Models\Fasilitas;
use App\Models\FasilitasRS;
use App\Models\Matra;
use App\Models\RumahSakit;
use App\Models\Provinsi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BORCovidYankesinController extends Controller
{
    public function index(Request $request,$id='all')
    {
    //   return $request->all();
        $active_menu = 'bor_covid_yankesin';
        $wil = Provinsi::select('id_provinsi', 'nama_provinsi')->get();

        $jumlah_icu = FasilitasRS::where('id_fasilitas', Fasilitas::ICU);
        if (isset($request->prov)) $jumlah_icu->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->where('id_kotakab', $request->prov);
        if (isset($request->matra)) {
            if (!isset($request->prov)) $jumlah_icu->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs');
            $jumlah_icu->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        }
        $kotama = array();
        if (isset($request->kotama)) {
            $kots = Angkatan::select('id_angkatan')->where("parent", $request->kotama)->get();
            foreach($kots as $k) $kotama[] = $k->id_angkatan;
            $kots = Angkatan::select('id_angkatan')->whereIn("parent", $kotama)->get();
            foreach($kots as $k) $kotama[] = $k->id_angkatan;
            $kotama[] = $request->kotama;
            $jumlah_icu->whereIn('rs.id_angkatan', $kotama);
        }
        $jumlah_icu = $jumlah_icu->sum('jumlah');

        $terisi_icu = BOR::join('fasilitas_rs', 'fasilitas_rs.id_fasilitas_rs', 'bor.id_fasilitas_rs')->where('fasilitas_rs.id_fasilitas', Fasilitas::ICU);
        if (isset($request->prov)) $terisi_icu->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->where('id_kotakab', $request->prov);
        if (isset($request->matra)) {
            if (!isset($request->prov)) $terisi_icu->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs');
            $terisi_icu->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        }
        if (isset($request->kotama)) $terisi_icu->whereIn('rs.id_angkatan', $kotama);
        $terisi_icu = $terisi_icu->sum('terpakai');

        $tersedia_icu = $jumlah_icu - $terisi_icu;

        $jumlah_isolasi = FasilitasRS::where('id_fasilitas', Fasilitas::ISOLASI);
        if (isset($request->prov)) $jumlah_isolasi->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->where('id_kotakab', $request->prov);
        if (isset($request->matra)) {
            if (!isset($request->prov)) $jumlah_isolasi->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs');
            $jumlah_isolasi->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        }
        if (isset($request->kotama)) $jumlah_isolasi->whereIn('rs.id_angkatan', $kotama);
        $jumlah_isolasi = $jumlah_isolasi->sum('jumlah');

        $terisi_isolasi = BOR::join('fasilitas_rs', 'fasilitas_rs.id_fasilitas_rs', 'bor.id_fasilitas_rs')->where('fasilitas_rs.id_fasilitas', Fasilitas::ISOLASI);
        if (isset($request->prov)) $terisi_isolasi->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')->where('id_kotakab', $request->prov);
        if (isset($request->matra)) {
            if (!isset($request->prov)) $terisi_isolasi->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs');
            $terisi_isolasi->join('angkatan', 'rs.id_angkatan', 'angkatan.id_angkatan')->where('kode_matra', $request->matra);
        }
        if (isset($request->kotama)) $terisi_isolasi->whereIn('rs.id_angkatan', $kotama);
        $terisi_isolasi = $terisi_isolasi->sum('terpakai');

        $tersedia_isolasi = $jumlah_isolasi - $terisi_isolasi;

        $tt_icu = [
            'Tersedia' => $tersedia_icu,
            'Terisi' => $terisi_icu
        ];

        $tt_isolasi = [
            'Tersedia' => $tersedia_isolasi,
            'Terisi' => $terisi_isolasi
        ];

        $bar_icu = $this->bor_covid_bar(Fasilitas::ICU, $request, $kotama);
        $bar_isolasi = $this->bor_covid_bar(Fasilitas::ISOLASI, $request, $kotama);
        // return $bar_isolasi;

        $data = [];
        $matra = Matra::select('kode_matra', 'nama_matra')->whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        $frs = DB::select("SELECT
            f.nama_fasilitas,
            SUM(fr.jumlah) AS tersedia,
            SUM(COALESCE(b.terpakai, 0)) AS terisi
        FROM fasilitas f
        JOIN kategori_fasilitas k USING(id_kategori)
        JOIN fasilitas_rs fr USING(id_fasilitas)
        JOIN rs USING (id_rs)" .
            ($id != 'all' ? "
        JOIN angkatan a USING (id_angkatan) " : '') .
            "LEFT JOIN (
                SELECT id_fasilitas_rs, terpakai FROM bor WHERE (created_at, id_fasilitas_rs) in (
                    SELECT MAX(created_at) AS created_at, id_fasilitas_rs FROM bor group by id_fasilitas_rs
                )
            ) b USING(id_fasilitas_rs)
        WHERE
            nama_kategori IN ('IGD', 'Rawat Inap', 'Rawat Inap Khusus', 'Ruang Operasi')" .
            ($id != 'all' ? " AND kode_matra = '$id'" : '') .
            "GROUP BY
            f.nama_fasilitas");
        foreach ($frs as $d) {
            $i = strpos($d->nama_fasilitas, '/');
            $nama = $i === false ? $d->nama_fasilitas : substr($d->nama_fasilitas, 0, $i);
            $data[$nama] = $d->tersedia;
            $data[$nama . '_isi'] = $d->terisi;
        }
        $last_update = BOR::select('tgl_update')->latest()->limit(1)->pluck('tgl_update')->first();

        return view('yankesin.covid_report.bor_yankesin.monitoring-bor', compact('active_menu', 'tt_icu', 'tt_isolasi', 'bar_icu', 'bar_isolasi', 'wil','data','matra','id','last_update'));
    }

    // public function get_tempat_tidur()
    // {
    //     $fasilitas_rs = FasilitasRS::get();
    //     $bor = BOR::with('fasilitas_rs')->get();

    //     $tersedia_icu = $fasilitas_rs->sum('jumlah');
    //     $terisi_icu = $bor->where('fasilitas_rs.id_fasilitas', Fasilitas::ICU)->sum('terpakai');

    //     $data = [
    //         'Tersedia' => $tersedia,
    //         'Terisi' => $terisi
    //     ];
    //     return $data;
    // }

    public function bor_covid_bar($id_fasilitas, $request, $kotama)
    {
        // $id_fasilitas = 4;
        $angkatan = Angkatan::whereNull('parent')->orderByRaw('kode_matra, nama_angkatan');
        if (isset($request->matra)) $angkatan->where('kode_matra', $request->matra);
        if (isset($request->kotama)) $angkatan->whereIn('id_angkatan', $kotama);
        $angkatan = $angkatan->get();

        $sum_data = DB::select("SELECT
            a.id_angkatan,
            a.parent,
            SUM(fr.jumlah - COALESCE(b.terpakai, 0)) AS tersedia,
            COALESCE(SUM(b.terpakai), 0) AS terisi
        FROM
            angkatan a
        JOIN rs r ON
            a.id_angkatan = r.id_angkatan
        JOIN fasilitas_rs fr ON
            r.id_rs = fr.id_rs
        LEFT JOIN bor b ON
            fr.id_fasilitas_rs = b.id_fasilitas_rs
        WHERE
            fr.id_fasilitas = {$id_fasilitas} AND
            (b.id_fasilitas_rs IS NULL OR (b.id_fasilitas_rs, b.tgl_update) IN (
            SELECT
                id_fasilitas_rs, MAX(tgl_update) AS tgl_update
            FROM
                bor
            GROUP BY
                id_fasilitas_rs
            ))" .
        (isset($request->prov) ? " AND id_kotakab = '{$request->prov}'" : '') .
        (isset($request->matra) ? " AND kode_matra = '{$request->matra}'" : '') .
        (isset($request->kotama) ? " AND a.id_angkatan IN ('" . implode("', '", $kotama) . "')" : '') .
        " GROUP BY
            a.id_angkatan
        ORDER BY kode_matra, nama_angkatan");

        // return $sum_data;

        $data = [];
        foreach ($sum_data as $index => $item) {
            if ($item->parent == null) $id = $item->id_angkatan;
            else {
                $d = Angkatan::find($item->parent);
                if ($d->parent == null) $id = $d->id_angkatan;
                else $id = $d->parent;
            }
            if (isset($data[$id])) {
                $data[$id]->terisi += $item->terisi;
                $data[$id]->tersedia += $item->tersedia;
            } else $data[$id] = $item;
        }
        $array_data=[];
        foreach ($angkatan as $key => $value) {
            if (isset($data[$value->id_angkatan])) {
                $key_name = $value->nama_angkatan . ' (' . ($data[$value->id_angkatan]->tersedia ? round($data[$value->id_angkatan]->terisi / $data[$value->id_angkatan]->tersedia * 100) : 0) . '%)';
                $array_data[$key_name]['tersedia'] = $data[$value->id_angkatan]->tersedia;
                $array_data[$key_name]['terisi'] = $data[$value->id_angkatan]->terisi;
            } else {
                $array_data[$value->nama_angkatan]['tersedia'] = 0;
                $array_data[$value->nama_angkatan]['terisi'] = 0;
            }
        }

        $result = [
            'angkatan' => array_keys($array_data),
            'tersedia' => array_column($array_data, 'tersedia'),
            'terisi' => array_column($array_data, 'terisi')
        ];
        return $result;
    }

    public function dashboard_bor_detail(Request $request)
    {
        $data = FasilitasRS::selectRaw('nama_rs, jumlah, id_fasilitas_rs')
            ->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')
            ->join('rs', 'rs.id_rs', 'fasilitas_rs.id_rs')
            ->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')
            ->whereIn('nama_kategori', ['IGD', 'Rawat Inap', 'Rawat Inap Khusus', 'Ruang Operasi'])
            ->where('nama_fasilitas', $request->fas)
            ->orderBy('nama_rs')
            ->with(['bor' => function($query) {
                $query->select('id_fasilitas_rs', 'terpakai')->latest();
            }]);
        if (isset($request->matra) && $request->matra != 'all') $data->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->where('kode_matra', $request->matra);
        $data = $data->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
