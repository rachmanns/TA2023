<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenyakitRequest;
use App\Models\Penyakit;
use App\Services\PenyakitService;

class PenyakitController extends Controller
{
    public function index()
    {
        $active_menu = 'penyakit';
        return view('yankesin.penyakit.index', compact('active_menu'));
    }

    public function store(PenyakitRequest $request)
    {
        PenyakitService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Penyakit Created!',
            'modal' => '#pm',
            'table' => '#penyakit'
        ]);
    }

    public function get()
    {
        return PenyakitService::dataTable();
    }

    public function show(Penyakit $penyakit)
    {
        return $penyakit;
    }

    public function update(PenyakitRequest $request, Penyakit $penyakit)
    {
        PenyakitService::update($request, $penyakit);
        return response()->json([
            'error' => false,
            'message' => 'Penyakit Updated!',
            'modal' => '#pm',
            'table' => '#penyakit'
        ]);
    }

    public function destroy(Penyakit $penyakit)
    {
        PenyakitService::destroy($penyakit);
        return response()->json([
            'error' => false,
            'message' => 'Penyakit Deleted!',
            'table' => '#penyakit'
        ]);
    }
}
