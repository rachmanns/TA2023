<?php

namespace App\Http\Controllers\kermabaktikes\kerma;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcaraKermaRequest;
use App\Models\AcaraKerma;
use App\Models\JenisKegiatan;
use App\Models\JenisKerma;
use App\Models\Kegiatan;
use App\Models\Keterangan;
use App\Models\LokasiAcara;
use App\Models\PosSatgas;
use App\Models\RumahSakit;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BilateralController extends Controller
{
    public function index()
    {
        $active_menu = 'data_bilateral';
        $jenis_kegiatan = JenisKegiatan::select('id_jenis_keg', 'jenis_keg')->where('kategori_keg', 'kerma')->get();
        return view('kermabaktikes.kerma.luar_negeri.bilateral.index', compact('active_menu', 'jenis_kegiatan'));
    }

    public function create()
    {
        $active_menu = 'data_bilateral';
        $keterangan = Keterangan::get();
        $status = Status::get();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.kerma.luar_negeri.bilateral.create', compact('active_menu', 'keterangan', 'status', 'jenis_kegiatan', 'locs'));
    }

    public function get_kegiatan($id_event)
    {
        $kegiatan = Kegiatan::where('id_event', $id_event)->get();
        $data = [];
        $data[] = ['id' => '', 'text' => "Pilih Kegiatan"];
        foreach ($kegiatan as $key => $value) {
            $data[] = ['id' => $value->id_kegiatan, 'text' => $value->nama_kegiatan];
        }
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function store(AcaraKermaRequest $request)
    {
        try {
            $requestData = $request->validated();

            if ($request->has('file_laporan')) {
                $path = public_path('acara_kerma');
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }
            // $requestData['periode'] = date('Y', strtotime($request->tgl_pelaksanaan));

            DB::transaction(function () use ($request, $requestData) {
                $acara_kerma = AcaraKerma::create($requestData);
                if ($request->lokasi_acara) {
                    foreach ($request->lokasi_acara as $k => $v) {
                        LokasiAcara::create([
                            'id_kerma' => $acara_kerma->id_kerma,
                            'nama_tempat' => $v['nama_tempat'],
                            'latitude' => $v['latitude'],
                            'longitude' => $v['longitude']
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Bilateral Created!',
                'url' => url('kerma/bilateral')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        $acara_kerma = AcaraKerma::with('kegiatan', 'keterangan', 'status', 'jenis_kegiatan')->whereHas('kegiatan', function (Builder $query) use ($request) {
            $query->where('id_event', $request->id_event);
        })
            ->when($request->id_jenis_keg, function ($query) use ($request) {
                return $query->where('id_jenis_keg', $request->id_jenis_keg);
            })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->where('periode', $request->tahun);
            })
            ->get();

        return DataTables::of($acara_kerma)
            ->addIndexColumn()
            ->addColumn('file_laporan', function ($query) {
                if ($query->file_laporan != null)
                    return "<div class='mt-50'><a href='" . url('kerma/bilateral/file_laporan/' . $query->file_laporan) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a title="Edit" href="' . route('kerma.bilateral.edit', $query->id_kerma) . '"><i data-feather="edit" class="font-medium-4"></i></a><a title="Delete" type="button" data-id="' . $query->id_kerma . '" data-url="' . url('kerma/bilateral') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns(['action', 'file_laporan'])
            ->toJson();
    }

    public function edit(AcaraKerma $bilateral)
    {
        $active_menu = 'data_bilateral';
        $keterangan = Keterangan::get();
        $status = Status::get();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $bilateral = $bilateral->load('kegiatan');
        $lokasi_acara = LokasiAcara::where('id_kerma', $bilateral->id_kerma)->get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.kerma.luar_negeri.bilateral.create', compact(
            'active_menu',
            'keterangan',
            'status',
            'jenis_kegiatan',
            'bilateral',
            'locs',
            'lokasi_acara'
        ));
    }

    public function update(AcaraKermaRequest $request, AcaraKerma $bilateral)
    {
        try {
            $requestData = $request->validated();
            // $requestData['periode'] = date('Y', strtotime($request->tgl_pelaksanaan));

            if ($request->file('file_laporan') != null) {
                $path = public_path('acara_kerma');
                if (file_exists($path . '/' . $bilateral->file_laporan) && $bilateral->file_laporan != "") unlink($path . '/' . $bilateral->file_laporan);
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }


            DB::transaction(function () use ($request, $requestData, $bilateral) {
                $bilateral->update($requestData);
                LokasiAcara::where('id_kerma', $bilateral->id_kerma)->delete();

                if ($request->lokasi_acara) {
                    foreach ($request->lokasi_acara as $k => $v) {
                        LokasiAcara::create([
                            'id_kerma' => $bilateral->id_kerma,
                            'nama_tempat' => $v['nama_tempat'],
                            'latitude' => $v['latitude'],
                            'longitude' => $v['longitude']
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Bilateral Updated!',
                'url' => url('kerma/bilateral')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(AcaraKerma $bilateral)
    {
        try {
            $bilateral = $bilateral->load('kegiatan');
            $id_event = $bilateral->kegiatan->id_event;
            $table = 'thainesia';
            if ($id_event == 1) $table = 'usibdd';

            if ($bilateral->file_laporan != '' || $bilateral->file_laporan != null) {
                $path = public_path('acara_kerma');
                unlink($path . '/' . $bilateral->file_laporan);
            }

            $bilateral->delete();
            return response()->json([
                'error' => false,
                'message' => 'Bilateral Deleted!',
                'table' => '#' . $table . '-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function dashboard()
    {
        $active_menu = 'dashboard_bilateral';
        $bar_usibdd = $this->bar_chart(1);
        $bar_thainesia =  $this->bar_chart(2);
        $usibdd = $this->pie_chart(1);
        $thainesia = $this->pie_chart(2);
        $kegiatan_akan_datang = $this->kegiatan_akan_datang();

        return view('kermabaktikes.kerma.luar_negeri.dashboard_bilateral', compact('active_menu', 'usibdd', 'thainesia', 'bar_usibdd', 'bar_thainesia', 'kegiatan_akan_datang'));
    }

    public function pie_chart($id_event)
    {

        $acara_kerma = AcaraKerma::join('jenis_kegiatan', 'acara_kerma.id_jenis_keg', '=', 'jenis_kegiatan.id_jenis_keg')
            ->join('kegiatan', 'acara_kerma.id_kegiatan', '=', 'kegiatan.id_kegiatan')
            ->select('jenis_kegiatan.jenis_keg', DB::raw('count(acara_kerma.id_kerma) as total'))
            ->where('id_event', $id_event)
            ->where('acara_kerma.periode', date('Y'))
            ->groupBy('jenis_kegiatan.jenis_keg')->get();

        $data = [];

        // foreach ($acara_kerma as $key => $value) {
        //     $data['labels'][] = $value->jenis_keg;
        //     $data['series'][] = $value->total;
        // }
        foreach ($acara_kerma as $key => $value) {
            $data['categories'][] = $value->jenis_keg;
            $data['series'][] = [
                'name' => $value->jenis_keg,
                'data' => [$value->total]
            ];
        }
        return $data;
    }

    public function bar_chart($id_event)
    {
        $acara_kerma = AcaraKerma::with('kegiatan')->get();
        $kegiatan = AcaraKerma::select('acara_kerma.id_kegiatan', 'kegiatan.nama_kegiatan')->join('kegiatan', 'kegiatan.id_kegiatan', '=', 'acara_kerma.id_kegiatan')->where('kegiatan.id_event', $id_event)->distinct('acara_kerma.id_kegiatan')->get();
        // $kegiatan = Kegiatan::where('id_event', $id_event)->get();
        // return $kegiatan;
        // $year = date('Y');
        $years = [
            date("Y", strtotime("-3 year")),
            date("Y", strtotime("-2 year")),
            date("Y", strtotime("-1 year")),
            date("Y"),
            date("Y", strtotime("+1 year")),
        ];

        $data = [];
        $series = [];

        foreach ($kegiatan as $key => $value) {
            foreach ($years as $k => $v) {
                $data[$v][] = $acara_kerma->where('periode', $v)->where('id_kegiatan', $value->id_kegiatan)->count();
            }
        }

        foreach ($data as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => $value
            ];
        }

        $results = [
            'categories' => $kegiatan->pluck('nama_kegiatan'),
            'series' => $series
        ];
        return $results;
    }

    public function detail_dashboard(Request $request)
    {
        $data = json_decode($request->collection);

        $nama_event = $data->nama_event;
        $nama_kegiatan = $data->nama_kegiatan;
        $tahun = $data->tahun;

        $active_menu = 'dashboard_bilateral';

        if ($nama_event == 'usibdd') $id_event = 1;
        else if ($nama_event == 'thainesia') $id_event = 2;

        $kegiatan = Kegiatan::where('nama_kegiatan', $nama_kegiatan)->firstOrFail();

        $detail_bar_chart = $this->detail_bar_chart($kegiatan->id_kegiatan, $tahun);

        $detail_donut_chart = $this->detail_donut_chart($kegiatan, $id_event, $tahun);

        return view('kermabaktikes.kerma.luar_negeri.detail_usibdd', compact('active_menu', 'nama_kegiatan', 'detail_bar_chart', 'nama_event', 'detail_donut_chart', 'tahun'));
    }

    public function detail_bar_chart($id_kegiatan, $tahun)
    {

        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $acara_kerma = AcaraKerma::get();

        $data = array();
        $categories = [];
        $series = [];

        foreach ($jenis_kegiatan as $key => $value) {
            $categories[] = $value->jenis_keg;
            $data[$tahun][] = $acara_kerma->where('id_jenis_keg', $value->id_jenis_keg)->where('periode', $tahun)->where('id_kegiatan', $id_kegiatan)->count();
        }

        foreach ($data as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => $value
            ];
        }

        return $results = [
            'categories' => $categories,
            'series' => $series
        ];
    }

    public function detail_donut_chart($kegiatan, $id_event, $tahun)
    {
        $data = [];
        $data[] = [
            'id' => $kegiatan->id_kegiatan,
            'parent' => '',
            'name' => $kegiatan->nama_kegiatan
        ];

        $keterangan = Keterangan::get();
        $acara_kerma = AcaraKerma::with('jenis_kegiatan')->whereHas('kegiatan', function (Builder $query) use ($id_event, $kegiatan) {
            $query->where('id_event', $id_event)->where('id_kegiatan', $kegiatan->id_kegiatan);
        })->where('periode', $tahun)->get();

        $jenis_kegiatan = $acara_kerma->unique('id_jenis_keg');

        foreach ($jenis_kegiatan as $key => $value) {
            $data[] = [
                'id' => $value->id_jenis_keg,
                'parent' => $kegiatan->id_kegiatan,
                'name' => $value->jenis_kegiatan->jenis_keg
            ];

            foreach ($keterangan as $k => $v) {
                $data[] = [
                    'id' => $v->id_keterangan,
                    'parent' => $value->id_jenis_keg,
                    'name' => $v->keterangan,
                    'value' => $acara_kerma->where('id_jenis_keg', $value->id_jenis_keg)->where('periode', $tahun)->where('id_keterangan', $v->id_keterangan)->count()
                ];
            }
        }
        return $data;
    }

    public function jadwal_bilateral(Request $request)
    {
        $data = [];

        $acara_kerma = AcaraKerma::with('kegiatan', 'jenis_kegiatan')->whereHas('kegiatan.event', function (Builder $query) {
            $query->where('id_jenis_kerma', JenisKerma::BILATERAL_LN);
        })->whereBetween('tgl_pelaksanaan', [$request->start, $request->end])->get();

        if ($acara_kerma->isEmpty()) return $data;

        foreach ($acara_kerma as $key => $value) {
            $data[] = [
                'id' => $value->id_kerma,
                'title' => '<div class="bg-light-success rounded"><span class="text-white font-weight-bolder font-small-4">' . $value->kegiatan->nama_kegiatan . '</span><p class="mb-0 text-white font-small-2">' . $value->jenis_kegiatan->jenis_keg . '</p></div>',
                'start' => $value->tgl_pelaksanaan,
                'end' => $value->tgl_pelaksanaan
            ];
        }

        return $data;
    }

    public function kegiatan_akan_datang()
    {
        $year = date('Y');
        $month = date('m');
        $data = [];

        $acara_kerma = AcaraKerma::with('kegiatan', 'jenis_kegiatan', 'keterangan')->whereHas('kegiatan.event', function (Builder $query) {
            $query->where('id_jenis_kerma', JenisKerma::BILATERAL_LN);
        })->whereYear('tgl_pelaksanaan', '>=', $year)->whereMonth('tgl_pelaksanaan', '>', $month)->get();

        foreach ($acara_kerma as $key => $value) {
            $data[] = [
                'tgl_pelaksanaan' => $value->tgl_pelaksanaan,
                'nama_kegiatan' => $value->kegiatan->nama_kegiatan,
                'jenis_keg' => $value->jenis_kegiatan->jenis_keg,
                'nama_acara' => $value->nama_acara,
                'tempat' => $value->tempat,
                'keterangan' => $value->keterangan->keterangan
            ];
        }

        return $data;
    }

    public function file_laporan($file_laporan)
    {
        $pathToFile = public_path('acara_kerma') . '/' . $file_laporan;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}
