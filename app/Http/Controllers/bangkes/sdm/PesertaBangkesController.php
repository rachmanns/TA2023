<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesertaBangkesRequest;
use App\Models\PesertaBangkes;
use App\Services\PesertaBangkesService;
use Illuminate\Http\Request;

class PesertaBangkesController extends Controller
{
    public function create($id_pelatihan_bangkes)
    {
        $active_menu = 'pelatihan';
        $matra = ['AD', 'AL', 'AU', 'Mabes TNI'];
        return view('bangkes.subbid_sdm.pelatihan.tambah_peserta', compact('active_menu', 'id_pelatihan_bangkes', 'matra'));
    }

    public function store(PesertaBangkesRequest $request)
    {
        PesertaBangkesService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Peserta Created!',
            'url' => url('bangkes/pelatihan') . '/' .  $request->id_pelatihan_bangkes
        ]);
    }

    public function get(Request $request)
    {
        return PesertaBangkesService::dataTable($request);
    }

    public function edit($id_pelatihan_bangkes, PesertaBangkes $peserta_bangkes)
    {
        $active_menu = 'pelatihan';
        $id_pelatihan_bangkes = $peserta_bangkes->id_pelatihan_bangkes;
        $matra = ['AD', 'AL', 'AU', 'Mabes TNI'];
        return view('bangkes.subbid_sdm.pelatihan.tambah_peserta', compact('active_menu', 'id_pelatihan_bangkes', 'matra', 'peserta_bangkes'));
    }

    public function update(PesertaBangkesRequest $request, PesertaBangkes $peserta_bangkes)
    {
        PesertaBangkesService::update($request, $peserta_bangkes);
        return response()->json([
            'error' => false,
            'message' => 'Peserta Updated!',
            'url' => url('bangkes/pelatihan') . '/' . $request->id_pelatihan_bangkes
        ]);
    }

    public function destroy(PesertaBangkes $peserta_bangkes)
    {
        PesertaBangkesService::destroy($peserta_bangkes);

        return response()->json([
            'error' => false,
            'message' => 'Peserta Deleted!',
            'table' => '#peserta'
        ]);
    }
}
