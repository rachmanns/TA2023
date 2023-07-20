<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Models\Patubel;
use App\Services\DokterService;
use App\Services\InternshipService;
use App\Services\ParamedisService;
use App\Services\PatubelService;
use App\Services\PelatihanBangkesService;
use App\Services\PesertaBangkesService;
use Illuminate\Http\Request;

class DashboardSdmController extends Controller
{
    public function index()
    {
        $data = [
            'active_menu' => 'dashboard_sdm',
            'dokter_by_kategori' => DokterService::dokter_chart_by_kategori(),
            'count_dokter' => DokterService::count_dokter(),
            'count_paramedis' => ParamedisService::count_paramedis(),
            'paramedis_by_jenis' => ParamedisService::paramedis_chart_by_jenis(),
            'count_jenis_pelatihan' => PelatihanBangkesService::get_count_jenis_pelatihan(),
            'count_internship' => InternshipService::count_internship(),
            'peserta_bangkes_by_jenis' => PesertaBangkesService::peserta_bangkes_chart_by_jenis(),
            'peserta_bangkes_by_matra' => PesertaBangkesService::peserta_bangkes_chart_by_matra(),
            'semester' => Patubel::select('tahun_ajaran')->distinct()->get(),
            'dokter_by_rs' => DokterService::count_dokter_by_rs(),
            'paramedis_by_rs' => ParamedisService::count_paramedis_by_rs()
        ];

        return view('bangkes.subbid_sdm.dashboard_sdm', $data);
    }

    public function count_patubel(Request $request)
    {
        return PatubelService::count_patubel($request);
    }
}
