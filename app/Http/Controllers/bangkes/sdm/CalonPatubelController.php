<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatubelRequest;
use App\Models\Dokter;
use App\Models\JenisParamedis;
use App\Models\KategoriDokter;
use App\Models\Paramedis;
use App\Models\Patubel;
use App\Services\PatubelService;
use Illuminate\Http\Request;

class CalonPatubelController extends Controller
{
    public function index()
    {
        $active_menu = 'patubel';
        return view('bangkes.subbid_sdm.pendidikan.patubel.index', compact('active_menu'));
    }

    public function create()
    {
        $kat_dok = KategoriDokter::select('id_kategori_dokter as id', 'nama_kategori as nama')->get();
        $jenis_param = JenisParamedis::select('id_jenis_paramedis as id', 'nama_jenis_paramedis as nama')->get();

        $kategori = array_merge($kat_dok->toArray(), $jenis_param->toArray());

        $data = [
            'active_menu' => 'patubel',
            'nakes' => PatubelService::get_nakes(),
            'kategori' => $kategori
        ];

        return view('bangkes.subbid_sdm.pendidikan.patubel.create', $data);
    }

    public function edit(Patubel $patubel)
    {
        $active_menu = 'patubel';
        $nakes = PatubelService::detail_nakes($patubel->id_nakes, $patubel->ket_peserta);

        $patubel['tmt_date_awal'] = indonesian_date_format($patubel->tmt_awal);
        $patubel['tmt_date_akhir'] = indonesian_date_format($patubel->tmt_akhir);

        return view('bangkes.subbid_sdm.pendidikan.patubel.edit', compact('active_menu', 'nakes', 'patubel'));
    }

    public function get_nakes(Request $request)
    {
        $nakes =  collect(PatubelService::get_nakes());
        return $nakes->where('id_nakes', $request->id_nakes)->first();
    }

    public function store(PatubelRequest $request)
    {
        PatubelService::store_check($request);
        return response()->json([
            'error' => false,
            'message' => 'Calon Patubel Created!',
            'url' => url('bangkes/calon-patubel')
        ]);
    }

    public function get(Request $request)
    {
        return PatubelService::calon_dataTable($request);
    }

    public function show(Patubel $patubel)
    {
        $patubel['tmt_date_awal'] = indonesian_date_format($patubel->tmt_awal);
        $patubel['tmt_date_akhir'] = indonesian_date_format($patubel->tmt_akhir);
        return $patubel;
    }

    public function update(PatubelRequest $request, Patubel $patubel)
    {
        PatubelService::update_status_calon($request, $patubel);

        return response()->json([
            'error' => false,
            'message' => 'Patubel Updated!',
            'url' => url('bangkes/calon-patubel')
        ]);
    }

    public function destroy(Patubel $patubel)
    {
        PatubelService::destroy($patubel);
        return response()->json([
            'error' => false,
            'message' => 'Calon Patubel Deleted!',
            'table' => '#patubel'
        ]);
    }

    public function detail($id_nakes, $ket_peserta)
    {
        $active_menu = 'patubel';
        $nakes = PatubelService::detail_nakes($id_nakes, $ket_peserta);

        return view('bangkes.subbid_sdm.pendidikan.patubel.detail', compact('active_menu', 'nakes', 'id_nakes'));
    }

    public function get_patubel_nakes($id_nakes)
    {
        return PatubelService::dataTable_patubel_nakes($id_nakes);
    }
}
