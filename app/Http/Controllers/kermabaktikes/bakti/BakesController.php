<?php

namespace App\Http\Controllers\kermabaktikes\bakti;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcaraBaktiRequest;
use App\Models\AcaraBakti;
use App\Models\JenisKegiatan;
use App\Models\Keterangan;
use App\Models\LokasiAcara;
use App\Models\PosSatgas;
use App\Models\RumahSakit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BakesController extends Controller
{
    public function index()
    {
        $active_menu = 'bakes';
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'bakti')->get();
        return view('kermabaktikes.bakti.bakes.index', compact('active_menu', 'jenis_kegiatan'));
    }

    public function create()
    {
        $active_menu = 'bakes';
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'bakti')->get();
        $keterangan = Keterangan::get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.bakti.bakes.create', compact('active_menu', 'jenis_kegiatan', 'keterangan', 'locs'));
    }

    public function store(AcaraBaktiRequest $request)
    {
        try {
            $requestData = $request->validated();

            if ($request->has('file_laporan')) {
                $path = public_path('acara_bakti');
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }
            $requestData['periode'] = $request->tgl_pelaksanaan;

            AcaraBakti::create($requestData);

            DB::transaction(function () use ($request, $requestData) {
                $acara_bakti = AcaraBakti::create($requestData);
                foreach ($request->lokasi_acara as $k => $v) {
                    LokasiAcara::create([
                        'id_kerma' => $acara_bakti->id_bakti,
                        'nama_tempat' => $v['nama_tempat'],
                        'latitude' => $v['latitude'],
                        'longitude' => $v['longitude']
                    ]);
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Bakti Created!',
                'url' => url('bakti/bakes')
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
        $acara_bakti = AcaraBakti::where('id_jenis_keg', $request->id_jenis_keg)->when($request->tahun, function ($query) use ($request) {
            return $query->where('periode', $request->tahun);
        })->get();
        return DataTables::of($acara_bakti)
            ->addIndexColumn()
            ->addColumn('file_laporan', function ($row) {
                if (!empty($row->file_laporan)) {
                    return "<div class='mt-50'><a href='" . url('bakti/bakes/file_laporan/' . $row->file_laporan) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                }
            })
            ->editColumn('tgl_pelaksanaan', function ($query) {
                $tgl_pelaksanaan = Carbon::parse($query->tgl_pelaksanaan)->locale('id')->isoFormat('DD MMMM YYYY');
                return $tgl_pelaksanaan;
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a title="Edit" href="' . route('bakti.bakes.edit', $query->id_bakti) . '"><i data-feather="edit" class="font-medium-4"></i></a><a title="Delete" type="button" data-id="' . $query->id_bakti . '" data-url="' . url('bakti/bakes') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns(['action', 'file_laporan'])
            ->toJson();
    }

    public function edit(AcaraBakti $bake)
    {
        $active_menu = 'bakes';
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'bakti')->get();
        $keterangan = Keterangan::get();
        $lokasi_acara = LokasiAcara::where('id_kerma', $bake->id_bakti)->get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();

        return view('kermabaktikes.bakti.bakes.create', compact(
            'active_menu',
            'jenis_kegiatan',
            'keterangan',
            'bake',
            'locs',
            'lokasi_acara'
        ));
    }

    public function update(AcaraBaktiRequest $request, AcaraBakti $bake)
    {
        try {
            $requestData = $request->validated();
            $requestData['periode'] = $request->tgl_pelaksanaan;
            if ($request->file('file_laporan') != null) {
                $path = public_path('acara_bakti');
                if (file_exists($path . '/' .  $bake->file_laporan) &&  $bake->file_laporan != "") unlink($path . '/' .  $bake->file_laporan);
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }

            DB::transaction(function () use ($request, $requestData, $bake) {
                $bake->update($requestData);
                LokasiAcara::where('id_kerma', $bake->id_bakti)->delete();
                if (isset($request->lokasi_acara)) {
                    foreach ($request->lokasi_acara as $k => $v) {
                        LokasiAcara::create([
                            'id_kerma' => $bake->id_bakti,
                            'nama_tempat' => $v['nama_tempat'],
                            'latitude' => $v['latitude'],
                            'longitude' => $v['longitude']
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Bakti Updated!',
                'url' => url('bakti/bakes')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(AcaraBakti $bake)
    {
        try {
            $id_jenis_keg = $bake->id_jenis_keg;

            if (!empty($bake->file_laporan)) {
                $path = public_path('acara_bakti');
                unlink($path . '/' . $bake->file_laporan);
            }

            DB::transaction(function () use ($bake) {
                LokasiAcara::where('id_kerma', $bake->id_bakti)->delete();
                $bake->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Bakti Deleted!',
                'table' => '#table-' . $id_jenis_keg
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
        $active_menu = 'dashboard_bakes';
        $years = [
            date("Y", strtotime("-1 year")),
            date("Y"),
            date("Y", strtotime("+1 year"))
        ];
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'bakti')->get();
        $acara_bakti = AcaraBakti::get();

        $data = [];
        $categories = [];
        $series = [];

        foreach ($jenis_kegiatan as $key => $value) {
            $categories[] = $value->jenis_keg;
            foreach ($years as $k => $v) {
                $data[$v][] = $acara_bakti->where('id_jenis_keg', $value->id_jenis_keg)->where('periode', $v)->count();
            }
        }

        foreach ($data as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => $value
            ];
        }

        return view('kermabaktikes.bakti.dashboard_bakes', compact('active_menu', 'categories', 'series'));
    }

    public function file_laporan($file_laporan)
    {
        $pathToFile = public_path('acara_bakti') . '/' . $file_laporan;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}
