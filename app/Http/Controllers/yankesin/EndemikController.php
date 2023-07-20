<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndemikRequest;
use App\Models\Endemik;
use App\Services\EndemikService;

class EndemikController extends Controller
{
    public function index()
    {
        $active_menu = 'endemik';
        return view('yankesin.endemik.index', compact('active_menu'));
    }

    public function store(EndemikRequest $request)
    {
        EndemikService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Endemik Created!',
            'modal' => '#em',
            'table' => '#endemik'
        ]);
    }

    public function get()
    {
        return EndemikService::dataTable();
    }

    public function show(Endemik $endemik)
    {
        return $endemik;
    }

    public function update(EndemikRequest $request, Endemik $endemik)
    {
        EndemikService::update($request, $endemik);
        return response()->json([
            'error' => false,
            'message' => 'Endemik Updated!',
            'modal' => '#em',
            'table' => '#endemik'
        ]);
    }

    public function destroy(Endemik $endemik)
    {
        EndemikService::destroy($endemik);
        return response()->json([
            'error' => false,
            'message' => 'Endemik Deleted!',
            'table' => '#endemik'
        ]);
    }
}
