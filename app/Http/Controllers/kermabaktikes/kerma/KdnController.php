<?php

namespace App\Http\Controllers\kermabaktikes\kerma;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcaraKermaRequest;
use App\Models\AcaraKerma;
use App\Models\JenisKegiatan;
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

class KdnController extends Controller
{
    public function index()
    {
        $active_menu = 'kdn';
        $jenis_kegiatan = JenisKegiatan::select('id_jenis_keg', 'jenis_keg')->where('kategori_keg', 'kerma')->get();
        return view('kermabaktikes.kerma.dalam_negeri.index', compact('active_menu', 'jenis_kegiatan'));
    }

    public function create()
    {
        $active_menu = 'kdn';
        $kegiatan = Kegiatan::where('id_event', 4)->get();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $keterangan = Keterangan::get();
        $status = Status::get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.kerma.dalam_negeri.create', compact('active_menu', 'kegiatan', 'jenis_kegiatan', 'keterangan', 'status', 'locs'));
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
                'message' => 'KDN Created!',
                'url' => url('kerma/kdn')
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
        $acara_kerma = AcaraKerma::with('kegiatan', 'keterangan', 'status', 'jenis_kegiatan')->whereHas('kegiatan', function (Builder $query) {
            $query->where('id_event', 4);
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
                if (isset($query->file_laporan) && $query->file_laporan != '') {
                    return "<div class='mt-50'><a href='" . url('kerma/kdn/file_laporan/' . $query->file_laporan) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                }
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a title="Edit" href="' . route('kerma.kdn.edit', $query->id_kerma) . '"><i data-feather="edit" class="font-medium-4"></i></a><a title="Delete" type="button" data-id="' . $query->id_kerma . '" data-url="' . url('kerma/kdn') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns(['action', 'file_laporan'])
            ->toJson();
    }

    public function edit(AcaraKerma $kdn)
    {
        $active_menu = 'data_non_bilateral';
        $kegiatan = Kegiatan::where('id_event', 4)->get();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $keterangan = Keterangan::get();
        $status = Status::get();
        $kdn = $kdn->load('kegiatan');
        $lokasi_acara = LokasiAcara::where('id_kerma', $kdn->id_kerma)->get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.kerma.dalam_negeri.create', compact(
            'active_menu',
            'kegiatan',
            'jenis_kegiatan',
            'keterangan',
            'status',
            'kdn',
            'locs',
            'lokasi_acara'
        ));
    }

    public function update(AcaraKermaRequest $request, AcaraKerma $kdn)
    {
        try {
            $requestData = $request->validated();

            if ($request->file('file_laporan') != null) {
                $path = public_path('acara_kerma');
                if ($kdn->file_laporan != '' && $kdn->file_laporan != null && file_exists($path . '/' . $kdn->file_laporan)) {
                    unlink($path . '/' . $kdn->file_laporan);
                }
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }

            DB::transaction(function () use ($request, $requestData, $kdn) {
                $kdn->update($requestData);
                LokasiAcara::where('id_kerma', $kdn->id_kerma)->delete();
                if (isset($request->lokasi_acara)) {
                    foreach ($request->lokasi_acara as $k => $v) {
                        LokasiAcara::create([
                            'id_kerma' => $kdn->id_kerma,
                            'nama_tempat' => $v['nama_tempat'],
                            'latitude' => $v['latitude'],
                            'longitude' => $v['longitude']
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'KDN Updated!',
                'url' => url('kerma/kdn')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(AcaraKerma $kdn)
    {
        try {
            $path = public_path('acara_kerma');
            if ($kdn->file_laporan != '' && $kdn->file_laporan != null && file_exists($path . '/' . $kdn->file_laporan)) {
                unlink($path . '/' . $kdn->file_laporan);
            }

            $kdn->delete();
            return response()->json([
                'error' => false,
                'message' => 'KDN Deleted!',
                'table' => '#kdn-table'
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
        $active_menu = 'dashboard_kdn';
        $years = [
            date("Y", strtotime("-1 year")),
            date("Y"),
            date("Y", strtotime("+1 year"))
        ];
        $kegiatan = Kegiatan::where('id_event', 4)->get();
        $acara_kerma = AcaraKerma::get();

        $data = array();
        $categories = [];
        $series = [];

        foreach ($kegiatan as $key => $value) {
            $categories[] = $value->nama_kegiatan;
            foreach ($years as $k => $v) {
                $data[$v][] = $acara_kerma->where('id_kegiatan', $value->id_kegiatan)->where('periode', $v)->count();
            }
        }

        foreach ($data as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => $value
            ];
        }

        return view('kermabaktikes.kerma.dalam_negeri.dashboard_kdn', compact('active_menu', 'categories', 'series'));
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
