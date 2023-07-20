<?php

namespace App\Services;

use App\Http\Requests\RSPemdaSwastaRequest;
use App\Models\RSPemdaSwasta;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class RSPemdaSwastaService
{
    public static function index()
    {
        # code...
    }

    public static function dataTable(): JsonResponse
    {
        $rs_pemda_swasta = RSPemdaSwasta::get();
        return DataTables::of($rs_pemda_swasta)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_rs_pem_swas . '" onclick="edit_rs_pemda_swasta($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_rs_pem_swas . '" data-url="' . url('dukkesops/rs') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(RSPemdaSwastaRequest $request): RSPemdaSwasta
    {
        return RSPemdaSwasta::create($request->validated());
    }

    public static function destroy(RSPemdaSwasta $rs_pemda_swasta): bool
    {
        return $rs_pemda_swasta->deleteOrFail();
    }

    public static function update(RSPemdaSwastaRequest $request, RSPemdaSwasta $rs_pemda_swasta): RSPemdaSwasta
    {
        $rs_pemda_swasta->update($request->validated());
        return $rs_pemda_swasta;
    }
}
