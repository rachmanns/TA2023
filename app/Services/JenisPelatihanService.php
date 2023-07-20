<?php

namespace App\Services;

use App\Models\JenisPelatihan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisPelatihanService
{
    public static function store(Request $request): JenisPelatihan
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required'
        ]);

        return JenisPelatihan::create($validated);
    }

    public static function dataTable(): JsonResponse
    {
        $jenis_spesialis = JenisPelatihan::get();
        return DataTables::of($jenis_spesialis)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_jenis_pelatihan . '" onclick="edit_jenis_pelatihan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jenis_pelatihan . '" data-url="' . url('bangkes/jenis-pelatihan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(Request $request, JenisPelatihan $jenis_pelatihan)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required'
        ]);

        return $jenis_pelatihan->update($validated);
    }

    public static function destroy(JenisPelatihan $jenis_pelatihan)
    {
        return $jenis_pelatihan->delete();
    }
}
