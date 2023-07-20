<?php

namespace App\Services;

use App\Http\Requests\FasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class FasilitasService
{
    public static function dataTable(): JsonResponse
    {
        $fasilitas = Fasilitas::with('kategori_fasilitas')->get();
        return DataTables::of($fasilitas)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_fasilitas . '" onclick="edit_fasilitas($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_fasilitas . '" data-url="' . url('yankesin/fasilitas') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(FasilitasRequest $request): Fasilitas
    {
        return Fasilitas::create($request->validated());
    }

    public static function update(FasilitasRequest $request, Fasilitas $fasilitas): Fasilitas
    {
        $fasilitas->update($request->validated());
        return $fasilitas;
    }

    public static function destroy(Fasilitas $fasilitas): bool
    {
        return $fasilitas->deleteOrFail();
    }
}
