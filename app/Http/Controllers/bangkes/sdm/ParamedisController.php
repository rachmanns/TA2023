<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParamedisRequest;
use App\Models\JenisParamedis;
use App\Models\Paramedis;
use App\Models\Patubel;
use App\Models\PraktekP;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ParamedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'paramedis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI', 'Lainnya'];
        $jenis_paramedis = JenisParamedis::get();
        return view('bangkes.subbid_sdm.paramedis.index', compact('active_menu', 'matra', 'jenis_paramedis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'paramedis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::get();
        $jenis_paramedis = JenisParamedis::get();
        return view('bangkes.subbid_sdm.paramedis.create', compact('active_menu', 'matra', 'jenjang', 'rumah_sakit', 'jenis_paramedis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParamedisRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $paramedis = Paramedis::create($request->validated());

                PraktekP::create([
                    'id_rs' => $request->id_rs,
                    'id_paramedis' => $paramedis->id_paramedis,
                    'status' => 'Disetujui'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Paramedis Created!',
                'url' => url('bangkes/paramedis')
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
        $active_menu = 'paramedis';
        $matra = ['AD', 'AL', 'AU', 'MABES TNI'];
        $jenjang = ['D3', 'S1', 'S2', 'S3'];
        $rumah_sakit = RumahSakit::get();

        $jenis_paramedis = JenisParamedis::get();


        $paramedis = Paramedis::with(['rumah_sakit' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($id_paramedis);

        // return Paramedis::find($id_paramedis)->rumah_sakit()->orderBy('created_at', 'desc')->first()->pivot->id_paramedis;

        return view('bangkes.subbid_sdm.paramedis.create', compact('active_menu', 'matra', 'jenjang', 'rumah_sakit', 'jenis_paramedis', 'paramedis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParamedisRequest $request, Paramedis $paramedis)
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
                    'status' => 'Disetujui'
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Paramedis Created!',
                'url' => url('bangkes/paramedis')
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
    public function destroy(Paramedis $paramedis)
    {
        try {
            DB::transaction(function () use ($paramedis) {
                PraktekP::where(
                    'id_paramedis',
                    $paramedis->id_paramedis
                )->delete();

                Patubel::where(
                    'id_nakes',
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

    public function list(Request $request)
    {
        $paramedis = Paramedis::with(['rumah_sakit' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'jenis_paramedis'])
            ->when($request->matra, function ($query) use ($request) {
                if ($request->matra == 'Lainnya') {
                    return $query->whereNull('matra');
                } else {
                    return $query->where('matra', $request->matra);
                }
            })
            ->when($request->jenis_paramedis, function ($query) use ($request) {
                return $query->where('id_jenis_paramedis', $request->jenis_paramedis);
            })
            ->latest()
            ->get();
        return DataTables::of($paramedis)
            ->addColumn('jenis_paramedis', function ($row) {
                return "<div class='text-center'>" . $row->jenis_paramedis->nama_jenis_paramedis . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
            })
            ->addColumn('sebaran', function ($row) {
                if (isset($row->rumah_sakit->first()->nama_rs)) {
                    return $row->rumah_sakit->first()->nama_rs;
                }
                return '-';
            })
            ->addColumn('pangkat', function ($row) {
                $pangkat = $row->pangkat ?? '-';
                return "<div class='text-center'> " . $pangkat . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.paramedis.edit', $row->id_paramedis) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_paramedis . "' data-url='" . url('bangkes/paramedis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['jenis_paramedis', 'action', 'id_spesialis', 'pangkat'])
            ->toJson();
    }
}
