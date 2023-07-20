<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TingkatRsRequest;
use App\Models\TingkatRS;
use App\Services\TingkatRsService;

class TingkatRsController extends Controller
{
    public function index()
    {
        $active_menu = 'tingkat_rs';
        return view('yankesin.tingkat_rs.index', compact('active_menu'));
    }

    public function store(TingkatRsRequest $request)
    {
        TingkatRsService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Tingkat RS Created!',
            'modal' => '#tr',
            'table' => '#tingkat-rs'
        ]);
    }

    public function get()
    {
        return TingkatRsService::dataTable();
    }

    public function show(TingkatRS $tingkat_rs)
    {
        return $tingkat_rs;
    }

    public function update(TingkatRsRequest $request, TingkatRS $tingkat_rs)
    {
        TingkatRsService::update($request, $tingkat_rs);
        return response()->json([
            'error' => false,
            'message' => 'Tingkat RS Updated!',
            'modal' => '#tr',
            'table' => '#tingkat-rs'
        ]);
    }

    public function destroy(TingkatRS $tingkat_rs)
    {
        TingkatRsService::destroy($tingkat_rs);
        return response()->json([
            'error' => false,
            'message' => 'Tingkat RS Deleted!',
            'table' => '#tingkat-rs'
        ]);
    }
}
