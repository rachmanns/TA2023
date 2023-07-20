<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PelatihanBangkesRequest;
use App\Models\JenisPelatihan;
use App\Models\PelatihanBangkes;
use App\Services\PelatihanBangkesService;
use Illuminate\Http\Request;

class PelatihanBangkesController extends Controller
{
    public function index()
    {
        $active_menu = 'pelatihan';
        return view('bangkes.subbid_sdm.pelatihan.index', compact('active_menu'));
    }

    public function create()
    {
        $active_menu = 'pelatihan';
        $jenis_pelatihan = JenisPelatihan::get();
        return view('bangkes.subbid_sdm.pelatihan.create', compact('active_menu', 'jenis_pelatihan'));
    }

    public function store(PelatihanBangkesRequest $request)
    {
        PelatihanBangkesService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Pelatihan Created!',
            'url' => url('bangkes/pelatihan')
        ]);
    }

    public function get(Request $request)
    {
        return PelatihanBangkesService::dataTable($request);
    }

    public function show(PelatihanBangkes $pelatihan_bangkes)
    {
        $active_menu = 'pelatihan';
        $pelatihan_bangkes = $pelatihan_bangkes->load('jenis_pelatihan');
        return view('bangkes.subbid_sdm.pelatihan.detail_pelatihan', compact('active_menu', 'pelatihan_bangkes'));
    }

    public function edit(PelatihanBangkes $pelatihan_bangkes)
    {
        $active_menu = 'pelatihan';
        $jenis_pelatihan = JenisPelatihan::get();
        return view('bangkes.subbid_sdm.pelatihan.create', compact('active_menu', 'jenis_pelatihan', 'pelatihan_bangkes'));
    }

    public function update(PelatihanBangkesRequest $request, PelatihanBangkes $pelatihan_bangkes)
    {
        PelatihanBangkesService::update($request, $pelatihan_bangkes);
        return response()->json([
            'error' => false,
            'message' => 'Pelatihan Updated!',
            'url' => url('bangkes/pelatihan')
        ]);
    }

    public function destroy(PelatihanBangkes $pelatihan_bangkes)
    {
        PelatihanBangkesService::destroy($pelatihan_bangkes);
        return response()->json([
            'error' => false,
            'message' => 'Pelatihan Deleted!',
            'table' => '#pelatihan'
        ]);
    }
}
