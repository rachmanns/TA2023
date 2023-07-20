<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\TandaJasaRequest;
use App\Models\TandaJasa;
use App\Models\TandaJasaPers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TandaJasaController extends Controller
{
    public function index()
    {
        $active_menu = 'master_tanda_jasa';
        return view('bidum.master.tanda_jasa.index', compact('active_menu'));
    }

    public function store(TandaJasaRequest $request)
    {
        try {
            TandaJasa::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Created!',
                'modal' => '#create_tanda_jasa_modal',
                'table' => '#tanda-jasa-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(TandaJasa $tanda_jasa)
    {
        return $tanda_jasa;
    }

    public function update(Request $request, TandaJasa $tanda_jasa)
    {
        $validatedData = $request->validate([
            'nama_jasa' => 'required',
            'keterangan' => 'required'
        ]);
        try {
            $tanda_jasa->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Updated!',
                'modal' => '#edit_tanda_jasa_modal',
                'table' => '#tanda-jasa-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function destroy(TandaJasa $tanda_jasa)
    {
        try {
            TandaJasaPers::where('id_jasa', $tanda_jasa->id_jasa)->delete();
            $tanda_jasa->delete();
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Deleted!',
                'table' => '#tanda-jasa-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function list()
    {
        $tanda_jasa = TandaJasa::all();
        return DataTables::of($tanda_jasa)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_jasa . '" onclick="edit_tanda_jasa($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jasa . '" data-url="' . url('master/tanda-jasa/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
