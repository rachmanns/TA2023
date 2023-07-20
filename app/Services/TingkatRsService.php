<?php

namespace App\Services;

use App\Http\Requests\TingkatRsRequest;
use App\Models\TingkatRS;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class TingkatRsService
{
    public static function store(TingkatRsRequest $request): TingkatRS
    {

        return TingkatRS::create($request->validated());
    }

    public static function dataTable(): JsonResponse
    {
        $tingkat_rs = TingkatRS::get();
        return DataTables::of($tingkat_rs)
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $row->id_tingkat_rs . '" onclick="edit_tingkat_rs($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $row->id_tingkat_rs . '" data-url="' . url('yankesin/tingkat-rs') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(TingkatRsRequest $request, TingkatRS $tingkat_rs): TingkatRS
    {
        $tingkat_rs->update($request->validated());
        return $tingkat_rs;
    }

    public static function destroy(TingkatRS $tingkat_rs): bool
    {
        return $tingkat_rs->deleteOrFail();
    }
}
