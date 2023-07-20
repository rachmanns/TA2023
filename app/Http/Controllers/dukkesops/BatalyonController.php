<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\BatalyonRequest;
use App\Models\Batalyon;
use App\Services\BatalyonService;
use Illuminate\Http\Request;

class BatalyonController extends Controller
{
    public function index()
    {
        $active_menu = 'batalyon';
        return view('dukkesops.batalyon.index', compact(
            'active_menu'
        ));
    }

    public function get()
    {
        return BatalyonService::dataTable();
    }

    public function show(Batalyon $batalyon)
    {
        return $batalyon;
    }

    public function store(BatalyonRequest $request)
    {
        BatalyonService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Batalyon Created!',
            'modal' => '#batalyon-modal',
            'table' => '#batalyon'
        ]);
    }

    public function update(BatalyonRequest $request, Batalyon $batalyon)
    {
        BatalyonService::update($request, $batalyon);

        return response()->json([
            'error' => false,
            'message' => 'Batalyon Updated!',
            'modal' => '#batalyon-modal',
            'table' => '#batalyon'
        ]);
    }

    public function destroy(Batalyon $batalyon)
    {
        BatalyonService::destroy($batalyon);

        return response()->json([
            'error' => false,
            'message' => 'Batalyon Delete!',
            'modal' => '#batalyon-modal',
            'table' => '#batalyon'
        ]);
    }
}
