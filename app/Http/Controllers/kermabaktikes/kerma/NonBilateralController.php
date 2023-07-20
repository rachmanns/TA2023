<?php

namespace App\Http\Controllers\kermabaktikes\kerma;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcaraKermaRequest;
use App\Models\AcaraKerma;
use App\Models\Event;
use App\Models\JenisKegiatan;
use App\Models\JenisKerma;
use App\Models\Kegiatan;
use App\Models\Keterangan;
use App\Models\LokasiAcara;
use App\Models\PosSatgas;
use App\Models\RumahSakit;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NonBilateralController extends Controller
{
    public function index()
    {
        $active_menu = 'data_non_bilateral';
        $jenis_kegiatan = JenisKegiatan::select('id_jenis_keg', 'jenis_keg')->where('kategori_keg', 'kerma')->get();
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.index', compact('active_menu', 'jenis_kegiatan'));
    }

    public function create()
    {
        $active_menu = 'data_non_bilateral';
        $kegiatan = Kegiatan::where('id_event', 3)->get();
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
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.create', compact('active_menu', 'kegiatan', 'jenis_kegiatan', 'keterangan', 'status', 'locs'));
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
                'message' => 'Multilateral Created!',
                'url' => url('kerma/nonbilateral')
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
            $query->where('id_event', 3);
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
                if ($query->file_laporan) {
                    return "<div class='mt-50'><a href='" . url('kerma/nonbilateral/file_laporan/' . $query->file_laporan) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                }
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a title="Edit" href="' . route('kerma.nonbilateral.edit', $query->id_kerma) . '"><i data-feather="edit" class="font-medium-4"></i></a><a title="Delete" type="button" data-id="' . $query->id_kerma . '" data-url="' . url('kerma/nonbilateral') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns(['action', 'file_laporan'])
            ->toJson();
    }

    public function edit(AcaraKerma $nonbilateral)
    {
        $active_menu = 'data_non_bilateral';
        $kegiatan = Kegiatan::where('id_event', 3)->get();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $keterangan = Keterangan::get();
        $status = Status::get();
        $nonbilateral = $nonbilateral->load('kegiatan');
        $lokasi_acara = LokasiAcara::where('id_kerma', $nonbilateral->id_kerma)->get();
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS nama_tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS nama_tempat, latitude, longitude')->union($locs);
        $locs = LokasiAcara::selectRaw('DISTINCT UPPER(nama_tempat) AS nama_tempat, latitude, longitude')
            ->whereNotNull('nama_tempat')
            ->orWhere('nama_tempat', '<>', '')
            ->union($locs)
            ->orderBy('nama_tempat')
            ->get();
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.create', compact(
            'active_menu',
            'kegiatan',
            'jenis_kegiatan',
            'keterangan',
            'status',
            'nonbilateral',
            'locs',
            'lokasi_acara'
        ));
    }

    public function update(AcaraKermaRequest $request, AcaraKerma $nonbilateral)
    {
        try {
            $requestData = $request->validated();
            // $requestData['periode'] = date('Y', strtotime($request->tgl_pelaksanaan));
            if ($request->file('file_laporan') != null) {
                $path = public_path('acara_kerma');
                if (file_exists($path . '/' . $nonbilateral->file_laporan) && $nonbilateral->file_laporan != "") unlink($path . '/' . $nonbilateral->file_laporan);
                $file_laporan = $request->file('file_laporan');
                $file_laporan_name =  rand() . '.' . $request->file('file_laporan')->getClientOriginalExtension();
                $file_laporan->move($path, $file_laporan_name);
                $requestData['file_laporan'] = $file_laporan_name;
            }

            DB::transaction(function () use ($request, $requestData, $nonbilateral) {
                $nonbilateral->update($requestData);

                LokasiAcara::where('id_kerma', $nonbilateral->id_kerma)->delete();

                if ($request->lokasi_acara) {
                    foreach ($request->lokasi_acara as $k => $v) {
                        LokasiAcara::create([
                            'id_kerma' => $nonbilateral->id_kerma,
                            'nama_tempat' => $v['nama_tempat'],
                            'latitude' => $v['latitude'],
                            'longitude' => $v['longitude']
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Multilateral Updated!',
                'url' => url('kerma/nonbilateral')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(AcaraKerma $nonbilateral)
    {
        try {
            $nonbilateral->delete();
            return response()->json([
                'error' => false,
                'message' => 'Multilateral Deleted!',
                'table' => '#nonbilateral-table'
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
        $active_menu = 'dashboard_non_bilateral';

        $years = [
            date("Y", strtotime("-3 year")),
            date("Y", strtotime("-2 year")),
            date("Y", strtotime("-1 year")),
            date("Y"),
            date("Y", strtotime("+1 year"))
        ];
        $kegiatan = Kegiatan::where('id_event', 3)->get();
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

        $kegiatan_akan_datang = $this->kegiatan_akan_datang();

        return view('kermabaktikes.kerma.luar_negeri.dashboard_non_bilateral', compact('active_menu', 'series', 'categories', 'kegiatan_akan_datang'));
    }

    public function file_laporan($file_laporan)
    {
        $pathToFile = public_path('acara_kerma') . '/' . $file_laporan;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function detail_dashboard($tahun, $nama_kegiatan)
    {
        $nama_event = Event::where('id_event', 3)->first()->nama_event;
        $kegiatan = Kegiatan::select('id_kegiatan', 'nama_kegiatan')->where('nama_kegiatan', $nama_kegiatan)->first();
        $jenis_kegiatan = JenisKegiatan::where('kategori_keg', 'kerma')->get();
        $acara_kerma = AcaraKerma::get();

        $categories = [];
        $series = [];
        $data = [];

        foreach ($jenis_kegiatan as $key => $value) {
            $categories[] = $value->jenis_keg;
            $data[$tahun][] = $acara_kerma->where('id_kegiatan', $kegiatan->id_kegiatan)->where('id_jenis_keg', $value->id_jenis_keg)->where('periode', $tahun)->count();
        }

        foreach ($data as $key => $value) {
            $series[] = [
                'name' => $key,
                'data' => $value
            ];
        }

        return view('kermabaktikes.kerma.luar_negeri.detail_non_bilateral', compact('kegiatan', 'categories', 'series', 'nama_event'));
    }

    public function kegiatan_akan_datang()
    {
        $year = date('Y');
        $month = date('m');
        $data = [];

        $acara_kerma = AcaraKerma::with('kegiatan', 'jenis_kegiatan', 'keterangan')->whereHas('kegiatan.event', function (Builder $query) {
            $query->where('id_jenis_kerma', JenisKerma::NONBILATERAL_LN);
        })->whereYear('tgl_pelaksanaan', '>=', $year)->whereMonth('tgl_pelaksanaan', '>=', $month)->get();

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

    public function jadwal_nonbilateral(Request $request)
    {
        $data = [];

        $acara_kerma = AcaraKerma::with('kegiatan', 'jenis_kegiatan')->whereHas('kegiatan.event', function (Builder $query) {
            $query->where('id_jenis_kerma', JenisKerma::NONBILATERAL_LN);
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
}
