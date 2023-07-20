<?php

namespace App\Services;

use App\Http\Requests\KategoriFasilitasRequest;
use App\Models\KategoriFasilitas;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class KategoriFasilitasService
{
    public static function dataTable(): JsonResponse
    {
        $kategori_fasilitas = KategoriFasilitas::get();
        return DataTables::of($kategori_fasilitas)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_kategori . '" onclick="edit_kategori_fasilitas($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_kategori . '" data-url="' . url('yankesin/kategori-fasilitas') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(KategoriFasilitasRequest $request): KategoriFasilitas
    {
        return KategoriFasilitas::create($request->validated());
    }

    public static function update(KategoriFasilitasRequest $request, KategoriFasilitas $kategori_fasilitas): KategoriFasilitas
    {
        $kategori_fasilitas->update($request->validated());
        return $kategori_fasilitas;
    }

    public static function destroy(KategoriFasilitas $kategori_fasilitas): bool
    {
        return $kategori_fasilitas->deleteOrFail();
    }
}
