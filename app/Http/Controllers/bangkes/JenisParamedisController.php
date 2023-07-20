<?php

namespace App\Http\Controllers\bangkes;

use App\Http\Controllers\Controller;
use App\Models\JenisParamedis;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisParamedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'jp';
        return view('bangkes.master_data.spesialis.jenis_paramedis.index', compact('active_menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $jenis_paramedis = JenisParamedis::get();
        return DataTables::of($jenis_paramedis)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_jenis_paramedis . '" onclick="edit_jenis_paramedis($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jenis_paramedis . '" data-url="' . url('bangkes/jenis-paramedis') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_jenis_paramedis' => 'required'
        ]);
        try {
            JenisParamedis::create($validateData);
            return response()->json([
                'error' => false,
                'message' => 'Jenis Paramedis Created!',
                'modal' => '#jp',
                'table' => '#jenis-paramedis'
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
    public function show(Jenisparamedis $jenis_paramedis)
    {
        return $jenis_paramedis;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisParamedis $jenis_paramedis)
    {
        $validateData = $request->validate([
            'nama_jenis_paramedis' => 'required'
        ]);
        try {
            $jenis_paramedis->update($validateData);
            return response()->json([
                'error' => false,
                'message' => 'Jenis Paramedis Updated!',
                'modal' => '#jp',
                'table' => '#jenis-paramedis'
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
    public function destroy(JenisParamedis $jenis_paramedis)
    {
        try {
            $jenis_paramedis->delete();
            return response()->json([
                'error' => false,
                'message' => 'Jenis Paramedis Deleted!',
                'table' => '#jenis-paramedis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}
