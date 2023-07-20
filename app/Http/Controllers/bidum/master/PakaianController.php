<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\PakaianRequest;
use App\Models\Pakaian;
use App\Models\PakaianPersonil;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PakaianController extends Controller
{
    public function index()
    {
        $active_menu = 'master_pakaian';
        return view('bidum.master.pakaian.index', compact('active_menu'));
    }

    public function store(PakaianRequest $request)
    {
        try {
            Pakaian::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Pakaian Created!',
                'modal' => '#create_pakaian_modal',
                'table' => '#pakaian-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Pakaian $pakaian)
    {
        return $pakaian;
    }

    public function update(PakaianRequest $request, Pakaian $pakaian)
    {
        try {
            $pakaian->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Pakaian Updated!',
                'modal' => '#edit_pakaian_modal',
                'table' => '#pakaian-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Pakaian $pakaian)
    {
        try {
            PakaianPersonil::where('id_pakaian', $pakaian->id_pakaian)->delete();
            $pakaian->delete();
            return response()->json([
                'error' => false,
                'message' => 'Pakaian Deleted!',
                'table' => '#pakaian-table'
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
        $pakaian = Pakaian::all();
        return DataTables::of($pakaian)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_pakaian . '" onclick="edit_pakaian($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_pakaian . '" data-url="' . url('master/pakaian/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
