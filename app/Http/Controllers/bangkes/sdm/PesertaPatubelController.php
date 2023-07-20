<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatubelRequest;
use App\Models\Patubel;
use App\Services\PatubelService;
use Illuminate\Http\Request;

class PesertaPatubelController extends Controller
{
    public function index()
    {
        $active_menu = 'sprin_patubel';
        $status = [
            'belum lulus' => 'Belum Lulus',
            'lulus' => 'Lulus',
            'tidak lulus' => 'Tidak Lulus',
        ];
        return view('bangkes.subbid_sdm.pendidikan.sprin_patubel.index', compact('active_menu', 'status'));
    }

    public function get(Request $request)
    {
        return PatubelService::peserta_dataTable($request);
    }

    public function edit(Patubel $patubel)
    {
        $active_menu = 'sprin_patubel';
        $nakes =  collect(PatubelService::get_nakes());
        $nakes = $nakes->where('id_nakes', $patubel->id_nakes)->first();
        $patubel['tmt_date_awal'] = indonesian_date_format($patubel->tmt_awal);
        $patubel['tmt_date_akhir'] = indonesian_date_format($patubel->tmt_akhir);

        return view('bangkes.subbid_sdm.pendidikan.sprin_patubel.edit', compact('active_menu', 'nakes',  'patubel'));
    }

    public function update(PatubelRequest $request, Patubel $patubel)
    {
        PatubelService::update($request, $patubel);
        return response()->json([
            'error' => false,
            'message' => 'Peserta Patubel Updated!',
            'url' => url('bangkes/peserta-patubel')
        ]);
    }

    public function destroy(Patubel $patubel)
    {
        PatubelService::destroy($patubel);
        return response()->json([
            'error' => false,
            'message' => 'Peserta Patubel Deleted!',
            'table' => '#sprin'
        ]);
    }
}
