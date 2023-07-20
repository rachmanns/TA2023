<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Realisasi;
use App\Models\RevisiPagu;
use App\Models\Uraian;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{

    public function index()
    {
        $chart_realisasi = $this->chart();
        return view('bidum.anggaran.dashboard', ['active_menu' => 'dashboard_anggaran'], compact('chart_realisasi'));
    }

    public function laporan_setiap_bidang($year)
    {
        $query = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            },
            'realisasi as realisasi' => function ($query) {
                $query->select(DB::raw('SUM(jumlah)'));
            }
        ])->where('tahun_anggaran', $year)->get();

        $grouping_laporan = $query->where('kode_akun', '!=', null)->groupBy('kode_bidang');

        $result = $grouping_laporan->mapWithKeys(function ($group, $key) {
            return [
                $key =>
                [
                    'kode_bidang' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                    'anggaran' => $group[0]->pagu_awal + $group[0]->revisi_tambah - $group[0]->revisi_kurang,
                    'realisasi' => $group->sum('realisasi'),
                    // 'lost' => $group->where('result', 'lost')->count(),
                ]
            ];
        });

        $data = $result->values();

        return DataTables::of($data)
            // ->addIndexColumn()
            ->editColumn('anggaran', function ($q) {
                return "Rp" . number_format($q['anggaran'], 0, ',', '.');
            })
            ->editColumn('realisasi', function ($q) {
                return "Rp" . number_format($q['realisasi'], 0, ',', '.');
            })
            ->addColumn('prosentase', function ($q) {
                $result = $q['realisasi'] / $q['anggaran'] * 100;
                return $result . '%';
            })
            ->addColumn('action', function ($q) {
                return '<div class="text-center" title="Detail"><a href="' . url('bidum/anggaran/report') . '/' . $q['kode_bidang'] . '"><i data-feather="file-text" class="font-medium-4"></i></a></div>';
            })
            ->toJson();
    }

    public function chart()
    {
        $month = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Mei",
            "Jun",
            "Jul",
            "Agu",
            "Sep",
            "Okt",
            "Nov",
            "Des"
        ];

        $length = count($month);
        $data = [];

        for ($a = 0; $a < $length; $a++) {
            for ($i = 0; $i < $a; $i++) {
                $data[$a][] = 0;
            }
            for ($c = $length; $c > $a; $c--) {
                $data[$a][] = Realisasi::whereYear('tgl_realisasi', date('Y'))->whereMonth('tgl_realisasi', $i + 1)->sum('jumlah');
            }
        }

        $series = [];
        for ($i = 0; $i < $length; $i++) {
            $series[] = [
                'name' => $month[$i],
                'data' => $data[$i]
            ];
        }


        return [
            'categories' => $month,
            'series' => $series
        ];
    }

    public function count_gaji($month_year)
    {
        $month = date('m', strtotime($month_year));
        $year = date('Y', strtotime($month_year));
        $query2 = Uraian::withCount([
            'realisasi as realisasi' => function ($query) use ($month, $year) {
                $query->select(DB::raw('SUM(jumlah)'))->whereMonth('tgl_realisasi', $month)->whereYear('tgl_realisasi', $year);
            }
        ])->get();

        $id_gaji_pns = Uraian::whereRaw("LOWER(REPLACE(`nama_uraian`,' ','') = ?)", strtolower(str_replace(' ', '', 'GAJI DAN TUNJ. PNS')))->first()->id_uraian;
        $id_gaji_tni = Uraian::whereRaw("LOWER(REPLACE(`nama_uraian`,' ','') = ?)", strtolower(str_replace(' ', '', 'GAJI DAN TUNJ. TNI')))->first()->id_uraian;
        $id_tunjangan_tni_pns = Uraian::whereRaw("LOWER(REPLACE(`nama_uraian`,' ','') = ?)", strtolower(str_replace(' ', '', 'TUNJANGAN TNI/PNS')))->first()->id_uraian;

        $gaji_pns = $query2->where('id_parent', $id_gaji_pns)->sum('realisasi');
        $gaji_tni = $query2->where('id_parent', $id_gaji_tni)->sum('realisasi');
        $tunjangan_tni_pns = $query2->where('id_parent', $id_tunjangan_tni_pns)->sum('realisasi');

        return $data = [
            'periode' => date('F Y', strtotime($month_year)),
            'gaji_pns' => "Rp" . number_format($gaji_pns, 0, ',', '.'),
            'gaji_tni' => "Rp" . number_format($gaji_tni, 0, ',', '.'),
            'tunjangan_tni_pns' => "Rp" . number_format($tunjangan_tni_pns, 0, ',', '.')
        ];
    }

    public function count_anggaran($year)
    {
        $query = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            },
            'realisasi as realisasi' => function ($query) {
                $query->select(DB::raw('SUM(jumlah)'));
            }
        ])->where('tahun_anggaran', $year)->get();

        $revisi_pusat = $query->where('kode_dipa', 'DIPPUS')->where('kode_akun', '!=', null);
        $revisi_daerah = $query->where('kode_dipa', 'DIPDAR')->where('kode_akun', '!=', null);

        $revisi_tambah_pusat = $revisi_pusat->sum('revisi_tambah');
        $revisi_kurang_pusat = $revisi_pusat->sum('revisi_kurang');
        $revisi_tambah_daerah = $revisi_daerah->sum('revisi_tambah');
        $revisi_kurang_daerah = $revisi_daerah->sum('revisi_kurang');

        $total_pagu_awal_pusat = $query->where('kode_dipa', 'DIPPUS')->where('id_parent', null)->sum('pagu_awal');
        $total_pagu_awal_daerah = $query->where('kode_dipa', 'DIPDAR')->where('id_parent', null)->sum('pagu_awal');

        $pagu_revisi_pusat = $total_pagu_awal_pusat + $revisi_tambah_pusat - $revisi_kurang_pusat;
        $pagu_revisi_daerah = $total_pagu_awal_daerah + $revisi_tambah_daerah - $revisi_kurang_daerah;
        $total_anggaran = $pagu_revisi_pusat + $pagu_revisi_daerah;

        $total_realisasi = $query->sum('realisasi');
        $total_realisasi_pusat = $query->where('kode_dipa', 'DIPPUS')->sum('realisasi');
        $total_realisasi_daerah = $query->where('kode_dipa', 'DIPDAR')->sum('realisasi');

        $sisa_anggaran = $total_anggaran - $total_realisasi;
        $sisa_anggaran_pusat = $total_pagu_awal_pusat - $total_realisasi_pusat;
        $sisa_anggaran_daerah = $total_pagu_awal_daerah - $total_realisasi_daerah;

        return $data = [
            'periode_anggaran' => $year,
            'total_anggaran' => "Rp" . number_format($total_anggaran, 0, ',', '.'),
            'total_pagu_awal_pusat' => "Rp" . number_format($total_pagu_awal_pusat, 0, ',', '.'),
            'total_pagu_awal_daerah' => "Rp" . number_format($total_pagu_awal_daerah, 0, ',', '.'),
            'total_realisasi' => "Rp" . number_format($total_realisasi, 0, ',', '.'),
            'total_realisasi_pusat' => "Rp" . number_format($total_realisasi_pusat, 0, ',', '.'),
            'total_realisasi_daerah' => "Rp" . number_format($total_realisasi_daerah, 0, ',', '.'),
            'sisa_anggaran' => "Rp" . number_format($sisa_anggaran, 0, ',', '.'),
            'sisa_anggaran_pusat' => "Rp" . number_format($sisa_anggaran_pusat, 0, ',', '.'),
            'sisa_anggaran_daerah' => "Rp" . number_format($sisa_anggaran_daerah, 0, ',', '.'),
            'pagu_revisi_pusat' => "Rp" . number_format($pagu_revisi_pusat, 0, ',', '.'),
            'pagu_revisi_daerah' => "Rp" . number_format($pagu_revisi_daerah, 0, ',', '.')
        ];
    }

    public function pagu_realisasi_per_bidang(Request $request)
    {
        $bidang = Bidang::withSum(
            ['uraian' => function (Builder $query) use ($request) {
                $query->whereNotNull('kode_akun')->where('tahun_anggaran', $request->tahun);
            }],
            'pagu_awal'
        )
            ->withSum(
                ['realisasi' => function (Builder $query) use ($request) {
                    $query->whereNotNull('kode_akun')->where('tahun_anggaran', $request->tahun);
                }],
                'jumlah'
            )->get();

        $data = [];
        $label = [];
        foreach ($bidang as $k => $v) {
            $label[] = $v->kode_bidang;
            $data['Pagu Anggaran'][] = $v->uraian_sum_pagu_awal ?? 0;
            $data['Realisasi'][] = $v->realisasi_sum_jumlah ?? 0;
        }

        $series = [];

        foreach ($data as $k => $v) {
            $series[] = [
                'name' => $k,
                'data' => $v
            ];
        }

        $results = [
            'categories' => $label,
            'series' => $series
        ];

        return $results;
    }

    public function penyerapan_anggaran(Request $request)
    {
        $month = ['Januari', 'Februari', 'Marer', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $revisi = RevisiPagu::select(DB::raw('MONTH(revisi_pagu.updated_at) as bulan'), DB::raw('sum(tambah) as tambah'), DB::raw('sum(kurang) as kurang'))->join('uraian', 'uraian.id_uraian', 'revisi_pagu.id_uraian')
            ->where('tahun_anggaran', $request->tahun)
            ->groupBy('bulan')
            ->get();

        $realisasi = Realisasi::select(DB::raw('MONTH(tgl_realisasi) as bulan'), DB::raw('sum(jumlah) as total'))
            ->whereYear('tgl_realisasi', $request->tahun)
            ->groupBy('bulan')
            ->get();

        $total_pagu = Uraian::where('tahun_anggaran', $request->tahun)->whereNotNull('kode_akun')->sum('pagu_awal');

        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $r = $revisi->where('bulan', $i)->first();
            $tambah = $r->tambah ?? 0;
            $kurang = $r->kurang ?? 0;
            $data['Pagu Anggaran'][] = $total_pagu + $tambah - $kurang;
            $data['Realisasi'][] = $realisasi->where('bulan', ($i + 1))->first()->total ?? 0;
            $total_pagu = $total_pagu + $tambah - $kurang;
        }

        $series = [];

        foreach ($data as $k => $v) {
            $series[] = [
                'name' => $k,
                'data' => $v
            ];
        }

        $results = [
            'categories' => $month,
            'series' => $series
        ];

        return $results;
    }
}
