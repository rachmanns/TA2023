<?php

namespace App\Http\Controllers\dukkesops\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeografisRequest;
use App\Models\Geografis;
use App\Services\GeografisService;
use Illuminate\Http\Request;

class GeografisController extends Controller
{
    public function index()
    {
        $active_menu = 'geografis';
        return view('dukkesops.geografis.index', compact(
            'active_menu'
        ));
    }

    public function get()
    {
        return GeografisService::dataTable();
    }

    public function show(Geografis $geografis)
    {
        return $geografis;
    }

    public function store(GeografisRequest $request)
    {
        GeografisService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Geografis Created!',
            'modal' => '#gm',
            'table' => '#geografis'
        ]);
    }

    public function update(GeografisRequest $request, Geografis $geografis)
    {
        GeografisService::update($request, $geografis);

        return response()->json([
            'error' => false,
            'message' => 'Geografis Updated!',
            'modal' => '#gm',
            'table' => '#geografis'
        ]);
    }

    public function destroy(Geografis $geografis)
    {
        GeografisService::destroy($geografis);

        return response()->json([
            'error' => false,
            'message' => 'Geografis Delete!',
            'modal' => '#gm',
            'table' => '#geografis'
        ]);
    }
}
