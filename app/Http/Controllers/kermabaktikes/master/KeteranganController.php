<?php

namespace App\Http\Controllers\kermabaktikes\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeteranganRequest;
use App\Models\Keterangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeteranganController extends Controller
{
    public function index()
    {
        $active_menu = 'master_keterangan';
        return view('kermabaktikes.master_data.keterangan', compact('active_menu'));
    }

    public function list()
    {
        $keterangan = Keterangan::get();
        return DataTables::of($keterangan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Detail" class="btn pr-0 text-primary" data-id="' . $query->id_keterangan . '" onclick="edit_keterangan($(this))"><i data-feather="file-text" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_keterangan . '" data-url="' . url('kerma/keterangan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'keterangan' => 'required',
        ]);
        try {
            Keterangan::create($requestData);
            return response()->json([
                'error' => false,
                'message' => 'Keterangan Created!',
                'modal' => '#tambah',
                'table' => '#keterangan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(Keterangan $keterangan)
    {
        return $keterangan;
    }

    public function update(Request $request, Keterangan $keterangan)
    {
        $requestData = $request->validate([
            'keterangan' => 'required',
        ]);
        try {
            $keterangan->update($requestData);
            return response()->json([
                'error' => false,
                'message' => 'Keterangan Updated!',
                'modal' => '#tambah',
                'table' => '#keterangan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Keterangan $keterangan)
    {
        try {
            $keterangan->delete();
            return response()->json([
                'error' => false,
                'message' => 'Keterangan Deleted!',
                'table' => '#keterangan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}
