<?php

namespace App\Http\Controllers\matfaskes\kegiatan;

use App\Http\Controllers\Controller;
use App\Models\BaHibah;
use App\Models\DetailBrgMatkesM;
use App\Models\InTktm;
use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $active_menu = 'dashboard_kegiatan';

        $tahun = date('Y');
        if ($request->q) $tahun = $request->q;

        $count_kontrak = $this->count_kontrak($tahun);
        $count_tktm = $this->count_tktm($tahun);
        $count_hibah = $this->count_hibah($tahun);

        $daftar_alkes_bekkes = [
            'nominal' => [
                'alkes' => $count_hibah['nominal']['alkes'] + $count_tktm['nominal']['alkes'] + $count_kontrak['nominal']['alkes'],
                'bekkes' => $count_hibah['nominal']['bekkes'] + $count_tktm['nominal']['bekkes'] + $count_kontrak['nominal']['bekkes']
            ],
            'jumlah' => [
                'alkes' => $count_hibah['jumlah_hibah']['alkes'] + $count_kontrak['jumlah_kontrak']['alkes'] + $count_tktm['jumlah_tktm']['alkes'],
                'bekkes' => $count_hibah['jumlah_hibah']['bekkes'] + $count_kontrak['jumlah_kontrak']['bekkes'] + $count_tktm['jumlah_tktm']['bekkes']
            ]
        ];

        return view('matfaskes.kegiatan.dashboard_kegiatan', compact(
            'active_menu',
            'count_kontrak',
            'count_tktm',
            'count_hibah',
            'daftar_alkes_bekkes',
            'tahun'
        ));
    }

    public function count_kontrak($tahun)
    {
        $detail_brg = DetailBrgMatkesM::with('kontrak')
            // ->has('kontrak')
            ->whereHas('kontrak', function (Builder $query) use ($tahun) {
                $query->whereYear('tgl_kontrak', $tahun);
            })
            ->get();

        $nominal_alkes = $detail_brg->where('kontrak.kode_kontrak', 'A')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });
        $nominal_bekkes = $detail_brg->where('kontrak.kode_kontrak', 'P')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });

        $jumlah_alkes = $detail_brg->where('kontrak.kode_kontrak', 'A')->sum('jumlah');
        $jumlah_bekkes = $detail_brg->where('kontrak.kode_kontrak', 'P')->sum('jumlah');

        $data = [
            'jenis_barang' => [
                'Bekkes' => $detail_brg->where('kontrak.kode_kontrak', 'P')->count(),
                'Alkes' => $detail_brg->where('kontrak.kode_kontrak', 'A')->count(),
            ],
            'kewenangan' => [
                'Daerah' => $detail_brg->where('kontrak.kode_dipa', 'DIPDAR')->count(),
                'Pusat' => $detail_brg->where('kontrak.kode_dipa', 'DIPPUS')->count(),
            ],
            'bar_chart_kewenangan' => [
                [
                    'label' => 'Pusat',
                    'value' => $detail_brg->where('kontrak.kode_dipa', 'DIPPUS')->count()
                ],
                [
                    'label' => 'Daerah',
                    'value' => $detail_brg->where('kontrak.kode_dipa', 'DIPDAR')->count()
                ]
            ],
            'nominal' => [
                'alkes' => $nominal_alkes,
                'bekkes' => $nominal_bekkes,
                // 'total' => $nominal_alkes + $nominal_bekkes
                'total' => Kontrak::sum('nominal_kontrak')
            ],
            'jumlah_kontrak' => [
                'alkes' => $jumlah_alkes,
                'bekkes' => $jumlah_bekkes
            ],
            'bar_chart_jenis_barang' => [
                [
                    'label' => 'Alkes',
                    'value' => $detail_brg->where('kontrak.kode_kontrak', 'A')->count()
                ],
                [
                    'label' => 'Bekkes',
                    'value' => $detail_brg->where('kontrak.kode_kontrak', 'P')->count()
                ]
            ],
        ];
        return $data;
    }

    public function count_tktm($tahun)
    {
        $detail_brg = DetailBrgMatkesM::with('tktm')
            // ->has('tktm')
            ->whereHas('tktm', function (Builder $query) use ($tahun) {
                $query->whereYear('tgl_kontrak_tktm', $tahun);
            })
            ->get();
        $in_tktm = InTktm::whereYear('tgl_kontrak_tktm', $tahun)->get();

        $nominal_alkes = $detail_brg->where('tktm.jenis_tktm', 'aset')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });
        $nominal_bekkes = $detail_brg->where('tktm.jenis_tktm', 'persediaan')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });

        $jumlah_alkes = $detail_brg->where('tktm.jenis_tktm', 'aset')->sum('jumlah');
        $jumlah_bekkes = $detail_brg->where('tktm.jenis_tktm', 'persediaan')->sum('jumlah');

        $data = [
            'jenis_barang' => [
                'Bekkes' => $in_tktm->where('jenis_tktm', 'persediaan')->count(),
                'Alkes' => $in_tktm->where('jenis_tktm', 'aset')->count(),
            ],
            'nominal' => [
                'alkes' => $nominal_alkes,
                'bekkes' => $nominal_bekkes,
                // 'total' => $nominal_alkes + $nominal_bekkes
                'total' => $in_tktm->sum('nominal')
            ],
            'jumlah_tktm' => [
                'alkes' => $jumlah_alkes,
                'bekkes' => $jumlah_bekkes,
            ],
            'bar_chart' => [
                [
                    'label' => 'Alkes',
                    'value' => $in_tktm->where('jenis_tktm', 'aset')->count()
                ],
                [
                    'label' => 'Bekkes',
                    'value' => $in_tktm->where('jenis_tktm', 'persediaan')->count()
                ]
            ]
        ];
        return $data;
    }

    public function count_hibah($tahun)
    {
        $detail_brg = DetailBrgMatkesM::with('hibah')
            // ->has('hibah')
            ->whereHas('hibah', function (Builder $query) use ($tahun) {
                $query->whereYear('tgl_ba_hibah', $tahun);
            })
            ->get();
        $ba_hibah = BaHibah::whereYear('tgl_ba_hibah', $tahun)->get();

        $nominal_alkes = $detail_brg->where('hibah.kode_ba_hibah', 'A')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });
        $nominal_bekkes = $detail_brg->where('hibah.kode_ba_hibah', 'P')->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });

        $jumlah_alkes = $detail_brg->where('hibah.kode_ba_hibah', 'A')->sum('jumlah');
        $jumlah_bekkes = $detail_brg->where('hibah.kode_ba_hibah', 'P')->sum('jumlah');

        $data = [
            'jenis_barang' => [
                'Bekkes' => $ba_hibah->where('kode_ba_hibah', 'P')->count(),
                'Alkes' => $ba_hibah->where('kode_ba_hibah', 'A')->count(),
            ],
            'nominal' => [
                'alkes' => $nominal_alkes,
                'bekkes' => $nominal_bekkes,
                'total' => $ba_hibah->sum('nominal')
            ],
            'jumlah_hibah' => [
                'alkes' => $jumlah_alkes,
                'bekkes' => $jumlah_bekkes,
            ],
            'bar_chart' => [
                [
                    'label' => 'Alkes',
                    'value' => $ba_hibah->where('kode_ba_hibah', 'A')->count()
                ],
                [
                    'label' => 'Bekkes',
                    'value' => $ba_hibah->where('kode_ba_hibah', 'P')->count()
                ]
            ]
        ];
        return $data;
    }
}
