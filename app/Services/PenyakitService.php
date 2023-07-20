<?php

namespace App\Services;

use App\Http\Requests\PenyakitRequest;
use App\Models\Penyakit;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PenyakitService
{
    public static function store(PenyakitRequest $request): Penyakit
    {
        return Penyakit::create($request->validated());
    }

    public static function dataTable(): JsonResponse
    {
        $penyakit = Penyakit::get();
        return DataTables::of($penyakit)
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $row->id_penyakit . '" onclick="edit_penyakit($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $row->id_penyakit . '" data-url="' . url('yankesin/penyakit') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(PenyakitRequest $request, Penyakit $penyakit): Penyakit
    {
        $penyakit->update($request->validated());
        return $penyakit;
    }

    public static function destroy(Penyakit $penyakit): bool
    {
        return $penyakit->deleteOrFail();
    }
}
