<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\JabatanRequest;
use App\Models\Jabatan;
use App\Models\Personil;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function index()
    {
        $active_menu = 'master_jabatan';
        return view('bidum.master.jabatan.index', compact('active_menu'));
    }

    public function store(JabatanRequest $request)
    {
        try {
            Jabatan::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jabatan Created!',
                'modal' => '#create_jabatan_modal',
                'table' => '#jabatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Jabatan $jabatan)
    {
        return $jabatan;
    }

    public function update(JabatanRequest $request, Jabatan $jabatan)
    {
        try {
            $jabatan->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jabatan Updated!',
                'modal' => '#edit_jabatan_modal',
                'table' => '#jabatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Jabatan $jabatan)
    {
        try {
            RiwayatJabatan::where('id_jabatan', $jabatan->id_jabatan)->delete();

            $jabatan->delete();
            return response()->json([
                'error' => false,
                'message' => 'Jabatan Deleted!',
                'table' => '#jabatan-table'
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
        $jabatan = Jabatan::all();
        return DataTables::of($jabatan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_jabatan . '" onclick="edit_jabatan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jabatan . '" data-url="' . url('master/jabatan/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
