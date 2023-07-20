<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\DokterRequest;
use App\Models\Dokter;
use App\Models\JenisSpesialis;
use App\Models\KategoriDokter;
use App\Models\Patubel;
use App\Models\PraktekD;
use App\Models\RumahSakit;
use App\Models\SpesialisDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TenagaMedisController extends Controller
{
    public function index()
    {
        $active_menu = 'tenaga_medis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI', 'Lainnya'];
        $jenis_spesialis = JenisSpesialis::select('id_spesialis', 'nama_spesialis')->whereNotIn('id_kategori_dokter', [1, 3])->get();
        $kategori_dokter = KategoriDokter::select('id_kategori_dokter', 'nama_kategori')->get();
        $rs = RumahSakit::select('id_rs', 'nama_rs')->get();

        return view('bangkes.subbid_sdm.tenaga_medis.index', compact(
            'active_menu',
            'matra',
            'jenis_spesialis',
            'kategori_dokter',
            'rs'
        ));
    }

    public function create()
    {
        $active_menu = 'tenaga_medis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::get();
        $kategori_dokter = KategoriDokter::get();
        return view('bangkes.subbid_sdm.tenaga_medis.create', compact('active_menu', 'matra', 'rumah_sakit', 'kategori_dokter', 'jenjang'));
    }

    public function store(DokterRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dokter = Dokter::create($request->validated());

                foreach ($request->id_spesialis as $key => $value) {
                    SpesialisDokter::create([
                        'id_spesialis' => $value,
                        'id_dokter' => $dokter->id_dokter
                    ]);
                }

                PraktekD::create([
                    'id_rs' => $request->id_rs,
                    'id_dokter' => $dokter->id_dokter,
                    'status' => 'Disetujui'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Tenaga Medis Created!',
                'url' => url('bangkes/tenaga-medis')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(DokterRequest $request, Dokter $dokter)
    {
        try {
            DB::transaction(function () use ($request, $dokter) {
                $dokter->update($request->validated());

                SpesialisDokter::where(
                    'id_dokter',
                    $dokter->id_dokter
                )->delete();

                foreach ($request->id_spesialis as $key => $value) {
                    SpesialisDokter::create([
                        'id_spesialis' => $value,
                        'id_dokter' => $dokter->id_dokter
                    ]);
                }

                $praktep_d = PraktekD::where(
                    'id_dokter',
                    $dokter->id_dokter
                )->delete();

                PraktekD::create([
                    'id_rs' => $request->id_rs,
                    'id_dokter' => $dokter->id_dokter,
                    'status' => 'Disetujui'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Tenaga Medis Updated!',
                'url' => url('bangkes/tenaga-medis')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function jenis_spesialis_list(Request $request)
    {
        $kota_kab = JenisSpesialis::where('id_kategori_dokter', $request->id_kategori_dokter)->get();
        $data = [];
        foreach ($kota_kab as $key => $value) {
            $data[] = ['id' => $value->id_spesialis, 'text' => $value->nama_spesialis];
        }
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function list(Request $request)
    {
        // $kategori_dokter = KategoriDokter::select('id_kategori_dokter', 'nama_kategori')->get();
        // $dokter = Dokter::with(['rumah_sakit' => function ($query) {
        //     $query->orderBy('created_at', 'desc');
        // }, 'jenis_spesialis'])
        //     ->when($request->matra, function ($query) use ($request) {
        //         if ($request->matra == 'Lainnya') {
        //             return $query->whereNull('matra');
        //         } else {
        //             return $query->where('matra', $request->matra);
        //         }
        //     })
        //     ->when($request->id_kategori_dokter, function ($query) use ($request) {
        //         return $query->whereHas('jenis_spesialis', function ($q) use ($request) {
        //             $q->where('id_kategori_dokter', $request->id_kategori_dokter);
        //         });
        //     })
        //     ->latest()->get();

        $dokter = DB::select(
            'SELECT
                MAX(pd.created_at),
                pd.id_rs,
                COUNT(pd.id_dokter),
                d.*,
                rs.nama_rs
            FROM
                dokter d
            LEFT JOIN praktek_d pd ON
                d.id_dokter = pd.id_dokter
            LEFT JOIN rs ON
                rs.id_rs = pd.id_rs
            GROUP BY
                d.id_dokter
            '
        );

        $id_dokter = array_column($dokter, 'id_dokter');
        $jenis_spesialis = SpesialisDokter::join('jenis_spesialis', 'jenis_spesialis.id_spesialis', '=', 'spesialis_dokter.id_spesialis')->join('kategori_dokter', 'jenis_spesialis.id_kategori_dokter', '=', 'kategori_dokter.id_kategori_dokter')->whereIn('id_dokter', $id_dokter)->get();


        $data_kd = [];
        $data_js = [];
        foreach ($jenis_spesialis as $k => $v) {
            $data_kd[$v->id_dokter] = $v->nama_kategori;
            $data_js[$v->id_dokter][] = $v->nama_spesialis;
        }

        $dokter = collect($dokter);

        //filter kategori
        if ($request->id_kategori_dokter) {
            $kat_dokter_filter = JenisSpesialis::select('id_dokter', 'spesialis_dokter.id_spesialis', 'id_kategori_dokter', DB::raw('MAX(spesialis_dokter.created_at)'))
                ->join('spesialis_dokter', 'spesialis_dokter.id_spesialis', '=', 'jenis_spesialis.id_spesialis')
                ->where('id_kategori_dokter', $request->id_kategori_dokter)
                ->groupBy('id_dokter')
                ->get()->pluck('id_dokter');

            $dokter = $dokter->whereIn('id_dokter', $kat_dokter_filter);
        }

        // filter matra
        if ($request->matra) {
            if ($request->matra == 'Lainnya') {
                $dokter = $dokter->whereNull('matra');
            } else {
                $dokter = $dokter->where('matra', $request->matra);
            }
        }

        // filter jenis spesialis
        if ($request->jenis_spesialis) {

            $filter_spesialis = SpesialisDokter::when($request->jenis_spesialis != 'Semua', function ($q) use ($request) {
                return $q->where('id_spesialis', $request->jenis_spesialis);
            })
                ->select('id_dokter')
                ->distinct()
                ->get()
                ->pluck('id_dokter');

            $dokter = $dokter->whereIn('id_dokter', $filter_spesialis);
        }

        // filter rumah sakit
        if ($request->id_rs) {
            $filter_rs = RumahSakit::select('id_rs', 'nama_rs')
                ->where('id_rs', $request->id_rs)
                ->first();
            $dokter = $dokter->where('id_rs', $filter_rs->id_rs);
        }

        return DataTables::of($dokter)
            ->addColumn('kategori_dokter', function ($row) use ($data_kd) {
                $nama_kategori = $data_kd[$row->id_dokter] ?? '--';

                return "<div class='text-center'>" . $nama_kategori . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
            })
            ->editColumn('id_spesialis', function ($row) use ($data_js) {
                $str = '';
                if (!empty($data_js[$row->id_dokter])) {
                    foreach ($data_js[$row->id_dokter] as $js) {
                        $str .= $js . '<br>';
                    }
                }
                return $str;
            })
            ->addColumn('pangkat_korps', function ($row) {
                $pangkat_korps = $row->pangkat_korps ?? '-';
                return "<div class='text-center'> " . $pangkat_korps . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.tenaga-medis.edit', $row->id_dokter) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_dokter . "' data-url='" . url('bangkes/tenaga-medis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->addColumn('sebaran', function ($row) {
                return $row->nama_rs;
            })
            ->rawColumns(['kategori_dokter', 'action', 'id_spesialis', 'pangkat_korps', 'sebaran'])
            ->toJson();
    }

    public function edit(Dokter $dokter)
    {
        $active_menu = 'tenaga_medis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::get();
        $kategori_dokter = KategoriDokter::get();

        $dokter = $dokter->load('jenis_spesialis');

        $id_rs = $dokter->rumah_sakit()->orderBy('created_at', 'desc')->first()->id_rs ?? null;

        $id_kategori_dokter = $dokter->jenis_spesialis->first()->id_kategori_dokter ?? null;

        $selected_spesialis = $dokter->jenis_spesialis()->get()->pluck('id_spesialis');

        return view('bangkes.subbid_sdm.tenaga_medis.create', compact('active_menu', 'matra', 'rumah_sakit', 'kategori_dokter', 'dokter', 'jenjang', 'id_rs', 'id_kategori_dokter', 'selected_spesialis'));
    }

    public function destroy(Dokter $dokter)
    {
        try {

            DB::transaction(function () use ($dokter) {

                PraktekD::where(
                    'id_dokter',
                    $dokter->id_dokter
                )->delete();

                Patubel::where(
                    'id_nakes',
                    $dokter->id_dokter
                )->delete();

                $dokter->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Tenaga Medis Deleted!',
                'table' => '#medis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function rekap_dokter()
    {

        $data = [
            'active_menu' => 'rekap_dokter',
            'matra' => ['AD', 'AL', 'AU', 'MABES TNI', 'Lainnya'],
            'jenis_spesialis' => JenisSpesialis::select('id_spesialis', 'nama_spesialis')->whereNotIn('id_kategori_dokter', [1, 3])->get(),
            'kategori_dokter' => KategoriDokter::select('id_kategori_dokter', 'nama_kategori')->get()
        ];
        return view('bangkes.subbid_sdm.rekap_dokter.index', $data);
    }

    public function rekap_dokter_get(Request $request)
    {
        $dokter = Dokter::leftjoin('spesialis_dokter', 'dokter.id_dokter', 'spesialis_dokter.id_dokter')
            ->leftjoin('jenis_spesialis', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
            ->leftjoin('kategori_dokter', 'jenis_spesialis.id_kategori_dokter', 'kategori_dokter.id_kategori_dokter')
            ->select(
                'dokter.id_dokter',
                'dokter.nama_dokter',
                'dokter.keterangan',
                'dokter.klasifikasi',
                'dokter.matra',
                'dokter.pangkat_korps',
                'dokter.satuan_asal',
                'dokter.jabatan_struktural',
                'dokter.jabatan_fungsional',
                'dokter.jenjang',
                'jenis_spesialis.id_spesialis',
                'kategori_dokter.id_kategori_dokter',
                'jenis_spesialis.nama_spesialis',
                'kategori_dokter.nama_kategori',
            );

        //filter kategori
        if ($request->id_kategori_dokter) {
            $dokter = $dokter->where('kategori_dokter.id_kategori_dokter', $request->id_kategori_dokter);
        }

        // filter matra
        if ($request->matra) {
            if ($request->matra == 'Lainnya') {
                $dokter = $dokter->whereNull('dokter.matra');
            } else {
                $dokter = $dokter->where('dokter.matra', $request->matra);
            }
        }

        // filter jenis spesialis
        if ($request->jenis_spesialis) {
            if ($request->jenis_spesialis != 'Semua') $dokter = $dokter->where('jenis_spesialis.id_spesialis', $request->jenis_spesialis);
        }

        $dokter = $dokter->get();

        return DataTables::of($dokter)
            ->addColumn('pangkat_korps', function ($row) {
                $pangkat_korps = $row->pangkat_korps ?? '-';
                return "<div class='text-center'> " . $pangkat_korps . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('kategori_dokter', function ($row) {
                return "<div class='text-center'>" . $row->nama_kategori . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
            })
            ->rawColumns(['kategori_dokter', 'pangkat_korps'])
            ->toJson();
    }
}
