<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\RSPemdaSwastaRequest;
use App\Models\RSPemdaSwasta;
use App\Services\RSPemdaSwastaService;
use Illuminate\Http\Request;

class RSPemdaSwastaController extends Controller
{
    public function index()
    {
        $active_menu = 'master_rs';
        return view('dukkesops.rumah_sakit.index', compact('active_menu'));
    }

    public function get()
    {
        return RSPemdaSwastaService::dataTable();
    }

    public function store(RSPemdaSwastaRequest $request)
    {
        RSPemdaSwastaService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'RS Created!',
            'modal' => '#add',
            'table' => '#rs'
        ]);
    }

    public function destroy(RSPemdaSwasta $rs_pemda_swasta)
    {
        RSPemdaSwastaService::destroy($rs_pemda_swasta);

        return response()->json([
            'error' => false,
            'message' => 'RS Deleted!',
            'table' => '#rs'
        ]);
    }

    public function show(RSPemdaSwasta $rs_pemda_swasta)
    {
        return $rs_pemda_swasta;
    }

    public function update(RSPemdaSwastaRequest $request, RSPemdaSwasta $rs_pemda_swasta)
    {
        RSPemdaSwastaService::update($request, $rs_pemda_swasta);
        return response()->json([
            'error' => false,
            'message' => 'RS Updated!',
            'modal' => '#add',
            'table' => '#rs'
        ]);
    }
}
