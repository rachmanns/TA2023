<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KorpsRequest;
use App\Models\Korps;
use App\Models\Matra;
use App\Models\Personil;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KorpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'master_korps';
        $matra = Matra::where('kode_matra', '<>', 'TNI')->get();
        return view('bidum.master.korps.index', compact('matra', 'active_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KorpsRequest $request)
    {
        try {
            Korps::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Korps Created!',
                'modal' => '#create_korps',
                'table' => '#korps-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
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
    public function edit(Korps $korps)
    {
        return $korps;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KorpsRequest $request, Korps $korps)
    {
        try {
            $korps->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Korps Created!',
                'modal' => '#edit_korps',
                'table' => '#korps-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Korps $korps)
    {
        try {
            $personil = Personil::where('kode_korps', $korps->kode_korps)->first();

            if ($personil) throw new \Exception("Cannot delete this data, please check personil first.");

            $korps->delete();
            return response()->json([
                'error' => false,
                'message' => 'Korps Deleted!',
                'table' => '#korps-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list()
    {
        $korps = Korps::all();
        return DataTables::of($korps)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_korps . '" onclick="edit_korps($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_korps . '" data-url="' . url('master/korps/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
