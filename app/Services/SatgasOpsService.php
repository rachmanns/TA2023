<?php

namespace App\Services;

use App\Http\Requests\SatgasOpsRequest;
use App\Models\SatgasOps;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SatgasOpsService
{
    public static function dataTable(): JsonResponse
    {
        $satgas_ops = SatgasOps::get();
        return DataTables::of($satgas_ops)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_satgas_ops . '" onclick="edit_satgas_ops($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_satgas_ops . '" data-url="' . url('dukkesops/satgas-ops') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(SatgasOpsRequest $request): SatgasOps
    {
        return SatgasOps::create($request->validated());
    }

    public static function update(SatgasOpsRequest $request, SatgasOps $satgas_ops): SatgasOps
    {
        $satgas_ops->update($request->validated());
        return $satgas_ops;
    }

    public static function destroy(SatgasOps $satgas_ops): bool
    {
        return $satgas_ops->deleteOrFail();
    }
}
