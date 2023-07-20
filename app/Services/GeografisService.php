<?php

namespace App\Services;

use App\Http\Requests\GeografisRequest;
use App\Models\Geografis;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class GeografisService
{
    public static function dataTable(): JsonResponse
    {
        $geografis = Geografis::get();
        return DataTables::of($geografis)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_geografis . '" onclick="edit_geografis($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_geografis . '" data-url="' . url('dukkesops/geografis') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(GeografisRequest $request): Geografis
    {
        return Geografis::create($request->validated());
    }

    public static function update(GeografisRequest $request, Geografis $geografis): Geografis
    {
        $geografis->update($request->validated());
        return $geografis;
    }

    public static function destroy(Geografis $geografis): bool
    {
        return $geografis->deleteOrFail();
    }
}
