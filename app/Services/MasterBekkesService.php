<?php

namespace App\Services;

use App\Http\Requests\MasterBekkesRequest;
use App\Models\MasterBekkes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterBekkesService
{
    public static function dataTable(): JsonResponse
    {
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get();
        return DataTables::of($master_bekkes)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_mas_bek . '" onclick="edit_master_bekkes($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_mas_bek . '" data-url="' . url('dukkesops/master-bekkes') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(MasterBekkesRequest $request): MasterBekkes
    {
        return MasterBekkes::create($request->validated());
    }

    public static function update(MasterBekkesRequest $request, MasterBekkes $master_bekkes): MasterBekkes
    {
        $master_bekkes->update($request->validated());
        return $master_bekkes;
    }

    public static function destroy(MasterBekkes $master_bekkes): bool
    {
        return $master_bekkes->deleteOrFail();
    }

    public static function update_urutan(Request $request): Collection
    {
        $count_urutan = count($request->urutan);

        for ($i = 0; $i < $count_urutan; $i++) {
            MasterBekkes::where('id_mas_bek', $request->urutan[$i])->update(['urutan' => $i + 1]);
        }

        return MasterBekkes::get();
    }
}
