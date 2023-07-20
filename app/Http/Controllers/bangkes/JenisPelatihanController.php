<?php

namespace App\Http\Controllers\bangkes;

use App\Http\Controllers\Controller;
use App\Services\JenisPelatihanService;
use App\Models\JenisPelatihan;
use Illuminate\Http\Request;

class JenisPelatihanController extends Controller
{
    public function index()
    {
        $active_menu = 'jenis_pelatihan';
        return view('bangkes.master_data.jenis_pelatihan.index', compact('active_menu'));
    }

    public function store(Request $request)
    {
        JenisPelatihanService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Jenis Pelatihan Created!',
            'modal' => '#jp',
            'table' => '#jenis-pelatihan'
        ]);
    }

    public function get()
    {
        return JenisPelatihanService::dataTable();
    }

    public function show(JenisPelatihan $jenis_pelatihan)
    {
        return $jenis_pelatihan;
    }

    public function update(Request $request, JenisPelatihan $jenis_pelatihan)
    {
        JenisPelatihanService::update($request, $jenis_pelatihan);
        return response()->json([
            'error' => false,
            'message' => 'Jenis Pelatihan Updated!',
            'modal' => '#jp',
            'table' => '#jenis-pelatihan'
        ]);
    }

    public function destroy(JenisPelatihan $jenis_pelatihan)
    {
        JenisPelatihanService::destroy($jenis_pelatihan);
        return response()->json([
            'error' => false,
            'message' => 'Jenis Pelatihan Deleted!',
            'table' => '#jenis-pelatihan'
        ]);
    }
}
