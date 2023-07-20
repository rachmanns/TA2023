<?php

namespace App\Services;

use App\Http\Requests\EndemikRequest;
use App\Models\Endemik;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class EndemikService
{
    public static function store(EndemikRequest $request): Endemik
    {
        return Endemik::create($request->validated());
    }

    public static function dataTable(): JsonResponse
    {
        $endemik = Endemik::get();
        return DataTables::of($endemik)
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $row->id_endemik . '" onclick="edit_endemik($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $row->id_endemik . '" data-url="' . url('yankesin/endemik') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(EndemikRequest $request, Endemik $endemik): Endemik
    {
        $endemik->update($request->validated());
        return $endemik;
    }

    public static function destroy(Endemik $endemik): bool
    {
        return $endemik->deleteOrFail();
    }
}
