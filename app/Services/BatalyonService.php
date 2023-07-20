<?php

namespace App\Services;

use App\Http\Requests\BatalyonRequest;
use App\Models\Batalyon;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BatalyonService
{
    public static function dataTable(): JsonResponse
    {
        $batalyon = Batalyon::get();
        return DataTables::of($batalyon)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_batalyon . '" onclick="edit_batalyon($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_batalyon . '" data-url="' . url('dukkesops/batalyon') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(BatalyonRequest $request): Batalyon
    {
        return Batalyon::create($request->validated());
    }

    public static function update(BatalyonRequest $request, Batalyon $batalyon): Batalyon
    {
        $batalyon->update($request->validated());
        return $batalyon;
    }

    public static function destroy(Batalyon $batalyon): bool
    {
        return $batalyon->deleteOrFail();
    }
}
