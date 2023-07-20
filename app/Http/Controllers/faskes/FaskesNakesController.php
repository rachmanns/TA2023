<?php

namespace App\Http\Controllers\faskes;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaskesNakesRequest;
use App\Models\FaskesNakes;
use App\Models\Dokter;
use App\Models\JenisSpesialis;
use App\Models\KategoriDokter;
use App\Models\Matra;
use App\Models\PraktekD;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class FaskesNakesController extends Controller
{
    public function index()
    {
        $active_menu = 'tenaga';
        $jenis_spesialisasi = JenisSpesialis::get();
        return view('faskes.nakes.index', compact('active_menu','jenis_spesialisasi'));
    }

    public function create()
    {
        $active_menu = 'tenaga';
        $id_faskes = Auth::user()->id_faskes;
        $matra = ['AD', 'AL', 'AU'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::where('id_rs', $id_faskes)->first();
        $kategori_dokter = KategoriDokter::get();
        return view('faskes.nakes.create', compact('active_menu', 'matra', 'rumah_sakit', 'kategori_dokter', 'jenjang'));
    }

    public function store(FaskesNakesRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dokter = FaskesNakes::create($request->validated());

                PraktekD::create([
                    'id_rs' => $request->id_rs,
                    'id_dokter' => $dokter->id_dokter,
                    'status' => 'Menunggu Persetujuan'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Tenaga Medis Created!',
                'url' => url('faskes/tenaga-medis')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(FaskesNakesRequest $request, FaskesNakes $dokter)
    {
        try {
            DB::transaction(function () use ($request, $dokter) {
                $dokter->update($request->validated());

                $praktep_d = PraktekD::where(
                    'id_dokter',
                    $dokter->id_dokter
                )->delete();

                PraktekD::create([
                    'id_rs' => $request->id_rs,
                    'id_dokter' => $dokter->id_dokter,
                    'status' => 'Menunggu Persetujuan'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Tenaga Medis Updated!',
                'url' => url('faskes/tenaga-medis')
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
        $data[] = ['id' => '', 'text' => "Pilih Jenis Spesialis"];
        foreach ($kota_kab as $key => $value) {
            $data[] = ['id' => $value->id_spesialis, 'text' => $value->nama_spesialis];
        }
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function list_filter(Request $request)
    {
        $id_faskes = Auth::user()->id_faskes;
        $requestData = $request->all();

        $dokter = DB::table('dokter')
        ->join('praktek_d', 'praktek_d.id_dokter', '=', 'dokter.id_dokter')
        ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', '=', 'dokter.id_spesialis')
        ->join('rs', 'rs.id_rs', '=', 'praktek_d.id_rs')
        ->join('kategori_dokter', 'kategori_dokter.id_kategori_dokter', '=', 'jenis_spesialis.id_kategori_dokter')
        ->select('nama_dokter','dokter.id_spesialis','matra','jenjang',
        'praktek_d.id_dokter','no_identitas','satuan_asal','dokter.pangkat_korps','jabatan_struktural','jabatan_fungsional',
        'keterangan','klasifikasi','id_praktek_d','rs.id_rs','nama_spesialis','nama_rs','status','nama_kategori')
        ->where('praktek_d.id_rs', '=', $id_faskes);

        $faskes_nakes = DB::table('faskes_nakes')
        ->join('praktek_d', 'praktek_d.id_dokter', '=', 'faskes_nakes.id_dokter')
        ->join('jenis_spesialis', 'jenis_spesialis.id_spesialis', '=', 'faskes_nakes.id_spesialis')
        ->join('rs', 'rs.id_rs', '=', 'praktek_d.id_rs')
        ->join('kategori_dokter', 'kategori_dokter.id_kategori_dokter', '=', 'jenis_spesialis.id_kategori_dokter')
        ->select('nama_dokter','faskes_nakes.id_spesialis','matra','jenjang',
        'praktek_d.id_dokter','no_identitas','satuan_asal','faskes_nakes.pangkat_korps','jabatan_struktural','jabatan_fungsional',
        'keterangan','klasifikasi','id_praktek_d','rs.id_rs','nama_spesialis','nama_rs','status','nama_kategori')
        ->where('praktek_d.id_rs', '=', $id_faskes);
        // ->union($dokter)->get();
        // ->union($dokter)->get();

        if ($requestData['matra'] != "Semua") {
            if($requestData['matra'] == "Null"){
                $dokter->whereNull('dokter.matra');
                $faskes_nakes->whereNull('faskes_nakes.matra');
            }else{
                $dokter->where('dokter.matra', '=', $requestData['matra']);
                $faskes_nakes->where('faskes_nakes.matra', '=', $requestData['matra']);
            }
        }

        if ($requestData['id_spesialis'] != "Semua") {
            $dokter->where('dokter.id_spesialis', '=', $requestData['id_spesialis']);
            $faskes_nakes->where('faskes_nakes.id_spesialis', '=', $requestData['id_spesialis']);
        }

       return DataTables::of($faskes_nakes->union($dokter)->get())  
            ->addColumn('kategori_dokter', function ($row) {
                return "<div class='text-center'>" . $row->nama_kategori . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";           
            })
            ->addColumn('sebaran', function ($row) {
                $nama_rs = $row->nama_rs;
                return $nama_rs; 
            })
            // ->addColumn('jenis_ijazah', function ($row) {
            //     $jenis_ijazah = $row->jenis_ijazah;
            //     return $jenis_ijazah;
            // })
            ->addColumn('nama_dokter', function ($row) {
                $nama_dokter = $row->nama_dokter;
                return $nama_dokter; 
            })
            ->addColumn('matra', function ($row) {
                $matra = $row->matra ?? '-';
                return $matra;  
            })
            ->addColumn('jabatan_struktural', function ($row) {
                $jabatan_struktural = $row->jabatan_struktural;
                return $jabatan_struktural;
            })
            ->addColumn('jabatan_fungsional', function ($row) {
                $jabatan_fungsional = $row->jabatan_fungsional;
                return $jabatan_fungsional; 
            })
            ->addColumn('keterangan', function ($row) {
                $keterangan = $row->keterangan;
                return $keterangan;   
            })
            ->editColumn('id_spesialis', function ($row) {
                return $row->nama_spesialis;  
            })
            ->addColumn('pangkat_korps', function ($row) {
                $pangkat_korps = $row->pangkat_korps ?? '-';
                return "<div class='text-center'> " . $pangkat_korps . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('action', function ($row) {
                if ($row->status =='Disetujui') {
                    return "<div class='text-center'> " . "-" . " </div>";    
                } else {
                    return "<div class='text-center'><a href='" . route('faskes.tenaga-medis.edit', $row->id_dokter) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_dokter . "' data-url='" . url('faskes/tenaga-medis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";  
                }
            })
            ->addColumn('status', function ($row) {
                if ($row->status =='Disetujui') {
                    return "<div class='text-center'><div class='badge badge-light-success font-small-4 mt-50'>" . "Disetujui" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge badge-light-warning font-small-4 mt-50'>" . "Diajukan" . "</div></div>";
                }
            })
            ->addColumn('satuan_asal', function ($row) {
                $satuan_asal = $row->satuan_asal ?? '-';
                return $satuan_asal;  
            })
            ->rawColumns(['kategori_dokter', 'action', 'id_spesialis', 'pangkat_korps', 'sebaran','status'])
            ->toJson();
    }

    public function edit(FaskesNakes $dokter)
    {
        $active_menu = 'tenaga';
        $id_faskes = Auth::user()->id_faskes;
        $matra = ['AD', 'AL', 'AU'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::where('id_rs', $id_faskes)->first();
        $kategori_dokter = KategoriDokter::get();

        $dokter = $dokter->load('jenis_spesialis');

        $id_rs = $dokter->rumah_sakit()->orderBy('created_at', 'desc')->first()->id_rs;

        return view('faskes.nakes.create', compact('active_menu', 'matra', 'rumah_sakit', 'kategori_dokter', 'dokter', 'jenjang', 'id_rs'));
    }

    public function destroy(FaskesNakes $dokter)
    {
        try {

            DB::transaction(function () use ($dokter) {
                PraktekD::where(
                    'id_dokter',
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
}
