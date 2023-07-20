<?php

namespace App\Http\Controllers\bangkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisSpesialisRequest;
use App\Models\JenisSpesialis;
use App\Models\KategoriDokter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisSpesialisController extends Controller
{
    public function index()
    {
        $active_menu = 'spesialis';
        $kategori_dokter = KategoriDokter::select('id_kategori_dokter', 'nama_kategori')->whereNotIn('id_kategori_dokter', [1, 3])->get();
        return view('bangkes.master_data.spesialis.index', compact('active_menu', 'kategori_dokter'));
    }

    public function list()
    {
        $jenis_spesialis = JenisSpesialis::with('kategori_dokter')->whereHas('kategori_dokter', function (Builder $query) {
            $query->whereNotIn('id_kategori_dokter', [1, 3]);
        })->get();
        return DataTables::of($jenis_spesialis)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_spesialis . '" onclick="edit_jenis_spesialis($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_spesialis . '" data-url="' . url('bangkes/jenis-spesialis') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(JenisSpesialisRequest $request)
    {
        try {
            JenisSpesialis::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jenis Spesialis Created!',
                'modal' => '#spesialis',
                'table' => '#jenis-spesialis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(JenisSpesialis $jenis_spesialis)
    {
        return $jenis_spesialis;
    }

    public function update(JenisSpesialisRequest $request, JenisSpesialis $jenis_spesialis)
    {
        try {
            $jenis_spesialis->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jenis Spesialis Updated!',
                'modal' => '#spesialis',
                'table' => '#jenis-spesialis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(JenisSpesialis $jenis_spesialis)
    {
        try {
            $jenis_spesialis->delete();
            return response()->json([
                'error' => false,
                'message' => 'Jenis Spesialis Deleted!',
                'table' => '#jenis-spesialis'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}
