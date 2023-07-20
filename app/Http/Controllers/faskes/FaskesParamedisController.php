<?php

namespace App\Http\Controllers\faskes;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaskesParamedisRequest;
use App\Models\FaskesNakes;
use App\Models\JenisParamedis;
use App\Models\FaskesParamedis;
use App\Models\Paramedis;
use App\Models\PraktekP;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class FaskesParamedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'medis';
        $jenis_paramedis = JenisParamedis::get();
        return view('faskes.paramedis.index', compact('active_menu','jenis_paramedis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'medis';
        $id_faskes = Auth::user()->id_faskes;
        $matra = ['AD', 'AL', 'AU'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::where('id_rs', $id_faskes)->first();
        $jenis_paramedis = JenisParamedis::get();
        return view('faskes.paramedis.create', compact('active_menu', 'matra', 'jenjang', 'rumah_sakit', 'jenis_paramedis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaskesParamedisRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $paramedis = FaskesParamedis::create($request->validated());

                PraktekP::create([
                    'id_rs' => $request->id_rs,
                    'id_paramedis' => $paramedis->id_paramedis,
                    'status' => 'Menunggu Persetujuan'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Paramedis Created!',
                'url' => url('faskes/paramedis')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_paramedis)
    {
        $active_menu = 'medis';
        $id_faskes = Auth::user()->id_faskes;
        $matra = ['AD', 'AL', 'AU'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::where('id_rs', $id_faskes)->first();
        $jenis_paramedis = JenisParamedis::get();
        $paramedis = FaskesParamedis::with(['rumah_sakit' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($id_paramedis);

        // return Paramedis::find($id_paramedis)->rumah_sakit()->orderBy('created_at', 'desc')->first()->pivot->id_paramedis;

        return view('faskes.paramedis.create', compact('active_menu', 'matra', 'jenjang', 'rumah_sakit', 'jenis_paramedis', 'paramedis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaskesParamedisRequest $request, FaskesParamedis $paramedis)
    {
        try {
            DB::transaction(function () use ($request, $paramedis) {
                $paramedis->update($request->validated());

                $praktep_p = PraktekP::where(
                    'id_paramedis',
                    $paramedis->id_paramedis
                )->delete();

                PraktekP::create([
                    'id_rs' => $request->id_rs,
                    'id_paramedis' => $paramedis->id_paramedis,
                    'status' => 'Menunggu Persetujuan'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Paramedis Updated!',
                'url' => url('faskes/paramedis')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaskesParamedis $paramedis)
    {
        try {
            DB::transaction(function () use ($paramedis) {
                PraktekP::where(
                    'id_paramedis',
                    $paramedis->id_paramedis
                )->delete();

                $paramedis->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Paramedis Deleted!',
                'table' => '#paramedis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function list_filter(Request $request)
    {
        $id_faskes = Auth::user()->id_faskes;
        $requestData = $request->all();

        $paramedis = DB::table('paramedis')
        ->join('praktek_p', 'praktek_p.id_paramedis', '=', 'paramedis.id_paramedis')
        ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', '=', 'paramedis.id_jenis_paramedis')
        ->join('rs', 'rs.id_rs', '=', 'praktek_p.id_rs')
        ->select('nama_paramedis','paramedis.id_jenis_paramedis','matra','jenis_ijazah','jenjang',
        'praktek_p.id_paramedis','no_identitas','satuan_asal','pangkat','jabatan_struktural','jabatan_fungsional',
        'keterangan','klasifikasi','id_praktek_p','rs.id_rs','nama_jenis_paramedis','nama_rs','status')
        ->where('praktek_p.id_rs', '=', $id_faskes);

        $faskes_paramedis = DB::table('faskes_paramedis')
        ->join('praktek_p', 'praktek_p.id_paramedis', '=', 'faskes_paramedis.id_paramedis')
        ->join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', '=', 'faskes_paramedis.id_jenis_paramedis')
        ->join('rs', 'rs.id_rs', '=', 'praktek_p.id_rs')
        ->select('nama_paramedis','faskes_paramedis.id_jenis_paramedis','matra','jenis_ijazah','jenjang',
        'praktek_p.id_paramedis','no_identitas','satuan_asal','pangkat','jabatan_struktural','jabatan_fungsional',
        'keterangan','klasifikasi','id_praktek_p','rs.id_rs','nama_jenis_paramedis','nama_rs','status')
        ->where('praktek_p.id_rs', '=', $id_faskes);

        if ($requestData['matra'] != "Semua") {
            if($requestData['matra'] == "Null"){
                $paramedis->whereNull('paramedis.matra');
                $faskes_paramedis->whereNull('faskes_paramedis.matra');
            }else{
                $paramedis->where('paramedis.matra', '=', $requestData['matra']);
                $faskes_paramedis->where('faskes_paramedis.matra', '=', $requestData['matra']);
            }
        }

        if ($requestData['id_jenis_paramedis'] != "Semua") {
            $paramedis->where('paramedis.id_jenis_paramedis', '=', $requestData['id_jenis_paramedis']);
            $faskes_paramedis->where('faskes_paramedis.id_jenis_paramedis', '=', $requestData['id_jenis_paramedis']);
        }

        return DataTables::of($faskes_paramedis->union($paramedis)->get())
            ->addColumn('jenis_paramedis', function ($row) {
                return "<div class='text-center'>" . $row->nama_jenis_paramedis . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
             })
            ->addColumn('sebaran', function ($row) {
                $nama_rs = $row->nama_rs;
                return $nama_rs;
            })
            ->addColumn('jenis_ijazah', function ($row) {
                $jenis_ijazah = $row->jenis_ijazah;
                return $jenis_ijazah;
            })
            ->addColumn('nama_paramedis', function ($row) {
                $nama_paramedis = $row->nama_paramedis;
                return $nama_paramedis;
            })
            ->addColumn('matra', function ($row) {
                $matra = $row->matra ?? '-';
                return $matra;
            })
            ->addColumn('pangkat', function ($row) {
                $pangkat = $row->pangkat ?? '-';
                return "<div class='text-center'> " . $pangkat . " <br> " . $row->no_identitas . " </div>";    
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
            ->addColumn('action', function ($row) {
                if ($row->status =='Disetujui') {
                    return "<div class='text-center'> " . "-" . " </div>";    
                } else {
                    return "<div class='text-center'><a href='" . route('faskes.paramedis.edit', $row->id_paramedis) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_paramedis . "' data-url='" . url('faskes/paramedis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
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
            ->rawColumns(['jenis_paramedis', 'action', 'id_spesialis', 'pangkat','status'])
            ->toJson();
    }
}
