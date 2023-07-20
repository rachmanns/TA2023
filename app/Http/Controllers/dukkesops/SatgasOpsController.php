<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\SatgasOpsRequest;
use App\Models\SatgasOps;
use App\Services\SatgasOpsService;

class SatgasOpsController extends Controller
{
    public function index()
    {
        $active_menu = 'satgas_ops';
        return view('dukkesops.satgas_ops.index', compact(
            'active_menu'
        ));
    }

    public function get()
    {
        return SatgasOpsService::dataTable();
    }

    public function show(SatgasOps $satgas_ops)
    {
        return $satgas_ops;
    }

    public function store(SatgasOpsRequest $request)
    {
        SatgasOpsService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Satgas Ops Created!',
            'modal' => '#so',
            'table' => '#satgas-ops'
        ]);
    }

    public function update(SatgasOpsRequest $request, SatgasOps $satgas_ops)
    {
        SatgasOpsService::update($request, $satgas_ops);

        return response()->json([
            'error' => false,
            'message' => 'Satgas Ops Updated!',
            'modal' => '#so',
            'table' => '#satgas-ops'
        ]);
    }

    public function destroy(SatgasOps $satgas_ops)
    {
        SatgasOpsService::destroy($satgas_ops);

        return response()->json([
            'error' => false,
            'message' => 'Satgas Ops Delete!',
            'modal' => '#so',
            'table' => '#satgas-ops'
        ]);
    }
}
